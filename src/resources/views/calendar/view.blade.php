@extends('layouts.main')

@section('content')
<div>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card  ">
                        <div class="card-body">
                            <div id="calendar1" class="calendar-s"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
<!-- Fullcalender Javascript -->
    <script src="{{asset('assets/vendor/fullcalendar/core/main.js')}}"></script>
    <script src="{{asset('assets/vendor/fullcalendar/daygrid/main.js')}}"></script>
    <script src="{{asset('assets/vendor/fullcalendar/timegrid/main.js')}}"></script>
    <script src="{{asset('assets/vendor/fullcalendar/list/main.js')}}"></script>
    <script src="{{asset('assets/vendor/fullcalendar/interaction/main.js')}}"></script>
    <script src="{{asset('assets/vendor/moment.min.js')}}"></script>
    {{-- <script src="{{asset('assets/js/plugins/calender.js')}}"></script> --}}
    <script type="text/javascript" nonce="{{ csp_nonce() }}">
        if (document.querySelectorAll('#calendar1').length) {
            document.addEventListener('DOMContentLoaded', function () {
                let calendarEl = document.getElementById('calendar1');
                let calendar1 = new FullCalendar.Calendar(calendarEl, {
                selectable: true,
                plugins: ["timeGrid", "dayGrid", "list", "interaction"],
                timeZone: "UTC",
                defaultView: "dayGridMonth",
                contentHeight: "auto",
                eventLimit: true,
                dayMaxEvents: 4,
                header: {
                    left: "prev,next today",
                    center: "title",
                    right: "dayGridMonth,timeGridWeek,timeGridDay,listWeek"
                },
                dateClick: function (info) {
                    $('#schedule-start-date').val(info.dateStr)
                    $('#schedule-end-date').val(info.dateStr)
                    $('#date-event').modal('show')
                },
                events: [
                    @foreach($current_month_events as $event_data)
                        @if($event_data->is_recurring_event)
                            @foreach($event_data->event_repeated_date as $val)
                                {
                                    title: '{{$event_data->event_title}}',
                                    url: '{{$event_data->event_link}}',
                                    start: '{{$val}}',
                                    backgroundColor: 'rgba({{$event_data->event_rgb}},0.2)',
                                    textColor: 'rgba({{$event_data->event_rgb}},1)',
                                    borderColor: 'rgba({{$event_data->event_rgb}},1)'
                                },
                            @endforeach
                        @else
                            {
                                title: '{{$event_data->event_title}}',
                                url: '{{$event_data->event_link}}',
                                start: '{{$event_data->event_start_date}}',
                                end: '{{$event_data->event_end_date}}',
                                backgroundColor: 'rgba({{$event_data->event_rgb}},0.2)',
                                textColor: 'rgba({{$event_data->event_rgb}},1)',
                                borderColor: 'rgba({{$event_data->event_rgb}},1)'
                            },
                        @endif
                    @endforeach
                ],
                customButtons: {
                    prev: {
                        text: 'Prev',
                        click: function() {
                            // do the original command
                            calendar1.prev();
                            // console.log('prev');
                        }
                    },
                    next: {
                        text: 'Next',
                        click: function() {
                            // do the original command
                            calendar1.next();
                            // console.log('prev');
                        }
                    },
                }
            });
            calendar1.render();
            });

        }
    </script>
@stop
