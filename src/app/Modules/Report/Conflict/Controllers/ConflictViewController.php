<?php

namespace App\Modules\Report\Conflict\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Document\Models\DocumentNotification;
use App\Modules\Event\Services\EventService;
use Carbon\Carbon;

class ConflictViewController extends Controller
{
    private $eventService;

    public function __construct(EventService $eventService)
    {
        $this->middleware('permission:view conflicts', ['only' => ['get','post']]);
        $this->eventService = $eventService;
    }

    public function get(){
        $data = $this->eventService->allConflict();
        $filtered = $data->filter(function($item){
            return $item->writerEvents->count()>=2;
        });

        $events = array();
        foreach($filtered as $item){
            $writer_events = array();
            foreach($item->writerEvents as $k => $val){
                $conflict_type = count(array_unique($item->writerEvents->pluck("event.created_by")->toArray(), SORT_REGULAR)) === 1 ? "Internal" : "External";
                if($val->event->is_recurring_event){
                    if(count($val->event->event_repeated_date)>0){
                        foreach($val->event->event_repeated_date as $date){
                            array_push($writer_events, array(
                                'event_id' => $val->event->id,
                                'event_name' => $val->event->name,
                                'event_date' => Carbon::parse($date)->format("M d Y"),
                                'event_start_time' => $val->event->start_time->format("h:i a"),
                                'event_end_time' => $val->event->end_time->format("h:i a"),
                                'event_conflict_writer' => array_unique($val->event->writers->pluck('writer.name')->toArray()),
                            ));
                        }
                    }
                }else{
                    array_push($writer_events, array(
                        'event_id' => $val->event->id,
                        'event_name' => $val->event->name,
                        'event_date' => $val->event->start_date->format("M d Y"),
                        'event_start_time' => $val->event->start_time->format("h:i a"),
                        'event_end_time' => $val->event->end_time->format("h:i a"),
                        'event_conflict_writer' => array_unique($val->event->writers->pluck('writer.name')->toArray()),
                    ));
                }
                // $events[$item->id] = $writer_events;
            }
            $res = array();
            foreach ($writer_events as $eve) {
                $res[$eve['event_date']][] = $eve;
            }
            $result = array_filter($res, function ($value) {
                return count($value) > 1;
            });
            array_push($events, array(
                'writer_id' => $item->id,
                'writer_name' => $item->name,
                'conflict_type' => $conflict_type,
                'events' => $result
            ));
        }
        $final = array_filter($events, function ($value) {
            return count($value['events']) > 1;
        });
        // return $final;
        return view('reports.conflict')->with([
            'page_name' => 'Conflict',
            'notifications' => DocumentNotification::filterByRoles()->latest()->limit(4)->get(),
            'data' => $final,
        ]);
    }
}