@extends('layouts.app')

@section('body-class') admin-home-page @endsection
@section('title') {{_t('Admin Panel')}} @endsection


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
					<a href="#events" 	class="collection-item">{{_t('Events')}}</a>
					<a href="#partners" class="collection-item">{{_t('Partners')}}</a>
					<a href="#locations" 	class="collection-item">{{_t('Locations')}}</a>
					<a href="#news" 	class="collection-item">{{_t('News')}}</a>
					<a href="#media" 	class="collection-item">{{_t('Media')}}</a>
					<a href="#staff" 	class="collection-item">{{_t('Staff')}}</a>
				</div>

			</aside>
		</div>

		<!-- Events -->
		<div class="col s12 m8">
			<div class="row scrollspy" id="events" name="events">
				<ul class="collection with-header">
					<li class="collection-header">
						<a href="{{ URL::route('events.create') }}" class="waves-effect waves-light btn right add-new-button col s12 m6 l4 col s12 m6 l4"><i class="fa fa-plus left"></i>{{_t('Add New Event')}}</a>
						<h4>{{_t('Events')}}</h4>
					</li>

					@foreach( $events as $event )
						<li class="collection-item">
							<div>
								<strong>{{ $event->title }}</strong>
								@if( $event->mediaCount > 0 )
									<a href="{{ URL::route('media.unprocessedForEvent', ['eventID'=>$event->id]) }}" alt="{{_t('Unprocessed Media')}}">
										<span class="new badge">{{ $event->mediaCount }}</span>
									</a>
								@endif
								<br /><small>({{ date('d M, Y', strtotime($event->start_datetime)) }} &rarr; {{ date('d M, Y', strtotime($event->end_datetime)) }})</small>
								<div class="secondary-content">
									<a href="{{ URL::route( 'events.show', [ 'id'=>$event->id ] ) }}">
										<i class="fa fa-eye teal-text" alt="View News"></i> &nbsp;
									</a>
									<a href="{{ URL::route('events.edit', ['event'=>$event->id]) }}">
										<i class="fa fa-pencil teal-text" alt="{{_t('Edit Event')}}"></i> &nbsp;
									</a>
									{{ Form::open(['route' => ['events.destroy', Crypt::encrypt($event->id)], 'method' => 'delete', 'class' => 'inline-form']) }}
										<button type="submit" ><i class="fa fa-times red-text" alt="{{_t('Delete Event')}}"></i></button>
									{{ Form::close() }}
								</div>
							</div>
						</li>
					@endforeach
				</ul>
				<a href="{{ URL::route('events.index') }}" class="waves-effect waves-light btn right">{{_t('View All Events')}} &rarr;</a>
			</div>

			<!-- Partners -->
			<div class="row scrollspy" id="partners" name="partners">
				<ul class="collection with-header">
					<li class="collection-header">
						<a href="{{ URL::route('partners.create') }}" class="waves-effect waves-light btn right add-new-button col s12 m6 l4"><i class="fa fa-plus left"></i>{{_t('Add New Partner')}}</a>
						<h4>{{_t('Partners')}}</h4>
					</li>

					@foreach( $partners as $partner )
						<li class="collection-item">
							<div>
								<strong>{{ $partner->name }}</strong>
								<br /><small>({{ $partner->location->name }})</small>
								<div class="secondary-content">
									<a href="{{ URL::route( 'locations.show', $partner->id ) }}">
										<i class="fa fa-eye teal-text" alt="View News"></i> &nbsp;
									</a>
									<a href="{{ URL::route('partners.edit', ['partner'=>$partner->id]) }}">
										<i class="fa fa-pencil teal-text" alt="{{_t('Edit Partner')}}"></i> &nbsp;
									</a>
									{{ Form::open(['route' => ['partners.destroy', Crypt::encrypt($partner->id)], 'method' => 'delete', 'class' => 'inline-form']) }}
										<button type="submit" ><i class="fa fa-times red-text" alt="{{_t('Delete Partner')}}"></i></button>
									{{ Form::close() }}
								</div>
							</div>
						</li>
					@endforeach
				</ul>
				<a href="{{ URL::route('partners.index') }}" class="waves-effect waves-light btn right">{{_t('View All Partners')}} &rarr;</a>
			</div>

			<div class="row scrollspy" id="locations" name="locations">
				<ul class="collection with-header">
					<li class="collection-header">
						<a href="{{ URL::route('locations.create') }}" class="waves-effect waves-light btn right add-new-button col s12 m6 l4"><i class="fa fa-plus left"></i>{{_t('Add New Location')}}</a>
						<h4>{{_t('Locations')}}</h4>
					</li>

					@foreach( $locations as $location )
						<li class="collection-item">
							<div>
								<strong>{{ $location->name }}</strong>
								<br /><small>({{ $location->capacity }} people)</small>
								<div class="secondary-content">
									<a href="{{ URL::route('locations.edit', ['location'=>$location->id]) }}">
										<i class="fa fa-pencil teal-text" alt="{{_t('Edit Location')}}"></i> &nbsp;
									</a>
									{{ Form::open(['route' => ['locations.destroy', Crypt::encrypt($location->id)], 'method' => 'delete', 'class' => 'inline-form']) }}
										<button type="submit" ><i class="fa fa-times red-text" alt="{{_t('Delete Location')}}"></i></button>
									{{ Form::close() }}
								</div>
							</div>
						</li>
					@endforeach
				</ul>
				<a href="{{ URL::route('locations.index') }}" class="waves-effect waves-light btn right">{{_t('View All Locations')}} &rarr;</a>
			</div>

			<div class="row scrollspy" id="news" name="news">
				<ul class="collection with-header">
					<li class="collection-header">
						<a href="{{ URL::route('news.create') }}" class="waves-effect waves-light btn right add-new-button col s12 m6 l4"><i class="fa fa-plus left"></i>{{_t('Add New News')}}</a>
						<h4>{{_t('News')}}</h4>
					</li>

					@foreach( $news as $new )
						<li class="collection-item">
							<div>
								<strong>{{ $new->title }}</strong>
								<br /><small>({{ strip_tags(str_limit($new->content, 150)) }})</small>
								<div class="secondary-content">
									<a href="{{ URL::route('news.show', ['news'=>$new->id]) }}">
										<i class="fa fa-eye teal-text" alt="View News"></i> &nbsp;
									</a>
									<a href="{{ URL::route('news.edit', ['news'=>$new->id]) }}">
										<i class="fa fa-pencil teal-text" alt="{{_t('Edit News')}}"></i> &nbsp;
									</a>

									{{ Form::open(['route' => ['news.destroy', Crypt::encrypt($new->id)], 'method' => 'delete', 'class' => 'inline-form']) }}
										<button type="submit" ><i class="fa fa-times red-text" alt="{{_t('Delete News')}}"></i></button>
									{{ Form::close() }}
								</div>
							</div>
						</li>
					@endforeach
				</ul>
				<a href="{{ URL::route('news.index') }}" class="waves-effect waves-light btn right">{{_t('View All News')}} &rarr;</a>
			</div>

			<div class="row scrollspy" id="media" name="media">
				<div class="row card white">
					<div class="card-content">
						<h4>{{_t('Approve Media for Frontpage')}}</h4>
						@foreach( $media as $row )
							<div class="row">
								@foreach( $row as $item )
									<div class="col s12 l4" id="{{ 'media_'.$item->id }}">
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

				<a href="{{ URL::route('media.unprocessed') }}" class="waves-effect waves-light btn right">{{_t('View All Unprocessed Media')}} &rarr;</a>
			</div>


			<div class="row scrollspy" id="staff" name="staff">
				<ul class="collection with-header">
					<li class="collection-header">
						<!-- <a href="#!" class="waves-effect waves-light btn right add-new-button col s12 m6 l4"><i class="fa fa-plus left"></i>{{_t('Add New Staff')}}</a> -->
						<h4>{{_t('Staff')}}</h4>
					</li>

					@foreach( $staffs as $staff )
						<li class="collection-item">
							<div>
								<strong>{{ $staff->name }}</strong>
								<br /><small>({{ str_limit($staff->bio, 150) }})</small>
								<a href="#!" class="secondary-content">
									<a href="{{URL::action('UserController@unsetUserStaff', $staff->id)}}"><i class="fa fa-times red-text"></i></a>
								</a>
							</div>
						</li>
					@endforeach
				</ul>
			</div>

		</div>
	</div>
</div>
@endsection
