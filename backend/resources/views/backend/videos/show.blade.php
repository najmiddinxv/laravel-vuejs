@extends('backend.layouts.main')
@section('title')
    - {{ __('lang.edit') }}
@endsection
@section('styles')
{{-- <link href="https://vjs.zencdn.net/7.16.0/video-js.css" rel="stylesheet"> --}}

<link href="{{ asset('assets/backend/vendor/videojs/video-js.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('backend.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('backend.videos.index') }}">Videos</a></li>
                <li class="breadcrumb-item">{{ __('lang.show') }}</li>
                <li class="breadcrumb-item active">{{ $video->id }}</li>
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
                    <td>category</td>
                    <td>{{ $video->category?->name }}</td>
                </tr>
                <tr>
                    <td>title</td>
                    <td>
                        uz - {{ $video->getTranslation('title','uz') }} <br>
                        ru - {{ $video->getTranslation('title','ru') }} <br>
                        en - {{ $video->getTranslation('title','en') }} <br>
                    </td>
                </tr>
                <tr>
                    <td>slug</td>
                    <td>
                        uz - {{ $video->getTranslation('slug','uz') }} <br>
                        ru - {{ $video->getTranslation('slug','ru') }} <br>
                        en - {{ $video->getTranslation('slug','en') }} <br>
                    </td>
                </tr>
                <tr>
                    <td>description</td>
                    <td>
                        uz - {{ $video->getTranslation('description','uz') }} <br>
                        ru - {{ $video->getTranslation('description','ru') }} <br>
                        en - {{ $video->getTranslation('description','en') }} <br>
                    </td>
                </tr>

                <tr>
                    <td>image</td>
                    <td><a href="{{ Storage::url($video->thumbnail['large'] ?? '') }}"><img src="{{ Storage::url($video->thumbnail['medium'] ?? '') }}" alt="img" width="20%"></a></td>
                </tr>
                <tr>
                    <td>original video</td>
                    <td>

                        <video width=600 height=300 class="vjs-default-skin" controls>
                            <source
                               src="/storage/{{ $video->original_path }}"
                               >
                          </video>
                          {{-- <script src="video.js"></script>
                          <script src="videojs-contrib-hls.min.js"></script> --}}
                    </td>
                </tr>
                <tr>
                    <td>hls video (ffmpeg)</td>
                    <td>
                        {{-- <video id="videoPlayer" class="video-js vjs-default-skin" controls preload="auto" width="640" height="264">
                            <source src="/storage/{{ $video->hls_path }}" type="application/x-mpegURL">
                            Your browser does not support the video tag.
                        </video> --}}

                        <video id="my-video" class="video-js vjs-default-skin" controls preload="auto" width="640" height="360">
                            <source src="/storage/{{ $video->hls_path }}" type="application/x-mpegURL">
                            <!-- Fallback for browsers that don't support HLS -->
                            <p class="vjs-no-js">
                                To view this video please enable JavaScript, and consider upgrading to a web browser that
                                <a href="https://videojs.com/html5-video-support/" target="_blank" rel="noreferrer">supports HTML5 video</a>
                            </p>
                        </video>
                        <select id="qualitySelector">
                            <option value="/storage/{{ str_replace('.m3u8', '_2_1000.m3u8', $video->hls_path); }}">1000p</option>
                            <option value="/storage/{{ str_replace('.m3u8', '_1_500.m3u8', $video->hls_path); }}">500p</option>
                            <option value="/storage/{{ str_replace('.m3u8', '_0_250.m3u8', $video->hls_path); }}">250p</option>
                            <!-- Add more quality options as needed -->
                        </select>

                    </td>

                </tr>

                <tr>
                    <td>status</td>
                    <td>{!! $video->status == 1 ? '<span class="badge badge-pill bg-success">active</span>' : '<span class="badge badge-pill bg-danger">not active</span>' !!}</td>
                </tr>
                <tr>
                    <td>view count</td>
                    <td>{{ $video->view_count }}</td>
                </tr>
                <tr>
                    <td>download count</td>
                    <td>{{ $video->download_count }}</td>
                </tr>
                <tr>
                    <td>created by</td>
                    <td>{{ $video->uploadedBy?->full_name }}</td>
                </tr>
                <tr>
                    <td>created at</td>
                    <td>{{ $video->created_at }}</td>
                </tr>
                <tr>
                    <td>updated at</td>
                    <td>{{ $video->updated_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
@section('scripts')

{{-- <script src="https://vjs.zencdn.net/7.16.0/video.min.js"></script> --}}

<script src="{{ asset('assets/backend/vendor/videojs/video.min.js') }}"></script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-hls/5.15.0/videojs-contrib-hls.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-http-streaming/2.10.8/videojs-http-streaming.min.js"></script> --}}

    <script>
      $(document).ready(function() {
        // Initialize Video.js
        var player = videojs('my-video');

        // HLS quality switching event listener
        // player.ready(function() {
        //     player.hlsQualitySelector({
        //         displayCurrentQuality: true,
        //         // Add more options or customize as needed
        //     });
        // });

        // Handle quality selection
        $('#qualitySelector').change(function() {
            var selectedQuality = $(this).val();
            // var src = "/storage/uploads/videos/2024/05/09/946/"+`${selectedQuality}`;
            // var src = generateHLSUrl(selectedQuality);
            // var src = 'URL_TO_HLS_STREAM_' + selectedQuality + '.m3u8'; // Update with your HLS stream URL
            player.src({
                src: selectedQuality,
                type: 'application/x-mpegURL'
            });
            player.play(); // Restart playback with the new quality
        });
    });

    </script>
@endsection
