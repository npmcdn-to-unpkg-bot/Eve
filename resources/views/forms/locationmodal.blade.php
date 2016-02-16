<div id="locationForm" class="modal bottom-sheet">
	<div class="modal-content">
		<h4>Create New Location</h4>
		<ul id="location-errors"></ul>
		{!! Form::open( ['route' => 'events.store', 'files' => true] ) !!}
		<div class="row">
			<div class="input-field col m6 s12">
				{!! Form::label('name','Location Name')	!!}
				{!! Form::text('name')	!!}
			</div>
			<div class="input-field col m6 s12">
				{!! Form::label('capacity','Location Capacity')	!!}
				{!! Form::number('capacity') !!}
			</div>
			<div class="input-field col m6 s12">
				{!! Form::label('coordinates','Location Coordinates')	!!}
				{!! Form::text('coordinates') !!}
			</div>
			<div class="file-field input-field col m6 s12">
				<div class="btn">
					<span>Feature Image</span>
					{!! Form::file('featured_image') !!}
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text">
				</div>
			</div>
		</div>
		{!! Form::close() !!}
	</div>
	<div class="modal-footer">
		<a href="#!" class="orange-text modal-action waves-effect waves-green btn-flat" onClick="createLocation()">Create</a>
		<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat" onClick="$('#location-select').val('');$('#location-select').material_select();">Cancel</a>
	</div>
</div>