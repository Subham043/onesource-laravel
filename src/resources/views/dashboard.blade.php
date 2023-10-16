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
    <script src="{{asset('assets/js/plugins/calender.js')}}"></script>
@stop
