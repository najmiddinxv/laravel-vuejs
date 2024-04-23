@extends('backend.layouts.main')
@section('title')
    - {{ __('lang.category') }}
@endsection
@section('content')
<div class="pagetitle">
    <h1>Files</h1>
    <nav style="display: flex;justify-content:space-between;align-items: center;">
      <ol class="breadcrumb" style="margin:0">
        <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Files</li>
      </ol>
      <div>
        <a href="{{ route('backend.tinymceFiles.create') }}" class="btn btn-success">{{ __('lang.create') }}</a>
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
                <th>{{__('lang.category')}}</th>
                <th>{{__('lang.name')}}</th>
                <th>{{__('lang.description')}}</th>
                <th>{{__('lang.path')}}</th>
                <th>{{__('lang.mime_type')}}</th>
                <th>{{__('lang.size')}}</th>
                <th>{{__('lang.download_count')}}</th>
                <th>{{__('lang.status')}}</th>
                <th>{{__('lang.uploaded_by')}}</th>
                <th>{{__('lang.actions')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tinymceFiles as $key => $tinymceFile)
                <tr>
                    <th scope="row">{{ $tinymceFiles->firstItem() + $key }}</th>
                    <td>{{ $tinymceFile->category?->name }}</td>
                    <td>{{ $tinymceFile->name }}</td>
                    <td>{{ $tinymceFile->description }}</td>
                    @if ($tinymceFile->mime_type == 'jpg' || $tinymceFile->mime_type == 'jpeg' || $tinymceFile->mime_type == 'png')
                        <td style="text-align: center"><a href="{{ Storage::url($tinymceFile->path) }}"><img src="{{ Storage::url($tinymceFile->path) }}" alt="img" width="20%"></a></td>
                    @else
                        <td><a href="{{ Storage::url($tinymceFile->path) }}">file</a></td>
                    @endif
                    <td>{{ $tinymceFile->mime_type }}</td>
                    <td>{{ Number::fileSize($tinymceFile->size); }}</td>
                    <td>{{ $tinymceFile->download_count }}</td>
                    <td>{!! $tinymceFile->status == 1 ? '<span class="badge badge-pill bg-success">active</span>' : '<span class="badge badge-pill bg-danger">not active</span>' !!}</td>
                    <td>{{ $tinymceFile->uploaded_by }}</td>
                    <td>
                        <div style="text-align: center;">
                            {{-- <a href="#" class="btn btn-primary" title="copy">
                                <i class="bx bx-copy"></i>
                            </a> --}}
                            <button style="font-size:14px" class="copyFIlePath btn btn-primary" data-filepath="{{ $tinymceFile->path }}">
                                <i class="bx bx-copy"></i>
                            </button>
                            <a href="{{ route('backend.tinymceFiles.edit',['tinymceFile'=>$tinymceFile->id]) }}" class="btn btn-primary" title="edit">
                                <i class="bx bx-pencil"></i>
                            </a>
                            <form style="display: inline-block;" action="{{ route('backend.tinymceFiles.destroy',['tinymceFile'=>$tinymceFile->id]) }}" method="POST">
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
        {{ $tinymceFiles->links() }}
    </div>
</div>
@endsection
@section('scripts')
<script>
     $(document).ready(function() {
        $('.copyFIlePath').click(function() {
            var filePathCopied = $(this).data('filepath');
            var tempInput = $('<input>');

            tempInput.val(filePathCopied);
            $('body').append(tempInput);
            tempInput.select();
            document.execCommand('copy');
            tempInput.remove();

            $(this).find('i').removeClass('bx-copy').addClass('bi bi-check2');

            setTimeout(function() {
                $(this).find('i').removeClass('bi bi-check2').addClass('bx bx-copy');
            }, 1000);

            // $(this).text('Copied');
            // console.log('copied : ' + filePathCopied);
        });
    });
</script>
@endsection



