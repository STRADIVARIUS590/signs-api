<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;


    public static function check($question, $answer){
        if($question->answer_type == 'SINGLE'){//&& !is_array($answer)
            $answer = explode(',', $answer);
            return $question->answers->get(0)->id == $answer[0];
        }
        if($question->answer_type == 'MANY'){
            return $question->answers->pluck('id')->implode(',') ==  $answer;
        }
    }


}
