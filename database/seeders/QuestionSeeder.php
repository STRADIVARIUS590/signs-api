<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];
        $question_answers = json_decode( file_get_contents('database/jsons/questions.json'), true);
        
        foreach($question_answers as $question){
            $q = Question::create([
                'text' => $question['text'],
            ]);
            $q->answers()->create([
                'meaning' =>  $question['answer']['meaning'],
                'image_path' =>  $question['answer']['image_path'],
            ]);
        }
        //
    }
}
