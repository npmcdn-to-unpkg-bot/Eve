@extends('layouts.app')

@section('body-class') admin-home-page @endsection


@section('extra-js')
	<script type="text/javascript">
		$(document).ready(function(){
			initAdmin( );
		});
	</script>
@endsection

@section('content')


<div class="row admin-with-sidebar">
	<div class="col s12 m8 offset-m2">
		<div class="col hide-on-small-only m4">
			<aside class="card">
				<div class="collection sidebar-scroll">
					<a href="#events" 	class="collection-item">Events</a>
					<a href="#partners" class="collection-item">Partners</a>
					<a href="#news" 	class="collection-item">News</a>
					<a href="#media" 	class="collection-item">Media</a>
					<a href="#staff" 	class="collection-item">Staff</a>
				</div>

			</aside>
		</div>
		<div class="col s12 m8">
			<div class="row scrollspy" id="events">
				<ul class="collection with-header">
					<li class="collection-header">
						<a href="#!" class="waves-effect waves-light btn right add-new-button"><i class="fa fa-plus left"></i>Add New Event</a>
						<h4>Events</h4>
					</li>

					@foreach( $events as $event )
						<li class="collection-item">
							<div>
								<strong>{{ $event->title }}</strong>
								<br /><small>({{ date('d M, Y', strtotime($event->start_datetime)) }} &rarr; {{ date('d M, Y', strtotime($event->end_datetime)) }})</small>
								<a href="#!" class="secondary-content">
									<i class="fa fa-pencil"></i> &nbsp;
									<i class="fa fa-times red-text"></i>
								</a>
							</div>
						</li>
					@endforeach
				</ul>
				<a href="#!" class="waves-effect waves-light btn right">View All Events &rarr;</a>
			</div>

			<div class="row scrollspy" id="partners">
				<ul class="collection with-header">
					<li class="collection-header">
						<a href="#!" class="waves-effect waves-light btn right add-new-button"><i class="fa fa-plus left"></i>Add New Partner</a>
						<h4>Partners</h4>
					</li>

					@foreach( $partners as $partner )
						<li class="collection-item">
							<div>
								<strong>{{ $partner->name }}</strong>
								<br /><small>({{ $partner->location->name }})</small>
								<a href="#!" class="secondary-content">
									<i class="fa fa-pencil"></i> &nbsp;
									<i class="fa fa-times red-text"></i>
								</a>
							</div>
						</li>
					@endforeach
				</ul>
				<a href="#!" class="waves-effect waves-light btn right">View All Partners &rarr;</a>
			</div>
			
			<div class="row scrollspy" id="news">
				<ul class="collection with-header">
					<li class="collection-header">
						<a href="#!" class="waves-effect waves-light btn right add-new-button"><i class="fa fa-plus left"></i>Add New New</a>
						<h4>News</h4>
					</li>

					@foreach( $news as $new )
						<li class="collection-item">
							<div>
								<strong>{{ $new->title }}</strong>
								<br /><small>({{ str_limit($new->content, 150) }})</small>
								<a href="#!" class="secondary-content">
									<i class="fa fa-pencil"></i> &nbsp;
									<i class="fa fa-times red-text"></i>
								</a>
							</div>
						</li>
					@endforeach
				</ul>
				<a href="#!" class="waves-effect waves-light btn right">View All News &rarr;</a>
			</div>

			<div class="row scrollspy" id="media">
				<div class="row card white">
					<div class="card-content">
						<h4>Approve Media for Frontpage</h4>
						@foreach( $media as $row )
							<div class="row">
								@foreach( $row as $item )
									<div class="col s12 m2 l4" id="{{ 'media_'.$item->id }}">
										<div class="card z-depth-0 off-black dimmed-card-image">
											<div class="card-image">
								              	<img src="{{ $item->file_location }}">
								              	<span class="card-title">{{ str_limit($item->name, 30) }} </span>
								            </div>
											<div class="card-action">
												<a href="#!">
													<i alt="Approve" class="fa fa-2x fa-check green-text" onclick="approveMedia('{{ Crypt::encrypt( $item->id ) }}', 'true', '{{ 'media_'.$item->id }}' );"></i>
												</a>
												<a href="#!">
													<i alt="Reject" class="fa fa-2x fa-times red-text right" onclick="approveMedia('{{ Crypt::encrypt( $item->id ) }}', 'false', '{{ 'media_'.$item->id }}' );"></i>
												</a>
											</div>
										</div>
									</div>
								@endforeach
							</div>
						@endforeach
					</div>
				</div>

				<a href="#!" class="waves-effect waves-light btn right">View All Unprocessed Media &rarr;</a>
			</div>


			<div class="row scrollspy" id="staffs">
				<ul class="collection with-header">
					<li class="collection-header">
						<a href="#!" class="waves-effect waves-light btn right add-new-button"><i class="fa fa-plus left"></i>Add New Staff</a>
						<h4>Staffs</h4>
					</li>

					@foreach( $staffs as $staff )
						<li class="collection-item">
							<div>
								<strong>{{ $staff->name }}</strong>
								<br /><small>({{ str_limit($staff->bio, 150) }})</small>
								<a href="#!" class="secondary-content">
									<i class="fa fa-pencil"></i> &nbsp;
									<i class="fa fa-times red-text"></i>
								</a>
							</div>
						</li>
					@endforeach
				</ul>
				<a href="#!" class="waves-effect waves-light btn right">View All Staffs &rarr;</a>
			</div>
		
		</div>
	</div>
</div>
@endsection