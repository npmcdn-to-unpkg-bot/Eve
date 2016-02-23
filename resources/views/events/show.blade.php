@extends('layouts.app')

@section('body-class') event-page media-upload @endsection
@section('title') {{$event->title}} @endsection

@section('extra-js')
	<script type="text/javascript">
		$(document).ready(function( ){
			// initDropzone( );
		});
	</script>
@endsection

@section('content')
	<main class="row">
		<section class="event-image valign-wrapper" style="background-image: linear-gradient( rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5) ), url('{{ $event->featured_image }}');;">
			<div class="row container valign">
				<div id="event-details" class="col s12 m4 l4 right-align valign-wrapper">
					<div class="valign">
						<h5>{{ $event->hrStartTime( ) }}</h5>
						<h5>{{ $event->hrEndTime( ) }}</h5>
						<h5>{{ $event->location->name }}</h5>
					</div>
				</div>
				<div class="col s12 m8 l8" id="event-title">
					<h1>{{ $event->title }}</h1>
					<h4>{{ $event->tagline }}</h4>
				</div>
			</div>
		</section>
		<section id="description" class="container">
			<div class="card">
				<div class="card-header red lighten-2">
					<div class="card-title">
						<h4 class="">About The Event</h4>
						@if( Auth::check() )
							@if(Auth::user()->is_admin)
								<a href="{{ route('events.edit', [$event->id]) }}" class="right waves-effect waves-light btn">
									Edit <i class="fa fa-pencil left"></i>
								</a>
							@endif

							{{-- If it's just a normal user, show them how to upload images --}}
							@if(! Auth::user()->is_admin && ! Auth::user()->is_staff )
								<a href="#media-modal"class="right waves-effect waves-light btn modal-trigger">
									Add Photos <i class="fa fa-pencil left"></i>
								</a>
							@endif
						@endif
					</div>
				</div>
				<div class="card-content">
					{!! $event->description !!}
				</div>
			</div>
		</section>

		<section id="event-actions" class="container row">
			<div id="ticket" class="col s12 m4 l4">
				<div id="ticket-card" class="card">
					<div class="card-header amber darken-2">
						<div class="card-title">
							<h4 class="ticket-card-title truncate">{{ $event->title }}</h4>
							<p class="ticket-card-date">{{ $event->location->name }}</p>
						</div>
					</div>
					<div class="card-content-bg white-text" style="background-image: url('{{ $event->featured_image }}')">
						<div class="card-content">
							<div class="row ticket-state-wrapper">
								@if(! $ticket)
									{!! Form::open( ['action' => 'TicketController@store', "class" => "col s12 center-align get_ticket_button"] ) !!}
										{!! Form::hidden('event_id', $event->id) !!}
										@if(!$event->price )
											<h2 id="price">
												FREE
											</h2>
											{!! Form::submit('Get Ticket', ['class' => 'btn btn-primary red lighten-2 form-control']) !!}
										@elseif( Auth::check() ) {{-- This is the Stripe embed and is used to
												   generate the token we use to verify payments --}}
											<h2 id="price">
												&euro;{{ $event->price }}
											</h2>
											<script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
													data-key="{{env('STRIPE_KEY')}}"
													data-image="{{URL::to('/images/logo.png')}}"
													data-description="{{$event->title}}"
													data-amount="{{$event->price * 100}}"
													data-locale="auto"
													data-currency="EUR"
													data-email="{{Auth::user()->email}}"></script>
										@else
											<h2 id="price">
												&euro;{{ $event->price }}
											</h2>
											<a class="btn btn-primary red lighten-2 modal-trigger" href="#login-modal">
												Buy Ticket
											</a>
										@endif
									{!! Form::close() !!}
								@else
									<div class="col s12 center-align">
										{!! $ticket->qr() !!}
									</div>
									<div class=" col s12 row center-align">
										<a class="btn red lighten-2" target="_blank" href="{{ URL::route( 'tickets/print', [ 'id' => Crypt::encrypt( $ticket->id ) ] ) }}"><i class="fa fa-print left"></i> Print ticket</a>
									</div>
									<div class=" col s12 row center-align">
										<a class="btn red lighten-2" target="_blank" href="{{ URL::route( 'events/info', ['ticket' => $ticket]) }}"><i class="fa fa-print left"></i> Info Pack</a>
									</div>
									<div class=" col s12 row center-align">
										<a class="btn red lighten-2 ical" target="_blank" href="{{ URL::action( 'TicketController@iCal', ['id' => Crypt::encrypt($ticket->id)]) }}"><i class="fa fa-calendar left"></i> Add To Calendar</a>
									</div>

								@endif
							</div>
							<div class="row">
								<div class="col s6 m6 l6 center-align">
									<div class="ticket-info">
										<p class="small center-align">Start</p>
										<p class="small"><span class="grey-text text-lighten-2">Time:</span> {{ date('h:i A', strtotime( $event->start_datetime ) ) }}</p>
										<p class="small"><span class="grey-text text-lighten-2">Date:</span> {{ date('d/m/Y', strtotime( $event->start_datetime ) ) }}</p>
									</div>
								</div>
								<div class="col s6 m6 l6 center-align ticket-state-two">
									<div class="ticket-info">
										<p class="small center-align">End</p>
										<p class="small"><span class="grey-text text-lighten-2">Time:</span> {{ date('h:i A', strtotime( $event->end_datetime ) ) }}</p>
										<p class="small"><span class="grey-text text-lighten-2">Date:</span> {{ date('d/m/Y', strtotime( $event->end_datetime ) ) }}</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				@if(count($users))
					<div class="divider"></div>
					<ul class="collection with-header">
						<li class="collection-header"><h4> Attendees:</h4></li>
						@foreach( $users as $user )
							<li class="collection-item avatar">
								<img src="{{ $user->profile_picture }}" alt="" class="circle">
								<strong class="title">{{ $user->name }}</strong>
								<p>
									{{ $user->city }}, {{ $user->country }}
								</p>
								<a href="{{ URL::route('user/show', [$user->username]) }}" class="secondary-content"><i class="fa fa-external-link red-text text-lighten-2"></i></a>
							</li>
						@endforeach
					</ul>
				@endif
			</div>

			<div id="partners" class="col s12 m8 l8">
				@foreach( $partners as $partner )
				<div class="col s12 m6 l6">
					<div class="product-card">
						<div class="card">
							<div class="card-image waves-effect waves-block waves-light">
								@if( $partner->price )
									<a href="#" class="btn-floating btn-large btn-price waves-effect waves-light  pink accent-2">&euro;{{ $partner->price }}</a>
								@endif
								<img src="{{ $partner->featured_image }}" alt="product-img">
							</div>
							<ul class="card-action-buttons">
								<li>
									<a class="btn-floating waves-effect waves-light green accent-4">
										<i class="fa fa-envelope-o"></i>
									</a>
								</li>
								<li>
									<a class="btn-floating waves-effect waves-light light-blue">
										<i class="mdi-action-info activator"></i>
									</a>
								</li>
								<li>
									<a class="btn-floating waves-effect waves-light red accent-2" href="{{ $partner->url }}">
										<i class="fa fa-external-link"></i>
									</a>
								</li>
							</ul>
							<div class="card-content">

								<div class="row">
									<div class="col s8">
										<p class="card-title grey-text text-darken-4"><a href="#" class="grey-text text-darken-4">{{ $partner->name }}</a>
										</p>
									</div>
									<div class="col s4 no-padding">
										<a href=""></a><img src="{{ $partner->logo }}" class="responsive-img">

									</div>
								</div>
							</div>
							<div class="card-reveal">
								<span class="card-title grey-text text-darken-4"><i class="mdi-navigation-close right"></i>{{$partner->name}}</span>
								<p>{{$partner->description}}</p>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
		</section>

		<section class="row container">
			<div classs="col s12">
				@include('events.gallery')
			</div>
		</section>
	</main>
	@if( Auth::check() )
		@include('media.upload')
	@endif
@endsection
