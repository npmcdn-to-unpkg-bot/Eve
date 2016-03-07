</div>

<footer class="page-footer">
  <div class="footer-copyright">
    <div class="container">
    	&copy; {{ date('Y') }} {{_t('Copyright')}}
    </div>
  </div>
</footer>

	@if(!Auth::check())
		<div class="row modal-row">
			<div id="login-modal" class="col s12 m4 offset-m4 modal">
			    <div class="modal-content">
			        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat right">&times;</a>
			        <h3> {{_t('Log in')}}</h3>
			        @include('forms.login')
			    </div>
			</div>
		</div>
	@endif

	<div class="row modal-row">
		<div id="language-modal" class="col s12 m4 offset-m4 modal">
		    <div class="modal-content">
		        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat right">&times;</a>
		        <h3> {{_t('Language')}}</h3>
		        @include('forms.language')
		    </div>
		</div>
	</div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
    <script src="{{URL::to('/')}}/js/libraries.js"></script>
	<script type="text/javascript" src="{{ URL::to('/') }}/js/main.js"></script>
	@yield('extra-js')

	@if(session('message'))
		<script>Materialize.toast('{!! session('message') !!}', 3000);</script>
	@endif
	
	<!-- Side Nav activation in the footer because it's not being included from the main javascript file -->
	<script>
		$(document).ready(function(){
			$('.button-collapse').sideNav();
		});
	</script>

</body>
</html>
