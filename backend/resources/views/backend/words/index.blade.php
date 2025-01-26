@extends('backend.layouts.main')
@section('content')
<div class="pagetitle">
    <h1>Words</h1>
    <nav style="display: flex;justify-content:space-between;align-items: center;">
      <ol class="breadcrumb" style="margin:0">
        <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Words</li>
      </ol>
      <div>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#create-word">Create</button>
        {{-- <a href="{{ route('backend.roles.create') }}" class="btn btn-success">create</a> --}}
      </div>
    </nav>
</div>
<div class="card">
    <div class="card-body" style="padding:20px">
          <x-alert-message-component></x-alert-message-component>
        <table class="table table-hover table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>{{__('lang.key')}}</th>
                <th>{{__('lang.value')}}</th>
                <th>{{__('lang.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($words as $key => $word)
                <tr>
                    <th scope="row">{{ $words->firstItem() + $key }}</th>
                    {{-- <td>{{ $word->getTranslation('name',app()->getLocale()) }}</td> --}}
                    {{-- https://github.com/mcamara/laravel-localization mana shu ishlatilgani uchun avtomat tarjima qilib yuboradi --}}
                    {{-- <td>{{ $word->name }}</td> --}}
                    <td>{{ $word->key }}</td>
                    <td>{{ $word->hasTranslation('value', app()->getLocale()) ? $word->getTranslation('value', app()->getLocale()) : '' }}</td>
                    <td>
                        <div style="text-align: center;">
                            <a href="{{ route('backend.words.edit',['word'=>$word->id]) }}" class="btn btn-primary" title="update">
                                <i class="bx bx-pencil"></i>
                            </a>
                            <form style="display: inline-block;" action="{{ route('backend.words.destroy',['word'=>$word->id]) }}" method="POST">
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
        {{ $words->links() }}
    </div>
</div>
<div class="modal fade" id="create-word" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="create-permission-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{route('backend.words.store')}}" method="POST" enctype="multipart/form-data" class="needs-validation was-validated" novalidate>
        @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="create-word-label">Word create</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group mt-10">
                                <label for="key" class="form-label">Key</label>
                                <input type="text" name="key" id="key" class="form-control @error('key') error-data-input @enderror" value="{{ old('key') }}" required>
                                <span class="error-data">@error('key'){{$message}}@enderror</span>
                            </div>
                            <div class="form-group mt-10">
                                <label for="value_uz" class="form-label">Name uz</label>
                                <input type="text" name="value[uz]" id="value_uz" class="form-control @error('value.uz') error-data-input @enderror" value="{{ old('value.uz') }}" required>
                                <span class="error-data">@error('value.uz'){{$message}}@enderror</span>
                            </div>
                            <div class="form-group mt-10">
                                <label for="value_ru" class="form-label">Value ru</label>
                                <input type="text" name="value[ru]" id="value_ru" class="form-control @error('value.ru') error-data-input @enderror" value="{{ old('value.ru') }}">
                                <span class="error-data">@error('value.ru'){{$message}}@enderror</span>
                            </div>
                            <div class="form-group mt-10">
                                <label for="value_en" class="form-label">Value en</label>
                                <input type="text" name="value[en]" id="value_en" class="form-control @error('value.en') error-data-input @enderror" value="{{ old('value.en') }}">
                                <span class="error-data">@error('value.en'){{$message}}@enderror</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{__('lang.close')}}</button>
                    <button type="submit" class="btn btn-success">{{__('lang.save')}}</button>
                </div>
            </div>
        </form>
    </div>
  </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection


