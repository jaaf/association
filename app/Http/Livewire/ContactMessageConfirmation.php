<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Message;
use Livewire\Component;
use App\Jobs\SendContactMessageJob;

class ContactMessageConfirmation extends Component
{
    public $message=null;
    public $content;
    public $button_visible=true;

    public function mount($token){
        $this->message=Message::where('token',$token)->first();
        if($this->message){
            $this->content=$this->message->content;
        }
        
    }
    public function render()
    {
         
        
        return view('livewire.contact-message-confirmation');
    }

    public function sendMessage()
    {

        $users = User::whereIn('role', ['admin'])->get();
        $details = [
            'title' => 'Message posté sur le site de Denentzat',
            'firstname' => '',
            'familyname'=>'',
            'email'=>$this->message->email,
            'body'=>$this->content,
            'sender'=>$this->message->email,//should be firstname and familyname
            'reply_to'=>$this->message->email
        ];
        foreach ($users as $user) {
            $details['user'] = $user;

            
            $job = (new SendContactMessageJob($details));
            dispatch($job);
        }
        $this->message->delete();
        $this->button_visible=false;
        $this->info('success',"Merci. Votre message a été envoyé aux managers de l'association.");
        
    }
    private function info($type,$mess,$timer='',$show_ok=true){
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

