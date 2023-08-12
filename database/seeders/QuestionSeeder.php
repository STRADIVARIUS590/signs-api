<?php

namespace Database\Seeders;

use App\Models\Data;
use App\Models\Image;
use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      
        $question_answers = json_decode( file_get_contents('database/jsons/questions.json'), true);
        
        foreach($question_answers as $question){
            $q = new Question();
            $q->text = $question['text'];
            $q->answer_type = (count($question['answers'])) > 1 ? 'MANY' : 'SINGLE';

            $q->save();
            foreach($question['answers'] as $answer){
                $ans = Data::where('meaning', $answer['meaning'])->first();
              
                if(!$ans){
                    $q->answers()->create([
                        'meaning' =>  $answer['meaning'],
                        'image_path' =>  $answer['image_path'],
                    ]);

                    $image = Image::create(['path' => $answer['image_path']]);
                    $q->images()->attach($image, ['created_at' => now(), 'updated_at' => now()]);
                }
                else{
                    $q->answers()->attach($ans);
                }
            }
        }
    }
}
