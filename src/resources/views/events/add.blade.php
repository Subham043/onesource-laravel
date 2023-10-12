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
                            <input type="email" class="form-control" id="eventName" placeholder=" ">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="client">Client:</label>
                        <div class="col-sm-10">
                            <select class="form-select shadow-none">
                                <option selected="">Select Client</option>
                                <option value="1">Client One</option>
                                <option value="2">Client Two</option>
                                <option value="3"> Client Three</option>
                            </select></div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="invRate">Invoice Rate:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pwd2" placeholder=" ">
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
                        <div class="col-sm-10"><input class="form-check-input" type="checkbox" value="" id="recurringEvent">
                        </div>
                    </div>
                    <div class="form-group row noborder">
                        <label class="control-label col-sm-2 align-self-center mb-0" for=""></label>
                        <div class="col-sm-10">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
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
                                    <input type="password" class="form-control" id="pwd2" placeholder=" ">
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
                                    <input type="date" class="form-control" id="exampleInputdate" value="2023-01-27"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card repeater-writer">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="header-title">
                        <h4 class="card-title">Assign Details</h4>
                    </div>
                    <div class="col-sm-auto">
                        <button data-repeater-create class="btn btn-primary" type="button">Add Writer</button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-12" data-repeater-list="group-a">
                        <div class="form-group row" data-repeater-item>
                            <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Writer:</label>
                            <div class="col-sm-4">
                                <select class="form-select shadow-none">
                                    <option selected="">Select Writer</option>
                                    <option value="1">Writer One</option>
                                    <option value="2">Writer Two</option>
                                    <option value="3"> Writer Three</option>
                                </select>
                            </div>
                            <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Billing Rate:</label>
                            <div class="col-sm-3">
                                <input type="email" class="form-control" id="eventName" placeholder=" ">
                            </div>
                            <div class="col-sm-1">
                                <button data-repeater-delete class="btn btn-danger" type="button">-</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card repeater-document">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="header-title">
                        <h4 class="card-title">Documents</h4>
                    </div>
                    <div class="col-sm-auto">
                        <button data-repeater-create class="btn btn-primary" type="button">Add Document</button>
                    </div>
                </div>
                <div class="card-body" data-repeater-list="group-a">
                    <div class="form-group row justify-content-between" data-repeater-item>
                        <div class="col-sm-11">
                            <input class="form-control" type="file" id="customFile">
                        </div>
                        <div class="col-sm-1">
                            <button data-repeater-delete class="btn btn-danger" type="button">-</button>
                        </div>
                    </div>
                </div>
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4 class="card-title">Notes</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <textarea class="form-control" aria-label="Notes"></textarea>
                    </div>
                    <form action="{{route('event.view.get', 1)}}"> <button type="submit" class="btn btn-primary" formaction="{{route('event.view.get', 1)}}">Create Event</button></form>
                </div>
            </div>
        </form>
    </div>
</div>
@stop

@section('javascript')
<script src="{{asset('assets/js/plugins/jquery.js')}}"></script>
<script src="{{asset('assets/js/plugins/jquery.repeater.js')}}"></script>

<script type="text/javascript" nonce="{{ csp_nonce() }}">
(function( $ ) {
    $(document).ready(function() {
        $('.repeater-writer').repeater({
            // options and callbacks here
            // isFirstItemUndeletable:true,
            initEmpty:false,
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                if(confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            },
            ready: function (setIndexes) {
            }
        });
        $('.repeater-document').repeater({
            // options and callbacks here
            // isFirstItemUndeletable:true,
            initEmpty:false,
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                if(confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            },
            ready: function (setIndexes) {
            }
        });
    });
})(jQuery);
</script>

@stop
