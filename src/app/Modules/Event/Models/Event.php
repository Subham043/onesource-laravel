<?php

namespace App\Modules\Event\Models;

use App\Enums\DayType;
use App\Enums\MonthType;
use App\Enums\RecurringInnerType;
use App\Enums\RecurringMonthInnerType;
use App\Enums\RecurringType;
use App\Modules\Authentication\Models\User;
use App\Modules\Client\Models\Client;
use App\Modules\Document\Models\DocumentNotification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'invoice_rate',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'fuzion_id',
        'is_active',
        'is_prep_ready',
        'is_recurring_event',
        'recurring_end_date',
        'recurring_type',
        'recurring_daily_type',
        'recurring_daily_days',
        'recurring_weekly_weeks',
        'recurring_weekly_sunday',
        'recurring_weekly_monday',
        'recurring_weekly_tuesday',
        'recurring_weekly_wednesday',
        'recurring_weekly_thursday',
        'recurring_weekly_friday',
        'recurring_weekly_saturday',
        'recurring_monthly_type',
        'recurring_monthly_first_days',
        'recurring_monthly_first_months',
        'recurring_monthly_second_type',
        'recurring_monthly_second_days',
        'recurring_monthly_second_months',
        'recurring_yearly_months',
        'recurring_yearly_days',
        'notes',
        'client_id',
        'created_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'recurring_end_date' => 'datetime',
        'recurring_daily_days' => 'int',
        'recurring_weekly_weeks' => 'int',
        'recurring_weekly_sunday' => 'boolean',
        'recurring_weekly_monday' => 'boolean',
        'recurring_weekly_tuesday' => 'boolean',
        'recurring_weekly_wednesday' => 'boolean',
        'recurring_weekly_thursday' => 'boolean',
        'recurring_weekly_friday' => 'boolean',
        'recurring_weekly_saturday' => 'boolean',
        'recurring_monthly_first_days' => 'int',
        'recurring_monthly_first_months' => 'int',
        'recurring_monthly_second_months' => 'int',
        'recurring_yearly_days' => 'int',
        'is_recurring_event' => 'boolean',
        'is_active' => 'boolean',
        'is_prep_ready' => 'boolean',
        'recurring_type' => RecurringType::class,
        'recurring_daily_type' => RecurringInnerType::class,
        'recurring_monthly_type' => RecurringInnerType::class,
        'recurring_monthly_second_days' => DayType::class,
        'recurring_monthly_second_type' => RecurringMonthInnerType::class,
        'recurring_yearly_months' => MonthType::class,
    ];

    protected $appends = ['event_title', 'event_link', 'event_start_date', 'event_end_date', 'event_repeated_date', 'event_rgb'];

    public static function boot(): void
    {
        parent::boot();
        static::created(function(Model $model){
            DocumentNotification::create([
                'created_event_id' => $model->id
            ]);
        });
        static::updated(function(Model $model){
            DocumentNotification::create([
                'updated_event_id' => $model->id
            ]);
        });
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by')->withDefault();
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id')->withDefault();
    }

    public function writers()
    {
        return $this->hasMany(EventWriter::class, 'event_id');
    }

    public function documents()
    {
        return $this->hasMany(EventDocument::class, 'event_id');
    }

    protected function eventTitle(): Attribute
    {
        return new Attribute(
            get: fn () => $this->name. ' (EVD'.$this->id.')',
        );
    }

    protected function eventLink(): Attribute
    {
        return new Attribute(
            get: fn () => route('event.view.get', $this->id),
        );
    }

    protected function eventStartDate(): Attribute
    {
        return new Attribute(
            get: fn () => $this->start_date->format('Y-m-d').'T05:30:00.000Z',
        );
    }

    protected function eventEndDate(): Attribute
    {
        return new Attribute(
            get: fn () => $this->end_date->format('Y-m-d').'T05:30:00.000Z',
        );
    }

    protected function getColor() {
        $hash = md5('color' . $this->id+135); // modify 'color' to get a different palette
        return
            hexdec(substr($hash, 0, 2)).','. // r
            hexdec(substr($hash, 2, 2)).','. // g
            hexdec(substr($hash, 4, 2)); //b
    }

    protected function eventRgb(): Attribute
    {
        return new Attribute(
            get: fn () => $this->getColor(),
        );
    }

    protected function isWeekend($date) {
        $weekDay = date('w', strtotime($date));
        return ($weekDay == 0 || $weekDay == 6);
    }

    protected function isDayOfWeek($date, $day) {
        $weekDay = date('D', strtotime($date));
        return ($weekDay == $day);
    }

    protected function eventRepeatedDate(): Attribute
    {
        $data_arr = [];
        if($this->is_recurring_event){
            $start_date_event = $this->start_date;
            $end_date_event = $this->recurring_end_date;
            if($this->recurring_type==RecurringType::DAILY){
                if($this->recurring_daily_type==RecurringInnerType::FIRST){
                    array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                }else{
                    if(!$this->isWeekend($start_date_event)){
                        array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                    }
                }
            }elseif($this->recurring_type==RecurringType::WEEKLY){
                $day = 1;
                $week_date_event = $start_date_event;
                while($day<=7 && $week_date_event <= $end_date_event){
                    if($this->recurring_weekly_sunday && $this->isDayOfWeek($start_date_event, 'Sun')){
                        array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                    }elseif($this->recurring_weekly_monday && $this->isDayOfWeek($start_date_event, 'Mon')){
                        array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                    }elseif($this->recurring_weekly_tuesday && $this->isDayOfWeek($start_date_event, 'Tue')){
                        array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                    }elseif($this->recurring_weekly_wednesday && $this->isDayOfWeek($start_date_event, 'Wed')){
                        array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                    }elseif($this->recurring_weekly_thursday && $this->isDayOfWeek($start_date_event, 'Thu')){
                        array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                    }elseif($this->recurring_weekly_friday && $this->isDayOfWeek($start_date_event, 'Fri')){
                        array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                    }elseif($this->recurring_weekly_saturday && $this->isDayOfWeek($start_date_event, 'Sat')){
                        array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                    }
                    $week_date_event->addDays(1);
                    $day++;
                }
            }elseif($this->recurring_type==RecurringType::MONTHLY){
                if($this->recurring_monthly_type==RecurringInnerType::FIRST){
                    array_push($data_arr, $start_date_event->format('Y-m').'-'.($this->recurring_monthly_first_days<10 ? '0'.$this->recurring_monthly_first_days : $this->recurring_monthly_first_days).'T05:30:00.000Z');
                }else{
                    switch ($start_date_event->format('m')) {
                        case '1':
                        case 1:
                            # code...
                            $carbonDate = new Carbon($this->recurring_monthly_second_type->value.' '.$this->recurring_monthly_second_days->value.' of January '.$start_date_event->format('Y'));
                            array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                            break;
                        case '2':
                        case 2:
                            # code...
                            $carbonDate = new Carbon($this->recurring_monthly_second_type->value.' '.$this->recurring_monthly_second_days->value.' of February '.$start_date_event->format('Y'));
                            array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                            break;
                        case '3':
                        case 3:
                            # code...
                            $carbonDate = new Carbon($this->recurring_monthly_second_type->value.' '.$this->recurring_monthly_second_days->value.' of March '.$start_date_event->format('Y'));
                            array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                            break;
                        case '4':
                        case 4:
                            # code...
                            $carbonDate = new Carbon($this->recurring_monthly_second_type->value.' '.$this->recurring_monthly_second_days->value.' of April '.$start_date_event->format('Y'));
                            array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                            break;
                        case '5':
                        case 5:
                            # code...
                            $carbonDate = new Carbon($this->recurring_monthly_second_type->value.' '.$this->recurring_monthly_second_days->value.' of May '.$start_date_event->format('Y'));
                            array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                            break;
                        case '6':
                        case 6:
                            # code...
                            $carbonDate = new Carbon($this->recurring_monthly_second_type->value.' '.$this->recurring_monthly_second_days->value.' of June '.$start_date_event->format('Y'));
                            array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                            break;
                        case '7':
                        case 7:
                            # code...
                            $carbonDate = new Carbon($this->recurring_monthly_second_type->value.' '.$this->recurring_monthly_second_days->value.' of July '.$start_date_event->format('Y'));
                            array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                            break;
                        case '8':
                        case 8:
                            # code...
                            $carbonDate = new Carbon($this->recurring_monthly_second_type->value.' '.$this->recurring_monthly_second_days->value.' of August '.$start_date_event->format('Y'));
                            array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                            break;
                        case '9':
                        case 9:
                            # code...
                            $carbonDate = new Carbon($this->recurring_monthly_second_type->value.' '.$this->recurring_monthly_second_days->value.' of September '.$start_date_event->format('Y'));
                            array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                            break;
                        case '10':
                        case 10:
                            # code...
                            $carbonDate = new Carbon($this->recurring_monthly_second_type->value.' '.$this->recurring_monthly_second_days->value.' of October '.$start_date_event->format('Y'));
                            array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                            break;
                        case '11':
                        case 11:
                            # code...
                            $carbonDate = new Carbon($this->recurring_monthly_second_type->value.' '.$this->recurring_monthly_second_days->value.' of November '.$start_date_event->format('Y'));
                            array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                            break;
                        case '12':
                        case 12:
                            # code...
                            $carbonDate = new Carbon($this->recurring_monthly_second_type->value.' '.$this->recurring_monthly_second_days->value.' of December '.$start_date_event->format('Y'));
                            array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                            break;
                    }
                }
            }elseif($this->recurring_type==RecurringType::YEARLY){
                if($start_date_event->format('m')==$this->recurring_yearly_months->value && $start_date_event->format('d')==($this->recurring_yearly_days<10 ? '0'.$this->recurring_yearly_days : $this->recurring_yearly_days)){
                    array_push($data_arr, $start_date_event->format('Y').'-'.($this->recurring_yearly_months->value<10 ? '0'.$this->recurring_yearly_months->value : $this->recurring_yearly_months->value).'-'.($this->recurring_yearly_days<10 ? '0'.$this->recurring_yearly_days : $this->recurring_yearly_days).'T05:30:00.000Z');
                }
            }
            while($start_date_event <= $end_date_event) {
                if($this->recurring_type==RecurringType::DAILY){
                    if($this->recurring_daily_type==RecurringInnerType::FIRST){
                        $start_date_event = $start_date_event->addDays($this->recurring_daily_days);
                        array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                    }else{
                        $start_date_event = $start_date_event->addDays(1);
                        if(!$this->isWeekend($start_date_event)){
                            array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                        }
                    }
                }elseif($this->recurring_type==RecurringType::WEEKLY){
                    $day = 1;
                    $start_date_event = $start_date_event->addWeeks($this->recurring_weekly_weeks);
                    $week_date_event = $start_date_event;
                    while($day<=7 && $week_date_event <= $end_date_event){
                        if($this->recurring_weekly_sunday && $this->isDayOfWeek($start_date_event, 'Sun')){
                            array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                        }elseif($this->recurring_weekly_monday && $this->isDayOfWeek($start_date_event, 'Mon')){
                            array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                        }elseif($this->recurring_weekly_tuesday && $this->isDayOfWeek($start_date_event, 'Tue')){
                            array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                        }elseif($this->recurring_weekly_wednesday && $this->isDayOfWeek($start_date_event, 'Wed')){
                            array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                        }elseif($this->recurring_weekly_thursday && $this->isDayOfWeek($start_date_event, 'Thu')){
                            array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                        }elseif($this->recurring_weekly_friday && $this->isDayOfWeek($start_date_event, 'Fri')){
                            array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                        }elseif($this->recurring_weekly_saturday && $this->isDayOfWeek($start_date_event, 'Sat')){
                            array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                        }
                        $week_date_event->addDays(1);
                        $day++;
                    }
                }elseif($this->recurring_type==RecurringType::MONTHLY){
                    if($this->recurring_monthly_type==RecurringInnerType::FIRST){
                        $start_date_event = $start_date_event->addMonths($this->recurring_monthly_first_months);
                        array_push($data_arr, $start_date_event->format('Y-m').'-'.($this->recurring_monthly_first_days<10 ? '0'.$this->recurring_monthly_first_days : $this->recurring_monthly_first_days).'T05:30:00.000Z');
                    }else{
                        $start_date_event = $start_date_event->addMonths($this->recurring_monthly_second_months);
                        switch ($start_date_event->format('m')) {
                            case '1':
                            case 1:
                                # code...
                                $carbonDate = new Carbon($this->recurring_monthly_second_type->value.' '.$this->recurring_monthly_second_days->value.' of January '.$start_date_event->format('Y'));
                                array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                                break;
                            case '2':
                            case 2:
                                # code...
                                $carbonDate = new Carbon($this->recurring_monthly_second_type->value.' '.$this->recurring_monthly_second_days->value.' of February '.$start_date_event->format('Y'));
                                array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                                break;
                            case '3':
                            case 3:
                                # code...
                                $carbonDate = new Carbon($this->recurring_monthly_second_type->value.' '.$this->recurring_monthly_second_days->value.' of March '.$start_date_event->format('Y'));
                                array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                                break;
                            case '4':
                            case 4:
                                # code...
                                $carbonDate = new Carbon($this->recurring_monthly_second_type->value.' '.$this->recurring_monthly_second_days->value.' of April '.$start_date_event->format('Y'));
                                array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                                break;
                            case '5':
                            case 5:
                                # code...
                                $carbonDate = new Carbon($this->recurring_monthly_second_type->value.' '.$this->recurring_monthly_second_days->value.' of May '.$start_date_event->format('Y'));
                                array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                                break;
                            case '6':
                            case 6:
                                # code...
                                $carbonDate = new Carbon($this->recurring_monthly_second_type->value.' '.$this->recurring_monthly_second_days->value.' of June '.$start_date_event->format('Y'));
                                array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                                break;
                            case '7':
                            case 7:
                                # code...
                                $carbonDate = new Carbon($this->recurring_monthly_second_type->value.' '.$this->recurring_monthly_second_days->value.' of July '.$start_date_event->format('Y'));
                                array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                                break;
                            case '8':
                            case 8:
                                # code...
                                $carbonDate = new Carbon($this->recurring_monthly_second_type->value.' '.$this->recurring_monthly_second_days->value.' of August '.$start_date_event->format('Y'));
                                array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                                break;
                            case '9':
                            case 9:
                                # code...
                                $carbonDate = new Carbon($this->recurring_monthly_second_type->value.' '.$this->recurring_monthly_second_days->value.' of September '.$start_date_event->format('Y'));
                                array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                                break;
                            case '10':
                            case 10:
                                # code...
                                $carbonDate = new Carbon($this->recurring_monthly_second_type->value.' '.$this->recurring_monthly_second_days->value.' of October '.$start_date_event->format('Y'));
                                array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                                break;
                            case '11':
                            case 11:
                                # code...
                                $carbonDate = new Carbon($this->recurring_monthly_second_type->value.' '.$this->recurring_monthly_second_days->value.' of November '.$start_date_event->format('Y'));
                                array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                                break;
                            case '12':
                            case 12:
                                # code...
                                $carbonDate = new Carbon($this->recurring_monthly_second_type->value.' '.$this->recurring_monthly_second_days->value.' of December '.$start_date_event->format('Y'));
                                array_push($data_arr, $carbonDate->format('Y-m-d').'T05:30:00.000Z');
                                break;
                        }
                    }
                }elseif($this->recurring_type==RecurringType::YEARLY){
                    $start_date_event = $start_date_event->addYears(1);
                    array_push($data_arr, $start_date_event->format('Y').'-'.($this->recurring_yearly_months->value<10 ? '0'.$this->recurring_yearly_months->value : $this->recurring_yearly_months->value).'-'.($this->recurring_yearly_days<10 ? '0'.$this->recurring_yearly_days : $this->recurring_yearly_days).'T05:30:00.000Z');
                }
            }
        }
        return new Attribute(
            get: fn () => $data_arr,
        );
    }

    public function scopeFilterByRoles(Builder $query): Builder
    {
        $query_builder = $query->with([
            'writers'=> function($qry){
                $qry->with('writer');
            },
            'documents',
            'client'
        ]);
        if(auth()->user()->current_role=='Writer'){
            $query_builder->whereHas('writers', function($qry){
                $qry->where('writer_id', auth()->user()->id);
            });
        }elseif(auth()->user()->current_role=='Client'){
            $query_builder->whereHas('client', function($qry){
                $qry->whereIn('id', auth()->user()->profiles->pluck('client_id')->filter());
            });
        }else{
            $query_builder->where('created_by', auth()->user()->current_role=='Staff-Admin' ? auth()->user()->member_profile_created_by_auth->created_by : auth()->user()->id);
        }
        return $query_builder;
    }
}
