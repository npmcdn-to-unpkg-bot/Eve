@extends('layouts.app')
@section('body-class') ticket-verify @endsection
@section('title') OK! @endsection

@section('content')
	<h1 class="green-text">Ticket verified!</h1>
  <div class="row">
    <div class="col s12 m6">
      <div class="card blue-grey darken-1">
        <div class="card-content white-text">
          <span class="card-title">{{$ticket->user->name}}</span>
          <p>{{$ticket->event->name}}</p>
          <p>{{ strip_tags($ticket->event->description) }}</p>
        </div>
      </div>
    </div>
  </div>
@endsection
