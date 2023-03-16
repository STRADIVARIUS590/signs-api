<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AnswerResource;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Streak;
use App\Enums\StreakQuestionStatusEnum as QuestionStatus;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    
    public function question(Request $request){
        
        $streak = Streak::create(['token' => uniqid()]);

      //  $options = Answer::whereIn('id', Answer::random(2))->inRandomOrder()->get();

        $questions = Question::whereIn('id', Question::random(4))->inRandomOrder()->get();

        $current_question = $questions->get(0);


        $options = Answer::where('id', '!=', $current_question->answers->id)->limit(3)->get()->add($current_question->answers);
        
        $streak->questions()->sync($questions);

        $streak->questions()->updateExistingPivot($current_question->id, ['status' => QuestionStatus::Current]);

        $streak->save();


        return response([
            'display' => $streak,
            'question' => $current_question, 
            'options' => $options
        ]);
    }
    
     public function validate_answer(Request $request){
        $streak = Streak::where('token',  $request->streak_token)->first();

       // return $streak->questions;
        if($streak){
            $current_question = $streak->questions->where('id', $request->question_id)->first();

        //    if($current_question->pivot->status == QuestionStatus::Current){ // la pregunta enviada es la pregunta actual
             
                $streak->question_count++; // intentos
                
                $correct = $current_question->answers->id == $request->answer_id;

                if($correct) {
                    $streak->score++;

                    $current_question_id = $streak->questions()->where('status', QuestionStatus::Current)->first()->id;
                
                    $new_question = $streak->questions()->where('status', QuestionStatus::Pending)->first();

                    $options = $options = Answer::where('id', '!=', $new_question->answers->id)->limit(3)->get()->add($new_question->answers);
                    
                    $streak->questions()->updateExistingPivot($current_question_id, ['status' => QuestionStatus::NoReturn]);
                    
                    $streak->questions()->updateExistingPivot($new_question->id, ['status' => QuestionStatus::Current]);


                }else{
                    
                }

                
                $streak->save();

                $streak->load('questions'); 
                
      /*       }else{
                return "No es la pregunta actual !";
            } */
            // $streak->answer->load('answers');

            return response([
                
                'correct' => $correct,
                'question' => $new_question,
                'options' => $options
            ]);
        }

        return 'No hay una partida con ese token :v';
          
    }


    public function setup_question(){

    }


}
