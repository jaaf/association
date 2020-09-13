@extends('errors::minimal')

@section('title', __('Service Unavailable'))
@section('code', '503')
@section('message', __($exception->getMessage() ?: 'Le site est actuellement indisponible pour raisons de maintenance. Veuillez m\'excuser pour ce dérangement. Je fais de mom mieux pour rétablir le service au plus vite.'))
