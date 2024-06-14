<?php

namespace App\Http\Controllers;
use App\Models\SocialMedia;

use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SocialMedia::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url',
            'platform' => 'required|in:instagram,twitter,other',
        ]);

        $socialMedia = SocialMedia::create($request->only('title', 'description', 'url', 'platform'));

        return response()->json($socialMedia, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return SocialMedia::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'sometimes|required|url',
            'platform' => 'sometimes|required|in:instagram,twitter,other',
        ]);

        $socialMedia = SocialMedia::findOrFail($id);
        $socialMedia->update($request->only('title', 'description', 'url', 'platform'));

        return response()->json($socialMedia, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $socialMedia = SocialMedia::findOrFail($id);
        $socialMedia->delete();

        return response()->json(null, 204);
    }
}
