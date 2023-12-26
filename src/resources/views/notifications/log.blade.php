@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                    <div class="flex-wrap card-header d-flex justify-content-between align-items-center">
                        <div class="header-title">
                            <h4 class="mb-0 card-title">Notification Logs</h4>
                        </div>
                        <div>
                            @can('add notifications')
                            <a href="{{route('notification.send.get')}}" class="btn btn-primary">Send Notification</a>
                            @endcan
                            <a href="{{route('dashboard.get')}}" class="btn btn-primary">Return To Dashboard</a>
                        </div>
                    </div>
                    <div class="p-0 card-body">
                        @if($data->total() > 0)
                        <div class="mt-4 table-responsive">
                            <table id="basic-table" class="table mb-0 table-striped" role="grid">
                                <thead>
                                    <tr>
                                        <th>Label</th>
                                        <th style="text-align: right">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->items() as $item)
                                    <tr>
                                        <td>
                                            <div class="iq-media-group iq-media-group-1">
                                                {{$item->log}}
                                            </div>
                                        </td>
                                        <td>
                                            {{$item->created_at->format('M d Y')}}
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
