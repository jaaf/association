{{--This mail is sent to the managers after a guest has confirmed his message--}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
 
</head>
<body>
    @include('emails.inc.contact-mail-intro')
  
   <p style="text-align: center;"> Bonjour {{$details['user']->firstname}} {{$details['user']->familyname}} ,</p>
    <div>
        {!!$details['body']!!}
    </div>
  

</body>
</html>