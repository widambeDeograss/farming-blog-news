<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Subscription;
use App\Mail\NewPostNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Post::with('tags', 'comments')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|json',
            'author' => 'string',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);


        $post = Post::create($request->only('title', 'path', 'image', 'content', 'author', 'views', 'type'));
        $post->tags()->sync($request->tags);

        $subscribers = Subscription::all();
        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new NewPostNotification($post));
        }

        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Post::with('tags', 'comments')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|json',
            'author' => 'string',
            'tags' => 'array',
            'tags.*' => 'exists:tags,id',
        ]);

        $post = Post::findOrFail($id);
        $post->update($request->only('title', 'path', 'image', 'content', 'author', 'views', 'type'));
        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        return response()->json($post, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->tags()->detach();
        $post->delete();

        return response()->json(null, 204);
    }
}
