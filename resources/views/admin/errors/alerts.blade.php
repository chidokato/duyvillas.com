@if(count($errors) > 0)
	@foreach($errors->all() as $err)
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert">×</button>
			<strong>{{$err}} !</strong>
		</div>
	@endforeach
@endif
@if(session('Alerts'))
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>
		{{session('Alerts')}} !
		</strong>
	</div>
@endif
@if(session('Errors'))
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>
		{{session('Errors')}} !
		</strong>
	</div>
@endif
@if(session('Success'))
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>
		{{session('Success')}} !
		</strong>
	</div>
@endif

