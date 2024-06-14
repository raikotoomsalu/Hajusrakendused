<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->get('limit');

        if ($limit) {
            return response()->json(Song::limit($limit)->get());
        }

        return response()->json(Song::get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'lyrics' => 'required|string',
            'artist' => 'required|string',
            'image_url' => 'required|url',
        ]);

        $song = Song::create($request->all());

        return response()->json($song);
    }

    public function show(Song $song)
    {
        return response()->json($song);
    }

    public function update(Request $request, song $song)
    {
        $request->validate([
            'title' => 'required|string',
            'artist' => 'required|string',
        ]);

        $song->update($request->all());

        return response()->json($song);
    }

    public function destroy(song $song)
    {
        $song->delete();

        return response()->json(['message' => 'Song deleted']);
    }

}