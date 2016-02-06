@extends('layouts.app')

@section('body-class') usersEvent-page usersAccount-page @endsection

@section('content')
	<main class="row">
		<nav class="oldEvents">
	    	<div class="nav-wrapper" >
	      			<div class="col s12">
	      				<a href="{{ URL::route('myEvents') }}" class="breadcrumb">Upcoming Events</a>
	       				<a href="{{ URL::route('pastEvents') }}" class="breadcrumb">  </a>
	      			</div>
	   			</div>
	  		</nav>
		<div class="col l10 push-l1 s12 card white">
			<div class="row">
				<div class="col m3 s12, hide-on-small-only" id="userInfo">
					<div class="collection">
						<div class="hide-on-med-and-down">
							<img src={{$me->profile_picture}}>
						</div>

						<div class="row">
							<div class="col s10">
								<span class="card-title">User Name: {{$me->name}}</span>
								<p>{{$me->bio}}</p>
							</div>
						</div>
					</div>
				</div>
				<div id="upComingEvents" class="col m9 s12">
					<div class="collection with-header, flow-text">
						<h3 class="center-align">Upcoming Events</h3>
							<div class="row">
					            @foreach($me->tickets as $ticket)
					                <div class="col s12 m6 l4">
					                    <div class="card">
					                        <div class="card-image">
					                            <img src="{{ URL::to('/') . '/images/sample_images/event_photos/event'.$ticket->event->id.'.jpg' }}">
					                            <span class="card-title">{{$ticket->event->title}}</span>
					                        </div>
					                        <div class="card-content">
					                            <p>{{$ticket->event->description}}</p>
					                        </div>
					                        <div class="card-action">
					                            <a href="{{action('EventsController@show', $ticket->event->id)}}" class="red-text text-lighten-2">View Event &rarr;</a>
					                        </div>
					                        <div class="card-action">
					                            <a href="{{action('TicketController@show', $ticket->event->id)}}" class="red-text text-lighten-2">View Info Pack &rarr;</a>
					                        </div>
					                    </div>
					                </div>
					            @endforeach
					        </div>
					</div>
				</div>
			</div>
		</div>
	</main>
@endsection

