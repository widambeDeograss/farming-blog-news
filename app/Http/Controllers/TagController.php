<?php

namespace App\Http\Controllers;
use App\Models\Tag;

use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Tag::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
            'slug' => 'required|string|max:255|unique:tags,slug',
        ]);

        $tag = Tag::create($request->only('name', 'slug'));

        return response()->json($tag, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Tag::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255|unique:tags,name,' . $id,
            'slug' => 'sometimes|required|string|max:255|unique:tags,slug,' . $id,
        ]);

        $tag = Tag::findOrFail($id);
        $tag->update($request->only('name', 'slug'));

        return response()->json($tag, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::findOrFail($id);
        $post->delete();

        return response()->json(null, 204);
    }
}
