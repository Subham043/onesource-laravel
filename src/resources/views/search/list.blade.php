@extends('layouts.main')

@section('content')
<div class="row">
    @if(!empty(request()->query('filter')['search']))
    <div class="col-md-12 col-lg-12">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                    <div class="flex-wrap card-header d-flex justify-content-between align-items-center">
                        <div class="header-title">
                            <h4 class="mb-0 card-title">Events</h4>
                        </div>
                        <div>
                            @can('add events')
                            <a href="{{route('event.create.get')}}" class="btn btn-primary">Add Event</a>
                            @endcan
                            @can('view calendar')
                            <a href="{{route('calendar.view.get')}}" class="btn btn-primary">Calendar View</a>
                            @endcan
                        </div>
                    </div>
                    <div class="p-0 card-body">
                        @if($event_data->total() > 0)
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
                                        <th>Prep</th>
                                        <th>Fuzion ID</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($event_data->items() as $item)
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
                                            <a href="#" class="remove-item-btn" data-link="{{route('event.prep.get', $item->id)}}" data-bs-toggle="tooltip" data-bs-original-title="Prep">
                                                @if($item->is_prep_ready)
                                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9.38574 11.8746L11.2777 13.7696L15.1757 9.86963" stroke="#1aa053" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                                @else
                                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M14.3955 9.59497L9.60352 14.387" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M14.3971 14.3898L9.60107 9.59277" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                                @endif
                                            </a>
                                        </td>
                                        <td>{{$item->fuzion_id}}</td>
                                        <td>

                                            @can('edit events')
                                            <a href="#" class="remove-item-btn" data-link="{{route('event.status.get', $item->id)}}" data-bs-toggle="tooltip" data-bs-original-title="Cancelled">
                                                @if(!$item->is_active)
                                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9.38574 11.8746L11.2777 13.7696L15.1757 9.86963" stroke="#1aa053" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                                @else
                                                <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M14.3955 9.59497L9.60352 14.387" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M14.3971 14.3898L9.60107 9.59277" stroke="#FF0000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                                @endif
                                            </a>
                                            @endcan

                                            @can('view events')
                                            <a href="{{route('event.view.get', $item->id)}}" class="" data-bs-toggle="tooltip" data-bs-original-title="View Event"> <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M17.7366 6.04606C19.4439 7.36388 20.8976 9.29455 21.9415 11.7091C22.0195 11.8924 22.0195 12.1067 21.9415 12.2812C19.8537 17.1103 16.1366 20 12 20H11.9902C7.86341 20 4.14634 17.1103 2.05854 12.2812C1.98049 12.1067 1.98049 11.8924 2.05854 11.7091C4.14634 6.87903 7.86341 4 11.9902 4H12C14.0683 4 16.0293 4.71758 17.7366 6.04606ZM8.09756 12C8.09756 14.1333 9.8439 15.8691 12 15.8691C14.1463 15.8691 15.8927 14.1333 15.8927 12C15.8927 9.85697 14.1463 8.12121 12 8.12121C9.8439 8.12121 8.09756 9.85697 8.09756 12Z" fill="currentColor"></path>
                                                    <path d="M14.4308 11.997C14.4308 13.3255 13.3381 14.4115 12.0015 14.4115C10.6552 14.4115 9.5625 13.3255 9.5625 11.997C9.5625 11.8321 9.58201 11.678 9.61128 11.5228H9.66006C10.743 11.5228 11.621 10.6695 11.6601 9.60184C11.7674 9.58342 11.8845 9.57275 12.0015 9.57275C13.3381 9.57275 14.4308 10.6588 14.4308 11.997Z" fill="currentColor"></path>
                                                </svg>
                                            </a>
                                            @endcan

                                            @can('edit events')
                                            <a href="{{route('event.update.get', $item->id)}}" class="" data-bs-toggle="tooltip" data-bs-original-title="Edit Event"> <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.4" d="M16.6643 21.9897H7.33488C5.88835 22.0796 4.46781 21.5781 3.3989 20.6011C2.4219 19.5312 1.92041 18.1107 2.01032 16.6652V7.33482C1.92041 5.88932 2.4209 4.46878 3.3979 3.39889C4.46781 2.42189 5.88835 1.92041 7.33488 2.01032H16.6643C18.1089 1.92041 19.5284 2.4209 20.5973 3.39789C21.5733 4.46878 22.0758 5.88832 21.9899 7.33482V16.6652C22.0788 18.1107 21.5783 19.5312 20.6013 20.6011C19.5314 21.5781 18.1109 22.0796 16.6643 21.9897Z" fill="currentColor"></path>
                                                    <path d="M17.0545 10.3976L10.5018 16.9829C10.161 17.3146 9.7131 17.5 9.24574 17.5H6.95762C6.83105 17.5 6.71421 17.4512 6.62658 17.3634C6.53895 17.2756 6.5 17.1585 6.5 17.0317L6.55842 14.7195C6.56816 14.261 6.75315 13.8317 7.07446 13.5098L11.7189 8.8561C11.7967 8.77805 11.9331 8.77805 12.011 8.8561L13.6399 10.4785C13.747 10.5849 13.9028 10.6541 14.0683 10.6541C14.4286 10.6541 14.7109 10.3615 14.7109 10.0102C14.7109 9.83463 14.6428 9.67854 14.5357 9.56146C14.5065 9.52244 12.9554 7.97805 12.9554 7.97805C12.858 7.88049 12.858 7.71463 12.9554 7.61707L13.6078 6.95366C14.2114 6.34878 15.1851 6.34878 15.7888 6.95366L17.0545 8.22195C17.6485 8.81707 17.6485 9.79268 17.0545 10.3976Z" fill="currentColor"></path>
                                                </svg> </a>
                                            @endcan

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="card-header">
                                {{$event_data->onEachSide(5)->links()}}
                            </div>
                        </div>
                        @else
                            <p class="text-center">No data available</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12">
                <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                    <div class="flex-wrap card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="mb-2 card-title">Documents</h4>
                        </div>
                        <div>
                            @can('delete documents')
                            <button id="delete_documents" class="btn btn-primary d-none">Delete Documents</button>
                            @endcan
                            @can('add documents')
                            <a href="{{route('document.create.get')}}" class="btn btn-primary">Add Document</a>
                            @endcan
                        </div>
                    </div>
                    <div class="p-0 card-body">
                        @if($document_data->total() > 0)
                        <div class="mt-4 table-responsive">
                            <table id="basic-table" class="table mb-0 table-striped" role="grid">
                                <thead>
                                    <tr>
                                        <th>Document Name</th>
                                        <th>Event ID</th>
                                        <th>Client</th>
                                        <th>Writer</th>
                                        <th>Event Date</th>
                                        <th>Start Time</th>
                                        <th> End Time</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($document_data->items() as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" data-bs-toggle="tooltip" data-bs-original-title="{{str_replace("storage/documents/","",$item->document)}}">{{str()->limit(str_replace("storage/documents/","",$item->document), 30)}}...</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="{{route('event.view.get', $item->event->id)}}">EVD{{$item->event->id}}</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="iq-media-group iq-media-group-1">
                                                {{$item->event->client->name}}
                                            </div>
                                        </td>
                                        <td>
                                            @foreach($item->event->writers as $k=>$v)
                                                {!!($k+1==count($item->event->writers)) ? $v->writer->name : $v->writer->name.'<br/> '!!}
                                            @endforeach
                                        </td>
                                        <td>
                                            {{$item->event->start_date->format('M d Y')}}
                                        </td>
                                        <td>{{$item->event->start_time->format('h:i a')}}</td>
                                        <td>{{$item->event->end_time->format('h:i a')}}</td>
                                        <td>
                                            @can('download documents')
                                            <a href="{{$item->document_link}}" download="" class="" data-bs-toggle="tooltip" data-bs-original-title="Download Document"> <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.4" d="M17.554 7.29614C20.005 7.29614 22 9.35594 22 11.8876V16.9199C22 19.4453 20.01 21.5 17.564 21.5L6.448 21.5C3.996 21.5 2 19.4412 2 16.9096V11.8773C2 9.35181 3.991 7.29614 6.438 7.29614H7.378L17.554 7.29614Z" fill="currentColor"></path>
                                                    <path d="M12.5464 16.0374L15.4554 13.0695C15.7554 12.7627 15.7554 12.2691 15.4534 11.9634C15.1514 11.6587 14.6644 11.6597 14.3644 11.9654L12.7714 13.5905L12.7714 3.2821C12.7714 2.85042 12.4264 2.5 12.0004 2.5C11.5754 2.5 11.2314 2.85042 11.2314 3.2821L11.2314 13.5905L9.63742 11.9654C9.33742 11.6597 8.85043 11.6587 8.54843 11.9634C8.39743 12.1168 8.32142 12.3168 8.32142 12.518C8.32142 12.717 8.39743 12.9171 8.54643 13.0695L11.4554 16.0374C11.6004 16.1847 11.7964 16.268 12.0004 16.268C12.2054 16.268 12.4014 16.1847 12.5464 16.0374Z" fill="currentColor"></path>
                                                </svg>
                                            </a>
                                            @endcan
                                            @can('delete documents')
                                                @if((auth()->user()->current_role=='Admin' || auth()->user()->current_role=='Staff-Admin') || (auth()->user()->current_role=='Writer') && $item->created_by==auth()->user()->id)
                                                <a href="#" class="remove-item-btn" data-link="{{route('document.delete.get', $item->id)}}" data-bs-toggle="tooltip" data-bs-original-title="Delete Document"> <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.4" d="M19.643 9.48851C19.643 9.5565 19.11 16.2973 18.8056 19.1342C18.615 20.8751 17.4927 21.9311 15.8092 21.9611C14.5157 21.9901 13.2494 22.0001 12.0036 22.0001C10.6809 22.0001 9.38741 21.9901 8.13185 21.9611C6.50477 21.9221 5.38147 20.8451 5.20057 19.1342C4.88741 16.2873 4.36418 9.5565 4.35445 9.48851C4.34473 9.28351 4.41086 9.08852 4.54507 8.93053C4.67734 8.78453 4.86796 8.69653 5.06831 8.69653H18.9388C19.1382 8.69653 19.3191 8.78453 19.4621 8.93053C19.5953 9.08852 19.6624 9.28351 19.643 9.48851Z" fill="currentColor"></path>
                                                        <path d="M21 5.97686C21 5.56588 20.6761 5.24389 20.2871 5.24389H17.3714C16.7781 5.24389 16.2627 4.8219 16.1304 4.22692L15.967 3.49795C15.7385 2.61698 14.9498 2 14.0647 2H9.93624C9.0415 2 8.26054 2.61698 8.02323 3.54595L7.87054 4.22792C7.7373 4.8219 7.22185 5.24389 6.62957 5.24389H3.71385C3.32386 5.24389 3 5.56588 3 5.97686V6.35685C3 6.75783 3.32386 7.08982 3.71385 7.08982H20.2871C20.6761 7.08982 21 6.75783 21 6.35685V5.97686Z" fill="currentColor"></path>
                                                    </svg>
                                                </a>
                                                @endif
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="card-header">
                                {{$document_data->onEachSide(5)->links()}}
                            </div>
                        </div>
                        @else
                            <p class="text-center">No data available</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-12">
                <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                    <div class="flex-wrap card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="mb-2 card-title">Users</h4>
                        </div>
                        <div>
                            <a href="{{route('user.create.get')}}" class="btn btn-primary">Add User</a>
                        </div>
                    </div>
                    <div class="p-0 card-body">
                        @if($user_data->total() > 0)
                        <div class="mt-4 table-responsive">
                            <table id="basic-table" class="table mb-0 table-striped" role="grid">
                                <thead>
                                    <tr>
                                        <th> Name</th>
                                        <th>Email ID</th>
                                        <th>Role</th>
                                        <th>Registration Date</th>

                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user_data->items() as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="{{route('user.view.get', $item->id)}}">{{$item->name}}</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="{{route('user.view.get', $item->id)}}">{{$item->email}}</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="iq-media-group iq-media-group-1">
                                                {{($item->current_role=='Staff-Admin' || $item->current_role=='Super-Admin' || $item->current_role=='Super Admin') ? 'Admin' : $item->current_role}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="{{route('user.view.get', $item->id)}}">
                                                    {{$item->member_profile_created_by_auth->created_at->format('M d Y')}}
                                                </a>
                                            </div>
                                        </td>

                                        <td>
                                            @can('edit users')
                                                @if(!$item->is_blocked)
                                                    <a href="#" class="remove-item-btn" data-link="{{route('user.status.get', $item->id)}}" data-bs-toggle="tooltip" data-bs-original-title="Active"> <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M9.38574 11.8746L11.2777 13.7696L15.1757 9.86963" stroke="#1aa053" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                @else
                                                    <a href="#" class="remove-item-btn" data-link="{{route('user.status.get', $item->id)}}" data-bs-toggle="tooltip" data-bs-original-title="Blocked">
                                                        <svg fill="red" width="10px" height="10px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                            viewBox="0 0 460.775 460.775" xml:space="preserve">
                                                            <path d="M285.08,230.397L456.218,59.27c6.076-6.077,6.076-15.911,0-21.986L423.511,4.565c-2.913-2.911-6.866-4.55-10.992-4.55
                                                            c-4.127,0-8.08,1.639-10.993,4.55l-171.138,171.14L59.25,4.565c-2.913-2.911-6.866-4.55-10.993-4.55
                                                            c-4.126,0-8.08,1.639-10.992,4.55L4.558,37.284c-6.077,6.075-6.077,15.909,0,21.986l171.138,171.128L4.575,401.505
                                                            c-6.074,6.077-6.074,15.911,0,21.986l32.709,32.719c2.911,2.911,6.865,4.55,10.992,4.55c4.127,0,8.08-1.639,10.994-4.55
                                                            l171.117-171.12l171.118,171.12c2.913,2.911,6.866,4.55,10.993,4.55c4.128,0,8.081-1.639,10.992-4.55l32.709-32.719
                                                            c6.074-6.075,6.074-15.909,0-21.986L285.08,230.397z"/>
                                                        </svg>
                                                    </a>
                                                @endif
                                            @endcan

                                            @can('view users')
                                            <a href="{{route('user.view.get', $item->id)}}" class="" data-bs-toggle="tooltip" data-bs-original-title="View User"> <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.4" fill-rule="evenodd" clip-rule="evenodd" d="M17.7366 6.04606C19.4439 7.36388 20.8976 9.29455 21.9415 11.7091C22.0195 11.8924 22.0195 12.1067 21.9415 12.2812C19.8537 17.1103 16.1366 20 12 20H11.9902C7.86341 20 4.14634 17.1103 2.05854 12.2812C1.98049 12.1067 1.98049 11.8924 2.05854 11.7091C4.14634 6.87903 7.86341 4 11.9902 4H12C14.0683 4 16.0293 4.71758 17.7366 6.04606ZM8.09756 12C8.09756 14.1333 9.8439 15.8691 12 15.8691C14.1463 15.8691 15.8927 14.1333 15.8927 12C15.8927 9.85697 14.1463 8.12121 12 8.12121C9.8439 8.12121 8.09756 9.85697 8.09756 12Z" fill="currentColor"></path>
                                                    <path d="M14.4308 11.997C14.4308 13.3255 13.3381 14.4115 12.0015 14.4115C10.6552 14.4115 9.5625 13.3255 9.5625 11.997C9.5625 11.8321 9.58201 11.678 9.61128 11.5228H9.66006C10.743 11.5228 11.621 10.6695 11.6601 9.60184C11.7674 9.58342 11.8845 9.57275 12.0015 9.57275C13.3381 9.57275 14.4308 10.6588 14.4308 11.997Z" fill="currentColor"></path>
                                                </svg>
                                            </a>
                                            @endcan

                                            @can('edit users')
                                            <a href="{{route('user.update.get', $item->id)}}" class="" data-bs-toggle="tooltip" data-bs-original-title="Edit User"> <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.4" d="M16.6643 21.9897H7.33488C5.88835 22.0796 4.46781 21.5781 3.3989 20.6011C2.4219 19.5312 1.92041 18.1107 2.01032 16.6652V7.33482C1.92041 5.88932 2.4209 4.46878 3.3979 3.39889C4.46781 2.42189 5.88835 1.92041 7.33488 2.01032H16.6643C18.1089 1.92041 19.5284 2.4209 20.5973 3.39789C21.5733 4.46878 22.0758 5.88832 21.9899 7.33482V16.6652C22.0788 18.1107 21.5783 19.5312 20.6013 20.6011C19.5314 21.5781 18.1109 22.0796 16.6643 21.9897Z" fill="currentColor"></path>
                                                    <path d="M17.0545 10.3976L10.5018 16.9829C10.161 17.3146 9.7131 17.5 9.24574 17.5H6.95762C6.83105 17.5 6.71421 17.4512 6.62658 17.3634C6.53895 17.2756 6.5 17.1585 6.5 17.0317L6.55842 14.7195C6.56816 14.261 6.75315 13.8317 7.07446 13.5098L11.7189 8.8561C11.7967 8.77805 11.9331 8.77805 12.011 8.8561L13.6399 10.4785C13.747 10.5849 13.9028 10.6541 14.0683 10.6541C14.4286 10.6541 14.7109 10.3615 14.7109 10.0102C14.7109 9.83463 14.6428 9.67854 14.5357 9.56146C14.5065 9.52244 12.9554 7.97805 12.9554 7.97805C12.858 7.88049 12.858 7.71463 12.9554 7.61707L13.6078 6.95366C14.2114 6.34878 15.1851 6.34878 15.7888 6.95366L17.0545 8.22195C17.6485 8.81707 17.6485 9.79268 17.0545 10.3976Z" fill="currentColor"></path>
                                                </svg> </a>
                                            @endcan

                                            @can('delete users')
                                            <a href="#" class="remove-item-btn" data-link="{{route('user.delete.get', $item->id)}}" data-bs-toggle="tooltip" data-bs-original-title="Delete User"> <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.4" d="M19.643 9.48851C19.643 9.5565 19.11 16.2973 18.8056 19.1342C18.615 20.8751 17.4927 21.9311 15.8092 21.9611C14.5157 21.9901 13.2494 22.0001 12.0036 22.0001C10.6809 22.0001 9.38741 21.9901 8.13185 21.9611C6.50477 21.9221 5.38147 20.8451 5.20057 19.1342C4.88741 16.2873 4.36418 9.5565 4.35445 9.48851C4.34473 9.28351 4.41086 9.08852 4.54507 8.93053C4.67734 8.78453 4.86796 8.69653 5.06831 8.69653H18.9388C19.1382 8.69653 19.3191 8.78453 19.4621 8.93053C19.5953 9.08852 19.6624 9.28351 19.643 9.48851Z" fill="currentColor"></path>
                                                    <path d="M21 5.97686C21 5.56588 20.6761 5.24389 20.2871 5.24389H17.3714C16.7781 5.24389 16.2627 4.8219 16.1304 4.22692L15.967 3.49795C15.7385 2.61698 14.9498 2 14.0647 2H9.93624C9.0415 2 8.26054 2.61698 8.02323 3.54595L7.87054 4.22792C7.7373 4.8219 7.22185 5.24389 6.62957 5.24389H3.71385C3.32386 5.24389 3 5.56588 3 5.97686V6.35685C3 6.75783 3.32386 7.08982 3.71385 7.08982H20.2871C20.6761 7.08982 21 6.75783 21 6.35685V5.97686Z" fill="currentColor"></path>
                                                </svg> </a>
                                            @endcan
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="card-header">
                                {{$user_data->onEachSide(5)->links()}}
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
    @else
    <div class="col-md-12 col-lg-12">
        <p class="text-center">Type in searchbar to search something...</p>
    </div>
    @endif
</div>
@stop
