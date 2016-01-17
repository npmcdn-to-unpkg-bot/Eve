@if ( isset($errors) )
	@foreach ($errors->all() as $message)
		{{$message}}
	@endforeach
@endif

{!! Form::open( array('url' => 'login', 'method' => 'post', 'class' => 'row col s12') ) 		!!}

<div class="row">
	<div class="input-field">
		{!! Form::label('email','Email')									!!}
		{!! Form::text('email', null,array('class' => 'twelve columns'))	!!}
	</div>
</div>

<div class="row">
	<div class="input-field">
		{!! Form::label('password','Password')								!!}
		{!! Form::password('password',array('class' => 'twelve columns'))	!!}
	</div>
</div>

<button class="btn waves-effect waves-light" type="submit" name="action">Login
	<i class="mdi-content-send right"></i>
</button>

{!! Form::close() 													!!}

<p>
	<a href="{{ URL::to('/password/email') }}"> Forgot password?</a>
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="{{ URL::to('register') }}"> Want to register?</a>
</p>