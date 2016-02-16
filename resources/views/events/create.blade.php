@extends('layouts.app')

@section('body-class') create-event @endsection

@section('title') Create an Event @endsection


@section('extra-css')
	<link rel="stylesheet" type="text/css" href="{{ URL::to('/') . '/css/clockpicker.css' }}">
@endsection

@section('extra-js')
	<script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.clockpicker').clockpicker({
				placement: 'bottom',
			    align: 'left',
			    donetext: 'Done'
			});

			tinymce.init({
			  selector: 'div.editable',
			  inline: true,
			  plugins: [
			    'advlist autolink lists link image charmap print preview anchor',
			    'searchreplace visualblocks code fullscreen',
			    'insertdatetime media table contextmenu paste'
			  ],
			  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image'
			});
		});
	</script>
@endsection

@section('content')


<div class="row">
	<div class="col m8 offset-m2">
		<div class="row">
			<div class="col s12">
				<h1>Create a New Event</h1>
			</div>
		</div>

		</hr>

		{!! Form::open( ['route' => 'events.store', 'files' => true] ) !!}

			<div class="row">
				<div class="input-field col m6 s12">
					{!! Form::label('title','Event Title')	!!}
					{!! Form::text('title')	!!}
				</div>
				<div class="input-field col m6 s12">
					{!! Form::label('tagline','Event Tagline')	!!}
					{!! Form::text('tagline') !!}
				</div>
				<div class="input-field col m12 s12">
					<h5>Description:</h5>
					<div class="editable content" id="description">
					  <p>
					    Start typing your description here!
					  </p>
					</div>
				</div>
			</div>

			<div class="row">

				<div class="col m6 s6">
					<label for="start_date">Start Date</label>
					<input name="start_date" id="start_date" type="date" value="Start Date" class="datepicker">
				</div>

				<div class="col m6 s6">
					<label for="input_enddate">End Date</label>
					<input name="end_date" id="input_enddate" type="date" value="End Date" class="datepicker">
				</div>
				
				<div class="input-field col m6 s6">
					{!! Form::label('price','Price') !!}
					{!! Form::number('price', '5.00', ['step' => 0.01]) !!}
				</div>

				<div class="file-field input-field col s12 m6">
					<div class="btn">
						<span>Feature Image</span>
						{!! Form::file('featured_image') !!}
					</div>
					<div class="file-path-wrapper">
						<input class="file-path validate" type="text">
					</div>
				</div>

			</div>

	      	<div class="row">
		      	<div class="input-field col s6">
		    		<select name="location_id" id="location-select" onChange="if(this.value==-1){$('#locationForm').openModal();}">
		      			<option value="" disabled selected>Choose location</option>
						@foreach($locations as $location)
							<option value="{{$location->id}}">{{$location->name}}</option>
						@endforeach
						<option value="-1">Create New Location</option>
		    		</select>
		    		<label>Location Select</label>
		  		</div>
		  		<div class="input-field col s6">
		    		<select multiple name="partner_id[]" id="partner-select">
		      			<option value="" disabled selected>Choose partner</option>
						@foreach($partners as $partner)
							<option value="{{$partner->id}}">{{$partner->name}}</option>
						@endforeach
		    		</select>
		    		<label>Partner Select</label>
		  		</div>
			</div>

			<div class="row">
				<div class="col s4">
					<label for="start_time">Start Time</label>
					<div id="start_time" class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
					    <input name="start_time" type="text" class="form-control" value="08:30">
					    <span class="input-group-addon">
					        <span class="glyphicon glyphicon-time"></span>
					    </span>
					</div>
				</div>
				<div class="col s4">
					<label for="end_time">End Time</label>
					<div id="end_time" class="input-group clockpicker" data-placement="left" data-align="top" data-autoclose="true">
					    <input name="end_time" type="text" class="form-control" value="16:00">
					    <span class="input-group-addon">
					        <span class="glyphicon glyphicon-time"></span>
					    </span>
					</div>
				</div>
			</div>

				<!-- <div class="input-field col m6 s12">
					{!! Form::label('start_datetime', 'Start') !!}
					{!! Form::text('start_datetime' ) !!}
				</div>

				<div class="input-field col m6 s12">
					{!! Form::label('end_datetime', 'End') !!}
					{!! Form::text('end_datetime' ) !!}
				</div> -->

			<!-- <button class="btn waves-effect waves-light right" type="button" name="action" onclick='createEvent();'>Next
				<i class="mdi-content-send right"></i>
			</button> -->
			<div class="row">
				<div class="col s2">
					<a href="{{ action('EventsController@index') }}" class="waves-effect waves-light btn">Cancel</a>
				</div>
				<div class="col s2 push-s8">
					<div class='form-group'>
					{!! Form::submit('Create Event', ['class' => 'btn btn-primary form-control']) !!}
					</div>
				</div>
			</div>
		{!! Form::close() !!}
	</div>
</div>

@include("forms.locationmodal")

@endsection
