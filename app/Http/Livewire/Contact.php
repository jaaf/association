<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Message;
use Livewire\Component;
use App\Jobs\SendContactBodyJob;
use App\Jobs\SendContactMessageJob;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendContactVerificationEmail;

class Contact extends Component
{
    public $firstname, $familyname, $email, $body;
    public $captcha;
    public $captcha_in;
    public $expression;




    public function mount()
    {
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->reset('familyname', 'firstname', 'email', 'body');
        $this->resetValidation();
        //$this->familyname='';
        ////$this->email='';
        //$this->body='';
        //$this->render();


    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function refreshCaptcha()
    {
        // return response()->json(['captcha'=> captcha_img()]);
        $this->captcha = captcha_img();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'firstname' => 'required',
            'familyname' => 'required',
            'email' => 'required|email',
            'body' => 'required',
            'captcha_in' => 'required|captcha'
        ]);
    }

    public function generateRandomString($length = 25)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    private function checkTraficJam(){
        
        //prevent a robot from clogging the site with numerous messages
        //normally pending messages shoul be less than 25
        
        $messages=Message::all();
        foreach ($messages as $message){
            $d=($message->created_at->diffInHours(Carbon::now()));
            if($d>5){$message->delete();}
           
        }
        
        $messages=Message::all();
        return count($messages);
      
        
    }


    public function store()
    {
        $stock=$this->checkTraficJam();
        //dd($stock);
        if($stock>25){

            $this->message('error','Pour des raisons techniques, nous ne pouvons accepter de nouveau message pour le moment. Veuillez réessayer plus tard.');
            return;
        }
        
        $token = $this->generateRandomString(128);
      
        $data = $this->validate([
            'firstname' => 'required',
            'familyname' => 'required',
            'email' => 'required|email',
            'body' => 'required|max:1024',
        ]);
      
             Message::create([
            'content' => $data['body'],
            'token'=>$token,
            'email'=>$data['email']
        ]);
     
        $this->resetForm();
        $mess = "Merci pour votre message. Nous vous avons adressé un courriel pour vérifier votre adresse électronique. Pour confirmer l'envoi de votre message, cliquez sur le lien qu'il contient.
        Si vous le faites pas dans les 24 heures votre message sera détruit et ne sera pas transmis."; 
        $details = [
            'title' => 'Denentzat.fr demande de confirmation de l\'envoi d\'un message',
            'firstname' => $data['firstname'],
            'familyname'=>$data['familyname'],
            'email'=>$data['email'],
            'token'=>$token,
            'recipient'=>$data['email']
        ];
       
        $job = (new SendContactVerificationEmail($details));
            dispatch($job);
           
            $this->message('success',$mess);
        
    }

    public function sendMessage()
    {

        $users = User::whereIn('role', ['admin'])->get();



        $details = [
        ];
        foreach ($users as $user) {
            $details['user'] = $user;
            $details['sender'] = $this->firstname . ' ' . $this->familyname;
            $job = (new SendContactMessageJob($details));
            dispatch($job);
        }
        
    }
    public function render()
    {
        return view('livewire.contact');
    }

    private function message($type,$mess,$timer='',$show_ok=true){
        $this->alert($type, $mess, [
            'position' =>  'center',
            'timer' =>  $timer,
            'toast' =>  true,
            'text' =>  '',
            'confirmButtonText' =>  'Ok',
            'cancelButtonText' =>  'Cancel',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  $show_ok,
        ]);
    }
}
