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
                    <div >
                        <a href="{{route('event.update.get', $event->id)}}" class="btn btn-primary">
                            Edit This Event
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="eventName">Event Name:</label>
                        <div class="col-sm-10">
                            {{$event->name}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="client">Client:</label>
                        <div class="col-sm-10">{{$event->client->name}} </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="invRate">Invoice Rate:</label>
                        <div class="col-sm-10">
                            $ {{$event->invoice_rate}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="startDate">Start Date:</label>
                        <div class="col-sm-3">
                            {{$event->start_date->format('M d Y')}}
                        </div>
                        <label class="control-label col-sm-2 align-self-center mb-0" for="startTime">Start Time:</label>
                        <div class="col-sm-3">
                            {{$event->start_time->format('h:i a')}}
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="endtDate">End Date:</label>
                        <div class="col-sm-3">
                            {{$event->end_date->format('M d Y')}}
                        </div>
                        <label class="control-label col-sm-2 align-self-center mb-0" for="endTime">End Time:</label>
                        <div class="col-sm-3">
                            {{$event->end_time->format('h:i a')}}
                        </div>
                    </div>
                    <div class="form-group row noborder">
                        <label class="control-label col-sm-2 align-self-center mb-0" for="recurringEvent">Recurring Event:</label>
                        <div class="col-sm-10">
                            @if(!$event->is_recurring_event)
                                No
                            @else
                                Yes <br />
                                Recurrs  {{$event->recurring_type}} @if($event->recurring_type->value=='Every') {{$event->recurring_days}} Days,@else, @endif<br />
                                End Day: {{$event->recurring_end_date->format('M d Y')}}
                            @endif
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
            @foreach($event->writers as $writers)
            <div class="form-group row">
                <div class="col-sm-2">Writer:</div>
                <div class="col-sm-4">
                    {{$writers->writer->name}}
                </div>
                <div class="col-sm-2">Billing Rate:</div>
                <div class="col-sm-4">
                    $ {{$writers->billing_rate}}
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Documents</h4>
            </div>
        </div>
        <div class="form-group">
            <table id="basic-table" class="table mb-0 table-striped mt-3" role="grid">
                <thead>
                    <tr>
                        <th>Document Name</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($event->documents as $document)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <a href="{{$document->document_link}}" download>{{str_replace("storage/documents/","",$document->document)}}</a>
                            </div>
                        </td>
                        <td>
                            <a href="{{$document->document_link}}" download data-bs-toggle="tooltip" data-bs-original-title="Download Document"> <svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.4" d="M17.554 7.29614C20.005 7.29614 22 9.35594 22 11.8876V16.9199C22 19.4453 20.01 21.5 17.564 21.5L6.448 21.5C3.996 21.5 2 19.4412 2 16.9096V11.8773C2 9.35181 3.991 7.29614 6.438 7.29614H7.378L17.554 7.29614Z" fill="currentColor"></path>
                                    <path d="M12.5464 16.0374L15.4554 13.0695C15.7554 12.7627 15.7554 12.2691 15.4534 11.9634C15.1514 11.6587 14.6644 11.6597 14.3644 11.9654L12.7714 13.5905L12.7714 3.2821C12.7714 2.85042 12.4264 2.5 12.0004 2.5C11.5754 2.5 11.2314 2.85042 11.2314 3.2821L11.2314 13.5905L9.63742 11.9654C9.33742 11.6597 8.85043 11.6587 8.54843 11.9634C8.39743 12.1168 8.32142 12.3168 8.32142 12.518C8.32142 12.717 8.39743 12.9171 8.54643 13.0695L11.4554 16.0374C11.6004 16.1847 11.7964 16.268 12.0004 16.268C12.2054 16.268 12.4014 16.1847 12.5464 16.0374Z" fill="currentColor"></path>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-header d-flex justify-content-between">
            <div class="header-title">
                <h4 class="card-title">Notes</h4>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                {{$event->notes}}
            </div>

        </div>
    </div>
</div>
@stop
