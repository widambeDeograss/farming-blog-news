<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Comment::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|json',
            'author_id' => 'string',
            'post_id' => 'required|exists:posts,id',
        ]);


        $post = Comment::create($request->only('author_id', 'content', 'post_id'));
        $post->tags()->sync($request->tags);

        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Comment::findOrFail($id); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Comment::findOrFail($id);
        $category->delete();

        return response()->json(null, 204);
    }
}
