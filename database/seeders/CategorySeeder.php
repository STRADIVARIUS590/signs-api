<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cat = Category::create([
            'name' => 'Meses'
        ]);
    
        Category::create([
            'name' => 'Dias'
        ]);
        $cat = Category::create([
            'name' => 'Letras'
        ]);

        $image = Image::create([
            'path' => 'words.png'
        ]);
        $cat->images()->attach($image,[ 'created_at' => now(), 'updated_at' => now()]);

        Category::create([
            'name' => 'Palabras'
        ]);
        

    }
}
