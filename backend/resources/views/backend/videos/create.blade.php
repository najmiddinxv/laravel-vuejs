@extends('backend.layouts.main')
@section('title')
    - {{ __('lang.edit') }}
@endsection
@section('content')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.videos.index') }}">Videos</a></li>
                <li class="breadcrumb-item active">{{ __('lang.create') }}</li>
            </ol>
        </nav>
    </div>
    <x-alert-message-component></x-alert-message-component>
    <form id="create-video-form" action="{{ route('backend.videos.store') }}" method="POST" enctype="multipart/form-data">
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
                                        <label for="title_uz" class="form-label">title uz</label>
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
                                </div>
                                <div class="tab-pane fade" id="pills-ru" role="tabpanel" aria-labelledby="ru-tab">
                                    <div class="form-group">
                                        <label for="title_ru" class="form-label">title ru</label>
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
                                </div>
                                <div class="tab-pane fade" id="pills-en" role="tabpanel" aria-labelledby="en-tab">
                                    <div class="form-group">
                                        <label for="title_en" class="form-label">title en</label>
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
                                @foreach ($categories as $category_item)
                                    <option value="">select category</option>
                                    <option value="{{ $category_item->id }}">{{ $category_item->name }}</option>
                                @endforeach
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

                        <div class="form-group mt-3">
                            <label for="video" class="form-label">Video</label>
                            <input type="file" name="video" id="video" class="form-control @error('video') error-data-input @enderror" vrequired>
                            <span class="error-data">
                                @error('video')
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

        <div class="progress mt-3" style="display: none;">
            <div class="progress-bar" role="progressbar" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"><span class="progressText">0%</span></div>
        </div>

    </form>
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


            $('#create-video-form').submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: '{{ route('backend.videos.store') }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    xhr: function () {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener('progress', function (evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = evt.loaded / evt.total * 100;
                                $('#progress').show();
                                $('#progress progress').val(percentComplete);
                                $('#progressText').text(percentComplete.toFixed(2) + '%');

                                $('.progress').show();
                                $('.progress .progress-bar').val(percentComplete);
                                $('.progress .progress-bar').css({'width':`${percentComplete}100%`});
                                $('.progressText').text(percentComplete.toFixed(2) + '%');
                            }
                        }, false);
                        return xhr;
                    },
                    success: function (response) {
                        $('#progress').hide();
                        $('.progress').hide();
                        // alert(response.success);
                        $('#create-video-form').append(
                            `<div class="mt-3" id='create-video-form-flash-message'>
                                   <div class="alert alert-success" role="alert">
                                    ${response.success}
                                    </div>
                            </div>`
                        );
                        $('#create-video-form')[0].reset();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('Error uploading file: ' + textStatus);
                    }
                });
            });

        });
    </script>
@endsection
