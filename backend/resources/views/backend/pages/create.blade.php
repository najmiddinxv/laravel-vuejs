@extends('backend.layouts.main')
@section('title')
    - {{ __('lang.edit') }}
@endsection
@section('content')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.pages.index') }}">Page</a></li>
                <li class="breadcrumb-item active">{{ __('lang.create') }}</li>
            </ol>
        </nav>
    </div>
    <x-alert-message-component></x-alert-message-component>
    <form action="{{ route('backend.pages.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card card-primary">
                    <div class="card-body">
                        <div>
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link active" id="pills-uz-tab" data-bs-toggle="pill" data-bs-target="#pills-uz" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Uz</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="pills-ru-tab" data-bs-toggle="pill" data-bs-target="#pills-ru" type="button" role="tab" aria-controls="pills-profile" aria-selected="false" tabindex="-1">Ру</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <button class="nav-link" id="pills-en-tab" data-bs-toggle="pill" data-bs-target="#pills-en" type="button" role="tab" aria-controls="pills-contact" aria-selected="false" tabindex="-1">En</button>
                                </li>
                              </ul>
                              <div class="tab-content pt-2" id="myTabContent">
                                <div class="tab-pane fade active show" id="pills-uz" role="tabpanel" aria-labelledby="uz-tab">
                                    <div class="form-group">
                                        <label for="title_uz" class="form-label">Title uz</label>
                                        <input type="text" name="title[uz]" id="title_uz"
                                            class="form-control @error('title.uz') error-data-input @enderror"
                                            value="{{ old('title.uz') }}" required>
                                        <span class="error-data">
                                            @error('title.uz')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="description_uz" class="form-label">Description uz</label>
                                        <textarea class="form-control @error('description.uz') error-data-input @enderror" name="description[uz]" id="description_uz"  style="height: 130px;" >{{ old('description.uz') }}</textarea>
                                        <span class="error-data">
                                            @error('description.uz')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="body_uz" class="form-label">Body uz</label>
                                        <textarea class="tinymce-editor @error('body.uz') error-data-input @enderror" name="body[uz]" id="body_uz"  style="height: 130px;" >{{ old('body.uz') }}</textarea>
                                        <span class="error-data">
                                            @error('body.uz')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-ru" role="tabpanel" aria-labelledby="ru-tab">
                                    <div class="form-group">
                                        <label for="title_ru" class="form-label">Title ru</label>
                                        <input type="text" name="title[ru]" id="title_ru"
                                            class="form-control @error('title.ru') error-data-input @enderror"
                                            value="{{ old('title.ru') }}">
                                        <span class="error-data">
                                            @error('title.ru')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="description_ru" class="form-label">Description ru</label>
                                        <textarea class="form-control @error('description.uz') error-data-input @enderror" name="description[ru]" id="description_ru" style="height: 130px;" >{{ old('description.ru') }}</textarea>
                                        <span class="error-data">
                                            @error('description.ru')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="body_ru" class="form-label">Body ru</label>
                                        <textarea class="tinymce-editor @error('body.ru') error-data-input @enderror" name="body[ru]" id="body_ru"  style="height: 130px;" >{{ old('body.ru') }}</textarea>
                                        <span class="error-data">
                                            @error('body.ru')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-en" role="tabpanel" aria-labelledby="en-tab">
                                    <div class="form-group">
                                        <label for="title_en" class="form-label">Title en</label>
                                        <input type="text" name="title[en]" id="title_en"
                                            class="form-control @error('title.en') error-data-input @enderror"
                                            value="{{ old('title.en') }}">
                                        <span class="error-data">
                                            @error('title.en')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="description_en" class="form-label">Description en</label>
                                        <textarea class="form-control @error('description.uz') error-data-input @enderror" name="description[en]" id="description_en" style="height: 130px;" >{{ old('description.en') }}</textarea>
                                        <span class="error-data">
                                            @error('description.en')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="body_en" class="form-label">Body ru</label>
                                        <textarea class="tinymce-editor @error('body.en') error-data-input @enderror" name="body[en]" id="body_en"  style="height: 130px;" >{{ old('body.en') }}</textarea>
                                        <span class="error-data">
                                            @error('body.en')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                              </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-primary">
                    <div class="card-body">

                        <div class="form-group mt-1">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" aria-label="Default select example" name="category_id" id="category_id" required>
                                <option value="">select category</option>
                                @foreach ($categories as $category_item)
                                    <option value="{{ $category_item->id }}">{{ $category_item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="status" class="form-label">status</label>
                            <select class="form-select" aria-label="Default select example" name="status" id="status">
                                <option value="1">active</option>
                                <option value="0">no active</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="slider" class="form-label">Slider</label>
                            <select class="form-select" aria-label="Default select example" name="slider" id="slider">
                                <option value="0">no active</option>
                                <option value="1">active</option>
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="image" class="form-label">image</label>
                            <input type="file" name="image" id="image"
                                class="form-control @error('image') error-data-input @enderror">
                            <img id="previewImage" src="" alt="Img" style="max-width: 100%;">

                            <span class="error-data">
                                @error('image')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-success">{{ __('lang.save') }}</button>
        </div>
    </form>

<script>
    tinymce.init({
            selector: 'textarea#body_uz',
            plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons ',
            editimage_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            link_list: [{
                title: 'My page 1',
                value: 'https://www.tiny.cloud'
            },
            {
                title: 'My page 2',
                value: 'http://www.moxiecode.com'
            }
            ],
            image_list: [{
                title: 'My page 1',
                value: 'https://www.tiny.cloud'
            },
            {
                title: 'My page 2',
                value: 'http://www.moxiecode.com'
            }
            ],
            image_class_list: [{
                title: 'None',
                value: ''
            },
            {
                title: 'Some class',
                value: 'class-name'
            }
            ],
            importcss_append: true,
            file_picker_callback: (callback, value, meta) => {
            /* Provide file and text for the link dialog */
            if (meta.filetype === 'file') {
                callback('https://www.google.com/logos/google.jpg', {
                text: 'My text'
                });
            }

            /* Provide image and alt text for the image dialog */
            if (meta.filetype === 'image') {
                callback('https://www.google.com/logos/google.jpg', {
                alt: 'My alt text'
                });
            }

            /* Provide alternative source and posted for the media dialog */
            if (meta.filetype === 'media') {
                callback('movie.mp4', {
                source2: 'alt.ogg',
                poster: 'https://www.google.com/logos/google.jpg'
                });
            }
            },
            templates: [{
                title: 'New Table',
                description: 'creates a new table',
                content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
            },
            {
                title: 'Starting my story',
                description: 'A cure for writers block',
                content: 'Once upon a time...'
            },
            {
                title: 'New list with dates',
                description: 'New List with dates',
                content: '<div class="mceTmpl"><span class="cdate">cdate</span><br><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
            }
            ],

            // extended_valid_elements : "iframe[src|frameborder|style|scrolling|class|width|height|name|align]",

            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 600,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            contextmenu: 'link image table',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',

        });



        tinymce.init({
            selector: 'textarea#body_ru',
            plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons ',
            editimage_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            link_list: [{
                title: 'My page 1',
                value: 'https://www.tiny.cloud'
            },
            {
                title: 'My page 2',
                value: 'http://www.moxiecode.com'
            }
            ],
            image_list: [{
                title: 'My page 1',
                value: 'https://www.tiny.cloud'
            },
            {
                title: 'My page 2',
                value: 'http://www.moxiecode.com'
            }
            ],
            image_class_list: [{
                title: 'None',
                value: ''
            },
            {
                title: 'Some class',
                value: 'class-name'
            }
            ],
            importcss_append: true,
            file_picker_callback: (callback, value, meta) => {
            /* Provide file and text for the link dialog */
            if (meta.filetype === 'file') {
                callback('https://www.google.com/logos/google.jpg', {
                text: 'My text'
                });
            }

            /* Provide image and alt text for the image dialog */
            if (meta.filetype === 'image') {
                callback('https://www.google.com/logos/google.jpg', {
                alt: 'My alt text'
                });
            }

            /* Provide alternative source and posted for the media dialog */
            if (meta.filetype === 'media') {
                callback('movie.mp4', {
                source2: 'alt.ogg',
                poster: 'https://www.google.com/logos/google.jpg'
                });
            }
            },
            templates: [{
                title: 'New Table',
                description: 'creates a new table',
                content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
            },
            {
                title: 'Starting my story',
                description: 'A cure for writers block',
                content: 'Once upon a time...'
            },
            {
                title: 'New list with dates',
                description: 'New List with dates',
                content: '<div class="mceTmpl"><span class="cdate">cdate</span><br><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
            }
            ],

            // extended_valid_elements : "iframe[src|frameborder|style|scrolling|class|width|height|name|align]",

            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 600,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            contextmenu: 'link image table',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',

        });



        tinymce.init({
            selector: 'textarea#body_en',
            plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons ',
            editimage_cors_hosts: ['picsum.photos'],
            menubar: 'file edit view insert format tools table help',
            toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            autosave_ask_before_unload: true,
            autosave_interval: '30s',
            autosave_prefix: '{path}{query}-{id}-',
            autosave_restore_when_empty: false,
            autosave_retention: '2m',
            image_advtab: true,
            link_list: [{
                title: 'My page 1',
                value: 'https://www.tiny.cloud'
            },
            {
                title: 'My page 2',
                value: 'http://www.moxiecode.com'
            }
            ],
            image_list: [{
                title: 'My page 1',
                value: 'https://www.tiny.cloud'
            },
            {
                title: 'My page 2',
                value: 'http://www.moxiecode.com'
            }
            ],
            image_class_list: [{
                title: 'None',
                value: ''
            },
            {
                title: 'Some class',
                value: 'class-name'
            }
            ],
            importcss_append: true,
            file_picker_callback: (callback, value, meta) => {
            /* Provide file and text for the link dialog */
            if (meta.filetype === 'file') {
                callback('https://www.google.com/logos/google.jpg', {
                text: 'My text'
                });
            }

            /* Provide image and alt text for the image dialog */
            if (meta.filetype === 'image') {
                callback('https://www.google.com/logos/google.jpg', {
                alt: 'My alt text'
                });
            }

            /* Provide alternative source and posted for the media dialog */
            if (meta.filetype === 'media') {
                callback('movie.mp4', {
                source2: 'alt.ogg',
                poster: 'https://www.google.com/logos/google.jpg'
                });
            }
            },
            templates: [{
                title: 'New Table',
                description: 'creates a new table',
                content: '<div class="mceTmpl"><table width="98%%"  border="0" cellspacing="0" cellpadding="0"><tr><th scope="col"> </th><th scope="col"> </th></tr><tr><td> </td><td> </td></tr></table></div>'
            },
            {
                title: 'Starting my story',
                description: 'A cure for writers block',
                content: 'Once upon a time...'
            },
            {
                title: 'New list with dates',
                description: 'New List with dates',
                content: '<div class="mceTmpl"><span class="cdate">cdate</span><br><span class="mdate">mdate</span><h2>My List</h2><ul><li></li><li></li></ul></div>'
            }
            ],

            // extended_valid_elements : "iframe[src|frameborder|style|scrolling|class|width|height|name|align]",

            template_cdate_format: '[Date Created (CDATE): %m/%d/%Y : %H:%M:%S]',
            template_mdate_format: '[Date Modified (MDATE): %m/%d/%Y : %H:%M:%S]',
            height: 600,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_class: 'mceNonEditable',
            toolbar_mode: 'sliding',
            contextmenu: 'link image table',
            content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }',

        });

</script>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(e) {
            $('#image').on('change',function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#previewImage').attr('src', e.target.result);
                    $('#previewImage').css({'display':'block'});
                }
                reader.readAsDataURL(this.files[0]);

            });
        });



    </script>
@endsection
