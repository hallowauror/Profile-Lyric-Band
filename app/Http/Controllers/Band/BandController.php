<?php

namespace App\Http\Controllers\Band;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use App\Models\Band;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BandController extends Controller
{
    public function table()
    {
        return view('bands.table', [
            'bands' => Band::latest()->paginate(16),
        ]);
    }

    public function create()
    {
        return view('bands.create', [
            'genres' => Genre::get(),
        ]);
    }

    public function store()
    {
        // dd('berhasil gan');
        request()->validate([
            'name' => 'required|unique:bands,name',
            'thumbnail' => request('thumbnail') ? 'image|mimes:png,jpeg,jpg,gif' : '',
            'genres' => 'required|array'
        ]);

        $band = Band::create([
            'name' => request('name'),
            'slug' => Str::slug(request('name')),
            'thumbnail' => request('thumbnail') ? request()->file('thumbnail')->store('images/band') : null,
        ]);

        $band->genres()->sync(request('genres'));

        return back()->with('success', 'Band Created!');
    }

    public function edit(Band $band)
    {
        return view('bands.edit', [
            'band' => $band,
            'genres' => Genre::get(),
        ]);
    }

    public function update(Band $band)
    {
        // dd('berhasil gan');
        request()->validate([
            'name' => 'required|unique:bands,name,' . $band->id,
            'thumbnail' => request('thumbnail') ? 'image|mimes:png,jpeg,jpg,gif' : '',
            'genres' => 'required|array'
        ]);

        if(request('thumbnail')){
            Storage::delete($band->thumbnail);
            $thumbnail = request()->file('thumbnail')->store('images/band');
        } else if($band->thumbnail) {
            $thumbnail = $band->thumbnail;
        } else {
            $thumbnail = null;
        }

        $band->update([
            'name' => request('name'),
            'slug' => Str::slug(request('name')),
            'thumbnail' => $thumbnail,
        ]);

        $band->genres()->sync(request('genres'));

        return back()->with('success', 'Band Updated!');
    }
}
