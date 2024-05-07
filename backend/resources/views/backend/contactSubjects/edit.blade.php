@extends('backend.layouts.main')
@section('title')
    {{ __('lang.update') }}
@endsection
@section('content')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.contact-subjects.index') }}">Contact subjects</a></li>
                <li class="breadcrumb-item active">{{ $contactSubject->name }}</li>
                <li class="breadcrumb-item active">Tahrirlash</li>
            </ol>
        </nav>
    </div>
    <form action="{{ route('backend.contact-subjects.update', $contactSubject->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card card-primary">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mt-3">
                            <label for="name_uz" class="form-label">Name uz</label>
                            <input type="text" name="name[uz]" id="name_uz"
                                class="form-control @error('name.uz') error-data-input @enderror"
                                value="{{ $contactSubject->getTranslation('name', 'uz'), old('name.uz') }}" required>
                            <span class="error-data">
                                @error('name.uz')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="name_ru" class="form-label">Name ru</label>
                            <input type="text" name="name[ru]" id="name_ru"
                                class="form-control @error('name.ru') error-data-input @enderror"
                                {{-- value="{{ $contactSubject->getTranslation('name', 'ru'), old('name.ru') }}" --}}
                                value="{{ $contactSubject->hasTranslation('name', 'ru') ? $contactSubject->getTranslation('name', 'ru') : '', old('name.ru') }}"
                                >
                            <span class="error-data">
                                @error('name.ru')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="name_en" class="form-label">Name en</label>
                            <input type="text" name="name[en]" id="name_en" class="form-control @error('name.en') error-data-input @enderror" value="{{ $contactSubject->hasTranslation('name', 'en') ? $contactSubject->getTranslation('name', 'en') : '', old('name.en') }}">
                            <span class="error-data">
                                @error('name.en')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-success">{{ __('lang.save') }}</button>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(e) {

        });
    </script>
@endsection
