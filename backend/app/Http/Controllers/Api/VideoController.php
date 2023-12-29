<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideoRequest;
use App\Jobs\ConvertVideoForDownloading;
use App\Jobs\ConvertVideoForStreaming;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{

    public function index(Request $request)
    {
        // https://protone.media/en/blog/how-to-use-ffmpeg-in-your-laravel-projects
        // https://github.com/protonemedia/laravel-ffmpeg
        // https://laravel-news.com/laravel-ffmpeg-tools
        return response()->json('video');
    }

    public function show(Request $request)
    {
        return response()->json('video');
    }

    public function create(Request $request)
    {
        return response()->json('video');
    }

    public function store(VideoRequest $request)
    {
        $video = Video::create([
            'disk'          => 'videos_disk',
            'original_name' => $request->video->getClientOriginalName(),
            'path'          => $request->video->store('videos', 'videos_disk'),
            'title'         => $request->title,
        ]);

        $this->dispatch(new ConvertVideoForDownloading($video));
        $this->dispatch(new ConvertVideoForStreaming($video));

        return response()->json([
            'id' => $video->id,
        ], 201);

//         $downloadUrl = Storage::disk('downloadable_videos')->url($video->id . '.mp4');
// $streamUrl = Storage::disk('streamable_videos')->url($video->id . '.m3u8');
    }

    public function edit(Request $request)
    {
        return response()->json('video');
    }

    public function update(VideoRequest $request)
    {
        return response()->json('video');
    }

    public function destroy(Request $request)
    {
        return response()->json('video');
    }
}
