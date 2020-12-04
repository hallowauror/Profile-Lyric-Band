<?php

namespace App\Http\Controllers\Band;

use App\Http\Controllers\Controller;
use App\Http\Requests\Band\GenreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Genre;

class GenreController extends Controller
{
    public function create()
    {
        return view('genres.create', [
            'title' => 'New Genre'
        ]);
    }

    public function store(GenreRequest $request)
    {
        // dd('berhasil gan!');
        Genre::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return back()->with('success', 'The genre was created!');
    }

    public function table()
    {
        return view('genres.table', [
            'title' => 'All Genre',
            'genres' => Genre::latest()->paginate(15),
        ]);
    }

    public function edit(Genre $genre)
    {
        return view('genres.edit', [
            'title' => "Edit genre : {$genre->name}",
            'genre' => $genre,
        ]);
    }

    public function update(Genre $genre, GenreRequest $request)
    {
        $genre->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('genres.table')->with('success', 'The genre was updated!');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
    }
}
