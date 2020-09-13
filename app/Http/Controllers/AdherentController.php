<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Adherent;
use Gate;
class AdherentController extends Controller
{

    public function __construct() {
        $this->middleware('isAtLeastManager');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adherents=Adherent::all();
        return view('adherents.index')->with('adherents',$adherents);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adherents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request,[
            'firstname'=>'required',
            'familyname'=>'required',
            'city'=>'required',
            'cotisation'=>'required',
        ]
        );
        $adherent= new Adherent();
        $adherent->firstname = $request->input('firstname');
        $adherent->familyname= $request->input('familyname');
        $adherent->city=$request->input('city');
       
        $adherent->email=$request->input('email');
        $adherent->phone=$request->input('phone');
        $adherent->cotisation=$request->input('cotisation');
        $adherent->registered=$request->input('registered');
        $adherent->user_id=auth()->user()->id;
        $adherent->save();
        return redirect('/adherents')->with('success','Nouvel adherent enregistré !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adherent=Adherent::find($id);
        return view('adherents.edit')->with('adherent',$adherent);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'firstname'=>'required',
            'familyname'=>'required',
            'city'=>'required',
            'cotisation'=>'required'
        ]);
        $adherent=Adherent::find($request->id);
        $adherent->firstname = $request->input('firstname');
        $adherent->familyname= $request->input('familyname');
        $adherent->city=$request->input('city');
       
        $adherent->email=$request->input('email');
        $adherent->phone=$request->input('phone');
        $adherent->cotisation=$request->input('cotisation');
        $adherent->registered=$request->input('registered');
        $adherent->user_id=auth()->user()->id;
        $adherent->save();
        return redirect('/adherents')->with('success','Adhérent '.$adherent->firstname. ' '.$adherent->familyname.' mis à jour  !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adherent=Adherent::find($id);
      
        $adherent->delete();
        return redirect('/adherents')->with('success','Adhérent '.$adherent->firstname. ' '.$adherent->familyname.' supprimé');
    }
}
