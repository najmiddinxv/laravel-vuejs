@extends('backend.layouts.main')
@section('content')
    <div class="pagetitle">
        <h1>Contact subjects</h1>
        <nav style="display: flex;justify-content:space-between;align-items: center;">
            <ol class="breadcrumb" style="margin:0">
                <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Contact subjects</li>
            </ol>
            <div>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#create-permission">Create</button>
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
                            <th>{{ __('lang.name') }}</th>
                            <th>{{ __('lang.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($contactSubjects as $key => $contactSubject)
                            <tr>
                                <th scope="row">{{ $contactSubjects->firstItem() + $key }}</th>
                                <td>{{ $contactSubject->name }}</td>
                                <td>
                                    <div style="text-align: center;">
                                        <a href="{{ route('backend.contact-subjects.edit', ['contactSubject' => $contactSubject->id]) }}"
                                            class="btn btn-primary" title="update">
                                            <i class="bx bx-pencil"></i>
                                        </a>
                                        <form style="display: inline-block;"
                                            action="{{ route('backend.contact-subjects.destroy', ['contactSubject' => $contactSubject->id]) }}"
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
                        @empty
                            <tr>
                                <td colspan="3">Ma'lumot topilmadi !</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $contactSubjects->links() }}
        </div>
    </div>
    <div class="modal fade" id="create-permission" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="create-permission-label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('backend.contact-subjects.store') }}" method="POST" enctype="multipart/form-data"
                class="needs-validation was-validated" novalidate>
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="create-permission-label">Contact mavzusini yaratish</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mt-10">
                                    <label for="name_uz" class="form-label">Name uz</label>
                                    <input type="text" name="name[uz]" id="name_uz"
                                        class="form-control @error('name.uz') error-data-input @enderror"
                                        value="{{ old('name.uz') }}" required>
                                    <span class="error-data">
                                        @error('name.uz')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                                <div class="form-group mt-10">
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
                                <div class="form-group mt-10">
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

        });
    </script>
@endsection
