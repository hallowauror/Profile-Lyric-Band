<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;
use Illuminate\Support\Str;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = collect([
            'Heavy Metal',
            'Speed Metal',
            'Thrash Metal',
            'Power Metal',
            'Death Metal',
            'Black Metall',
            'Pagan Metal',
            'Viking Metal',
            'Folk Metal',
            'Symphonic Metal',
            'Gothic Metal',
            'Glam Metal',
            'Hair Metal',
            'Doom Metal',
            'Groove Metal',
            'Industrial Metal',
            'Modern Metal',
            'Neoclassical Metal',
            'New Wave Of British Heavy Metal',
            'Post Metal',
            'Progressive Metal',
        ]);

        $genres->each(function($genre){
            Genre::create([
                'name' => $genre,
                'slug' => Str::slug($genre),
            ]);
        });
    }
}
