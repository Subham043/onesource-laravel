@extends('layouts.main')


@section('content')
    <div>
        <div class="col-sm-12 col-lg-12">
            <form id="profileForm" method="POST" action="{{route('notification.template.post')}}" class="form-horizontal" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Notification Template</h4>
                        </div>
                        <div>
                            @can('add notifications')
                            <a href="{{route('notification.send.get')}}" class="btn btn-primary">Send Notification</a>
                            @endcan
                            @can('add notifications')
                            <a href="{{route('notification.log.get')}}" class="btn btn-primary">Logs</a>
                            @endcan
                            <a href="{{route('dashboard.get')}}" class="btn btn-primary">Dashboard</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label class="control-label col-sm-2 align-self-center mb-0" for="logo">Logo<span data-bs-toggle="tooltip" data-bs-original-title="This will appear in the header of the email notification"><i class="icon">
                                <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='currentColor'><circle cx='6' cy='6' r='4.5'/><path stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/><circle cx='6' cy='8.2' r='.6' fill='currentColor' stroke='none'/></svg>
                           </i></span>:</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="logo" name="logo" aria-describedby="logo">
                                    @error('logo')
                                        <div class="invalid-message">{{ $message }}</div>
                                    @enderror
                                @if(!empty($data) && $data->logo)
                                    <div class="mt-1">
                                        <img src="{{$data->logo_link}}" style="height: 100px;object-fit:contain;" />
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-2 align-self-center mb-0" for="footer">Footer:</label>
                            <div class="col-sm-10">
                                <div id="footer_quill">{!! !empty($data) ? (old('footer') ? old('footer') : $data->footer) : old('footer') !!}</div>
                                <input type="hidden" id="footer" name="footer" value="{{!empty($data) ? (old('footer') ? old('footer') : $data->footer) : old('footer')}}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" id="submitBtn">Save</button>
                        <a href="{{route('notification.send.get')}}" class="btn btn-danger">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop


@section('javascript')
<script src="{{asset('assets/js/plugins/ckeditor.js')}}"></script>

<script type="text/javascript" nonce="{{ csp_nonce() }}">

let editor;
const CKEDITOR_OPTIONS = {
    // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
    toolbar: {
        items: [
            'findAndReplace', 'selectAll', '|',
            'heading', '|',
            'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
            'bulletedList', 'numberedList', 'todoList', '|',
            'outdent', 'indent', '|',
            'undo', 'redo',
            'fontSize', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
            'alignment', '|',
            'link', 'blockQuote', 'insertTable', '|',
            'specialCharacters', 'horizontalLine', 'pageBreak', '|',
            'sourceEditing'
        ],
        shouldNotGroupWhenFull: true
    },
    // Changing the language of the interface requires loading the language file using the <script> tag.
    // language: 'es',
    list: {
        properties: {
            styles: true,
            startIndex: true,
            reversed: true
        }
    },
    // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
    heading: {
        options: [
            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
            { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
            { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
            { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
            { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
            { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
            { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
        ]
    },
    // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
    placeholder: '',
    // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
    fontSize: {
        options: [ 10, 12, 14, 'default', 18, 20, 22 ],
        supportAllValues: true
    },
    // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
    // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
    htmlSupport: {
        allow: [
            {
                name: /.*/,
                attributes: true,
                classes: true,
                styles: true
            }
        ]
    },
    // Be careful with enabling previews
    // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
    htmlEmbed: {
        showPreviews: true
    },
    // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
    link: {
        decorators: {
            addTargetToExternalLinks: true,
            defaultProtocol: 'https://',
            toggleDownloadable: {
                mode: 'manual',
                label: 'Downloadable',
                attributes: {
                    download: 'file'
                }
            }
        }
    },
    // The "super-build" contains more premium features that require additional configuration, disable them below.
    // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
    removePlugins: [
        // These two are commercial, but you can try them out without registering to a trial.
        // 'ExportPdf',
        // 'ExportWord',
        'CKBox',
        'CKFinder',
        'EasyImage',
        // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
        // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
        // Storing images as Base64 is usually a very bad idea.
        // Replace it on production website with other solutions:
        // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
        // 'Base64UploadAdapter',
        'RealTimeCollaborativeComments',
        'RealTimeCollaborativeTrackChanges',
        'RealTimeCollaborativeRevisionHistory',
        'PresenceList',
        'Comments',
        'TrackChanges',
        'TrackChangesData',
        'RevisionHistory',
        'Pagination',
        'WProofreader',
        // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
        // from a local file system (file://) - load this site via HTTP server if you enable MathType.
        'MathType',
        // The following features are part of the Productivity Pack and require additional license.
        'SlashCommand',
        'Template',
        'DocumentOutline',
        'FormatPainter',
        'TableOfContents',
        'PasteFromOfficeEnhanced'
    ]
};

CKEDITOR.ClassicEditor
.create(document.getElementById("footer_quill"), CKEDITOR_OPTIONS)
.then( newEditor => {
    editor = newEditor;
    editor.model.document.on( 'change:data', () => {
        document.getElementById('footer').value = editor.getData()
    } );
});

// initialize the validation library
const validation = new JustValidate('#profileForm', {
      errorFieldCssClass: 'is-invalid',
      focusInvalidField: true,
      lockForm: true,
});
// apply rules to form fields
validation
  .addField('#logo', [
    {
        validator: (value, fields) => true
    },
  ])
  .addField('#footer', [
    {
        rule: 'required',
        errorMessage: 'Footer is required',
    },
  ])
  .onSuccess(async (event) => {
    // event.target.submit();
    var submitBtn = document.getElementById('submitBtn')
    submitBtn.innerHTML = spinner
    submitBtn.disabled = true;
    try {
        var formData = new FormData();
        formData.append('footer',editor.getData())
        if((document.getElementById('logo').files).length>0){
            formData.append('logo',document.getElementById('logo').files[0])
        }

        const response = await axios.post('{{route('notification.template.post')}}', formData)
        successToast(response.data.message)
        setInterval(location.reload(), 1500);
    }catch (error){
        console.log(error);
        if(error?.response?.data?.errors?.footer){
            validation.showErrors({'#footer': error?.response?.data?.errors?.footer[0]})
        }
        if(error?.response?.data?.errors?.logo){
            validation.showErrors({'#logo': error?.response?.data?.errors?.logo[0]})
        }
        if(error?.response?.data?.message){
            errorToast(error?.response?.data?.message)
        }
    }finally{
        submitBtn.innerHTML =  `
            Save
            `
        submitBtn.disabled = false;
    }
  });
</script>

@stop
