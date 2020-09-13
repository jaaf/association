@extends ('layouts.app')



@section('content')
<div class='container'>
	<h1>
		Inscription à
		{{$registration->post->title}}
	</h1>
	
	@if ($registration->post->inscription_directive != "")
        <div class="inscription-directive my-rubric">
			<h3>Directives d'inscription spécifiques à cet événement</h3>
            {{$registration->post->inscription_directive}}
        </div>
	@endif
	
    {!! Form::open(['action' => ['RegistrationController@update',$registration->id],'method'=>'PUT']) !!}
        <input id="post_id" type="hidden"  value={{$registration->post->id}} name="post_id" required >
        <input id="agent_id" type="hidden"  value={{ auth()->user()->id}} name="agent_id" required >

        <div class="form-group row">
            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ 'Prénom' }}</label>
            <div class="col-md-6">
                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{$registration->agent->firstname}}" required>

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
                <input id="familyname" type="text" class="form-control @error('familyname') is-invalid @enderror" name="familyname" value="{{$registration->agent->familyname}}" required >

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
                <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{$registration->city}}" required >

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
                <input id="remark" type="text" class="form-control @error('remark') is-invalid @enderror" name="remark" value="{{$registration->remark}}" >

                @error('remark')
                     <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                @enderror
            </div>
        </div>
	
	    @if ($registration->post->receiveRegistration == true){{-- and post.closeDate|date('Y-m-d') >= 'now'|date('Y-m-d') --}}
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ 'Mettre à jour cette inscription'}}
                    </button>
                </div>
            </div>

		@else 
           @isAtLeast('manager')
	            <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ 'Mettre à jour cette inscription'}}
                        </button>
                    </div>
                </div>

	
	 @endif
   {!! Form::close() !!}
</div>   
@endsection