<?php

namespace Database\Seeders;

use App\Models\Categorie;
use App\Models\Category;
use App\Models\Data;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $data = json_decode( file_get_contents('database/jsons/letters.json'), true);
        
        foreach($data as $data){
            $info = Data::create([
                'image_path' => $data['image'],
                'meaning' =>  $data['meaning']
            ]);
            
            if(array_key_exists('categories', $data)){
                $categories = Category::whereIn('name', $data['categories'])->pluck('id');
                $info->categories()->attach($categories);
            }
        }
    }
}