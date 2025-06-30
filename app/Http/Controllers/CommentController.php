<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store (Request $request, $id)
    {
        // return $request->all();
        $request->validate([
            'description' => 'required',
            'article_id' => 'required|exists:articles,id'
        ]);
        Comment::create($request->all());
        return redirect()->back()->with('success', 'Comment added successfully');

    }
}
