@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="overflow-hidden card" data-aos="fade-up" data-aos-delay="600">
                    <div class="flex-wrap card-header d-flex justify-content-between">
                        <div class="header-title d-flex align-items-center gap-2">
                            <h4 class="mb-2 card-title">Documents</h4>
                            <form method="GET" action="{{route('document.paginate.get')}}" id='sort-form' class="col-auto">
                                <select class="form-select shadow-none" id="sort" name="sort">
                                    <option value="" {{empty(request()->query('sort')) ? 'selected' : ''}}>Sort By</option>
                                    <option value="writer" {{request()->query('sort')=='writer' ? 'selected' : ''}}>Writer:A-Z</option>
                                    <option value="-writer" {{request()->query('sort')=='-writer' ? 'selected' : ''}}>Writer:Z-A</option>
                                    <option value="-id" {{request()->query('sort')=='-id' ? 'selected' : ''}}>Event ID:Latest</option>
                                    <option value="id" {{request()->query('sort')=='id' ? 'selected' : ''}}>Event ID:Oldest</option>
                                    <option value="-start_date" {{request()->query('sort')=='-start_date' ? 'selected' : ''}}>Event Date:Latest</option>
                                    <option value="start_date" {{request()->query('sort')=='start_date' ? 'selected' : ''}}>Event Date:Oldest</option>
                                    <option value="-start_time" {{request()->query('sort')=='-start_time' ? 'selected' : ''}}>Event Time:Latest</option>
                                    <option value="start_time" {{request()->query('sort')=='start_time' ? 'selected' : ''}}>Event Time:Oldest</option>
                                </select>
                            </form>
                        </div>
                        <div>
                            @can('delete documents')
                            <button id="delete_documents" class="btn btn-primary d-none">Delete Documents</button>
                            @endcan
                            @can('add documents')
                            <a href="{{route('document.create.get')}}" class="btn btn-primary">Add Document</a>
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
                                        @can('delete documents')
                                        <th style="max-width: 10px;">
                                            <input type="checkbox" class="form-check-input" id="checkAll"  data-bs-toggle="tooltip" data-bs-original-title="Select All">
                                        </th>
                                        @endcan
                                        <th>Document Name</th>
                                        <th>Event ID</th>
                                        <th style="max-width: 170px; width: 170px;text-wrap:balance;">Client</th>
                                        <th style="max-width: 170px; width: 170px;text-wrap:balance;">Writer</th>
                                        <th>Start Date</th>
                                        <th>Start Time</th>
                                        <th>End Date</th>
                                        <th> End Time</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->items() as $item)
                                    <tr>
                                        @can('delete documents')
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if((auth()->user()->current_role=='Admin' || auth()->user()->current_role=='Staff-Admin') || (auth()->user()->current_role=='Writer') && $item->created_by==auth()->user()->id)
                                                    <input type="checkbox" class="form-check-input document-checkbox" value="{{$item->id}}" data-bs-toggle="tooltip" data-bs-original-title="Select {{str_replace("storage/documents/","",$item->document)}}">
                                                @endif
                                            </div>
                                        </td>
                                        @endcan
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="#" data-bs-toggle="tooltip" data-bs-original-title="{{str_replace("storage/documents/","",$item->document)}}">{{str()->limit(str_replace("storage/documents/","",$item->document), 30)}}</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="{{route('event.view.get', $item->event->id)}}">EVD{{$item->event->id}}</a>
                                            </div>
                                        </td>
                                        <td style="max-width: 170px; width: 170px;text-wrap:balance;">
                                            <div class="iq-media-group iq-media-group-1">
                                                {{$item->event->client->name}}
                                            </div>
                                        </td>
                                        <td style="max-width: 170px; width: 170px;text-wrap:balance;">
                                            @foreach($item->event->writers as $k=>$v)
                                                {!!($k+1==count($item->event->writers)) ? $v->writer->name : $v->writer->name.'<br/> '!!}
                                            @endforeach
                                        </td>
                                        <td>
                                            {{$item->event->start_date->format('M d Y')}}
                                        </td>
                                        <td>{{$item->event->start_time->format('h:i a')}}</td>
                                        <td>
                                            {{$item->event->end_date->format('M d Y')}}
                                        </td>
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

@section('javascript')
<script type="text/javascript" nonce="{{ csp_nonce() }}">
    document.getElementById('sort').addEventListener('change', function() {
        document.getElementById('sort-form').submit();
    });
</script>
@can('delete documents')
<script type="text/javascript" nonce="{{ csp_nonce() }}">
    let document_arr = []
    const checkAll = document.getElementById('checkAll');
    checkAll.addEventListener('input', function(){
        const document_checkbox = document.querySelectorAll('.document-checkbox');
        if(checkAll.checked){
            for (let index = 0; index < document_checkbox.length; index++) {
                if(document_checkbox[index].value.length>0){
                    document_checkbox[index].checked = true
                    if(!document_arr.includes(document_checkbox[index].value)){
                        document_arr.push(document_checkbox[index].value);
                    }
                }
            }
        }else{
            for (let index = 0; index < document_checkbox.length; index++) {
                if(document_checkbox[index].value.length>0){
                    document_checkbox[index].checked = false
                    document_arr= [];
                }
            }
        }
        toggleCancelBtn()
    })


    document.querySelectorAll('.document-checkbox').forEach(el => {
        el.addEventListener('input', function(event){
            toggleSingleCancelBtn(event)
        })
    });

    const toggleCancelBtn = () => {
        document.querySelectorAll('.document-checkbox').forEach(el => {
            if(el.checked && document_arr.length>0){
                document.getElementById('delete_documents').classList.add('d-inline-block')
                document.getElementById('delete_documents').classList.remove('d-none')
            }else{
                document.getElementById('delete_documents').classList.add('d-none')
                document.getElementById('delete_documents').classList.remove('d-inline-block')
            }
        })
    }

    const toggleSingleCancelBtn = (event) => {
        if(!event.target.checked){
            document_arr = document_arr.filter(function(item) {
                return item !== event.target.value
            })
        }else{
            if(!document_arr.includes(event.target.value)){
                document_arr.push(event.target.value)
            }
        }
        if(!event.target.checked && document_arr.length<1){
            document.getElementById('delete_documents').classList.add('d-none')
            document.getElementById('delete_documents').classList.remove('d-inline-block')
        }else{
            document.getElementById('delete_documents').classList.add('d-inline-block')
            document.getElementById('delete_documents').classList.remove('d-none')
        }
    }


    document.getElementById('delete_documents').addEventListener('click', function(){
        delete_documents_handler()
    })

    const delete_documents_handler = () => {
        iziToast.question({
            timeout: 20000,
            close: false,
            overlay: true,
            displayMode: 'once',
            id: 'question',
            zindex: 999,
            title: 'Hey',
            message: 'Are you sure about that?',
            position: 'center',
            buttons: [
                ['<button><b>YES</b></button>', async function (instance, toast) {

                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    var submitBtn = document.getElementById('delete_documents');
                    submitBtn.innerHTML = spinner
                    submitBtn.disabled = true;
                    try {

                        const response = await axios.post('{{route('document.delete.post')}}', {document: document_arr})
                        successToast(response.data.message)
                        setInterval(window.location.replace("{{route('document.paginate.get')}}"), 1500);
                    }catch (error){
                        if(error?.response?.data?.message){
                            errorToast(error?.response?.data?.message)
                        }
                    }finally{
                        submitBtn.innerHTML =  `
                            Cancel Event
                            `
                        submitBtn.disabled = false;
                    }

                }, true],
                ['<button>NO</button>', function (instance, toast) {

                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                }],
            ],
            onClosing: function(instance, toast, closedBy){
                console.info('Closing | closedBy: ' + closedBy);
            },
            onClosed: function(instance, toast, closedBy){
                console.info('Closed | closedBy: ' + closedBy);
            }
        });
    }


</script>
@endcan

@stop
