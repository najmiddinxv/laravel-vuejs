<?php

namespace App\Http\Controllers\Backend\Content;

use App\Models\Content\Post;
use App\Models\Content\Category;
use App\Services\FileUploadService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Content\PostRequest;
use App\Models\Content\Tag;
use DOMDocument;
use Exception;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct(protected FileUploadService $fileUploadService){}

    public function index()
    {
        $posts = Post::latest()->paginate(config('settings.paginate_per_page'));
		return view('backend.posts.index',[
			'posts'=>$posts,
		]);
    }

    public function create()
    {
        $tags = Tag::postModel()->orWhere('tagsable_type',null)->get();
        $categories = Category::byModel(Post::class)->latest()->get();
        return view('backend.posts.create',[
            'categories' => $categories,
            'tags' => $tags,
		]);
    }

    public function store(PostRequest $request)
    {
        $data = $request->validated();

        // $data['slug'] = [
        //     'uz' => Str::slug($data['title']['uz']),
        //     'ru' => Str::slug($data['title']['ru']),
        //     'en' => Str::slug($data['title']['en']),
        // ];

        $this->fileUploadService->processBodyImages(data:$data, locales:config('app.locales'),path:'uploads/posts/' . now()->format('Y/m/d'));

        if (isset($data['image'])) {
            $data['main_image'] = $this->fileUploadService->resizeImageUpload($data['image'], '/uploads/posts/'.now()->format('Y/m/d'));
        }

        $post = Post::create($data);
        if(isset($data['tags'])){
            $post->tags()->sync($data['tags']);
        }

        return redirect()->route('backend.posts.index')->with('post ',__('lang.successfully_created'));
    }


    // public function update(PostRequest $request, Post $post)
    // {
    //     $post->update([
    //         'category_id' => $request->post_category_id,
    //         'title' => $request->title,
    //         'description' => $request->description,
    //         // 'body' => $request->body,
    //         'user_id' => Auth::user()->id,
    //     ]);

    //     $content = $request->body;
    //     $dom = new \DomDocument();
    //     $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    //     $imageFile = $dom->getElementsByTagName('img');

    //     if (count($imageFile) > 1) {

    //         // Storage::deleteDirectory('posts/' . $post->id);
    //         foreach ($imageFile as $item => $image) {

    //             $data = $image->getAttribute('src');
    //             if (preg_match('/data:image/', $data)) {
    //                 // dd($data);
    //                 list($type, $data) = explode(';', $data);
    //                 list(, $data)      = explode(',', $data);
    //                 $imgeData = base64_decode($data);

    //                 if (!Storage::exists('posts/' . $post->id)) {
    //                     Storage::createDirectory('posts/' . $post->id);
    //                 }

    //                 $path = Storage::path('posts/' . $post->id); // set the storage path for the image file
    //                 $image_name = $path . '/' . sha1(time()) . $item . '.png'; // generate a unique filename for the image
    //                 $image_path = "/storage/posts/{$post->id}/" . sha1(time()) . $item . '.png'; // generate a unique filename for the image

    //                 file_put_contents("{$image_name}", $imgeData); // write the image data to the file


    //                 $image->removeAttribute('src');
    //                 $image->setAttribute('src', $image_path);
    //             }

    //         }

    //         $post->body = $dom->saveHTML();
    //     } else {
    //         $post->body = $content;
    //     }
    //     $post->save();

    //     return redirect()->route('frontend.post.index')->with('success', __('locale.successfully_updated'));
    // }






    public function show(Post $post)
    {
        return view('backend.posts.show',[
            'post' => $post,
        ]);
    }

    public function edit(Post $post)
    {
        $tags = Tag::postModel()->get();
        $categories = Category::byModel(Post::class)->latest()->get();
        return view('backend.posts.edit',[
            'post' => $post,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $data = $request->validated();

        if (isset($data['image'])) {
            $this->fileUploadService->resizedImageDelete($post->main_image);
            $data['main_image'] = $this->fileUploadService->resizeImageUpload($data['image'], '/uploads/posts/'.now()->format('Y/m/d'));
        }

        $post->update($data);
        if(isset($data['tags'])){
            $post->tags()->sync($data['tags']);
        }

        return redirect()->route('backend.posts.index')->with('posts ',__('lang.successfully_updated'));
    }

    public function destroy(Post $post)
    {
        $this->fileUploadService->resizedImageDelete($post->main_image);
        $post->delete();
        return back()->with('success', 'post ' . __('lang.successfully_deleted'));
    }
}
