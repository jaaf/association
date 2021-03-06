<?php

namespace App\Http\Controllers;

use Gate;
use App\Job;
use App\Auth;
use App\User;
use App\Adherent;
use Carbon\Carbon;
use App\Failed_job;
use App\Infoletter;
use App\Jobs\SendEmailJob;
use App\Mail\InfoletterMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Http\Middleware\IsAtLeastManager;
use Illuminate\Database\Eloquent\Collection;


class InfoletterController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAtLeastManager');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agent = auth()->user();
        $infoletters = $agent->infoletters;
        return view('infoletters.index')->with('infoletters', $infoletters);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('infoletters.create');
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
            'title' => 'required',
            'body' => 'required'
        ]);
        $infoletter = new Infoletter();
        $infoletter->title = $request->input('title');
        $infoletter->body = $request->input('body');
        $infoletter->user_id = auth()->user()->id;
        $infoletter->save();
        return redirect('/infoletters')->with('success', 'Votre info-lettre a été enregistrée !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {


        Log::debug('Entering infoletter@view');
        $infoletter = Infoletter::find($id);
        $users = User::all();

        $adds = Adherent::all();
        $adherents=new Collection();
        foreach($adds as $key =>$add){
          if(filter_var($add->email,FILTER_VALIDATE_EMAIL)){
               $adherents->add($add);
           }
         }
          //dd($adherents);


        $fakeuser = new User(); // to simulate the user in the presentation of the mail in the view
        $fakeuser->firstname = "Prénom ?";
        $fakeuser->familyname = 'Nom ?';
        $emailview = view('emails.infoletter')->with('details', ['title' => $infoletter->title, 'body' => $infoletter->body, 'user' => $fakeuser, 'sender' => auth()->user()]);
        return view('infoletters.view', compact('infoletter', 'users', 'adherents', 'emailview')); //here we pass a fake email view as example to bee shown
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     **/
    public function edit($id)
    {
        $infoletter = Infoletter::find($id);
        return view('infoletters.edit', compact('infoletter'));
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
        $infoletter = Infoletter::find($request->id);
        $user = auth()->user();;
        $agent = $infoletter->agent; //belongsTo relationship 
        #only admin can update others infoletters
        if ($user != $agent and Gate::denies('isAdmin')) {
            abort(403); //forbiden
        }
        $this->validate($request, [
            'id' => 'required',
            'title' => 'required',
            'body' => 'required'
        ]);

        $infoletter->title = $request->input('title');
        $infoletter->body = $request->input('body');
        $infoletter->user_id = auth()->user()->id; //devrait pouvoir disparaître

        $infoletter->save();
        return redirect('/infoletters')->with('success', 'Votre info-lettre a été mise à jour !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $infoletter = Infoletter::find($id);
        $user = auth()->user();;
        $agent = $infoletter->agent; //belongsTo relationship 
        #only admin can destroy others infoletters
        if ($user != $agent and Gate::denies('isAdmin')) {
            abort(403); //forbiden
        }
        $infoletter->delete();
        return redirect('/infoletters')->with('success', 'Info-lettre supprimée.');
    }




    public function sendToOne(Request $request)
    {
        if ($request->ajax()) {
            $this->validate($request, [
                'user_id' => 'required',
                'infoletter_id' => 'required'
            ]);

            $infoletter = Infoletter::find($request->infoletter_id);
            if (isset($request->additional)) {
                $user = Adherent::find($request->user_id);
            } else {
                $user = User::find($request->user_id);
            }

            $sender = auth()->user();
            if (filter_var($user->email, FILTER_VALIDATE_EMAIL)) {

                $details = [
                    'title' => $infoletter->title,
                    'body' => $infoletter->body,
                    'sender' => $sender,
                    'user' => $user,
                ];
                $job = (new SendEmailJob($details))->delay($request->delay);
                dispatch($job);
                $duree = $request->delay;
                $minutes = intval(($duree % 3600) / 60);
                $secondes = intval((($duree % 3600) % 60));
                return response()->json(['success' => 'Envoi de l\'infolettre programmé pour ' . $user->firstname . ' ' . $user->familyname . '. L\'envoi aura lieu dans ' . $minutes . ' minutes et ' . $secondes . ' secondes.']);
            }
        } else {
            return 'request is not ajax';
        }
    }
}
