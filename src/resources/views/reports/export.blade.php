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
                        <div class="d-flex align-items-center filterset">
                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">Writer</label>
                                <input type="email" class="form-control form-control-sm" id="colFormLabelSm"
                                    placeholder="Writer">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">Start Date</label>
                                <input type="date" class="form-control form-control-sm" id="exampleInputdate"
                                    value="2023-01-27">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="colFormLabelSm">End Date Date</label>
                                <input type="date" class="form-control form-control-sm" id="exampleInputdate"
                                    value="2023-01-27">
                            </div>
                            <div class="form-group"><br /><a href="quickbook-export.html"
                                    class="btn btn-link btn-soft-light">
                                    Reset
                                </a></div>
                        </div>
                    </div>
                    <div class="p-0 card-body">
                        <div class="mt-4 table-responsive">
                            <script language="javascript" nonce="{{ csp_nonce() }}">
                                function toggle(source) {
                                    checkboxes = document.getElementsByName('foo');
                                    for (var i = 0, n = checkboxes.length; i < n; i++) {
                                        checkboxes[i].checked = source.checked;
                                    }
                                }
                            </script>
                            <table id="basic-table" class="table mb-0 table-striped" role="grid">
                                <thead>
                                    <tr>
                                        <th style="max-width: 10px;"><input type="checkbox" class="form-check-input"
                                                id="customCheck1" data-bs-toggle="tooltip"
                                                data-bs-original-title="Select All" onClick="toggle(this)"> </th>
                                        <th>Event ID</th>
                                        <th>Event</th>
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
                                                <input type="checkbox" class="form-check-input" name="foo"
                                                    id="customCheck1">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="view-job.html">EVD1x</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="iq-media-group iq-media-group-1">
                                                <a href="event.html"> Event Name</a>
                                            </div>
                                        </td>
                                        <td>John Doe</td>
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
                                            <a href="view-job.html" class="btn btn-primary">View Event</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <input type="checkbox" class="form-check-input" name="foo"
                                                    id="customCheck1">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="view-job.html">EVD1x</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="iq-media-group iq-media-group-1">
                                                <a href="#"> Event Name</a>
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
                                            <a href="view-job.html" class="btn btn-primary">View Event</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <input type="checkbox" class="form-check-input" name="foo"
                                                    id="customCheck1">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="view-job.html">EVD1x</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="iq-media-group iq-media-group-1">
                                                <a href="job.html"> Event Name</a>
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
                                            1Fuzid
                                        </td>
                                        <td>
                                            <a href="view-job.html" class="btn btn-primary">View Event</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <input type="checkbox" class="form-check-input" name="foo"
                                                    id="customCheck1">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="view-job.html">EVD1x</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="iq-media-group iq-media-group-1">
                                                <a href="job.html"> Event Name</a>
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
                                            <a href="view-job.html" class="btn btn-primary">View Event</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <input type="checkbox" class="form-check-input" name="foo"
                                                    id="customCheck1">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="view-job.html">EVD1x</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="iq-media-group iq-media-group-1">
                                                <a href="job.html"> Event Name</a>
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
                                            <a href="view-job.html" class="btn btn-primary">View Event</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <input type="checkbox" class="form-check-input" name="foo"
                                                    id="customCheck1">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="view-job.html">EVD1x</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="iq-media-group iq-media-group-1">
                                                <a href="job.html"> Event Name</a>
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
                                            <a href="view-job.html" class="btn btn-primary">View Event</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <input type="checkbox" class="form-check-input" name="foo"
                                                    id="customCheck1">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="view-job.html">EVD1x</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="iq-media-group iq-media-group-1">
                                                <a href="event.html"> Event Name</a>
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
                                            <a href="view-job.html" class="btn btn-primary">View Event</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <input type="checkbox" class="form-check-input" name="foo"
                                                    id="customCheck1">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="view-job.html">EVD1x</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="iq-media-group iq-media-group-1">
                                                <a href="job.html"> Event Name</a>
                                            </div>
                                        </td>
                                        <td>John Doe<br /> Jane Doe<br /> John </td>
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
                                            <a href="view-job.html" class="btn btn-primary">View Event</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <input type="checkbox" class="form-check-input" name="foo"
                                                    id="customCheck1">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="view-job.html">EVD1x</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="iq-media-group iq-media-group-1">
                                                <a href="job.html"> Event Name</a>
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
                                            <a href="view-job.html" class="btn btn-primary">View Event</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <input type="checkbox" class="form-check-input" name="foo"
                                                    id="customCheck1">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="view-job.html">EVD1x</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="iq-media-group iq-media-group-1">
                                                <a href="job.html"> Event Name</a>
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
                                            <a href="view-job.html" class="btn btn-primary">View Event</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <input type="checkbox" class="form-check-input" name="foo"
                                                    id="customCheck1">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="view-job.html">EVD1x</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="iq-media-group iq-media-group-1">
                                                <a href="#"> Event Name</a>
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