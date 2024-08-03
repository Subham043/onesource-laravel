<?php

namespace App\Modules\Report\Conflict\Services;

use App\Modules\Event\Models\EventWriter;
use Carbon\Carbon;

class ConflictService{
    protected function convertToDateTime($date, $time) {
        return Carbon::createFromFormat('M d Y h:i a', $date . ' ' . $time);
    }

    protected function detectClashingEvents($events) {
        $clashes = [];
        
        foreach ($events as $i => $event1) {
            foreach ($events as $j => $event2) {
                if ($i !== $j && $event1['writer_id'] === $event2['writer_id']) {
                    if (($event1['start'] <= $event2['start'] && $event1['end'] > $event2['start']) ||
                        ($event1['start'] < $event2['end'] && $event1['end'] >= $event2['end'])) {
                        $clashes[] = [
                            'writer_id' => $event1['writer_id'],
                            'writer_name' => $event1['writer_name'],
                            'events' => [$event1, $event2],
                        ];
                    }
                }
            }
        }
        
        return $clashes;
    }

    public function getConflicts(){
        $data = EventWriter::with(['event', 'writer'])->whereHas('event', function($q){
            $q->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id);
        })->whereHas('writer')->get();

        $events = array();
        foreach($data as $item){
            if($item->event->is_recurring_event){
                if(count($item->event->event_repeated_date)>0){
                    foreach($item->event->event_repeated_date as $date){
                        array_push($events, array(
                            'event_id' => $item->event->id,
                            'event_name' => $item->event->name,
                            'event_date' => Carbon::parse($date)->format("M d Y"),
                            'event_start_time' => $item->event->start_time->format("h:i a"),
                            'event_end_time' => $item->event->end_time->format("h:i a"),
                            'writer_id' => $item->writer->id,
                            'writer_name' => $item->writer->name,
                            'start' => $this->convertToDateTime(Carbon::parse($date)->format("M d Y"), $item->event->start_time->format("h:i a")),
                            'end' => $this->convertToDateTime(Carbon::parse($date)->format("M d Y"), $item->event->end_time->format("h:i a"))
                        ));
                    }
                }
            }else{
                array_push($events, array(
                    'event_id' => $item->event->id,
                    'event_name' => $item->event->name,
                    'event_date' => Carbon::parse($item->event->start_date)->format("M d Y"),
                    'event_start_time' => $item->event->start_time->format("h:i a"),
                    'event_end_time' => $item->event->end_time->format("h:i a"),
                    'writer_id' => $item->writer->id,
                    'writer_name' => $item->writer->name,
                    'start' => $this->convertToDateTime(Carbon::parse($item->event->start_date)->format("M d Y"), $item->event->start_time->format("h:i a")),
                    'end' => $this->convertToDateTime(Carbon::parse($item->event->start_date)->format("M d Y"), $item->event->end_time->format("h:i a"))
                ));
            }
        }

        $clashingEvents = $this->detectClashingEvents($events);
        return $clashingEvents;
    }
}