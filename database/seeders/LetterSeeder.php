<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LetterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $question_answers = json_decode( file_get_contents('database/jsons/letters.json'), true);
        
        foreach($question_answers as $question){
            
        }
}
