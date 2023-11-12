@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                    <div class="flex-wrap card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="mb-2 card-title">Export Events to 1CapApp</h4>
                        </div>
                        <div class="d-flex align-items-middle">
                        </div>
                        <form action="{{route('report.export.view.get')}}" method="GET" class="d-flex align-items-center filterset">
                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">Writer</label>
                                <select class="form-select shadow-none writer-id-input" name="filter[has_writer]">
                                    <option {{empty(request()->query('filter')['has_writer']) ? 'selected' : ''}} value="">Select Writer</option>
                                    @foreach($writers as $writer)
                                        <option value="{{$writer->id}}" {{!empty(request()->query('filter')['has_writer']) && request()->query('filter')['has_writer']==$writer->id ? 'selected' : ''}}>{{$writer->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="filter[has_start_date]" value="{{request()->query('filter')['has_start_date'] ?? ''}}">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">End Date Date</label>
                                <input type="date" class="form-control" id="end_date" name="filter[has_end_date]" value="{{request()->query('filter')['has_end_date'] ?? ''}}">
                            </div>
                            <div class="form-group">
                                <br />
                                <button class="btn btn-link btn-soft-primary">
                                    Filter
                                </button>
                                <a href="{{route('report.export.view.get')}}" class="btn btn-link btn-soft-light">
                                    Reset
                                </a>
                            </div>
                        </form>
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
                            <div class="card-header">
                                {{$data->onEachSide(5)->links()}}
                            </div>
                        </div>
                        @else
                            <p class="text-center">No data available</p>
                        @endif
                        <div style="padding: 20px; text-align: right; "><a href="#" class="btn btn-primary">
                                <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.4"
                                        d="M2 7.916V16.084C2 19.623 4.276 22 7.665 22H16.335C19.724 22 22 19.623 22 16.084V7.916C22 4.378 19.723 2 16.334 2H7.665C4.276 2 2 4.378 2 7.916Z"
                                        fill="currentColor"></path>
                                    <path
                                        d="M7.72033 12.8555L11.4683 16.6205C11.7503 16.9035 12.2493 16.9035 12.5323 16.6205L16.2803 12.8555C16.5723 12.5615 16.5713 12.0865 16.2773 11.7945C15.9833 11.5025 15.5093 11.5025 15.2163 11.7965L12.7493 14.2735V7.91846C12.7493 7.50346 12.4133 7.16846 11.9993 7.16846C11.5853 7.16846 11.2493 7.50346 11.2493 7.91846V14.2735L8.78333 11.7965C8.63633 11.6495 8.44433 11.5765 8.25133 11.5765C8.06033 11.5765 7.86833 11.6495 7.72233 11.7945C7.42933 12.0865 7.42833 12.5615 7.72033 12.8555Z"
                                        fill="currentColor"></path>
                                </svg> Export to 1CapApp</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
