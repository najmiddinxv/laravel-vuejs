@extends('backend.layouts.main')
@section('title')
    {{ __('lang.update') }}
@endsection
@section('content')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.words.index') }}">Words</a></li>
                <li class="breadcrumb-item active">{{ $word->name }}</li>
                <li class="breadcrumb-item active">{{ __('lang.edit') }}</li>
            </ol>
        </nav>
    </div>
    <form action="{{ route('backend.words.update', $word->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card card-primary">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mt-3">
                            <label for="key" class="form-label">Key</label>
                            <input type="text" name="key" id="key"
                                class="form-control @error('key') error-data-input @enderror"
                                value="{{ $word->key, old('key') }}" required>
                            <span class="error-data">
                                @error('key')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="value_uz" class="form-label">Value uz</label>
                            <input type="text" name="value[uz]" id="value_uz"
                                class="form-control @error('value.uz') error-data-input @enderror"
                                value="{{ $word->getTranslation('value', 'uz'), old('value.uz') }}" required>
                            <span class="error-data">
                                @error('value.uz')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="value_ru" class="form-label">Value ru</label>
                            <input type="text" name="value[ru]" id="value_ru"
                                class="form-control @error('value.ru') error-data-input @enderror"
                                {{-- value="{{ $word->getTranslation('name', 'ru'), old('name.ru') }}" --}}
                                value="{{ $word->hasTranslation('value', 'ru') ? $word->getTranslation('value', 'ru') : '', old('value.ru') }}"
                                >
                            <span class="error-data">
                                @error('value.ru')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="form-group mt-3">
                            <label for="value_en" class="form-label">Value en</label>
                            <input type="text" name="value[en]" id="value_en"
                                class="form-control @error('value.en') error-data-input @enderror"
                                {{-- value="{{ $word->getTranslation('name', 'en'), old('name.en') }}" --}}
                                value="{{ $word->hasTranslation('value', 'en') ? $word->getTranslation('value', 'en') : '', old('value.en') }}"
                                >
                            <span class="error-data">
                                @error('value.en')
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
