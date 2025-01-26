@extends('backend.layouts.main')
@section('title')
    - {{ __('lang.edit') }}
@endsection
@section('content')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.contacts.index') }}">Contacts</a></li>
                <li class="breadcrumb-item">{{ __('lang.show') }}</li>
                <li class="breadcrumb-item active">{{ $contact->id }}</li>
            </ol>
        </nav>
    </div>
    <div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Column name</th>
                    <th>data</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>contactSubjet</td>
                    <td>{{ $contact->contactSubject?->name }}</td>
                </tr>
                <tr>
                    <td>name</td>
                    <td>{{ $contact->name }}</td>
                </tr>
                <tr>
                    <td>phone number</td>
                    <td>{{ $contact->phone_number }}</td>
                </tr>
                <tr>
                    <td>email</td>
                    <td>{{ $contact->email }}</td>
                </tr>
                <tr>
                    <td>body</td>
                    <td>
                        {!! $contact->body !!} <br>
                    </td>
                </tr>
                <tr>
                    <td>status</td>
                    <td>{!! $contact->status == 1 ? '<span class="badge badge-pill bg-success">active</span>' : '<span class="badge badge-pill bg-danger">not active</span>' !!}</td>
                </tr>
                <tr>
                    <td>created at</td>
                    <td>{{ $contact->created_at }}</td>
                </tr>
                <tr>
                    <td>updated at</td>
                    <td>{{ $contact->updated_at }}</td>
                </tr>
            </tbody>
        </table>

        <div class="border border-success p-3">
            <p><b>Murojaat statusini o'zgartirish</b></p>
            <form action="{{ route('backend.contacts.update',['contact'=>$contact->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mt-3">
                    <label for="status" class="form-label">status</label>
                    <select class="form-select" aria-label="Default select example" name="status" id="status">
                        <option value="1" {{ $contact->status == 1 ? 'selected' : '' }}>O'rganildi</option>
                        <option value="0" {{ $contact->status == 0 ? 'selected' : '' }}>O'rganilmadi</option>
                    </select>
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-success" title="update">
                        Update
                    </button>
                </div>

            </form>
        </div>

    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(e) {

        });
    </script>
@endsection
