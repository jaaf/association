{{--This email email is sent to a guest who has posted a message. The message is stored in the database, waiting for the guest's confirmation--}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
 
</head>
<body>
   
  
   <p style="text-align: center;"> Bonjour {{$details['firstname']}} {{$details['familyname']}} ,</p>
    <div>
       <p>Vous avez posté un message sur le site de Denentzat. </p> 
       <p>Pour confirmer cet envoi, cliquez sur le lien ci-dessous ou recopiez-le dans la barre d'adresse de votre navigateur.</p>
       <p>Sans confirmation de votre part dans les 24 heures, ce message sera détruit.</p>


       @if (env('APP_ENV')==='production')
       <a href="{{env('APP_URL')}}/verify-contact-email/{{$details['token']}}">Cliquez-moi pour confirmer</a>
       
       @else
           <a href="localhost:8000/verify-contact-email/{{$details['token']}}">Cliquez-moi pour confirmer</a>
       @endif
    </div>
  

</body>
</html>