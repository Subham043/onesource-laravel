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
                            Event Name
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="client">Client:</label>
                        <div class="col-sm-10">Client </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="client">Company:</label>
                        <div class="col-sm-10">Company </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="invRate">Invoice Rate:</label>
                        <div class="col-sm-10">
                            $ 100
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="startDate">Start Date:</label>
                        <div class="col-sm-3">
                            2023-01-27</div>
                        <label class="control-label col-sm-2 align-self-center mb-0" for="startTime">Start Time:</label>
                        <div class="col-sm-3">
                            13:45
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="endtDate">End Date:</label>
                        <div class="col-sm-3">
                            2023-01-27</div>
                        <label class="control-label col-sm-2 align-self-center mb-0" for="endTime">End Time:</label>
                        <div class="col-sm-3">
                            14:45
                        </div>
                    </div>
                    <div class="form-group row noborder">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="recurringEvent">Recurring Event:</label>
                        <div class="col-sm-10">Yes <br />
                            Recurrs  Every Week, for 50 Days,<br />
                            End Day: 2024-01-27
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Writers</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <div class="col-sm-2">Writer:</div>
                <div class="col-sm-3">
                    John Doe
                </div>
                <div class="col-sm-2">Billing Rate:</div>
                <div class="col-sm-3">
                    $ 80
                </div>
                <div class="col-sm-2">
                    <a href="#" class="btn btn-primary">Edit</a>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2">Writer:</div>
                <div class="col-sm-3">
                    Jane
                </div>
               <div class="col-sm-2">Billing Rate:</div>
                <div class="col-sm-3">
                    $ 80
                </div>
                <div class="col-sm-2">
                    <a href="#" class="btn btn-primary">Edit</a>
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
                <a href="#">DocumentName.docs</a>
            </div>
            <div class="form-group">
                <a href="#">DocumentName.docs</a>
            </div>
            <div class="form-group">
                <a href="#">DocumentName.docs</a>
            </div>
        </div>

        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Notes</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                This event has notes.
            </div>

        </div>
    </div>
</div>
@stop
