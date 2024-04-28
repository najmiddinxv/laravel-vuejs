<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageRequest;
use App\Models\Category;
use App\Models\Image;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function __construct(protected FileUploadService $fileUploadService){}

    public function index()
    {
        $images = Image::orderBy('id','desc')->paginate(30);
		return view('backend.images.index',[
			'images'=>$images,
		]);
    }

    public function create()
    {
        $categories = Category::where('categoryable_type','App\Models\Image')->orderBy('id','desc')->get();
        return view('backend.images.create',[
            'categories' => $categories,
		]);
    }

    public function store(ImageRequest $request)
    {
        $data = $request->validated();

        foreach ($data['images'] as $key => $image) {
            $fileUploadServiceResponse = $this->fileUploadService->resizeImageUpload($image, '/uploads/images');
            $data['path'] = $fileUploadServiceResponse;
            $data['mime_type'] = $image->getClientOriginalExtension();
            if(!isset($data['name.*'])){
                $data['name'] = [
                    'uz'=>$image->getClientOriginalName(),
                    'ru'=>$image->getClientOriginalName(),
                    'en'=>$image->getClientOriginalName(),
                ];
            }

            //faqat katta o'lchamda kesilgan rasmni o'lchami saqlanayapti
            $data['size'] = Storage::size($fileUploadServiceResponse['large']);

            //agar 3 ta o'lchamdagi rasmni ham hajmi kerak bo'lsa
            // $data['size'] = [
            //     'large' => Storage::size($fileUploadServiceResponse['large']),
            //     'medium' => Storage::size($fileUploadServiceResponse['medium']),
            //     'small' => Storage::size($fileUploadServiceResponse['small']),
            // ];

            $data['uploaded_by'] = auth()->user()->id;

            Image::create($data);
        }

        return redirect()->route('backend.images.index')->with('image ',__('lang.successfully_created'));
    }

    public function edit(Image $image)
    {
        //
    }

    public function update(ImageRequest $request, Image $image)
    {
        //
    }

    public function destroy(Image $image)
    {
        $this->fileUploadService->resizedImageDelete($image->path);
        $image->delete();

        return back()->with('success', 'image ' . __('lang.successfully_deleted'));
    }
}
