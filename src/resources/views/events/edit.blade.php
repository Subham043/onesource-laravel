@extends('layouts.main')

@section('content')
<div>
    <div class="col-sm-12 col-lg-12">
        <form class="form-horizontal">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Event Details</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Event Name:</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="eventName" placeholder="Event Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="client">Client:</label>
                        <div class="col-sm-10">
                            <select class="form-select shadow-none">
                                <option>Select Client</option>
                                <option value="1" selected="">Client One</option>
                                <option value="2">Client Two</option>
                                <option value="3"> Client Three</option>
                            </select></div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="invRate">Invoice Rate:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pwd2" placeholder="$100 ">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="startDate">Start Date:</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control" id="exampleInputdate" value="2023-01-27"></div>
                        <label class="control-label col-sm-2 align-self-center mb-0" for="startTime">Start Time:</label>
                        <div class="col-sm-3">
                            <input type="time" class="form-control" id="exampleInputtime" value="13:45">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="endtDate">End Date:</label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control" id="exampleInputdate" value="2023-01-27"></div>
                        <label class="control-label col-sm-2 align-self-center mb-0" for="endTime">End Time:</label>
                        <div class="col-sm-3">
                            <input type="time" class="form-control" id="exampleInputtime" value="13:45">
                        </div>
                    </div>
                    <div class="form-group row noborder">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="recurringEvent">Recurring Event:</label>
                        <div class="col-sm-10"><input class="form-check-input" type="checkbox" value="" id="recurringEvent" checked>
                        </div>
                    </div>
                    <div class="form-group row noborder">
                        <label class="control-label col-sm-2 align-self-center mb-0" for=""></label>
                        <div class="col-sm-10">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1" checked="true">
                                Daily
                            </label>
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Weekly
                            </label>
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Monthly
                            </label>
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Yearly
                            </label>
                            <div class="row mt-4">
                                <div class="col-sm-2"> <input class="form-check-input" type="radio" name="flexRadioDefault2" id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Every
                                    </label>
                                </div>
                                <div class="col-sm-2">
                                    <input type="password" class="form-control" id="pwd2" placeholder="7 ">
                                </div><label class="control-label col-sm-2 align-self-center mb-0" for="invRate">Days</label>
                                <div class="col-sm-2"> <input class="form-check-input" type="radio" name="flexRadioDefault3" id="flexRadioDefault3">
                                    <label class="form-check-label" for="flexRadioDefault3">
                                        Every Week Day
                                    </label>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <label class="control-label col-sm-2 align-self-center mb-0" for="endtDate">End Date:</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control" id="exampleInputdate" value="2024-01-27"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Assign Details</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Writer:</label>
                        <div class="col-sm-3">
                            <input type="email" class="form-control" id="eventName" placeholder="John Doe">
                        </div>
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Billing Rate:</label>
                        <div class="col-sm-3">
                            <input type="email" class="form-control" id="eventName" placeholder="$50 ">
                        </div>
                        <div class="col-sm-2">
                            <a href="#" class="btn btn-primary">+</a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Writer:</label>
                        <div class="col-sm-3">
                            <input type="email" class="form-control" id="eventName" placeholder="Jane Doe ">
                        </div>
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Billing Rate:</label>
                        <div class="col-sm-3">
                            <input type="email" class="form-control" id="eventName" placeholder="$60 ">
                        </div>
                        <div class="col-sm-2">
                            <a href="#" class="btn btn-primary">+</a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Writer:</label>
                        <div class="col-sm-3">
                            <input type="email" class="form-control" id="eventName" placeholder="Mark ">
                        </div>
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Billing Rate:</label>
                        <div class="col-sm-3">
                            <input type="email" class="form-control" id="eventName" placeholder="$50 ">
                        </div>
                        <div class="col-sm-2">
                            <a href="#" class="btn btn-primary">+</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Documents</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <table id="basic-table" class="table mb-0 table-striped" role="grid">
                            <thead>
                                <tr>
                                    <th>Document Name</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#">DocumentName.docx</a>
                                        </div>
                                    </td>
                                    <td>
                                            <a href="#" class="" data-bs-toggle="tooltip" data-bs-original-title="Download Document"> <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.4" d="M17.554 7.29614C20.005 7.29614 22 9.35594 22 11.8876V16.9199C22 19.4453 20.01 21.5 17.564 21.5L6.448 21.5C3.996 21.5 2 19.4412 2 16.9096V11.8773C2 9.35181 3.991 7.29614 6.438 7.29614H7.378L17.554 7.29614Z" fill="currentColor"></path>
                                                    <path d="M12.5464 16.0374L15.4554 13.0695C15.7554 12.7627 15.7554 12.2691 15.4534 11.9634C15.1514 11.6587 14.6644 11.6597 14.3644 11.9654L12.7714 13.5905L12.7714 3.2821C12.7714 2.85042 12.4264 2.5 12.0004 2.5C11.5754 2.5 11.2314 2.85042 11.2314 3.2821L11.2314 13.5905L9.63742 11.9654C9.33742 11.6597 8.85043 11.6587 8.54843 11.9634C8.39743 12.1168 8.32142 12.3168 8.32142 12.518C8.32142 12.717 8.39743 12.9171 8.54643 13.0695L11.4554 16.0374C11.6004 16.1847 11.7964 16.268 12.0004 16.268C12.2054 16.268 12.4014 16.1847 12.5464 16.0374Z" fill="currentColor"></path>
                                                </svg> </a>
                                            <a href="#" class="" data-bs-toggle="tooltip" data-bs-original-title="Delete Document"> <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.4" d="M19.643 9.48851C19.643 9.5565 19.11 16.2973 18.8056 19.1342C18.615 20.8751 17.4927 21.9311 15.8092 21.9611C14.5157 21.9901 13.2494 22.0001 12.0036 22.0001C10.6809 22.0001 9.38741 21.9901 8.13185 21.9611C6.50477 21.9221 5.38147 20.8451 5.20057 19.1342C4.88741 16.2873 4.36418 9.5565 4.35445 9.48851C4.34473 9.28351 4.41086 9.08852 4.54507 8.93053C4.67734 8.78453 4.86796 8.69653 5.06831 8.69653H18.9388C19.1382 8.69653 19.3191 8.78453 19.4621 8.93053C19.5953 9.08852 19.6624 9.28351 19.643 9.48851Z" fill="currentColor"></path>
                                                    <path d="M21 5.97686C21 5.56588 20.6761 5.24389 20.2871 5.24389H17.3714C16.7781 5.24389 16.2627 4.8219 16.1304 4.22692L15.967 3.49795C15.7385 2.61698 14.9498 2 14.0647 2H9.93624C9.0415 2 8.26054 2.61698 8.02323 3.54595L7.87054 4.22792C7.7373 4.8219 7.22185 5.24389 6.62957 5.24389H3.71385C3.32386 5.24389 3 5.56588 3 5.97686V6.35685C3 6.75783 3.32386 7.08982 3.71385 7.08982H20.2871C20.6761 7.08982 21 6.75783 21 6.35685V5.97686Z" fill="currentColor"></path>
                                                </svg> </a>
                                        </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#">DocumentName.docx</a>
                                        </div>
                                    </td>
                                   <td>
                                            <a href="#" class="" data-bs-toggle="tooltip" data-bs-original-title="Download Document"> <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.4" d="M17.554 7.29614C20.005 7.29614 22 9.35594 22 11.8876V16.9199C22 19.4453 20.01 21.5 17.564 21.5L6.448 21.5C3.996 21.5 2 19.4412 2 16.9096V11.8773C2 9.35181 3.991 7.29614 6.438 7.29614H7.378L17.554 7.29614Z" fill="currentColor"></path>
                                                    <path d="M12.5464 16.0374L15.4554 13.0695C15.7554 12.7627 15.7554 12.2691 15.4534 11.9634C15.1514 11.6587 14.6644 11.6597 14.3644 11.9654L12.7714 13.5905L12.7714 3.2821C12.7714 2.85042 12.4264 2.5 12.0004 2.5C11.5754 2.5 11.2314 2.85042 11.2314 3.2821L11.2314 13.5905L9.63742 11.9654C9.33742 11.6597 8.85043 11.6587 8.54843 11.9634C8.39743 12.1168 8.32142 12.3168 8.32142 12.518C8.32142 12.717 8.39743 12.9171 8.54643 13.0695L11.4554 16.0374C11.6004 16.1847 11.7964 16.268 12.0004 16.268C12.2054 16.268 12.4014 16.1847 12.5464 16.0374Z" fill="currentColor"></path>
                                                </svg> </a>
                                            <a href="#" class="" data-bs-toggle="tooltip" data-bs-original-title="Delete Document"> <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.4" d="M19.643 9.48851C19.643 9.5565 19.11 16.2973 18.8056 19.1342C18.615 20.8751 17.4927 21.9311 15.8092 21.9611C14.5157 21.9901 13.2494 22.0001 12.0036 22.0001C10.6809 22.0001 9.38741 21.9901 8.13185 21.9611C6.50477 21.9221 5.38147 20.8451 5.20057 19.1342C4.88741 16.2873 4.36418 9.5565 4.35445 9.48851C4.34473 9.28351 4.41086 9.08852 4.54507 8.93053C4.67734 8.78453 4.86796 8.69653 5.06831 8.69653H18.9388C19.1382 8.69653 19.3191 8.78453 19.4621 8.93053C19.5953 9.08852 19.6624 9.28351 19.643 9.48851Z" fill="currentColor"></path>
                                                    <path d="M21 5.97686C21 5.56588 20.6761 5.24389 20.2871 5.24389H17.3714C16.7781 5.24389 16.2627 4.8219 16.1304 4.22692L15.967 3.49795C15.7385 2.61698 14.9498 2 14.0647 2H9.93624C9.0415 2 8.26054 2.61698 8.02323 3.54595L7.87054 4.22792C7.7373 4.8219 7.22185 5.24389 6.62957 5.24389H3.71385C3.32386 5.24389 3 5.56588 3 5.97686V6.35685C3 6.75783 3.32386 7.08982 3.71385 7.08982H20.2871C20.6761 7.08982 21 6.75783 21 6.35685V5.97686Z" fill="currentColor"></path>
                                                </svg> </a>
                                        </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="mt-5"><strong>Add Documents </strong></p>
                    <div class="form-group">
                        <input class="form-control" type="file" id="customFile">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="file" id="customFile">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="file" id="customFile">
                    </div>

                </div>
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Notes</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <textarea class="form-control" aria-label="Notes" placeholder="This event has notes"></textarea>
                    </div>
                    <form action="view-job.html"> <button type="submit" class="btn btn-primary" formaction="view-job.html">Save Changes</button></form>
                </div>
            </div>
        </form>
    </div>
</div>
@stop
