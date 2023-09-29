@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                    <div class="flex-wrap card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="mb-2 card-title">You have 5 Conflicts</h4>
                        </div>
                    </div>
                    <div class="p-0 card-body">
                        <div class="mt-4 table-responsive">
                            <table id="basic-table" class="table mb-0 table-striped" role="grid">
                                <thead>
                                    <tr>
                                        <th>Writer</th>
                                        <th>Conflict Type</th>
                                        <th>Event ID</th>
                                        <th>Event</th>
                                        <th>Date</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="2">John Doe</td>
                                        <td rowspan="2">External</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                Exxx <span data-bs-toggle="tooltip"
                                                    data-bs-original-title="You cannot view/edit an external event"><i
                                                        class="icon">
                                                        <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12'
                                                            width='12' height='12' fill='none'
                                                            stroke='currentColor'>
                                                            <circle cx='6' cy='6' r='4.5' />
                                                            <path stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z' />
                                                            <circle cx='6' cy='8.2' r='.6'
                                                                fill='currentColor' stroke='none' />
                                                        </svg>
                                                    </i></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="iq-media-group iq-media-group-1">
                                                Evxxx
                                            </div>
                                        </td>
                                        <td>
                                            5th Jan 2023</td>
                                        <td>10:00 AM </td>
                                        <td> 11:30 AM</td>
                                        <td class="">
                                            <a href="#" class="btn disabled">View Event </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="padfix">
                                            <div class="d-flex align-items-center">
                                                <a href="view-job.html">EVD1x</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="iq-media-group iq-media-group-1">
                                                <a href="view-job.html"> Event Name</a>
                                            </div>
                                        </td>
                                        <td>
                                            5th Jan 2023</td>
                                        <td>10:30 AM </td>
                                        <td> 11:30 AM</td>
                                        <td>
                                            <a href="resolve-event-conflict.html" class="btn btn-primary">Edit Event</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                    <div class="p-0 card-body">
                        <div class="mt-0 table-responsive">
                            <table id="basic-table" class="table mb-0 table-striped" role="grid">
                                <thead>
                                    <tr>
                                        <th>Writer</th>
                                        <th>Conflict Type</th>
                                        <th>Event ID</th>
                                        <th>Event</th>
                                        <th>Date</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="2">Jane Doe</td>
                                        <td rowspan="2">Internal</td>

                                        <td class="padfix">
                                            <div class="d-flex align-items-center">
                                                <a href="view-job.html">EVD3x</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="iq-media-group iq-media-group-1">
                                                <a href="view-job.html"> Event Name 3</a>
                                            </div>
                                        </td>
                                        <td>
                                            5th Jan 2023</td>
                                        <td>10:00 AM </td>
                                        <td> 11:30 AM</td>
                                        <td>
                                            <a href="resolve-event-conflict.html" class="btn btn-primary">Edit Event</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="padfix">
                                            <div class="d-flex align-items-center">
                                                <a href="view-job.html">EVD1x</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="iq-media-group iq-media-group-1">
                                                <a href="view-job.html"> Event Name</a>
                                            </div>
                                        </td>
                                        <td>
                                            5th Jan 2023</td>
                                        <td>10:30 AM </td>
                                        <td> 11:30 AM</td>
                                        <td>
                                            <a href="resolve-event-conflict.html" class="btn btn-primary">Edit Event</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                    <div class="p-0 card-body">
                        <div class="mt-0 table-responsive">
                            <table id="basic-table" class="table mb-0 table-striped" role="grid">
                                <thead>
                                    <tr>
                                        <th>Writer</th>
                                        <th>Conflict Type</th>
                                        <th>Event ID</th>
                                        <th>Event</th>
                                        <th>Date</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="2">Jane Doe</td>
                                        <td rowspan="2">Internal</td>

                                        <td class="padfix">
                                            <div class="d-flex align-items-center">
                                                <a href="view-job.html">EVD3x</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="iq-media-group iq-media-group-1">
                                                <a href="view-job.html"> Event Name 3</a>
                                            </div>
                                        </td>
                                        <td>
                                            5th Jan 2023</td>
                                        <td>10:00 AM </td>
                                        <td> 11:30 AM</td>
                                        <td>
                                            <a href="resolve-event-conflict.html" class="btn btn-primary">Edit Event</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="padfix">
                                            <div class="d-flex align-items-center">
                                                <a href="view-job.html">EVD1x</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="iq-media-group iq-media-group-1">
                                                <a href="view-job.html"> Event Name</a>
                                            </div>
                                        </td>
                                        <td>
                                            5th Jan 2023</td>
                                        <td>10:30 AM </td>
                                        <td> 11:30 AM</td>
                                        <td>
                                            <a href="resolve-event-conflict.html" class="btn btn-primary">Edit Event</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                    <div class="p-0 card-body">
                        <div class="mt-0 table-responsive">
                            <table id="basic-table" class="table mb-0 table-striped" role="grid">
                                <thead>
                                    <tr>
                                        <th>Writer</th>
                                        <th>Conflict Type</th>
                                        <th>Event ID</th>
                                        <th>Event</th>
                                        <th>Date</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="2">Jane Doe</td>
                                        <td rowspan="2">Internal</td>

                                        <td class="padfix">
                                            <div class="d-flex align-items-center">
                                                <a href="view-job.html">EVD3x</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="iq-media-group iq-media-group-1">
                                                <a href="view-job.html"> Event Name 3</a>
                                            </div>
                                        </td>
                                        <td>
                                            5th Jan 2023</td>
                                        <td>10:00 AM </td>
                                        <td> 11:30 AM</td>
                                        <td>
                                            <a href="resolve-event-conflict.html" class="btn btn-primary">Edit
                                                Event</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="padfix">
                                            <div class="d-flex align-items-center">
                                                <a href="view-job.html">EVD1x</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="iq-media-group iq-media-group-1">
                                                <a href="view-job.html"> Event Name</a>
                                            </div>
                                        </td>
                                        <td>
                                            5th Jan 2023</td>
                                        <td>10:30 AM </td>
                                        <td> 11:30 AM</td>
                                        <td>
                                            <a href="resolve-event-conflict.html" class="btn btn-primary">Edit
                                                Event</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                    <div class="p-0 card-body">
                        <div class="mt-0 table-responsive">
                            <table id="basic-table" class="table mb-0 table-striped" role="grid">
                                <thead>
                                    <tr>
                                        <th>Writer</th>
                                        <th>Conflict Type</th>
                                        <th>Event ID</th>
                                        <th>Event</th>
                                        <th>Date</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="2">Jane Doe</td>
                                        <td rowspan="2">Internal</td>

                                        <td class="padfix">
                                            <div class="d-flex align-items-center">
                                                <a href="view-job.html">EVD3x</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="iq-media-group iq-media-group-1">
                                                <a href="view-job.html"> Event Name 3</a>
                                            </div>
                                        </td>
                                        <td>
                                            5th Jan 2023</td>
                                        <td>10:00 AM </td>
                                        <td> 11:30 AM</td>
                                        <td>
                                            <a href="resolve-event-conflict.html" class="btn btn-primary">Edit
                                                Event</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="padfix">
                                            <div class="d-flex align-items-center">
                                                <a href="view-job.html">EVD1x</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="iq-media-group iq-media-group-1">
                                                <a href="view-job.html"> Event Name</a>
                                            </div>
                                        </td>
                                        <td>
                                            5th Jan 2023</td>
                                        <td>10:30 AM </td>
                                        <td> 11:30 AM</td>
                                        <td>
                                            <a href="resolve-event-conflict.html" class="btn btn-primary">Edit
                                                Event</a>
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
@stop
