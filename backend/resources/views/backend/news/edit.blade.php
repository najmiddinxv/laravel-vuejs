@extends('backend.layouts.main')
@section('title')
    - {{ __('lang.edit') }}
@endsection
@section('content')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.news.index') }}">News</a></li>
                <li class="breadcrumb-item">{{ __('lang.edit') }}</li>
                <li class="breadcrumb-item active">{{ $news->title }}</li>
            </ol>
        </nav>
    </div>
    <x-alert-message-component></x-alert-message-component>
    <form action="{{ route('backend.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
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
                                        <label for="title_uz" class="form-label">Name uz</label>
                                        <input type="text" name="title[uz]" id="title_uz"
                                            class="form-control @error('title.uz') error-data-input @enderror"
                                            value="{{ $news->translate('uz')->title, old('title.uz') }}" required>
                                        <span class="error-data">
                                            @error('title.uz')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="description_uz" class="form-label">Description uz</label>
                                        <textarea class="form-control @error('description.uz') error-data-input @enderror" name="description[uz]" id="description_uz"  style="height: 130px;" >{{ $news->translate('uz')->description, old('description.uz') }}</textarea>
                                        <span class="error-data">
                                            @error('description.uz')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="body_uz" class="form-label">Body uz</label>
                                        <textarea class="tinymce-editor @error('body.uz') error-data-input @enderror" name="body[uz]" id="body_uz"  style="height: 130px;" >{{ $news->translate('uz')->body, old('body.uz') }}</textarea>
                                        <span class="error-data">
                                            @error('body.uz')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label for="image" class="col-form-label">image</label>
                                        <input type="file" class="form-control" name="image[uz]" id="imageuz" accept=".jpg,.jpeg,.png">
                                        <img id="previewImageuz" src="{{ Storage::url($news->translate('uz')->main_image['large'] ?? '-') }}" alt="Img" style="max-width: 40%;">
                                        <div class="valid-feedback">
                                        </div>
                                    </div> --}}
                                    <div class="form-group mt-3">
                                        <label for="image" class="form-label">image uz</label>
                                        <input type="file" name="image[uz]" id="imageuz"
                                            class="form-control @error('image.uz') error-data-input @enderror">
                                        <img id="previewImageuz" src="{{ Storage::url($news->translate('uz')->main_image['large'] ?? '-') }}" alt="Img" style="max-width: 40%;">
                                        <span class="error-data">
                                            @error('image.uz')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-ru" role="tabpanel" aria-labelledby="ru-tab">
                                    <div class="form-group mt-3">
                                        <label for="title_ru" class="form-label">Name ru</label>
                                        <input type="text" name="title[ru]" id="title_ru"
                                            class="form-control @error('title.ru') error-data-input @enderror"
                                            value="{{ $news->translate('ru')->title, old('title.ru') }}">
                                        <span class="error-data">
                                            @error('title.ru')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="description_ru" class="form-label">Description ru</label>
                                        <textarea class="form-control @error('description.uz') error-data-input @enderror" name="description[ru]" id="description_ru" style="height: 130px;" >{{ $news->translate('ru')->description, old('description.ru') }}</textarea>
                                        <span class="error-data">
                                            @error('description.ru')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="body_ru" class="form-label">Body ru</label>
                                        <textarea class="tinymce-editor @error('body.ru') error-data-input @enderror" name="body[ru]" id="body_ru"  style="height: 130px;" >{{ $news->translate('ru')->body, old('body.ru') }}</textarea>
                                        <span class="error-data">
                                            @error('body.ru')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="image" class="form-label">image ru</label>
                                        <input type="file" name="image[ru]" id="imageru"
                                            class="form-control @error('image.ru') error-data-input @enderror">
                                        <img id="previewImageru" src="{{ Storage::url($news->translate('ru')->main_image['large'] ?? '-') }}" alt="Img" style="max-width: 40%;">
                                        <span class="error-data">
                                            @error('image.ru')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="pills-en" role="tabpanel" aria-labelledby="en-tab">
                                    <div class="form-group mt-3">
                                        <label for="title_en" class="form-label">Name en</label>
                                        <input type="text" name="title[en]" id="name_en"
                                            class="form-control @error('title.en') error-data-input @enderror"
                                            value="{{ $news->translate('en')->title, old('title.en') }}">
                                        <span class="error-data">
                                            @error('title.en')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="description_en" class="form-label">Description en</label>
                                        <textarea class="form-control @error('description.uz') error-data-input @enderror" name="description[en]" id="description_en" style="height: 130px;" >{{ $news->translate('en')->description, old('description.en') }}</textarea>
                                        <span class="error-data">
                                            @error('description.en')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="body_en" class="form-label">Body en</label>
                                        <textarea class="tinymce-editor @error('body.en') error-data-input @enderror" name="body[en]" id="body_en"  style="height: 130px;" >{{ $news->translate('en')->body, old('body.en') }}</textarea>
                                        <span class="error-data">
                                            @error('body.en')
                                                {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="image" class="form-label">image en</label>
                                        <input type="file" name="image[en]" id="imageen"
                                            class="form-control @error('image.ru') error-data-input @enderror">
                                        <img id="previewImageen" src="{{ Storage::url($news->translate('en')->main_image['large'] ?? '-') }}" alt="Img" style="max-width: 40%;">
                                        <span class="error-data">
                                            @error('image.en')
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
                            <select class="form-select" aria-label="Default select example" name="category_id" id="category_id">
                                @foreach ($categories as $category_item)
                                    <option value="{{ $category_item->id }}" {{ $category_item->id == $news->category?->id ? 'selected' : '' }}>{{ $category_item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="status" class="form-label">status</label>
                            <select class="form-select" aria-label="Default select example" name="status" id="status">
                                <option value="1" {{ $news->status == 1 ? 'selected' : '' }}>active</option>
                                <option value="0" {{ $news->status == 0 ? 'selected' : '' }}>no active</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="slider" class="form-label">Slider</label>
                            <select class="form-select" aria-label="Default select example" name="slider" id="slider">
                                <option value="1" {{ $news->slider == 1 ? 'selected' : '' }}>active</option>
                                <option value="0" {{ $news->slider == 0 ? 'selected' : '' }}>no active</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="tags" class="form-label">Tags</label>
                            <select class="form-select tags" name="tags[]" id="tags" multiple="multiple">
                                @forelse($tags as $tag)
                                    <option value="{{ $tag->id }}" {{ in_array($tag->id, $news->tags->pluck('id')->toArray()) ? 'selected' : ''}}>{{ $tag->name }}</option>
                                @empty
                                    <option value="">no tags</option>
                                @endforelse
                            </select>
                        </div>

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
            // $('#image').on('change',function(){
            //     let reader = new FileReader();
            //     reader.onload = (e) => {
            //         $('#previewImage').attr('src', e.target.result);
            //         $('#previewImage').css({'display':'block'});
            //     }
            //     reader.readAsDataURL(this.files[0]);
            // });

            $('#imageuz').on('change',function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#previewImageuz').attr('src', e.target.result);
                    $('#previewImageuz').css({'display':'block'});
                }
                reader.readAsDataURL(this.files[0]);
            });
            $('#imageru').on('change',function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#previewImageru').attr('src', e.target.result);
                    $('#previewImageru').css({'display':'block'});
                }
                reader.readAsDataURL(this.files[0]);
            });
            $('#imageen').on('change',function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#previewImageen').attr('src', e.target.result);
                    $('#previewImageen').css({'display':'block'});
                }
                reader.readAsDataURL(this.files[0]);
            });

            $('.tags').select2();
        });

    </script>
@endsection
