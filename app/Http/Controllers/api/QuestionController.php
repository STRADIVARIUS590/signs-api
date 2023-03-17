<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AnswerResource;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Streak;
use App\Enums\StreakQuestionStatusEnum as QuestionStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    
    public function question(Request $request){
        
        $streak = Streak::create(['token' => uniqid()]);

        $questions = QuestionController::setup_question($streak);

        $streak->save();

        return response([
            'display' => $streak,
            'question' => $questions->current_question, 
            'options' => $questions->options
        ]);
    }
    
     public function validate_answer(Request $request){
    
        $validator = Validator::make($request->all(), [
            'streak_id' => 'exists:streaks,id'
        ]);

        if($validator->passes()){

            $streak = Streak::where('token',  $request->streak_token)->first();            

            $current_question = $streak->questions()->where('status', QuestionStatus::Current)->first();
            
            $is_answer_correct = $current_question->answers->id == $request->answer_id;
            if($is_answer_correct){
                $streak->score++;
                $streak->save();
                $questions = QuestionController::setup_question($streak);
            
                return response([
                    'display' => $streak,
                    'question' => $questions->current_question, 
                    'options' => $questions->options
                ]);
            }else{
                return 'incorrecto';
            }
        }

    }


    public static function setup_question(Streak $streak){
        $current_question = null;
        $options = null;
        if($streak->questions()->exists()){

            $old_question = $streak->questions()->wherePivot('status' ,QuestionStatus::Current)->first();

            $current_question = $streak->questions()->wherePivot('status' ,QuestionStatus::Pending)->first();
            
            $streak->questions()->updateExistingPivot($old_question->id, ['status' => QuestionStatus::NoReturn]);

            if($current_question){

                $options = Answer::where('id', '!=', $current_question->answers->id)->limit(3)->get()->add($current_question->answers);
                
                $streak->questions()->updateExistingPivot($current_question->id, ['status' => QuestionStatus::Current]);
            
                unset($current_question->pivot);
                
                unset($current_question->answers);
            
            }
            
        }else{
            $questions = Question::whereIn('id', Question::random(4))->inRandomOrder()->get();

            $current_question = $questions->get(0);
    
            $options = Answer::where('id', '!=', $current_question->answers->id)->limit(3)->get()->add($current_question->answers);
            
            $streak->questions()->sync($questions);
    
            $streak->questions()->updateExistingPivot($current_question->id, ['status' => QuestionStatus::Current]);

            unset($current_question->answers);
        }

        $object = new \stdClass;
        $object->current_question = $current_question;
        $object->options = $options;
        return $object;
    }


}
