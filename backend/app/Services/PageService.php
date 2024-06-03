<?php

namespace App\Services;

use App\Models\Content\Category;
use App\Contracts\PageServiceContract;
use App\Models\Content\Page;
use Illuminate\Support\Arr;

class PageService implements PageServiceContract
{
    public function __construct(
        protected FileUploadService $fileUploadService
    ){}

    public function index(array $queryParam)
    {
        $perPage = $queryParam['per_page'] ?? config('settings.paginate_per_page');
        $sortParams = Arr::only($queryParam, ['view_count', 'created_at']);

        $categories = Page::query()
            ->select('id','title','slug','description','main_image','view_count','created_at')
            ->whenJsonColumnLikeForEachWord('title', $queryParam)
            ->sortByJsonField('title', $queryParam)
            ->sortByArr($sortParams)
            ->latest('id')
            ->paginate($perPage);

        return $categories;
    }

    public function show(int $id)
    {
        $page = Page::findOrFail($id);
        return $page;
    }

    public function store(array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = $this->fileUploadService->resizeImageUpload($data['image'], '/uploads/pages/'.now()->format('Y/m/d'));
        }
        $page = Page::create($data);
        return $page;
    }

    public function update(array $data, int $id)
    {
        $page = Page::findOrFail($id);
        if (isset($data['image'])) {
            $this->fileUploadService->resizedImageDelete($page->image);
            $data['image'] = $this->fileUploadService->resizeImageUpload($data['image'], '/uploads/pages/'.now()->format('Y/m/d'));
        }
        $page->update($data);
        return $page;
    }

    public function destroy(int $id)
    {
        $page = Page::findOrFail($id);
        if(!is_null($page->image)){
            $this->fileUploadService->resizedImageDelete($page->image);
        }
        $page->delete();
    }
}
