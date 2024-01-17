@extends('backend.layouts.index')
@section('title') Permission @endsection

@section('content')

    <div class="page-header card">
    </div>
    <div class="card">
        <div class="content-header">
            <div class="container-fluid card-block">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Permission</h1>
                    </div>
                    <div class="col-sm-6">
                        {{-- <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.index')}}">{{__('msg.Home')}}</a></li>
                            <li class="breadcrumb-item active">Role</li>
                        </ol> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="breadcrumb-and-filter">
                <div class="row">
                    <div class="col-md-9">

                    </div>
                    <div class="col-md-3">
                        <div class="create-data" style="float: right;">
                            {{-- @role('super admin') --}}
                                <a href="{{route('admin.permission.create')}}" class=" style-add btn btn-primary">Yaratish</a>
                            {{-- @else --}}

                            {{-- @endrole --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-error" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="card-body">
            <table id="dashboard_datatable" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Permission</th>
                    <th>Gurad name</th>
                    <th>{{__('msg.Actions')}}</th>
                </tr>
                </thead>
                <tbody>

                @php $i=($models->currentPage()-1) * $models->perPage() + 1 @endphp
                @foreach($models as $model)
                    <tr>
                        <th scope="row">{{ $i }}</th>
                        <td>{{ $model->name }}</td>
                        <td>{{ $model->guard_name }}</td>
                        <td>
                            <div style="text-align: center;">
                                {{-- <a href="{{route('permission.show',$model->id)}}" class="btn btn-info" title="view">
                                    <i class="fas fa-eye"></i>
                                </a> --}}
                                <a href="{{route('admin.permission.edit',$model->id)}}" class="btn btn-primary" title="update">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                                <form style="display: inline-block;" action="{{route('admin.permission.destroy',$model->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="role_ids[]" value="{{ implode(',', $model->roles->pluck('id')->toArray()) }}">

                                    <button type="submit" class="delete-data-item btn btn-danger" title="delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @php $i++ @endphp
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

<style>

</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $("#dashboard_datatable").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "paging": false

        });

    });
</script>
@endsection







