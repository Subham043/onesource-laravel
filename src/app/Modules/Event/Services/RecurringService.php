<?php

namespace App\Modules\Event\Services;

use App\Enums\RecurringInnerType;
use App\Enums\RecurringType;
use App\Modules\Event\Models\Event;
use Carbon\Carbon;

class RecurringService
{

    protected function isWeekend($date) {
        $weekDay = date('w', strtotime($date));
        return ($weekDay == 0 || $weekDay == 6);
    }

    protected function isDayOfWeek($date, $day) {
        $weekDay = date('D', strtotime($date));
        return ($weekDay == $day);
    }

    public function eventRepeatedDate(Event $event)
    {
        $data_arr = [];
        if($event->is_recurring_event){
            $start_date_event = $event->start_date;
            $end_date_event = $event->recurring_end_date;
            if($event->recurring_type==RecurringType::DAILY){
                if($event->recurring_daily_type==RecurringInnerType::FIRST){
                    array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                }else{
                    if(!$this->isWeekend($start_date_event)){
                        array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                    }
                }
            }elseif($event->recurring_type==RecurringType::WEEKLY){
                $week_date_event = $start_date_event;
                $weekDay = date('D', strtotime($week_date_event));
                switch ($weekDay) {
                    case 'Sun':
                        # code...
                        $day = 1;
                        break;
                    case 'Mon':
                        # code...
                        $day = 2;
                        break;
                    case 'Tue':
                        # code...
                        $day = 3;
                        break;
                    case 'Wed':
                        # code...
                        $day = 4;
                        break;
                    case 'Thu':
                        # code...
                        $day = 5;
                        break;
                    case 'Fri':
                        # code...
                        $day = 6;
                        break;
                    case 'Sat':
                        # code...
                        $day = 7;
                        break;

                    default:
                        # code...
                        $day = 1;
                        break;
                }
                while($day<=7 && $week_date_event <= $end_date_event){
                    if($event->recurring_weekly_sunday && $this->isDayOfWeek($start_date_event, 'Sun')){
                        array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                    }elseif($event->recurring_weekly_monday && $this->isDayOfWeek($start_date_event, 'Mon')){
                        array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                    }elseif($event->recurring_weekly_tuesday && $this->isDayOfWeek($start_date_event, 'Tue')){
                        array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                    }elseif($event->recurring_weekly_wednesday && $this->isDayOfWeek($start_date_event, 'Wed')){
                        array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                    }elseif($event->recurring_weekly_thursday && $this->isDayOfWeek($start_date_event, 'Thu')){
                        array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                    }elseif($event->recurring_weekly_friday && $this->isDayOfWeek($start_date_event, 'Fri')){
                        array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                    }elseif($event->recurring_weekly_saturday && $this->isDayOfWeek($start_date_event, 'Sat')){
                        array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                    }
                    $week_date_event->addDays(1);
                    $day++;
                }
            }elseif($event->recurring_type==RecurringType::MONTHLY){
                if($event->recurring_monthly_type==RecurringInnerType::FIRST){
                    array_push($data_arr, $start_date_event->format('Y-m').'-'.($event->recurring_monthly_first_days<10 ? '0'.$event->recurring_monthly_first_days : $event->recurring_monthly_first_days).'T05:30:00.000Z');
                }else{
                    switch ($start_date_event->format('m')) {
                        case '1':
                        case 1:
                            # code...
                            $carbonDate = new Carbon($event->recurring_monthly_second_type->value.' '.$event->recurring_monthly_second_days->value.' of January '.$start_date_event->format('Y'));
                            array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                            break;
                        case '2':
                        case 2:
                            # code...
                            $carbonDate = new Carbon($event->recurring_monthly_second_type->value.' '.$event->recurring_monthly_second_days->value.' of February '.$start_date_event->format('Y'));
                            array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                            break;
                        case '3':
                        case 3:
                            # code...
                            $carbonDate = new Carbon($event->recurring_monthly_second_type->value.' '.$event->recurring_monthly_second_days->value.' of March '.$start_date_event->format('Y'));
                            array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                            break;
                        case '4':
                        case 4:
                            # code...
                            $carbonDate = new Carbon($event->recurring_monthly_second_type->value.' '.$event->recurring_monthly_second_days->value.' of April '.$start_date_event->format('Y'));
                            array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                            break;
                        case '5':
                        case 5:
                            # code...
                            $carbonDate = new Carbon($event->recurring_monthly_second_type->value.' '.$event->recurring_monthly_second_days->value.' of May '.$start_date_event->format('Y'));
                            array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                            break;
                        case '6':
                        case 6:
                            # code...
                            $carbonDate = new Carbon($event->recurring_monthly_second_type->value.' '.$event->recurring_monthly_second_days->value.' of June '.$start_date_event->format('Y'));
                            array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                            break;
                        case '7':
                        case 7:
                            # code...
                            $carbonDate = new Carbon($event->recurring_monthly_second_type->value.' '.$event->recurring_monthly_second_days->value.' of July '.$start_date_event->format('Y'));
                            array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                            break;
                        case '8':
                        case 8:
                            # code...
                            $carbonDate = new Carbon($event->recurring_monthly_second_type->value.' '.$event->recurring_monthly_second_days->value.' of August '.$start_date_event->format('Y'));
                            array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                            break;
                        case '9':
                        case 9:
                            # code...
                            $carbonDate = new Carbon($event->recurring_monthly_second_type->value.' '.$event->recurring_monthly_second_days->value.' of September '.$start_date_event->format('Y'));
                            array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                            break;
                        case '10':
                        case 10:
                            # code...
                            $carbonDate = new Carbon($event->recurring_monthly_second_type->value.' '.$event->recurring_monthly_second_days->value.' of October '.$start_date_event->format('Y'));
                            array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                            break;
                        case '11':
                        case 11:
                            # code...
                            $carbonDate = new Carbon($event->recurring_monthly_second_type->value.' '.$event->recurring_monthly_second_days->value.' of November '.$start_date_event->format('Y'));
                            array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                            break;
                        case '12':
                        case 12:
                            # code...
                            $carbonDate = new Carbon($event->recurring_monthly_second_type->value.' '.$event->recurring_monthly_second_days->value.' of December '.$start_date_event->format('Y'));
                            array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                            break;
                    }
                }
            }elseif($event->recurring_type==RecurringType::YEARLY){
                if($start_date_event->format('m')==$event->recurring_yearly_months->value && $start_date_event->format('d')==($event->recurring_yearly_days<10 ? '0'.$event->recurring_yearly_days : $event->recurring_yearly_days)){
                    array_push($data_arr, $start_date_event->format('Y').'-'.($event->recurring_yearly_months->value<10 ? '0'.$event->recurring_yearly_months->value : $event->recurring_yearly_months->value).'-'.($event->recurring_yearly_days<10 ? '0'.$event->recurring_yearly_days : $event->recurring_yearly_days).'T05:30:00.000Z');
                }
            }
            while($start_date_event <= $end_date_event) {
                if($event->recurring_type==RecurringType::DAILY){
                    if($event->recurring_daily_type==RecurringInnerType::FIRST){
                        $start_date_event = $start_date_event->addDays($event->recurring_daily_days);
                        array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                    }else{
                        $start_date_event = $start_date_event->addDays(1);
                        if(!$this->isWeekend($start_date_event)){
                            array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                        }
                    }
                }elseif($event->recurring_type==RecurringType::WEEKLY){
                    $day = 1;
                    if($event->recurring_weekly_weeks!=1){
                        $start_date_event = $start_date_event->addWeeks($event->recurring_weekly_weeks);
                    }
                    $week_date_event = $start_date_event;
                    while($day<=7 && $week_date_event <= $end_date_event){
                        if($event->recurring_weekly_sunday && $this->isDayOfWeek($start_date_event, 'Sun')){
                            array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                        }elseif($event->recurring_weekly_monday && $this->isDayOfWeek($start_date_event, 'Mon')){
                            array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                        }elseif($event->recurring_weekly_tuesday && $this->isDayOfWeek($start_date_event, 'Tue')){
                            array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                        }elseif($event->recurring_weekly_wednesday && $this->isDayOfWeek($start_date_event, 'Wed')){
                            array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                        }elseif($event->recurring_weekly_thursday && $this->isDayOfWeek($start_date_event, 'Thu')){
                            array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                        }elseif($event->recurring_weekly_friday && $this->isDayOfWeek($start_date_event, 'Fri')){
                            array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                        }elseif($event->recurring_weekly_saturday && $this->isDayOfWeek($start_date_event, 'Sat')){
                            array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                        }
                        $week_date_event->addDays(1);
                        $day++;
                    }
                }elseif($event->recurring_type==RecurringType::MONTHLY){
                    if($event->recurring_monthly_type==RecurringInnerType::FIRST){
                        $start_date_event = $start_date_event->addMonths($event->recurring_monthly_first_months);
                        array_push($data_arr, $start_date_event->format('Y-m').'-'.($event->recurring_monthly_first_days<10 ? '0'.$event->recurring_monthly_first_days : $event->recurring_monthly_first_days).'T05:30:00.000Z');
                    }else{
                        $start_date_event = $start_date_event->addMonths($event->recurring_monthly_second_months);
                        switch ($start_date_event->format('m')) {
                            case '1':
                            case 1:
                                # code...
                                $carbonDate = new Carbon($event->recurring_monthly_second_type->value.' '.$event->recurring_monthly_second_days->value.' of January '.$start_date_event->format('Y'));
                                array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                                break;
                            case '2':
                            case 2:
                                # code...
                                $carbonDate = new Carbon($event->recurring_monthly_second_type->value.' '.$event->recurring_monthly_second_days->value.' of February '.$start_date_event->format('Y'));
                                array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                                break;
                            case '3':
                            case 3:
                                # code...
                                $carbonDate = new Carbon($event->recurring_monthly_second_type->value.' '.$event->recurring_monthly_second_days->value.' of March '.$start_date_event->format('Y'));
                                array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                                break;
                            case '4':
                            case 4:
                                # code...
                                $carbonDate = new Carbon($event->recurring_monthly_second_type->value.' '.$event->recurring_monthly_second_days->value.' of April '.$start_date_event->format('Y'));
                                array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                                break;
                            case '5':
                            case 5:
                                # code...
                                $carbonDate = new Carbon($event->recurring_monthly_second_type->value.' '.$event->recurring_monthly_second_days->value.' of May '.$start_date_event->format('Y'));
                                array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                                break;
                            case '6':
                            case 6:
                                # code...
                                $carbonDate = new Carbon($event->recurring_monthly_second_type->value.' '.$event->recurring_monthly_second_days->value.' of June '.$start_date_event->format('Y'));
                                array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                                break;
                            case '7':
                            case 7:
                                # code...
                                $carbonDate = new Carbon($event->recurring_monthly_second_type->value.' '.$event->recurring_monthly_second_days->value.' of July '.$start_date_event->format('Y'));
                                array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                                break;
                            case '8':
                            case 8:
                                # code...
                                $carbonDate = new Carbon($event->recurring_monthly_second_type->value.' '.$event->recurring_monthly_second_days->value.' of August '.$start_date_event->format('Y'));
                                array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                                break;
                            case '9':
                            case 9:
                                # code...
                                $carbonDate = new Carbon($event->recurring_monthly_second_type->value.' '.$event->recurring_monthly_second_days->value.' of September '.$start_date_event->format('Y'));
                                array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                                break;
                            case '10':
                            case 10:
                                # code...
                                $carbonDate = new Carbon($event->recurring_monthly_second_type->value.' '.$event->recurring_monthly_second_days->value.' of October '.$start_date_event->format('Y'));
                                array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                                break;
                            case '11':
                            case 11:
                                # code...
                                $carbonDate = new Carbon($event->recurring_monthly_second_type->value.' '.$event->recurring_monthly_second_days->value.' of November '.$start_date_event->format('Y'));
                                array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                                break;
                            case '12':
                            case 12:
                                # code...
                                $carbonDate = new Carbon($event->recurring_monthly_second_type->value.' '.$event->recurring_monthly_second_days->value.' of December '.$start_date_event->format('Y'));
                                array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                                break;
                        }
                    }
                }elseif($event->recurring_type==RecurringType::YEARLY){
                    $start_date_event = $start_date_event->addYears(1);
                    array_push($data_arr, $start_date_event->format('Y').'-'.($event->recurring_yearly_months->value<10 ? '0'.$event->recurring_yearly_months->value : $event->recurring_yearly_months->value).'-'.($event->recurring_yearly_days<10 ? '0'.$event->recurring_yearly_days : $event->recurring_yearly_days).'T05:30:00.000Z');
                }
            }
        }
        return $data_arr;
    }
}
