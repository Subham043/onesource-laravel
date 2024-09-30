<?php

namespace App\Modules\Notification\Services;

use App\Modules\Authentication\Models\User;
use App\Modules\Event\Models\Event;
use App\Modules\Notification\Jobs\SingleClientNotificationJob;
use App\Modules\Notification\Models\Notification;
use App\Modules\Notification\Models\NotificationLog;
use Carbon\Carbon;

class CronService
{

    protected function convertToDateTime($date, $time) {
        return Carbon::createFromFormat('M d Y h:i a', $date . ' ' . $time);
    }

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
            $notifications = Notification::where('created_by', $value->id)->latest()->get();
            foreach ($notifications as $notification) {
                $assigned_time = $this->convertToDateTime(now()->format("M d Y"), $notification->recurring_time->timezone($value->timezone ? strtok($value->timezone->value, " GMT") : "UTC")->format("h:i a"));
                $now_time = $this->convertToDateTime(now()->format("M d Y"), now()->timezone($value->timezone ? strtok($value->timezone->value, " GMT") : "UTC")->format("h:i a"));
                if(count($notification->notification_cron_date)>0 && $assigned_time==$now_time){
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
                    foreach ($users as $user) {
                        if($user->current_role=='Writer'){
                            $this->sendWriterNotification($user);
                        }
                        else{
                            $this->sendClientNotification($user);
                        }
                    }
                    NotificationLog::create([
                        'log' => $notification->label,
                        'created_by' => $notification->created_by
                    ]);
                }
            }
        }
    }

    public function sendWriterNotification($user)
    {
        $data = Event::with([
            'writers'=> function($qry) use($user){
                $qry->with('writer')->where('writer_id', $user->id);
            },
        ])->where('is_active', true)
        ->where(function($q){
            $q->where(function($q){
                $q->where('start_date', '<=', today())->where('end_date', '>=', today());
            })->orWhere(function($q){
                $q->where('start_date', '<=', today())->where('recurring_end_date', '>=', today());
            });
        })
        // ->whereDate('end_date', '>=', Carbon::today()->startOfMonth())
        // ->whereDate('start_date', '<=', Carbon::today()->endOfMonth())
        ->whereHas('writers', function($qry) use($user){
            $qry->where('writer_id', $user->id);
        })->get();

        $new_data = $data->filter(function($item) {
            if(!$item->is_recurring_event){
                return true;
            }
            return (in_array(Carbon::today()->format('Y-m-d')."T05:30:00.000Z", $item->event_repeated_date));
         });

        if($new_data->count()>0){
            dispatch(new SingleClientNotificationJob($user, $new_data));
        }

    }

    public function sendClientNotification($user)
    {
        $data = Event::with([
            'client'=> function($qry) use($user){
                $qry->where('id',$user->cron_member_profile_created_by_auth->client->id);
            },
        ])->where('is_active', true)
        ->whereDate('end_date', '>=', Carbon::today()->startOfMonth())
        ->whereDate('start_date', '<=', Carbon::today()->endOfMonth())
        ->whereHas('client', function($qry) use($user){
            $qry->where('id', $user->cron_member_profile_created_by_auth->client->id);
        })->get();

        $new_data = $data->filter(function($item) {
            if(!$item->is_recurring_event){
                return true;
            }
            return (in_array(Carbon::today()->format('Y-m-d')."T05:30:00.000Z", $item->event_repeated_date));
         });

        if($new_data->count()>0){
            dispatch(new SingleClientNotificationJob($user, $new_data));
        }

    }

}