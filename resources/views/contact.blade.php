@extends('layouts.app')

@section('content')
<div class="container my-post my-content ">
    
    <h1>{{ 'Laissez-nous un message'}}</h1>
                <div class="light">
                   <p>Si vous avez du mal à lire le captcha (dispositif anti-robot), n'hésitez pas à le rafraîchir autant de fois que nécessaire pour n'avoir aucun doute.</p>
                   
                </div>

                <div class="">
                    <form method="POST" action="{{ route('contact') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="firstname" class="col-md-2 col-form-label text-md-right">{{ 'Prénom' }}</label>

                            <div class="col-md-10">
                                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>

                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="familyname" class="col-md-2 col-form-label text-md-right">{{ 'Nom de famille' }}</label>

                            <div class="col-md-10">
                                <input id="familyname" type="text" class="form-control @error('familyname') is-invalid @enderror" name="familyname" value="{{ old('familyname') }}" required autocomplete="familyname" autofocus>

                                @error('familyname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right">{{ 'Adresse électronique'}}</label>

                            <div class="col-md-10">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="message" class="col-md-2 col-form-label text-md-right">{{ 'Votre message'}}</label>

                            <div class="col-md-10">
                                
                        <textarea id="message" name="message" cols="50" rows="4" class="form-control @error('message') is-invalid @enderror" name="message" value="{{ old('message') }}" required>{{ old('message') }}</textarea>
                        @error('message')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                            </div>
                        </div>
                 
                        <div class="form-group mt-4 mb-4">
                            <div class="captcha">
                                <span>{!! captcha_img() !!}</span>
                                <button type="button" class="btn btn-danger" class="reload" id="reload">
                                    &#x21bb;
                                </button>
                            </div>
                        </div>
            
                        <div class="form-group mb-4">
                            <input id="captcha" type="text" class="form-control" placeholder="Recopiez le captcha ici" name="captcha">
                        </div>


                       

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ 'Poster le message'}}
                                </button>
                            </div>
                        </div>

                        
                    </form>
  

</div>
<script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
<script type="text/javascript">
$( document ).ready(function() { 
    CKEDITOR.replace( 'message' );
    $('#reload').click(function () {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function (data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
});
</script>


@endsection
