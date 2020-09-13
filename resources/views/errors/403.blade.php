@extends('errors::minimal')

@section('title', __('ACTION INTERDITE'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: "Action interdite. Vous avez tenté de faire une action pour laquelle vous n'avez pas l'autorisation. Vous n'auriez
jamais dû tenter une telle chose sauf si délibérément vous avez forcé une url dans la barre d'adresse du navigateur. Si vous avez pu faire cela en suivant des liens 
dans les pages du site, signalez-le à l'administrateur car il s'agit là d'une vulnérabilité à traiter. 
Pour retourner d'où vous venez, utilisez la flèche de retour du navigateur."))
