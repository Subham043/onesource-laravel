<?php

namespace App\Modules\Notification\Services;

use App\Modules\Authentication\Models\User;
use App\Modules\Event\Models\Event;
use App\Modules\Notification\Jobs\SingleClientNotificationJob;
use App\Modules\Notification\Models\Notification;
use App\Modules\Notification\Models\NotificationLog;
use App\Modules\Notification\Models\Template;
use Carbon\Carbon;

class CronService
{

    public function __invoke()
    {
        $admins = User::with([
            'roles' => function($qry){
                $qry->where('name', 'Admin');
            }
        ])->whereHas('roles', function($qry){
            $qry->where('name', 'Admin');
        })->get();
        foreach ($admins as $key => $value) {
            $template = Template::where('created_by', $value->id)->first();
            $users = User::with([
                'roles' => function($qry){
                    $qry->whereIn('name', ['Writer', 'Client']);
                },
                'cron_member_profile_created_by_auth' => function($query) use($value){
                    $query->with(['tools', 'client'])->where('created_by', $value->id);
                },
            ])->whereHas('roles', function($qry){
                $qry->whereIn('name', ['Writer', 'Client']);
            })->whereHas('cron_member_profile_created_by_auth', function($qry) use($value){
                $qry->with(['tools', 'client'])->where('created_by', $value->id);
            })->get();
            $notifications = Notification::where('created_by', $value->id)->latest()->get();
            if($notifications->count()>0){
                foreach ($users as $user) {
                    if($user->current_role=='Writer'){
                        $this->sendWriterNotification($user, $template);
                    }
                    else{
                        $this->sendClientNotification($user, $template);
                    }
                }
                foreach ($notifications as $notification) {
                    NotificationLog::create([
                        'log' => $notification->label,
                        'created_by' => $notification->created_by
                    ]);
                }
            }

        }
    }

    public function sendWriterNotification($user, $template)
    {
        $date =  Carbon::today();
        $data = Event::with([
            'writers'=> function($qry) use($user){
                $qry->with('writer')->where('writer_id', $user->id);
            },
        ])->where('is_active', true)
        ->whereDate('end_date', '>=', $date->format('Y-m-d'))
        ->whereDate('start_date', '<=', $date->format('Y-m-d'))
        ->whereHas('writers', function($qry) use($user){
            $qry->where('writer_id', $user->id);
        })->get();

        $new_data = $data->filter(function($item) {
            if(!$item->is_recurring_event){
                return true;
            }
            return (in_array(Carbon::today()->format('Y-m-d')."T05:30:00.000Z", $item->event_repeated_date));
         });

        if($new_data->count()>0 && $template){
            dispatch(new SingleClientNotificationJob($user, $new_data, $template));
        }

    }

    public function sendClientNotification($user, $template)
    {
        $date =  Carbon::today();
        $data = Event::with([
            'client'=> function($qry) use($user){
                $qry->where('id',$user->cron_member_profile_created_by_auth->client->id);
            },
        ])->where('is_active', true)
        ->whereDate('end_date', '>=', $date->format('Y-m-d'))
        ->whereDate('start_date', '<=', $date->format('Y-m-d'))
        ->whereHas('client', function($qry) use($user){
            $qry->where('id', $user->cron_member_profile_created_by_auth->client->id);
        })->get();

        $new_data = $data->filter(function($item) {
            if(!$item->is_recurring_event){
                return true;
            }
            return (in_array(Carbon::today()->format('Y-m-d')."T05:30:00.000Z", $item->event_repeated_date));
         });

        if($new_data->count()>0 && $template){
            dispatch(new SingleClientNotificationJob($user, $new_data, $template));
        }

    }

}
