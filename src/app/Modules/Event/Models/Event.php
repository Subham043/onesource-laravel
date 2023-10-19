<?php

namespace App\Modules\Event\Models;

use App\Enums\RecurringType;
use App\Modules\Authentication\Models\User;
use App\Modules\Client\Models\Client;
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
        'is_recurring_event',
        'recurring_type',
        'recurring_days',
        'recurring_end_date',
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
        'is_recurring_event' => 'boolean',
        'recurring_type' => RecurringType::class,
    ];

    protected $attributes = [
        'recurring_type' => RecurringType::DAILY,
    ];

    protected $appends = ['event_title', 'event_link', 'event_start_date', 'event_end_date', 'event_repeated_date', 'event_rgb'];

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

    protected function eventRepeatedDate(): Attribute
    {
        $data_arr = [];
        if($this->is_recurring_event){
            $start_date_event = $this->start_date;
            $end_date_event = $this->recurring_end_date;
            array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
            while($start_date_event <= $end_date_event) {
                if($this->recurring_type==RecurringType::DAILY){
                    $start_date_event = $start_date_event->addDays(1);
                    array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                }elseif($this->recurring_type==RecurringType::WEEKLY){
                    $start_date_event = $start_date_event->addDays(7);
                    array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                }elseif($this->recurring_type==RecurringType::MONTHLY){
                    $start_date_event = $start_date_event->addDays(30);
                    array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                }elseif($this->recurring_type==RecurringType::YEARLY){
                    $start_date_event = $start_date_event->addDays(365);
                    array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                }elseif($this->recurring_type==RecurringType::EVERY){
                    $start_date_event = $start_date_event->addDays($this->recurring_days);
                    array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                }elseif($this->recurring_type==RecurringType::EVERYWEEKDAY){
                    $start_date_event = $start_date_event->addDays(1);
                    if(!$this->isWeekend($start_date_event)){
                        array_push($data_arr, $start_date_event->format('Y-m-d').'T05:30:00.000Z');
                    }
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
