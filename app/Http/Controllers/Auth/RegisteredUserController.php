<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Utils\InputCorrector;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'firstname' => 'required|string|max:255',
            'familyname'=> 'required|string|max:255',
            'city'=>'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
$firstname=$request->firstname;
            $firstname=InputCorrector::nameize($firstname);
            $familyname=$request->familyname;
            $familyname=InputCorrector::nameize($familyname);
            $city=$request->city;
            $city=InputCorrector::nameize($city);
        $user = User::create([
            
            'firtname'=>$firstname,
            'familyname'=>$familyname,
            'name' => $firstname.' '.$familyname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]); 
        

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
