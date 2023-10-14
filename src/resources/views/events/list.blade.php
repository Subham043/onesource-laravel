@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                    <div class="flex-wrap card-header d-flex justify-content-between align-items-center">
                        <div class="header-title">
                            <h4 class="mb-0 card-title">Events</h4>
                        </div>
                        <div>
                            <a href="{{route('event.create.get')}}" class="btn btn-primary">Add Event</a>
                            <a href="{{route('calendar.view.get')}}" class="btn btn-primary">Calendar View</a>
                        </div>
                    </div>
                    <div class="p-0 card-body">
                        @if($data->total() > 0)
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
                                    @foreach ($data->items() as $item)
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
@stop
