<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store (Request $request, $id)
    {
        // return $request->all();
        $request->validate([
            'body' => 'required',
            'article_id' => 'required|exists:articles,id'
        ]);
        // return $request->all();
        Comment::create([
            'body' => $request->body,
            'commentable_id' => $id,
            'commentable_type' => Article::class, // Assuming Article is the model for comments
        ]);
        return redirect()->back()->with('success', 'Comment added successfully');
    }

    public function storeVideo(Request $request, $id)
    {
        // return $request->all();
        $request->validate([
            'body' => 'required',
            'video_id' => 'required|exists:videos,id',
        ]);

        Comment::create([
            'body' => $request->body,
            'commentable_id' => $id,
            'commentable_type' => Video::class, // Assuming Video is the model for comments
        ]);
        return redirect()->back()->with('success', 'Comment added successfully');
    }
}
