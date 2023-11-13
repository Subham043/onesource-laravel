<?php

namespace App\Modules\Report\Export\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Database\Eloquent\Collection;

class ExcelExport implements FromCollection,WithHeadings,WithMapping
{
    protected $report;

    public function __construct(Collection $report)
    {
        $this->report = $report;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings():array{
        return[
            'Name',
            'URL Static Name',
            'Videolinq Server',
            'Videolinq key',
            'Videolinq Password',
            'Teams URL',
            'Youtube URL',
            'Adobe Connect URL',
            'Type',
            'Date',
            'Time ',
            'Writers',
            'Notes Option',
            'Hardstop',
            'Memo',
            'Main Language',
            'Translations',
            'Viewers',
            'Chat',
            'Transcript Retention',
            'Copy',
            'Welcome Title',
            'Welcome Body',
            'Reminder Delay',
            'Email Chat',
            'Send Transcript To',
            'Preset ID',
            'Recurring',
            'Recurrence Type',
            'Daily Interval',
            'Daily Recur Weekdays',
            'Weekly Interval',
            'Week Days',
            'Monthly Day',
            'Monthly Month Interval',
            'Monthly Week Day',
            'Monthly Week Day Interval',
            'Yearly Months',
            'Yearly Day',
        ];
    }
    public function map($data): array
    {
         return[
            $data->name,
            route('event.view.get', $data->id),
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            $data->start_date ? $data->start_date->format('M d Y') : '',
            $data->start_time ? $data->start_time->format('h:i a') : '',
            $data->writers->count()>0 ? implode(', ', $data->writers->pluck('writer.name')->toArray()) : '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
            $data->is_recurring_event ? 'Yes' : 'No',
            $data->is_recurring_event ? $data->recurring_type->value : '',
            $data->is_recurring_event && $data->recurring_type->value=="Daily" && $data->recurring_daily_type->value=='First' ? 'every '.$data->recurring_daily_days.' days' : '',
            $data->is_recurring_event && $data->recurring_type->value=="Daily" && $data->recurring_daily_type->value=='Second' ? 'Yes' : 'No',
            $data->is_recurring_event && $data->recurring_type->value=="Weekly" ? 'every '.$data->recurring_weekly_weeks.' weeks' : '',
            $data->is_recurring_event && $data->recurring_type->value=="Weekly" ? implode(', ', array_filter([$data->recurring_weekly_sunday ? 'Sun' : null, $data->recurring_weekly_monday ? 'Mon' : null, $data->recurring_weekly_tuesday ? 'Tue' : null, $data->recurring_weekly_wednesday ? 'Wed' : null, $data->recurring_weekly_thursday ? 'Thu' : null, $data->recurring_weekly_friday ? 'Fri' : null, $data->recurring_weekly_saturday ? 'Sat' : null])) : '',
            $data->is_recurring_event && $data->recurring_type->value=="Monthly" && $data->recurring_monthly_type->value=='First' ? $data->recurring_monthly_first_days.' of the month' : '',
            $data->is_recurring_event && $data->recurring_type->value=="Monthly" && $data->recurring_monthly_type->value=='First' ? 'every '.$data->recurring_monthly_first_months.' month' : '',
            $data->is_recurring_event && $data->recurring_type->value=="Monthly" && $data->recurring_monthly_type->value=='Second' ? 'the '.$data->recurring_monthly_second_type->value.' '.$data->recurring_monthly_second_days->value.' of the month' : '',
            $data->is_recurring_event && $data->recurring_type->value=="Monthly" && $data->recurring_monthly_type->value=='Second' ? 'the '.$data->recurring_monthly_second_type->value.' '.$data->recurring_monthly_second_days->value.' of every '.$data->recurring_monthly_second_months.' month' : '',
            $data->is_recurring_event && $data->recurring_type->value=="Yearly" ? $data->recurring_yearly_months->name : '',
            $data->is_recurring_event && $data->recurring_type->value=="Yearly" ? $data->recurring_yearly_days : '',
         ];
    }
    public function collection()
    {
        return $this->report;
    }
}
