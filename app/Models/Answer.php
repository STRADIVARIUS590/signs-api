<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    public function question(){
        return $this->belongsTo(Question::class);
    }

    
    public static function random($amount = 1, $column = 'id'){
        $col = static::select($column)->inRandomOrder()->limit($amount)->get()->pluck($column);
        return  $amount==1? $col[0] : $col;
    }

    public static function check($question, $answer){
        error_log($question);
        if($question->answer_type == 'SINGLE'){//&& !is_array($answer)
            // error_log($question->answers->get(0)->id);
            return $question->answers->get(0)->id == $answer[0];
        }
        if($question->answer_type == 'MANY'){
            // $answer = [5,6];
            // error_log(implode(',', $answer));
            // error_log( $question->answers->pluck('id')->implode(','));
            // error_log( $question->answers->pluck('id')->implode(',') == implode(',', $answer));
            return $question->answers->pluck('id')->implode(',') == implode(',', $answer);
        }
    }


}
