<?php

namespace App\Http\Controllers\Backend\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Content\ImageRequest;
use App\Models\Content\Category;
use App\Models\Content\Image;
use App\Models\Content\News;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function __construct(protected FileUploadService $fileUploadService){}

    public function index()
    {
        $categories = Category::byModel(News::class)->latest('id')->get();
        $images = Image::latest()->paginate(config('settings.paginate_per_page'));
		return view('backend.images.index',[
			'categories'=>$categories,
			'images'=>$images,
		]);
    }

    public function create()
    {
        $categories = Category::byModel(Image::class)->latest()->get();
        return view('backend.images.create',[
            'categories' => $categories,
		]);
    }

    public function store(ImageRequest $request)
    {
        $data = $request->validated();

        foreach ($data['images'] as $key => $image) {
            $fileUploadServiceResponse = $this->fileUploadService->resizeImageUpload($image, '/uploads/images/'.now()->format('Y/m/d'));
            $data['path'] = $fileUploadServiceResponse;
            $data['mime_type'] = $image->getClientOriginalExtension();
            if(!isset($data['name']['uz']) && !isset($data['name']['ru']) && !isset($data['name']['en'])){
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

        if($request->ajax()){
            return response()->json(['success' => 'image ' . __('lang.successfully_created')]);
        }

        return redirect()->route('backend.images.index')->with('image ',__('lang.successfully_created'));
    }

    public function edit(int $id)
    {
        $image = Image::find($id,['name','category_id','status']);
        $categories = Category::byModel(Image::class)->latest()->get();
        return response()->json([
            'image' => $image,
            'categories' => $categories,
        ]);

        // // Select specified columns from all employees
        // $employees = Employee::select(['name', 'title', 'email'])->get();
        // // Select specified columns from all employees
        // $employees = Employee::get(['name', 'title', 'email']);

        // return view('backend.images.edit',[
		// 	'categories' => $categories,
		// 	'image' => $image,
		// ]);
    }

    public function update(ImageRequest $request, int $id)
    {
        $data = $request->validated();
        $image = Image::findOrFail($id);
        $image->update($data);
        if($request->ajax()){
            return response()->json(['success' => 'image ' . __('lang.successfully_updated')]);
        }
        return back()->with('success', 'image ' . __('lang.successfully_updated'));
    }

    public function destroy(Image $image)
    {
        $this->fileUploadService->resizedImageDelete($image->path);
        $image->delete();

        return back()->with('success', 'image ' . __('lang.successfully_deleted'));
    }
}
