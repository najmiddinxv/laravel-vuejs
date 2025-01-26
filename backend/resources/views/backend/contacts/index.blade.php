@extends('backend.layouts.main')
@section('content')
<div class="pagetitle">
    <h1>Contacts</h1>
    <nav style="display: flex;justify-content:space-between;align-items: center;">
      <ol class="breadcrumb" style="margin:0">
        <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Contacts</li>
      </ol>
      <div>
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
                <th>{{__('lang.contact_subjet')}}</th>
                <th>{{__('lang.name')}}</th>
                <th>{{__('lang.phone_number')}}</th>
                <th>{{__('lang.email')}}</th>
                <th>{{__('lang.status')}}</th>
                <th>{{__('lang.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($contacts as $key => $contact)
                <tr>
                    <th scope="row">{{ $contacts->firstItem() + $key }}</th>
                    <td>{{ $contact->contactSubject?->name }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->phone_number }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{!! $contact->status == 1 ? '<span class="badge badge-pill bg-success">o`rganildi</span>' : '<span class="badge badge-pill bg-danger">o`rganilmadi</span>' !!}</td>
                    <td>
                        <div style="text-align: center;">
                            <a href="{{ route('backend.contacts.show',['contact'=>$contact->id]) }}" class="btn btn-primary" title="update">
                                <i class="bx bx-show"></i>
                            </a>
                            <form style="display: inline-block;" action="{{ route('backend.contacts.destroy',['contact'=>$contact->id]) }}" method="POST">
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
        {{ $contacts->links() }}
    </div>
</div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function () {

        });
    </script>
@endsection


