<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Registration;
use App\Auth;
use App\User;


class RegistrationController extends Controller
{



     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');#seuls les membres ont accès aux inscriptions
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($post_id)
    {
        
        $post=Post::find($post_id);
        $registrations=Registration::where('post_id',$post_id)->orderBy('created_at','asc')->paginate(25);
        return view('registrations.index',compact('registrations','post'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($post_id)
    {
        //get the post to which this inscription is attached
        $post=Post::find($post_id);
 
       $user=auth()->user();
       //create a new registration and prefill it with already known values
       $registration= new Registration();
       $registration->agent_id=$user->id;
       $registration->post_id=$post_id;

       return view('registrations/create',compact('post'));

    }
   

     

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()){
           $this->validate($request,[
                'firstname'=>'required',
                'familyname'=>'required',
                'city'=>'required',
                'post_id'=>'required',
                'agent_id'=>'required'

           ]);
           $registration=new Registration();
           $registration->firstname=$request->input('firstname');
           $registration->familyname=$request->input('familyname');
           $registration->city=$request->input('city');
           $registration->remark=$request->input('remark');
           $registration->post_id=$request->input('post_id');
           $registration->agent_id=$request->input('agent_id');
           $registration->save();
          return redirect('/registrations/'.$request->post_id)->with('success', 'Personne inscrite');
        }
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
        $registration=Registration::find($id);
        return view('registrations.edit')->with('registration',$registration);
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
        if (auth()->user()) {
            $this->validate($request, [
                 'firstname'=>'required',
                 'familyname'=>'required',
                 'city'=>'required',
                 'post_id'=>'required',
                 'agent_id'=>'required'
 
            ]);
            $registration=Registration::find($id);
            $registration->firstname=$request->input('firstname');
            $registration->familyname=$request->input('familyname');
            $registration->city=$request->input('city');
            $registration->remark=$request->input('remark');
            $registration->post_id=$request->input('post_id');
            $registration->agent_id=$request->input('agent_id');
            $registration->save();
            return redirect('/registrations/'.$request->post_id)->with('success', 'Inscription mise à jour');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $registration=Registration::find($id);
        //find the post the registration belongs to
        $post=$registration->post;
        $registration->delete();
        return redirect('/registrations/'.$post->id)->with('success','Personne désinscrite');
    }
}
