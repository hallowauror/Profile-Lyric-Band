<?php

namespace App\Http\Controllers\Band;

use App\Http\Controllers\Controller;
use App\Http\Requests\Band\AlbumRequest;
use App\Models\{Band, Album};
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AlbumController extends Controller
{
    public function create()
    {
        return view('albums.create', [
            'title' => 'New Album',
            'bands' => Band::get(),
            'submitLabel' => 'Create',
            'album' => new Album,
        ]);
    }

    public function store(AlbumRequest $request)
    {
        // dd('berhasil gan!');

        $band = Band::find(request('band'));

        Album::create([
            'band_id' => request('band'),
            'name' => request('name'),
            'slug' => Str::slug(request('name')),
            'year' => request('year'),
        ]);

        return back()->with('success', 'Album was created into ' . $band->name);
    }

    public function table()
    {
        return view('albums.table', [
            'albums' => Album::paginate(15),
            'title' => 'Albums'
        ]);
    }

    public function edit(Album $album)
    {
        return view('albums.edit', [
            'title' => "Edit album : {$album->name}",
            'bands' => Band::get(),
            'album' => $album,
            'submitLabel' => 'Update',
        ]);
    }

    public function update(Album $album, AlbumRequest $request)
    {
        $album->update([
            'band_id' => request('band'),
            'name' => request('name'),
            'slug' => Str::slug(request('name')),
            'year' => request('year'),
        ]);

        return redirect()->route('albums.table')->with('success', 'Album ' . $album->name . '   was updated!');
    }

    public function destroy(Album $album)
    {
        $album->delete();
    }
}
