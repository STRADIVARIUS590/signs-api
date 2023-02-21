<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AnswerResource;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    //

    public function question(){
        
        $options = Answer::whereIn('id', Answer::random(4))->get();
        $options->shuffle();
        $question = Question::where('id',  $options->get(0)->question_id)->first();
        // $question->options = $options;
        return response([
            'question' => $question, 
            'options' => (AnswerResource::collection($options))
        ]);
    }
}
