@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                        <div class="flex-wrap card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="mb-2 card-title">Events For Today</h4>
                                <p class="mb-0">
                                    <svg class="me-2 text-primary" width="24" height="24" viewBox="0 0 24 24">
                                        <path fill="#070F3A" d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z" />
                                    </svg>
                                    5th January 2023
                                </p>
                            </div>
                            <div>
                                <a href="{{route('event.paginate.get')}}" class="btn btn-primary">View All Events</a> <a
                                    href="{{route('calendar.view.get')}}" class="btn btn-primary">Calendar View</a>
                            </div>
                        </div>
                        <div class="p-0 card-body">
                            <div class="mt-4 table-responsive">
                                <table id="basic-table" class="table mb-0 table-striped" role="grid">
                                    <thead>
                                        <tr>
                                            <th>Event ID</th>
                                            <th>Event</th>
                                            <th>Company</th>
                                            <th>Writer</th>
                                            <th>Date</th>
                                            <th>Start Time</th>
                                            <th>End Time</th>
                                            <th>Prep</th>
                                            <th>1Fuzion ID</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="{{route('event.view.get', 1)}}">EVD1x</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="iq-media-group iq-media-group-1">
                                                    <a href="{{route('event.paginate.get')}}"> Event Name</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="iq-media-group iq-media-group-1">
                                                    <a href="#"> Company</a>
                                                </div>
                                            </td>
                                            <td>John Doe<br /> Jane Doe<br /> John</td>
                                            <td>
                                                5th Jan 2023</td>
                                            <td>10:30 AM </td>
                                            <td> 11:30 AM</td>
                                            <td> <svg width="32" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M14.3955 9.59497L9.60352 14.387" stroke="#FF0000"
                                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                    </path>
                                                    <path d="M14.3971 14.3898L9.60107 9.59277" stroke="#FF0000"
                                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                    </path>
                                                </svg> </td>
                                            <td>
                                                1Fuzid
                                            </td>
                                            <td>
                                                <a href="{{route('event.view.get', 1)}}" class="btn btn-primary">View Event</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="{{route('event.view.get', 1)}}">EVD1x</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="iq-media-group iq-media-group-1">
                                                    <a href="#"> Event Name</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="iq-media-group iq-media-group-1">
                                                    <a href="#"> Company</a>
                                                </div>
                                            </td>
                                            <td>John Doe</td>
                                            <td>
                                                5th Jan 2023</td>
                                            <td>10:30 AM </td>
                                            <td> 11:30 AM </td>
                                            <td><svg width="32" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9.38574 11.8746L11.2777 13.7696L15.1757 9.86963"
                                                        stroke="#1aa053" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg></td>
                                            <td>
                                                1Fuzid
                                            </td>
                                            <td>
                                                <a href="{{route('event.view.get', 1)}}" class="btn btn-primary">View Event</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="{{route('event.view.get', 1)}}">EVD1x</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="iq-media-group iq-media-group-1">
                                                    <a href="{{route('event.view.get', 1)}}"> Event Name</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="iq-media-group iq-media-group-1">
                                                    <a href="#"> Company</a>
                                                </div>
                                            </td>
                                            <td>John Doe<br /> Jane Doe<br /> John</td>
                                            <td>
                                                5th Jan 2023</td>
                                            <td>10:30 AM </td>
                                            <td> 11:30 AM </td>
                                            <td> <svg width="32" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M14.3955 9.59497L9.60352 14.387" stroke="#FF0000"
                                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                    </path>
                                                    <path d="M14.3971 14.3898L9.60107 9.59277" stroke="#FF0000"
                                                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                    </path>
                                                </svg> </td>
                                            <td>
                                                1Fuzid
                                            </td>
                                            <td>
                                                <a href="{{route('event.view.get', 1)}}" class="btn btn-primary">View Event</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="{{route('event.view.get', 1)}}">EVD1x</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="iq-media-group iq-media-group-1">
                                                    <a href="{{route('event.view.get', 1)}}"> Event Name</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="iq-media-group iq-media-group-1">
                                                    <a href="#"> Company</a>
                                                </div>
                                            </td>
                                            <td>John Doe</td>
                                            <td>
                                                5th Jan 2023</td>
                                            <td>10:30 AM </td>
                                            <td> 11:30 AM </td>
                                            <td><svg width="32" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9.38574 11.8746L11.2777 13.7696L15.1757 9.86963"
                                                        stroke="#1aa053" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg></td>
                                            <td>
                                            </td>
                                            <td>
                                                <a href="{{route('event.view.get', 1)}}" class="btn btn-primary">View Event</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="{{route('event.view.get', 1)}}">EVD1x</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="iq-media-group iq-media-group-1">
                                                    <a href="{{route('event.view.get', 1)}}"> Event Name</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="iq-media-group iq-media-group-1">
                                                    <a href="#"> Company</a>
                                                </div>
                                            </td>
                                            <td>John Doe</td>
                                            <td>
                                                5th Jan 2023</td>
                                            <td>10:30 AM </td>
                                            <td> 11:30 AM </td>
                                            <td> <svg width="32" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M14.3955 9.59497L9.60352 14.387" stroke="#FF0000"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                    <path d="M14.3971 14.3898L9.60107 9.59277" stroke="#FF0000"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg> </td>
                                            <td>
                                            </td>
                                            <td>
                                                <a href="{{route('event.view.get', 1)}}" class="btn btn-primary">View Event</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="{{route('event.view.get', 1)}}">EVD1x</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="iq-media-group iq-media-group-1">
                                                    <a href="{{route('event.view.get', 1)}}"> Event Name</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="iq-media-group iq-media-group-1">
                                                    <a href="#"> Company</a>
                                                </div>
                                            </td>
                                            <td>John Doe</td>
                                            <td>
                                                5th Jan 2023</td>
                                            <td>10:30 AM </td>
                                            <td> 11:30 AM </td>
                                            <td><svg width="32" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9.38574 11.8746L11.2777 13.7696L15.1757 9.86963"
                                                        stroke="#1aa053" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg></td>
                                            <td>
                                            </td>
                                            <td>
                                                <a href="{{route('event.view.get', 1)}}" class="btn btn-primary">View Event</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="{{route('event.view.get', 1)}}">EVD1x</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="iq-media-group iq-media-group-1">
                                                    <a href="{{route('event.paginate.get')}}"> Event Name</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="iq-media-group iq-media-group-1">
                                                    <a href="#"> Company</a>
                                                </div>
                                            </td>
                                            <td>John Doe</td>
                                            <td>
                                                5th Jan 2023</td>
                                            <td>10:30 AM </td>
                                            <td> 11:30 AM </td>
                                            <td><svg width="32" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9.38574 11.8746L11.2777 13.7696L15.1757 9.86963"
                                                        stroke="#1aa053" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg></td>
                                            <td>
                                            </td>
                                            <td>
                                                <a href="{{route('event.view.get', 1)}}" class="btn btn-primary">View Event</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="{{route('event.view.get', 1)}}">EVD1x</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="iq-media-group iq-media-group-1">
                                                    <a href="{{route('event.view.get', 1)}}"> Event Name</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="iq-media-group iq-media-group-1">
                                                    <a href="#"> Company</a>
                                                </div>
                                            </td>
                                            <td>John Doe</td>
                                            <td>
                                                5th Jan 2023</td>
                                            <td> 10:30 AM </td>
                                            <td> 11:30 AM</td>
                                            <td> <svg width="32" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M14.3955 9.59497L9.60352 14.387" stroke="#FF0000"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                    <path d="M14.3971 14.3898L9.60107 9.59277" stroke="#FF0000"
                                                        stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg> </td>
                                            <td>
                                            </td>
                                            <td>
                                                <a href="{{route('event.view.get', 1)}}" class="btn btn-primary">View Event</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="{{route('event.view.get', 1)}}">EVD1x</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="iq-media-group iq-media-group-1">
                                                    <a href="{{route('event.view.get', 1)}}"> Event Name</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="iq-media-group iq-media-group-1">
                                                    <a href="#"> Company</a>
                                                </div>
                                            </td>
                                            <td>John Doe</td>
                                            <td>
                                                5th Jan 2023</td>
                                            <td>10:30 AM </td>
                                            <td> 11:30 AM </td>
                                            <td><svg width="32" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9.38574 11.8746L11.2777 13.7696L15.1757 9.86963"
                                                        stroke="#1aa053" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg></td>
                                            <td>
                                            </td>
                                            <td>
                                                <a href="{{route('event.view.get', 1)}}" class="btn btn-primary">View Event</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="{{route('event.view.get', 1)}}">EVD1x</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="iq-media-group iq-media-group-1">
                                                    <a href="{{route('event.view.get', 1)}}"> Event Name</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="iq-media-group iq-media-group-1">
                                                    <a href="#"> Company</a>
                                                </div>
                                            </td>
                                            <td>John Doe</td>
                                            <td>
                                                6th Jan 2023</td>
                                            <td>10:30 AM </td>
                                            <td> 11:30 AM </td>
                                            <td><svg width="32" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9.38574 11.8746L11.2777 13.7696L15.1757 9.86963"
                                                        stroke="#1aa053" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg></td>
                                            <td>
                                            </td>
                                            <td>
                                                <a href="{{route('event.view.get', 1)}}" class="btn btn-primary">View Event</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <a href="{{route('event.view.get', 1)}}">EVD1x</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="iq-media-group iq-media-group-1">
                                                    <a href="#"> Event Name</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="iq-media-group iq-media-group-1">
                                                    <a href="#"> Company</a>
                                                </div>
                                            </td>
                                            <td>John Doe</td>
                                            <td>
                                                5th Jan 2023</td>
                                            <td>10:30 AM </td>
                                            <td> 11:30 AM </td>
                                            <td><svg width="32" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9.38574 11.8746L11.2777 13.7696L15.1757 9.86963"
                                                        stroke="#1aa053" stroke-width="1.5" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </svg></td>
                                            <td>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-primary">View Event</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
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
