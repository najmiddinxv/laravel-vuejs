<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\ImageResize;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::with('parent')->orderBy('id','desc')->paginate(30);
		return view('backend.categories.index',[
			'categories'=>$categories,
		]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.categories.create',[
            'categories' => $categories,
		]);
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->validated();

        if (isset($data['image'])) {
            $image = $data['image'];
            $imagePath = '/uploads/categories/'.now()->format('Y/m/d');
            if (!Storage::exists($imagePath)) {
                Storage::makeDirectory($imagePath, 0755, true, true);
            }

            $imageHashName = md5(Str::random(10).time()).'.'.$image->getClientOriginalExtension();
            $imageLargeHashName =  $imagePath.'/l_'.$imageHashName;
            $imageMeduimHashName = $imagePath.'/m_'.$imageHashName;
            $imageSmallHashName = $imagePath.'/s_'.$imageHashName;

            $imageR = new ImageResize($image->getRealPath());
            $imageR->resizeToBestFit(1920, 1080)->save(Storage::path($imageLargeHashName));
            $imageR->resizeToBestFit(500, 500)->save(Storage::path($imageMeduimHashName));
            $imageR->resizeToBestFit(150, 150)->save(Storage::path($imageSmallHashName));

            $data['image'] = [
                'large' => $imageLargeHashName,
                'medium' => $imageMeduimHashName,
                'small' => $imageSmallHashName,
                // 'large' => '/storage'.$userAvatarLargeHashName,
                // 'medium' => '/storage'.$userAvatarSmallHashName,
                // 'small' => '/storage'.$userAvatarMeduimHashName,
            ];
        }

        Category::create($data);

        return redirect()->route('backend.categories.index')->with('category ',__('lang.successfully_created'));
    }

    public function edit(Category $category)
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();
        return view('backend.categories.edit',[
			'categories' => $categories,
			'category' => $category,
		]);
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $data = $request->validated();
        // $category = User::findOrFail($id);

        if (isset($data['image'])) {
            $img = $data['image'];
            //papaka yaratilayapti
            $imgPath = '/uploads/categories/'.now()->format('Y/m/d');
            if (!Storage::exists($imgPath)) {
                Storage::makeDirectory($imgPath, 0755, true, true);
            }

            //fayl nomi va yo'li generatsiya qilinayapti
            $imgHashName = md5(Str::random(10).time()).'.'.$img->getClientOriginalExtension();
            $imgLargeHashName =  $imgPath.'/l_'.$imgHashName;
            $imgMeduimHashName = $imgPath.'/m_'.$imgHashName;
            $imgSmallHashName = $imgPath.'/s_'.$imgHashName;

            //rasm kesilib yuklanayapti
            $imageR = new ImageResize($img->getRealPath());
            $imageR->resizeToBestFit(1920, 1080)->save(Storage::path($imgLargeHashName));
            $imageR->resizeToBestFit(500, 500)->save(Storage::path($imgMeduimHashName));
            $imageR->resizeToBestFit(150, 150)->save(Storage::path($imgSmallHashName));

            //nomlari bazaga saqlanayapti
            $data['image'] = [
                'large' =>  $imgLargeHashName,
                'medium' => $imgMeduimHashName,
                'small' =>  $imgSmallHashName,
            ];

            //eski fayllar o'chirilayapti
            // if (Storage::exists('images/file.jpg')) {}

            Storage::delete($category->image['large'] ?? '');
            Storage::delete($category->image['medium'] ?? '');
            Storage::delete($category->image['small'] ?? '');
        }

        $category->update($data);
        return back()->with('success', 'category ' . __('lang.successfully_updated'));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', 'category ' . __('lang.successfully_deleted'));
    }
}
