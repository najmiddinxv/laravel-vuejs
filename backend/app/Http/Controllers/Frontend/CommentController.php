<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CommentRequest $request, $commentableId, $commentableType)
    {
        $data = $request->validated();

        $commentable = $commentableType::findOrFail($commentableId);

        $comment = new Comment();
        $comment->body = $data['body'];

        $commentable->comments()->save($comment);

        return back();
    }

    public function storeReply(CommentRequest $request, $commentId)
    {
        $data = $request->validated();

        $comment = Comment::findOrFail($commentId);

        $replyComment = new Comment();
        $replyComment->body = $data['body'];
        $replyComment->commentable_type = $comment->commentable_type;
        $replyComment->commentable_id = $comment->commentable_id;
        $comment->replies()->save($replyComment);

        return back();
    }
}

