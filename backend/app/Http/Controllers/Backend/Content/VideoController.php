<?php

namespace App\Http\Controllers\Backend\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Content\VideoRequest;
use App\Jobs\ConvertVideoForStreaming;
use App\Models\Content\Category;
use App\Models\Content\Video;
use App\Services\FileUploadService;

class VideoController extends Controller
{
    public function __construct(protected FileUploadService $fileUploadService){}

    public function index()
    {
        $videos = Video::latest()->paginate(30);
		return view('backend.videos.index',[
			'videos'=>$videos,
		]);
    }

    public function show(Video $video)
    {
        return view('backend.videos.show',[
            'video' => $video,
        ]);
    }

    public function create()
    {
        $categories = Category::where('categoryable_type','App\Models\Video')->orderBy('id','desc')->get();
        return view('backend.videos.create',[
            'categories' => $categories,
		]);
    }

    public function store(VideoRequest $request)
    {
        $data = $request->validated();

        $randFolder = rand(1,1000);
        $file = $data['video'];
        $data['thumbnail'] = $this->fileUploadService->resizeImageUpload($data['image'], '/uploads/videos/'.now()->format('Y/m/d').'/'.$randFolder);
        $fileUploadServiceResponse = $this->fileUploadService->fileUpload($file, '/uploads/videos/'.now()->format('Y/m/d').'/'.$randFolder);
        $data['original_path'] = $fileUploadServiceResponse[0];
        $data['hls_path'] = substr($data['original_path'], 0, -4).".m3u8";
        $data['size'] = $fileUploadServiceResponse[1];
        $data['mime_type'] = $file->getClientOriginalExtension();

        Video::create($data);

        ConvertVideoForStreaming::dispatch($data['original_path']);

        if($request->ajax()){
            return response()->json(['success' => 'image ' . __('lang.successfully_created')]);
        }

        // return redirect()->route('backend.videos.index')->with('category ',__('lang.successfully_created'));
    }

    public function edit(Video $video)
    {
        $categories = Category::where('categoryable_type','App\Models\Video')->orderBy('id','desc')->get();

        return view('backend.videos.edit',[
			'categories' => $categories,
			'video' => $video,
		]);
    }

    public function update(VideoRequest $request, Video $video)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $this->fileUploadService->resizedImageDelete($video->thumbnail);
            $parts = explode('/', $video->thumbnail['large']);
            $folderNumber = $parts[count($parts) - 2];
            $data['thumbnail'] = $this->fileUploadService->resizeImageUpload($request->file('image'), '/uploads/videos/'.now()->format('Y/m/d').'/'.$folderNumber);
        }
        $video->update($data);
        return redirect()->route('backend.videos.index')->with('success', 'video ' . __('lang.successfully_updated'));
    }

    public function destroy(Video $video)
    {
        $this->fileUploadService->resizedImageDelete($video->thumbanil);
        $this->fileUploadService->fileDelete($video->original_path);
        $video->delete();
        return back()->with('success', 'video ' . __('lang.successfully_deleted'));
    }
}
