@extends('backend.layouts.main')
@section('title')
    - {{ __('lang.images') }}
@endsection
@section('content')
    <div class="pagetitle">
        <h1>Images</h1>
        <nav style="display: flex;justify-content:space-between;align-items: center;">
            <ol class="breadcrumb" style="margin:0">
                <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Images</li>
            </ol>
            <div>
                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                    data-bs-target="#create-image">Create</button>
                {{-- <a href="{{ route('backend.images.create') }}" class="btn btn-success">{{ __('lang.create') }}</a> --}}
            </div>
        </nav>
    </div>
    <div class="card">
        <div class="card-body" style="padding:20px">
            <x-alert-message-component></x-alert-message-component>
           <p>jami : {{ $images->total() }} ta</p>
            <table class="table table-hover table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('lang.category') }}</th>
                        <th>{{ __('lang.name') }}</th>
                        <th>{{ __('lang.path') }}</th>
                        <th>{{ __('lang.mime_type') }}</th>
                        <th>{{ __('lang.size') }}</th>
                        <th>{{ __('lang.uploaded_by') }}</th>
                        <th>{{ __('lang.status') }}</th>
                        <th>{{ __('lang.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($images as $key => $image)
                        <tr>
                            <th scope="row">{{ $images->firstItem() + $key }}</th>
                            <td>{{ $image->category?->name }}</td>
                            {{-- <td>{{ $image->name }}</td> --}}
                            <td>
                                uz - {{ $image->getTranslation('name','uz') }} <br>
                                ru - {{ $image->getTranslation('name','ru') }} <br>
                                en - {{ $image->getTranslation('name','en') }} <br>
                            </td>
                            <td style="text-align: center">
                                <a href="{{ Storage::url($image->path['large'] ?? '-') }}">
                                    <img src="{{ Storage::url($image->path['medium'] ?? '-') }}" alt=""
                                        style="width:30%">
                                </a>
                            </td>
                            <td>{{ $image->mime_type }}</td>
                            <td>{{ Number::fileSize($image->size) }}</td>
                            <td>{{ $image->uploadedBy?->full_name }}</td>
                            <td>{!! $image->status == 1
                                ? '<span class="badge badge-pill bg-success">active</span>'
                                : '<span class="badge badge-pill bg-danger">not active</span>' !!}</td>
                            <td>
                                <div style="text-align: center;">

                                    <button type="button" class="btn-edit-image btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#edit-image" data-id="{{ $image->id }}" title="edit">
                                        <i class="bx bx-pencil"></i>
                                    </button>
                                    {{-- <a href="{{ route('backend.images.edit',['image'=>$image->id]) }}" class="btn btn-primary" title="edit">
                                        <i class="bx bx-pencil"></i>
                                    </a> --}}
                                    <form style="display: inline-block;"
                                        action="{{ route('backend.images.destroy', ['image' => $image->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-data-item btn btn-danger" title="delete">
                                            <i class="bx bxs-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $images->links() }}
        </div>
    </div>











    {{-- image yaratilayapti modal oyna orqali --}}
    <div class="modal fade" id="create-image" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="create-image-label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="create-image-form-modal" action="{{ route('backend.images.store') }}" method="POST" enctype="multipart/form-data"
                class="needs-validation was-validated" novalidate>
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="create-image-label">Image yaratish</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card card-primary">
                            <div class="card-body">

                                <div>
                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="pills-uz-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-uz" type="button" role="tab"
                                                aria-controls="pills-home" aria-selected="true">Uz</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-ru-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-ru" type="button" role="tab"
                                                aria-controls="pills-profile" aria-selected="false"
                                                tabindex="-1">Ру</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-en-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-en" type="button" role="tab"
                                                aria-controls="pills-contact" aria-selected="false"
                                                tabindex="-1">En</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content pt-2" id="myTabContent">
                                        <div class="tab-pane fade active show" id="pills-uz" role="tabpanel"
                                            aria-labelledby="uz-tab">
                                            <div class="form-group">
                                                <label for="name_uz" class="form-label">Name uz</label>
                                                <input type="text" name="name[uz]" id="name_uz"
                                                    class="form-control @error('name.uz') error-data-input @enderror"
                                                    value="{{ old('name.uz') }}">
                                                <span class="error-data">
                                                    @error('name.uz')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-ru" role="tabpanel"
                                            aria-labelledby="ru-tab">
                                            <div class="form-group">
                                                <label for="name_ru" class="form-label">Name ru</label>
                                                <input type="text" name="name[ru]" id="name_ru"
                                                    class="form-control @error('name.ru') error-data-input @enderror"
                                                    value="{{ old('name.ru') }}">
                                                <span class="error-data">
                                                    @error('name.ru')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-en" role="tabpanel"
                                            aria-labelledby="en-tab">
                                            <div class="form-group">
                                                <label for="name_en" class="form-label">Name en</label>
                                                <input type="text" name="name[en]" id="name_en"
                                                    class="form-control @error('name.en') error-data-input @enderror"
                                                    value="{{ old('name.en') }}">
                                                <span class="error-data">
                                                    @error('name.en')
                                                        {{ $message }}
                                                    @enderror
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                        <div class="form-group mt-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" aria-label="Default select example" name="category_id"
                                id="category_id" required>
                                @foreach ($categories as $category_item)
                                    <option value="">select category</option>
                                    <option value="{{ $category_item->id }}">{{ $category_item->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="images" class="form-label">File</label>
                            <input type="file" name="images[]" id="images"
                                class="form-control @error('images') error-data-input @enderror" multiple required>
                            <span class="error-data">
                                @error('images')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>

                    {{-- fayl yuklanayotganda ko'rsatiladigan progress --}}
                    <div class="progress" style="display: none;">
                        <div class="progress-bar" role="progressbar" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100"><span class="progressText">0%</span></div>
                    </div>
                    {{-- fayl yuklanayotganda ko'rsatiladigan progress --}}

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                            data-bs-dismiss="modal">{{ __('lang.close') }}</button>
                        <button type="submit" class="btn btn-success">{{ __('lang.save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>





    {{-- image modal oynada edit qilinayapti --}}
    <div class="modal fade" id="edit-image" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="edit-image-label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            {{-- <form action="{{ route('backend.images.update') }}" method="POST" enctype="multipart/form-data" --}}
            <form id="image-edit-form-modal" action="" method="POST" enctype="multipart/form-data"
                class="needs-validation was-validated" novalidate>
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="edit-image-label">Image edit</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary">
                                    <div class="card-body">


                                        <div id="spinner-div" class="pt-5">
                                            <div class="spinner-border text-primary" role="status"></div>
                                        </div>
                                        <style>
                                            #spinner-div {
                                                position: fixed;
                                                width: 100%;
                                                height: 100%;
                                                top: 0;
                                                left: 0;
                                                text-align: center;
                                                background-color: rgba(255, 255, 255, 0.8);
                                                z-index: 2;
                                                display: flex;
                                                justify-content: center;
                                                align-items: center;
                                            }
                                        </style>


                                        <div style="">
                                            <ul class="nav nav-pills mb-3" id="pills-edit-tab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link active" id="pills-edit-uz-tab"
                                                        data-bs-toggle="pill" data-bs-target="#pills-edit-uz" type="button"
                                                        role="tab" aria-controls="pills-edit-home"
                                                        aria-selected="true">Uz</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="pills-edit-ru-tab" data-bs-toggle="pill"
                                                        data-bs-target="#pills-edit-ru" type="button" role="tab"
                                                        aria-controls="pills-edit-profile" aria-selected="false"
                                                        tabindex="-1">Ру</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link" id="pills-edit-en-tab" data-bs-toggle="pill"
                                                        data-bs-target="#pills-edit-en" type="button" role="tab"
                                                        aria-controls="pills-edit-contact" aria-selected="false"
                                                        tabindex="-1">En</button>
                                                </li>
                                            </ul>
                                            <div class="tab-content pt-2" id="myTabContent">
                                                <div class="tab-pane fade active show" id="pills-edit-uz" role="tabpanel"
                                                    aria-labelledby="uz-tab">
                                                    <div class="form-group">
                                                        <label for="name_uz_edit" class="form-label">Name uz</label>
                                                        <input type="text" name="name[uz]" id="name_uz_edit"
                                                            class="form-control @error('name.uz') error-data-input @enderror"
                                                            value="{{ old('name.uz') }}">
                                                        <span class="error-data">
                                                            @error('name.uz')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="pills-edit-ru" role="tabpanel"
                                                    aria-labelledby="ru-tab">
                                                    <div class="form-group">
                                                        <label for="name_ru_edit" class="form-label">Name ru</label>
                                                        <input type="text" name="name[ru]" id="name_ru_edit"
                                                            class="form-control @error('name.ru') error-data-input @enderror"
                                                            value="{{ old('name.ru') }}">
                                                        <span class="error-data">
                                                            @error('name.ru')
                                                                {{ $message }}
                                                            @enderror
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="pills-edit-en" role="tabpanel"
                                                    aria-labelledby="en-tab">
                                                    <div class="form-group">
                                                        <label for="name_en_edit" class="form-label">Name en</label>
                                                        <input type="text" name="name[en]" id="name_en_edit"
                                                            class="form-control @error('name.en') error-data-input @enderror"
                                                            value="{{ old('name.en') }}">
                                                        <span class="error-data">
                                                            @error('name.en')
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
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                            data-bs-dismiss="modal">{{ __('lang.close') }}</button>
                        <button type="submit" class="btn btn-success">{{ __('lang.save') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {


            var token = $("meta[name='csrf-token']").attr("content");
            var siteLang = '{{ app()->getLocale() }}';

            //===========edit image using ajax=========
            $('.btn-edit-image').on('click', function() {

                let imageId = $(this).data('id');
                $('#image-edit-form-modal-flash-message').remove();
                $('#appendedContent').remove();
                $('#image-edit-form-modal').attr('action', '/admin/images/update/' + imageId);

                //ajax sorovni kechiktirib spinnerni test qilihs uchun
                // setTimeout(function() {
                $.ajax({
                    url: `/admin/images/edit/${imageId}`,
                    type: "GET",
                    // cache: false,
                    beforeSend: function() {
                        $("#spinner-div").show();
                    },
                    success: function(response) {
                        // console.log(response);

                        $('#name_uz_edit').val(response.image.name.uz);
                        $('#name_ru_edit').val(response.image.name.ru);
                        $('#name_en_edit').val(response.image.name.en);

                        var categoryOptions = '';
                        $.each(response.categories, function(index, category) {
                            var selected = (category.id == response.image.category_id) ?
                                'selected' : '';
                            categoryOptions += "<option value='" + category.id + "' " +
                                selected + ">" + category.name[`${siteLang}`] +
                                "</option>";
                        });

                        $('#image-edit-form-modal .card-body').append(
                            `<div id="appendedContent" class="appended-content">
                                <div class="form-group mt-3">
                                    <label for="category_id_edit" class="form-label">Category</label>
                                    <select class="form-select" aria-label="Default select example" name="category_id" id="category_id_edit">
                                        ${categoryOptions}
                                    </select>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" aria-label="Default select example" name="status" id="status">
                                        <option value="1" ${response.image.status == 1 ? 'selected' : ''}>Active</option>
                                        <option value="0" ${response.image.status == 0 ? 'selected' : ''}>Not Active</option>
                                    </select>
                                </div>
                            </div>
                            `
                        );
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    },
                    complete: function() {
                        $("#spinner-div").hide();

                    }
                });
                //ajax sorovni kechiktirib spinnerni test qilihs uchun
                // }, 2000); // 2 seconds delay
            });

            //bu ham ishlayapti commenntdan chiqarsam bolle
            // $(document).on('submit', '#yourFormId', function(event) {
            $('#image-edit-form-modal').on('submit', function(e) {
                e.preventDefault();

                $('#image-edit-form-modal-flash-message').remove();

                var formAction = $(this).attr('action');

                let category_id_edit = $('#category_id_edit').val();
                let name_uz = $('#name_uz_edit').val();
                let name_ru = $('#name_ru_edit').val();
                let name_en = $('#name_en_edit').val();
                let status = $('#status').val();

                // var formData = $(this).serialize();

                $.ajax({
                    url: formAction,
                    type: "PUT",
                    cache: false,
                    data: {
                        "_token": token,
                        // formData
                        "category_id": category_id_edit,
                        "name": {
                            'uz': name_uz,
                            'ru': name_ru,
                            'en': name_en
                        },
                        "status": status
                    },
                    success: function(response) {
                        console.log(response);
                        $('#image-edit-form-modal .modal-body').append(
                            `<div id='image-edit-form-modal-flash-message'>
                                   <div class="alert alert-success" role="alert">
                                    ${response.success}
                                    </div>
                            </div>`
                        );

                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });


            //agar buni commentdan chiqarsak modal yopilganda page refresh bo'ladi
            $('#edit-image').on('hidden.bs.modal', function (e) {
                location.reload();
            });

            $('#create-image').on('hidden.bs.modal', function (e) {
                location.reload();
            });
            //==============edit image using ajax============
            //==============catate image using ajax on modal============


            $('#create-image-form-modal').submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: '{{ route('backend.images.store') }}',
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
                        $('#create-image-form-modal .modal-body').append(
                            `<div id='image-edit-form-modal-flash-message'>
                                   <div class="alert alert-success" role="alert">
                                    ${response.success}
                                    </div>
                            </div>`
                        );
                        $('#create-image-form-modal')[0].reset();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('Error uploading file: ' + textStatus);
                    }
                });
            });


        });
    </script>
@endsection
