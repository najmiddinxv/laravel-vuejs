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

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'comment ' . __('lang.successfully_deleted'));
    }
}
