@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                        <div class="flex-wrap card-header d-flex justify-content-between align-items-center">
                            <div class="header-title">
                                <h4 class="mb-2 card-title">Events For Today</h4>
                                <p class="mb-0">
                                    <svg class="me-2 text-primary" width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="#070F3A" d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z" />
                                    </svg>
                                    {{today()->format('M d Y')}}
                                </p>
                            </div>
                            <div>
                                @can('list events')
                                <a href="{{route('event.paginate.get')}}" class="btn btn-primary">View All Events</a>
                                @endcan
                                @can('view calendar')
                                <a href="{{route('calendar.view.get')}}" class="btn btn-primary">Calendar View</a>
                                @endcan
                            </div>
                        </div>
                        <div class="p-0 card-body">
                            @if($events->total() > 0)
                                <div class="mt-4 table-responsive">
                                    <table id="basic-table" class="table mb-0 table-striped" role="grid">
                                        <thead>
                                            <tr>
                                                <th>Event ID</th>
                                                <th>Event</th>
                                                <th>Client</th>
                                                <th>Writer</th>
                                                <th>Date</th>
                                                <th>Start Time</th>
                                                <th>End Time</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($events->items() as $item)
                                                @if($item->is_recurring_event)
                                                    @if(in_array(now()->format('Y-m-d').'T05:30:00.000Z', $item->event_repeated_date))
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="{{route('event.view.get', $item->id)}}">EVD{{$item->id}}</a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="iq-media-group iq-media-group-1">
                                                                <a href="{{route('event.view.get', $item->id)}}"> {{$item->name}}</a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="iq-media-group iq-media-group-1">
                                                                {{$item->client->name}}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @foreach($item->writers as $k=>$v)
                                                                {!!($k+1==count($item->writers)) ? $v->writer->name : $v->writer->name.'<br/> '!!}
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            {{$item->start_date->format('M d Y')}}
                                                        </td>
                                                        <td>{{$item->start_time->format('h:i a')}}</td>
                                                        <td>{{$item->end_time->format('h:i a')}}</td>
                                                        <td>
                                                            @can('view events')
                                                            <a href="{{route('event.view.get', $item->id)}}" class="btn btn-primary">View Event</a>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @elseif($item->start_date->format('Y-m-d').'T05:30:00.000Z'==$item->end_date->format('Y-m-d').'T05:30:00.000Z' && $item->start_date->format('Y-m-d').'T05:30:00.000Z'==now()->format('Y-m-d').'T05:30:00.000Z')
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="{{route('event.view.get', $item->id)}}">EVD{{$item->id}}</a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="iq-media-group iq-media-group-1">
                                                                <a href="{{route('event.view.get', $item->id)}}"> {{$item->name}}</a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="iq-media-group iq-media-group-1">
                                                                {{$item->client->name}}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @foreach($item->writers as $k=>$v)
                                                                {!!($k+1==count($item->writers)) ? $v->writer->name : $v->writer->name.'<br/> '!!}
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            {{$item->start_date->format('M d Y')}}
                                                        </td>
                                                        <td>{{$item->start_time->format('h:i a')}}</td>
                                                        <td>{{$item->end_time->format('h:i a')}}</td>
                                                        <td>
                                                            @can('view events')
                                                            <a href="{{route('event.view.get', $item->id)}}" class="btn btn-primary">View Event</a>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @elseif($item->start_date->format('Y-m-d').'T05:30:00.000Z'!=$item->end_date->format('Y-m-d').'T05:30:00.000Z' && (now()->format('Y-m-d').'T05:30:00.000Z'>=$item->start_date->format('Y-m-d').'T05:30:00.000Z' && now()->format('Y-m-d').'T05:30:00.000Z'<=$item->end_date->format('Y-m-d').'T05:30:00.000Z'))
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <a href="{{route('event.view.get', $item->id)}}">EVD{{$item->id}}</a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="iq-media-group iq-media-group-1">
                                                                <a href="{{route('event.view.get', $item->id)}}"> {{$item->name}}</a>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="iq-media-group iq-media-group-1">
                                                                {{$item->client->name}}
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @foreach($item->writers as $k=>$v)
                                                                {!!($k+1==count($item->writers)) ? $v->writer->name : $v->writer->name.'<br/> '!!}
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            {{$item->start_date->format('M d Y')}}
                                                        </td>
                                                        <td>{{$item->start_time->format('h:i a')}}</td>
                                                        <td>{{$item->end_time->format('h:i a')}}</td>
                                                        <td>
                                                            @can('view events')
                                                            <a href="{{route('event.view.get', $item->id)}}" class="btn btn-primary">View Event</a>
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-center">No data available</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-lg-8">
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
        <div class="col-md-12 col-lg-4">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="card" data-aos="fade-up" data-aos-delay="600">
                        <div class="flex-wrap card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="mb-2 card-title">Notifications</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-2  d-flex profile-media align-items-top">
                                <div class="mt-1 profile-dots-pills border-primary"></div>
                                <div class="ms-4">
                                    <h6 class="mb-1 "><a href="#">New Document - Document_Title.docx</a></h6>
                                    <span class="mb-0">5th JAN 8:10 AM | <a href="#"> Job Title </a></span>
                                </div>
                            </div>
                            <div class="mb-2  d-flex profile-media align-items-top">
                                <div class="mt-1 profile-dots-pills border-primary"></div>
                                <div class="ms-4">
                                    <h6 class="mb-1 "><a href="#">New Document - Document_Title.docx</a></h6>
                                    <span class="mb-0">5th JAN 8:10 AM | <a href="#"> Job Title </a></span>
                                </div>
                            </div>
                            <div class="mb-2  d-flex profile-media align-items-top">
                                <div class="mt-1 profile-dots-pills border-primary"></div>
                                <div class="ms-4">
                                    <h6 class="mb-1 "><a href="#">New Document - Document_Title.docx</a></h6>
                                    <span class="mb-0">5th JAN 8:10 AM | <a href="#"> Job Title </a></span>
                                </div>
                            </div>
                            <div class="mb-2  d-flex profile-media align-items-top">
                                <div class="mt-1 profile-dots-pills border-primary"></div>
                                <div class="ms-4">
                                    <h6 class="mb-1 "><a href="#">New Document - Document_Title.docx</a></h6>
                                    <span class="mb-0">5th JAN 8:10 AM | <a href="#"> Job Title </a></span>
                                </div>
                            </div>
                            <div class="mb-2  d-flex profile-media align-items-top">
                                <div class="mt-1 profile-dots-pills border-primary"></div>
                                <div class="ms-4">
                                    <h6 class="mb-1 "><a href="#">New Document - Document_Title.docx</a></h6>
                                    <span class="mb-0">5th JAN 8:10 AM | <a href="#"> Job Title </a></span>
                                </div>
                            </div>
                            <div class="mb-2  d-flex profile-media align-items-top">
                                <div class="mt-1 profile-dots-pills border-primary"></div>
                                <div class="ms-4">
                                    <h6 class="mb-1 "><a href="#">New Document - Document_Title.docx</a></h6>
                                    <span class="mb-0">5th JAN 8:10 AM | <a href="#"> Job Title </a></span>
                                </div>
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
                displayEventTime: false,
                header: {
                    left: "",
                    center: "title",
                    right: ""
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
