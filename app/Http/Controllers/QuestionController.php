<?php

namespace App\Http\Controllers;

use App\Http\Controllers\api\QuestionController as ApiQuestionController;
use App\Models\Question;
use App\Models\Streak;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }

    public function game(Request $request){
            
        $streak = Streak::create(['token' => uniqid()]);

        $questions = ApiQuestionController::setup_question($streak);

        $question = $questions->current_question;
        $options = $questions->options;
        foreach($options as $option){
            $option->image_path = URL::to('').'/storage/'.$option->image_path;
        }
        $streak_token = $streak->token;
    return view('game.cards', compact('options' , 'question', 'streak_token' ));
    }
}
