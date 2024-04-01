<table id="basic-table" class="table mb-0">
    <thead>
        <tr>
            <th>Event ID</th>
            <th>Event</th>
            <th>Client</th>
            <th>Writer</th>
            <th>Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Total Time</th>
            <th>Billing Rate</th>
            <th>Total</th>
        </tr>
    </thead>
    @if($data->count() > 0)
        <tbody>
            @foreach ($data as $key=>$item)
                    @if($item->is_recurring_event)
                        @foreach ($item->event_repeated_date as $r_date)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="{{ route('event.view.get', $item->id) }}">EVD{{$item->id}}</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="iq-media-group iq-media-group-1">
                                        <a href="{{ route('event.view.get', $item->id) }}">{{$item->name}}</a>
                                    </div>
                                </td>
                                <td>{{$item->client->name}}</td>
                                <td>&nbsp;</td>
                                <td>
                                    {{date("M d Y", strtotime(str_replace('T05:30:00.000Z','',$r_date)))}}
                                </td>
                                <td>{{$item->start_time->format('h:i a')}}</td>
                                <td>{{$item->end_time->format('h:i a')}}</td>
                                <td> 1 Hour</td>
                                <td> {{$item->invoice_rate}} $ / hr </td>
                                <td>
                                    {{$item->invoice_rate}} $
                                </td>
                            </tr>
                            @foreach($item->writers as $k=>$v)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="{{ route('event.view.get', $item->id) }}">EVD{{$item->id}}</a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="iq-media-group iq-media-group-1">
                                            <a href="{{ route('event.view.get', $item->id) }}">{{$item->name}}</a>
                                        </div>
                                    </td>
                                    <td></td>
                                    <td>{{$v->writer->name}}</td>
                                    <td>
                                        {{date("M d Y", strtotime(str_replace('T05:30:00.000Z','',$r_date)))}}
                                    </td>
                                    <td>{{$item->start_time->format('h:i a')}}</td>
                                    <td>{{$item->end_time->format('h:i a')}}</td>
                                    <td> 1 Hour</td>
                                    <td> {{$v->billing_rate}} $ / hr </td>
                                    <td>
                                        {{$v->billing_rate}} $
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    @else
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('event.view.get', $item->id) }}">EVD{{$item->id}}</a>
                                </div>
                            </td>
                            <td>
                                <div class="iq-media-group iq-media-group-1">
                                    <a href="{{ route('event.view.get', $item->id) }}">{{$item->name}}</a>
                                </div>
                            </td>
                            <td>{{$item->client->name}}</td>
                            <td>&nbsp;</td>
                            <td>
                                {{$item->start_date->format('M d Y')}}
                            </td>
                            <td>{{$item->start_time->format('h:i a')}}</td>
                            <td>{{$item->end_time->format('h:i a')}}</td>
                            <td> 1 Hour</td>
                            <td> {{$item->invoice_rate}} $ / hr </td>
                            <td>
                                {{$item->invoice_rate}} $
                            </td>
                        </tr>
                        @foreach($item->writers as $k=>$v)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a href="{{ route('event.view.get', $item->id) }}">EVD{{$item->id}}</a>
                                    </div>
                                </td>
                                <td>
                                    <div class="iq-media-group iq-media-group-1">
                                        <a href="{{ route('event.view.get', $item->id) }}">{{$item->name}}</a>
                                    </div>
                                </td>
                                <td></td>
                                <td>{{$v->writer->name}}</td>
                                <td>
                                    {{$item->start_date->format('M d Y')}}
                                </td>
                                <td>{{$item->start_time->format('h:i a')}}</td>
                                <td>{{$item->end_time->format('h:i a')}}</td>
                                <td> 1 Hour</td>
                                <td> {{$v->billing_rate}} $ / hr </td>
                                <td>
                                    {{$v->billing_rate}} $
                                </td>
                            </tr>
                        @endforeach
                    @endif
            @endforeach
        </tbody>
    @else
    <tbody>
        <tr>
            <td colspan="10">
                <p class="text-center">No data available</p>
            </td>
        </tr>
    </tbody>
    @endif
</table>
