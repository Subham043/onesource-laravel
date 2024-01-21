@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                    <div class="flex-wrap card-header d-flex justify-content-between align-items-center">
                        <div class="header-title">
                            <h4 class="mb-0 card-title">Notification Settings</h4>
                        </div>
                        <div>
                            @can('add notifications')
                            <a href="{{route('notification.create.get')}}" class="btn btn-primary">Add Setting</a>
                            @endcan
                            @can('add notifications')
                            <a href="{{route('notification.send.get')}}" class="btn btn-primary">Send Notification</a>
                            @endcan
                            @can('add notifications')
                            <a href="{{route('notification.template.get')}}" class="btn btn-primary">Template</a>
                            @endcan
                            @can('add notifications')
                            <a href="{{route('notification.log.get')}}" class="btn btn-primary">Logs</a>
                            @endcan
                            <a href="{{route('dashboard.get')}}" class="btn btn-primary">Dashboard</a>
                        </div>
                    </div>
                    <div class="p-0 card-body">
                        @if($data->total() > 0)
                        <div class="mt-4 table-responsive">
                            <table id="basic-table" class="table mb-0 table-striped" role="grid">
                                <thead>
                                    <tr>
                                        <th>Label</th>
                                        <th>Schedule</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->items() as $item)
                                    <tr>
                                        <td>
                                            <div class="iq-media-group iq-media-group-1">
                                                {{$item->label}}
                                            </div>
                                        </td>
                                        <td>
                                            @if($item->recurring_type->value=='Daily')
                                                @if($item->recurring_daily_type->value=='First')
                                                    Scheduled every {{$item->recurring_daily_days}} Days
                                                @else
                                                    Scheduled every weekday
                                                @endif
                                            @elseif($item->recurring_type->value=='Weekly')
                                                Scheduled every {{$item->recurring_weekly_weeks}} week(s) on : {{$item->recurring_weekly_sunday ? 'Sun, ' : ''}} {{$item->recurring_weekly_monday ? 'Mon, ' : ''}} {{$item->recurring_weekly_tuesday ? 'Tue, ' : ''}} {{$item->recurring_weekly_wednesday ? 'Wed, ' : ''}} {{$item->recurring_weekly_thursday ? 'Thu, ' : ''}} {{$item->recurring_weekly_friday ? 'Fri, ' : ''}} {{$item->recurring_weekly_saturday ? 'Sat, ' : ''}}
                                            @elseif($item->recurring_type->value=='Monthly')
                                                @if($item->recurring_monthly_type->value=='First')
                                                    Scheduled day {{$item->recurring_monthly_first_days}} of every {{$item->recurring_monthly_first_months}} month(s)
                                                @else
                                                    Scheduled the {{$item->recurring_monthly_second_type}}, {{$item->recurring_monthly_second_days}} of every {{$item->recurring_monthly_second_months}} month(s)
                                                @endif
                                            @elseif($item->recurring_type->value=='Yearly')
                                                Scheduled every {{$item->recurring_yearly_months->name}}, {{$item->recurring_yearly_days}}
                                            @endif
                                        </td>
                                        <td>

                                            @can('edit notifications')
                                            <a href="{{route('notification.update.get', $item->id)}}" class="" data-bs-toggle="tooltip" data-bs-original-title="Edit Notification"> <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.4" d="M16.6643 21.9897H7.33488C5.88835 22.0796 4.46781 21.5781 3.3989 20.6011C2.4219 19.5312 1.92041 18.1107 2.01032 16.6652V7.33482C1.92041 5.88932 2.4209 4.46878 3.3979 3.39889C4.46781 2.42189 5.88835 1.92041 7.33488 2.01032H16.6643C18.1089 1.92041 19.5284 2.4209 20.5973 3.39789C21.5733 4.46878 22.0758 5.88832 21.9899 7.33482V16.6652C22.0788 18.1107 21.5783 19.5312 20.6013 20.6011C19.5314 21.5781 18.1109 22.0796 16.6643 21.9897Z" fill="currentColor"></path>
                                                    <path d="M17.0545 10.3976L10.5018 16.9829C10.161 17.3146 9.7131 17.5 9.24574 17.5H6.95762C6.83105 17.5 6.71421 17.4512 6.62658 17.3634C6.53895 17.2756 6.5 17.1585 6.5 17.0317L6.55842 14.7195C6.56816 14.261 6.75315 13.8317 7.07446 13.5098L11.7189 8.8561C11.7967 8.77805 11.9331 8.77805 12.011 8.8561L13.6399 10.4785C13.747 10.5849 13.9028 10.6541 14.0683 10.6541C14.4286 10.6541 14.7109 10.3615 14.7109 10.0102C14.7109 9.83463 14.6428 9.67854 14.5357 9.56146C14.5065 9.52244 12.9554 7.97805 12.9554 7.97805C12.858 7.88049 12.858 7.71463 12.9554 7.61707L13.6078 6.95366C14.2114 6.34878 15.1851 6.34878 15.7888 6.95366L17.0545 8.22195C17.6485 8.81707 17.6485 9.79268 17.0545 10.3976Z" fill="currentColor"></path>
                                                </svg> </a>
                                            @endcan

                                            @can('delete notifications')
                                            <a href="#" class="remove-item-btn" data-link="{{route('notification.delete.get', $item->id)}}" data-bs-toggle="tooltip" data-bs-original-title="Delete Notification"> <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.4" d="M19.643 9.48851C19.643 9.5565 19.11 16.2973 18.8056 19.1342C18.615 20.8751 17.4927 21.9311 15.8092 21.9611C14.5157 21.9901 13.2494 22.0001 12.0036 22.0001C10.6809 22.0001 9.38741 21.9901 8.13185 21.9611C6.50477 21.9221 5.38147 20.8451 5.20057 19.1342C4.88741 16.2873 4.36418 9.5565 4.35445 9.48851C4.34473 9.28351 4.41086 9.08852 4.54507 8.93053C4.67734 8.78453 4.86796 8.69653 5.06831 8.69653H18.9388C19.1382 8.69653 19.3191 8.78453 19.4621 8.93053C19.5953 9.08852 19.6624 9.28351 19.643 9.48851Z" fill="currentColor"></path>
                                                    <path d="M21 5.97686C21 5.56588 20.6761 5.24389 20.2871 5.24389H17.3714C16.7781 5.24389 16.2627 4.8219 16.1304 4.22692L15.967 3.49795C15.7385 2.61698 14.9498 2 14.0647 2H9.93624C9.0415 2 8.26054 2.61698 8.02323 3.54595L7.87054 4.22792C7.7373 4.8219 7.22185 5.24389 6.62957 5.24389H3.71385C3.32386 5.24389 3 5.56588 3 5.97686V6.35685C3 6.75783 3.32386 7.08982 3.71385 7.08982H20.2871C20.6761 7.08982 21 6.75783 21 6.35685V5.97686Z" fill="currentColor"></path>
                                                </svg>
                                            </a>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
