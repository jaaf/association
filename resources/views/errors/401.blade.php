@extends('errors::minimal')

@section('title', 'ACCÈS NON AUTORISÉ !'))
@section('code', '401')
@section('message', "Vous n'avez pas l'autorisation d'accéder  à la page que vous avez demandée. Vous n'auriez jamais dû vous retrouver ici. Sans doute avez vous forcé l'url dans la barre d'adresse du 
 navigateur. Si ce n'est pas le cas et que vous avez suivi des liens des pages visitées, alors signalez cette anomalie à l'administrateur du site. 
 
 <p>Pour sortir d'ici, utilisez la flèche de retour du navigateur</p>."))
