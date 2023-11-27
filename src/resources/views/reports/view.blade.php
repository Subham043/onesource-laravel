@extends('layouts.main')

@section('content')
<div class="row">
    @can('view conflicts')
    <div class="col-12 d-flex justify-content-end mb-3">
        <a href="{{route('dashboard.get')}}" class="btn btn-primary">Return To Dashboard</a>
    </div>
    <div class="col-sm-12 col-lg-4">

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title"> <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.4"
                                d="M4.72251 21.1672C4.70951 21.1672 4.69751 21.1672 4.68351 21.1662C4.36851 21.1502 4.05951 21.0822 3.76551 20.9632C2.31851 20.3752 1.62051 18.7222 2.20751 17.2762L9.52851 4.45025C9.78051 3.99425 10.1625 3.61225 10.6285 3.35425C11.9935 2.59825 13.7195 3.09525 14.4745 4.45925L21.7475 17.1872C21.9095 17.5682 21.9785 17.8782 21.9955 18.1942C22.0345 18.9502 21.7765 19.6752 21.2705 20.2362C20.7645 20.7972 20.0695 21.1282 19.3145 21.1662L4.79451 21.1672H4.72251Z"
                                fill="currentColor"></path>
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M11.1245 10.0208C11.1245 9.53875 11.5175 9.14575 11.9995 9.14575C12.4815 9.14575 12.8745 9.53875 12.8745 10.0208V12.8488C12.8745 13.3318 12.4815 13.7238 11.9995 13.7238C11.5175 13.7238 11.1245 13.3318 11.1245 12.8488V10.0208ZM11.1245 16.2699C11.1245 15.7849 11.5175 15.3899 11.9995 15.3899C12.4815 15.3899 12.8745 15.7799 12.8745 16.2589C12.8745 16.7519 12.4815 17.1449 11.9995 17.1449C11.5175 17.1449 11.1245 16.7519 11.1245 16.2699Z"
                                fill="currentColor"></path>
                        </svg> Conflicts</h4>
                </div>

            </div>
            <div class="card-body">
                <div class="">
                    <h5 class="mb-3">{{$conflict_count}} Conflicts</h5>
                    <div>
                        <a href="{{route('report.conflict.view.get')}}" class="btn btn-primary">Resolve</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endcan
    @can('view exports')
    <div class="col-sm-12 col-lg-4">

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title"><img src="{{asset('assets/images/1cap-app.jpg')}}" width="100px"></h4>
                </div>

            </div>
            <div class="card-body">
                <div class="">
                    <h5 class="mb-3">Export Events to 1CapApp</h5>
                    <div>
                        <a href="{{route('report.export.view.get')}}" class="btn btn-primary">Export</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endcan
    @can('view quickbook')
    <div class="col-sm-12 col-lg-4">

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title"> <svg class="icon-32" width="32" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M21.9964 8.37513H17.7618C15.7911 8.37859 14.1947 9.93514 14.1911 11.8566C14.1884 13.7823 15.7867 15.3458 17.7618 15.3484H22V15.6543C22 19.0136 19.9636 21 16.5173 21H7.48356C4.03644 21 2 19.0136 2 15.6543V8.33786C2 4.97862 4.03644 3 7.48356 3H16.5138C19.96 3 21.9964 4.97862 21.9964 8.33786V8.37513ZM6.73956 8.36733H12.3796H12.3831H12.3902C12.8124 8.36559 13.1538 8.03019 13.152 7.61765C13.1502 7.20598 12.8053 6.87318 12.3831 6.87491H6.73956C6.32 6.87664 5.97956 7.20858 5.97778 7.61852C5.976 8.03019 6.31733 8.36559 6.73956 8.36733Z"
                                fill="currentColor"></path>
                            <path opacity="0.4"
                                d="M16.0374 12.2966C16.2465 13.2478 17.0805 13.917 18.0326 13.8996H21.2825C21.6787 13.8996 22 13.5715 22 13.166V10.6344C21.9991 10.2297 21.6787 9.90077 21.2825 9.8999H17.9561C16.8731 9.90338 15.9983 10.8024 16 11.9102C16 12.0398 16.0128 12.1695 16.0374 12.2966Z"
                                fill="currentColor"></path>
                            <circle cx="18" cy="11.8999" r="1" fill="currentColor"></circle>
                        </svg> Quickbooks</h4>
                </div>

            </div>
            <div class="card-body">
                <div class="">
                    <h5 class="mb-3">Export Events to Quickbooks</h5>
                    <div>
                        <a href="{{route('report.quickbook.view.get')}}" class="btn btn-primary">Export</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @endcan
</div>
@stop
