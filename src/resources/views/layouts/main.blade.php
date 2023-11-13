<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>1Source | Appointment Management</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}" />
    <!-- H1source Design  Css Built -->
    <link rel="stylesheet" href="{{asset('assets/css/iziToast.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/1source.css')}}" />
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}" />
    <!-- Fullcalender CSS -->
    <link rel='stylesheet' href="{{asset('assets/vendor/fullcalendar/core/main.css')}}" />
    <link rel='stylesheet' href="{{asset('assets/vendor/fullcalendar/daygrid/main.css')}}" />
    <link rel='stylesheet' href="{{asset('assets/vendor/fullcalendar/timegrid/main.css')}}" />
    <link rel='stylesheet' href="{{asset('assets/vendor/fullcalendar/list/main.css')}}" />
    <style nonce="{{ csp_nonce() }}">
        .header-auth-img{
            object-fit: contain;
            height: 50px;
            width: 50px;
            border: 1px solid #ccc;
            border-radius: 50%;
        }
    </style>
    @yield('css')
</head>

<body class="  ">
    <div class="cwrapper">
        <!-- loader Start -->
        @include('includes.loader')
        <!-- loader END -->
        @include('includes.sidebar')
        <main class="main-content">
            <div class="position-relative iq-banner">
                <!--Nav Start-->
                @include('includes.header')
                <!-- Nav Header Component Start -->
                @include('includes.breadcrumb')
                <!-- Nav Header Component End -->
                <!--Nav End-->
            </div>
            <div class="conatiner-fluid content-inner mt-n5 py-0">
                @yield('content')
            </div>
            <!-- Footer Section Start -->
            @include('includes.footer')
            <!-- Footer Section End -->
        </main>
    </div>
    <!-- Wrapper End-->
    <!-- offcanvas start -->
    <!-- Library Bundle Script -->
    <script src="{{asset('assets/js/core/libs.min.js')}}"></script>
    <!-- External Library Bundle Script -->
    <script src="{{asset('assets/js/core/external.min.js')}}"></script>
    <!-- fslightbox Script -->
    <script src="{{asset('assets/js/plugins/fslightbox.js')}}"></script>
    <!-- Settings Script -->
    <script src="{{asset('assets/js/plugins/setting.js')}}"></script>
    <!-- Slider-tab Script -->
    <script src="{{asset('assets/js/plugins/slider-tabs.js')}}"></script>
    <!-- Form Wizard Script -->
    <script src="{{asset('assets/js/plugins/form-wizard.js')}}"></script>
    <!-- App Script -->
    <script src="{{asset('assets/js/1source.js')}}" defer></script>
    <!-- Axios Script -->
    <script src="{{asset('assets/js/plugins/axios.min.js')}}"></script>
    <!-- Toast Script -->
    <script src="{{asset('assets/js/plugins/iziToast.min.js')}}"></script>
    <!-- Validate Script -->
    <script src="{{asset('assets/js/plugins/just-validate.production.min.js')}}"></script>

    <script type="text/javascript" nonce="{{ csp_nonce() }}">

        const CHOICE_CONFIG = {
                silent: false,
                items: [],
                renderChoiceLimit: -1,
                maxItemCount: -1,
                addItems: true,
                addItemFilter: null,
                removeItems: true,
                removeItemButton: false,
                editItems: false,
                allowHTML: true,
                duplicateItemsAllowed: true,
                delimiter: ',',
                paste: true,
                searchEnabled: true,
                searchChoices: true,
                searchFloor: 1,
                searchResultLimit: 4,
                searchFields: ['label', 'value'],
                position: 'auto',
                resetScrollPosition: true,
                shouldSort: true,
                shouldSortItems: false,
                // sorter: () => {...},
                placeholder: true,
                searchPlaceholderValue: null,
                prependValue: null,
                appendValue: null,
                renderSelectedChoices: 'auto',
                loadingText: 'Loading...',
                noResultsText: 'No results found',
                noChoicesText: 'No choices to choose from',
                itemSelectText: 'Press to select',
                addItemText: (value) => {
                    return `Press Enter to add <b>"${value}"</b>`;
                },
                maxItemText: (maxItemCount) => {
                    return `Only ${maxItemCount} values can be added`;
                },
                valueComparer: (value1, value2) => {
                    return value1 === value2;
                },
                classNames: {
                    containerOuter: 'choices',
                    containerInner: 'choices__inner',
                    input: 'choices__input',
                    inputCloned: 'choices__input--cloned',
                    list: 'choices__list',
                    listItems: 'choices__list--multiple',
                    listSingle: 'choices__list--single',
                    listDropdown: 'choices__list--dropdown',
                    item: 'choices__item',
                    itemSelectable: 'choices__item--selectable',
                    itemDisabled: 'choices__item--disabled',
                    itemChoice: 'choices__item--choice',
                    placeholder: 'choices__placeholder',
                    group: 'choices__group',
                    groupHeading: 'choices__heading',
                    button: 'choices__button',
                    activeState: 'is-active',
                    focusState: 'is-focused',
                    openState: 'is-open',
                    disabledState: 'is-disabled',
                    highlightedState: 'is-highlighted',
                    selectedState: 'is-selected',
                    flippedState: 'is-flipped',
                    loadingState: 'is-loading',
                    noResults: 'has-no-results',
                    noChoices: 'has-no-choices'
                },
                // Choices uses the great Fuse library for searching. You
                // can find more options here: https://fusejs.io/api/options.html
                fuseOptions: {
                    includeScore: true
                },
                labelId: '',
                callbackOnInit: null,
                callbackOnCreateTemplates: null
            };

        @if (session('success_status'))

            iziToast.success({
                title: 'Success',
                message: '{{ Session::get('success_status') }}',
                position: 'bottomCenter',
                timeout:6000
            });

        @endif
        @if (session('error_status'))

            iziToast.error({
                title: 'Error',
                message: '{{ Session::get('error_status') }}',
                position: 'bottomCenter',
                timeout:6000
            });

        @endif

    </script>

    <script type="text/javascript" nonce="{{ csp_nonce() }}">

        const errorToast = (message) =>{
            iziToast.error({
                title: 'Error',
                message: message,
                position: 'bottomCenter',
                timeout:7000
            });
        }
        const successToast = (message) =>{
            iziToast.success({
                title: 'Success',
                message: message,
                position: 'bottomCenter',
                timeout:6000
            });
        }

        const spinner = `
            <span class="d-flex align-items-center">
                <span class="spinner-border flex-shrink-0" role="status">
                    <span class="visually-hidden">Loading...</span>
                </span>
                <span class="flex-grow-1 ms-2">
                    Loading...
                </span>
            </span>
        `;

        document.querySelectorAll('.remove-item-btn').forEach(el => {
            el.addEventListener('click', function(){
                deleteHandler(event.target.getAttribute('data-link'))
            })
        });

        function deleteHandler(url){
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
                    ['<button><b>YES</b></button>', function (instance, toast) {

                        window.location.replace(url);
                        // instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

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

    @yield('javascript')
</body>

</html>
