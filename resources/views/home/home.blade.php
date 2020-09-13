@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 my-col my-col-l">
            @include('home.inc.agenda')
            @include('home.inc.liens')
            @include('home.inc.howto')
        </div>
        <div class="col-md-8 my-col ">
            @auth
               @include('home.inc.maincol')
            @endauth
            @guest
                @include('home.inc.inviteguest')

            @endguest
        </div>
    </div>
</div>
@endsection
