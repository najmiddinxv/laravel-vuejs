<?php

namespace App\Http\Controllers\Api;

use App\Models\Video;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\VideoRequest;
use App\Http\Controllers\Controller;
use App\Jobs\ConvertVideoForStreaming;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ConvertVideoForDownloading;

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
            'title'         => $request->title,
            'disk'          => 'public',
            'original_name' => $request->video->getClientOriginalName(),
            // 'path'          => $request->video->store('videos', 'videos_disk'),
            'path'          => Storage::putFile(
                'uploads/videos/'.now()->format('Y/m/d'),
                $request->file('video'),
                md5(Str::random(10).time())
            ),
        ]);

        dd($video);

        // $path = Storage::putFile('avatars', $request->file('avatar'));

        // $path = $request->file('avatar')->storeAs(
        //     'avatars', $request->user()->id
        // );

        // $path = Storage::putFileAs(
        //     'avatars', $request->file('avatar'), $request->user()->id
        // );



        // $file = $request->file('avatar');

        // $name = $file->getClientOriginalName();
        // $extension = $file->getClientOriginalExtension();


        // $file = $request->file('avatar');

        // $name = $file->hashName(); // Generate a unique, random name...
        // $extension = $file->extension(); // Determine the file's extension based on the file's MIME type...

        // $this->dispatch(new ConvertVideoForDownloading($video));
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
