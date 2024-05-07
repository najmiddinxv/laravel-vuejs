<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::orderBy(['id' => 'desc', 'status' => 0])->paginate(30);
		return view('backend.comments.index',[
			'comments'=>$comments,
		]);
    }

    public function show(Comment $comment)
    {
        return view('backend.comments.show',[
			'comment' => $comment,
		]);
    }

    public function store(CommentRequest $request)
    {
        $data = $request->validated();
        
        Comment::create($data);

        return response()->json([
            'success' => 'Comment posted successfully!'
        ]);
    }

//     <!-- show_comments.blade.php -->
// @foreach ($comments as $comment)
//     <div class="comment">
//         <p>{{ $comment->content }}</p>
//         <p>By: {{ $comment->user->name }}</p>

//         <!-- Display replies recursively -->
//         @include('comments.show_comments', ['comments' => $comment->replies])

//         <!-- Reply form -->
//         <form action="{{ route('comments.reply', ['commentableType' => $commentableType, 'commentableId' => $commentableId]) }}" method="post">
//             @csrf
//             <textarea name="content" placeholder="Your reply"></textarea>
//             <button type="submit">Reply</button>
//         </form>
//     </div>
// @endforeach


    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'comment ' . __('lang.successfully_deleted'));
    }
}
