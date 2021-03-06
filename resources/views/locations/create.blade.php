@extends('layouts.app')

@section('body-class') locations @endsection
@section('title') {{_t('Creating a location')}} @endsection

@section('extra-js')
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_API_KEY') }}&libraries=places"></script>
	<script type="text/javascript">
			initEvents();
	</script>
@endsection
@section('content')

	<div class="row">
		<div class="col s12 m8 offset-m2 l6 offset-l3">
			<h2>{{_t('Add New Location:')}}</h2>
			{!! Form::open( ['route' => 'locations.store', 'files' => true] ) !!}
				<div class="row">
					<div class="input-field col m5 s12">
						{!! Form::label('name',_t('Location Title'))!!}
						{!! Form::text('name')	!!}
					</div>
				</div>
				<div class="row">
					<div class="input-field col m5 s12">
						{!! Form::label('latitude',_t('Latitude'))	!!}
						{!! Form::text('latitude','53.2812223')	!!}
					</div>
					<div class="input-field col m5 s12">
						{!! Form::label('longitude',_t('Longitude'))	!!}
						{!! Form::text('longitude','-7.3740124')	!!}
					</div>
					<div class="input-field col m2 s12">
						{!! Form::label('capacity',_t('Capacity'))	!!}
						{!! Form::number('capacity')	!!}
					</div>
				</div>

				<div class="row">
					<div class="input-field col s12">
						{!! Form::label('move-marker', 'Search map')!!}
						{!! Form::text('move-marker')!!}
					</div>
					<div id="map" class="row col s12 center-align" style="width: 65%; height: 400px;"></div>
				</div>

				<div class="row">
					<div class="file-field input-field col s12">
						<div class="btn">
							<span>{{_t('Add Image')}}</span>
							{!! Form::file('featured_image') !!}
						</div>
						<div class="file-path-wrapper">
							<input class="file-path validate" type="text">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col s2 right">
						<div class='form-group'>
							{!! Form::submit( _t('Create Location &rarr;'), ['class' => 'btn btn-primary form-control', 'id' => 'news-button']) !!}
						</div>
					</div>
				</div>
			{!! Form::close() !!}
		</div>
	</div>

@endsection
