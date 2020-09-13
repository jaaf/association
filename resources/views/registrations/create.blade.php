@extends ('layouts.app')



@section('content')
<div class='container'>
	<h1>
		Inscription à
		{{$post->title}}
	</h1>
	
	@if ($post->inscription_directive != "")
        <div class="inscription-directive my-rubric">
			<h3>Directives d'inscription spécifiques à cet événement</h3>
            {{$post->inscription_directive}}
        </div>
	@endif
	
    {!! Form::open(['action' => 'RegistrationController@store','method'=>'POST']) !!}
        <input id="post_id" type="hidden"  value={{$post->id}} name="post_id" required >
        <input id="agent_id" type="hidden"  value={{ auth()->user()->id}} name="agent_id" required >

        <div class="form-group row">
            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ 'Prénom' }}</label>
            <div class="col-md-6">
                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" required >

                @error('firstname')
                     <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="familyname" class="col-md-4 col-form-label text-md-right">{{ 'Nom de famille' }}</label>
            <div class="col-md-6">
                <input id="familyname" type="text" class="form-control @error('familyname') is-invalid @enderror" name="familyname" required >

                @error('familyname')
                     <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="city" class="col-md-4 col-form-label text-md-right">{{ 'Ville ou village' }}</label>
            <div class="col-md-6">
                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" required >

                @error('city')
                     <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="remark" class="col-md-4 col-form-label text-md-right">{{ 'Observations' }}</label>
            <div class="col-md-6">
                <input id="remark" type="text" class="form-control @error('remark') is-invalid @enderror" name="remark">

                @error('remark')
                     <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
        </div>
	
	    @if ($post->receiveRegistration == true){{-- and post.closeDate|date('Y-m-d') >= 'now'|date('Y-m-d') --}}
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ 'Inscrire cette personne'}}
                    </button>
                </div>
            </div>

		@else 
           @isAtLeast('manager')
	            <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ 'Inscrire cette personne'}}
                        </button>
                    </div>
                </div>

	
	 @endif
   {!! Form::close() !!}
</div>   
@endsection