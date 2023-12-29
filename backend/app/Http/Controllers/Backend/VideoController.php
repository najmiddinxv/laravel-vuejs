<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\VideoRequest;
use App\Jobs\ConvertVideoForDownloading;
use App\Jobs\ConvertVideoForStreaming;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
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
    }
}
