<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;
use App\Poll;

class PollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $surveys=Survey::all();
        return view('polls.create')->with('surveys',$surveys);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'rank'=>'required',
            'question' => 'required',
            'survey_id' => 'required',
            'is_random'=>'required',
            'allow_multiple'=>'required',
            'show_vote'=>'required'
        ]);
        $poll = new Poll;
        $poll->rank=$request->input('rank');
        $poll->question = $request->input('question');
        $poll->survey_id = $request->input('survey_id');
        $poll->is_random = $request->input('is_random');
        $poll->allow_multiple = $request->input('allow_multiple');
        $poll->show_vote = $request->input('show_vote');
        $poll->save();
        return redirect('/polls')->with('success', 'Question enregistrée !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
