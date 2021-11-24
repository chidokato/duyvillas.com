@extends('admin.layout.index')

@section('setting') class="active" @endsection

@section('content')

<form action="admin/setting/edit/{{$data['id']}}" method="POST" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{csrf_token()}}" />

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <button type="submit" class="btn btn-primary btn-sm"><i class='fa fa-save'></i> SAVE</button>
        </h1>
    </div>
</div>
@include('admin.errors.alerts')

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Setting
            </div>
            <div class="panel-body">
            	<div class="row">
					<div class="col-md-12">
						<label >Name</label>
					  	<input value="{!! old('name'), isset($data['name'])?$data['name']:null !!}" name='name' type="text" placeholder="Name" class="form-control">
					
						<label >Address</label>
					  	<input value="{!! old('address'), isset($data['address'])?$data['address']:null !!}" name='address' type="text" placeholder="address" class="form-control">
					
						<label >Email</label>
					  	<input value="{!! old('email'), isset($data['email'])?$data['email']:null !!}" name='email' type="text" placeholder="email" class="form-control">
					</div>
					<div class="col-md-6">
						<label >Hotline</label>
					  	<input value="{!! old('hotline'), isset($data['hotline'])?$data['hotline']:null !!}" name='hotline' type="text" placeholder="hotline" class="form-control">
					</div>
					<div class="col-md-6">
						<label >Tel</label>
					  	<input value="{!! old('hotline1'), isset($data['hotline1'])?$data['hotline1']:null !!}" name='hotline1' type="text" placeholder="Tel" class="form-control">
					</div>
					<div class="col-md-6">
						<label >Analytics</label>
					  	<input value="{!! old('analytics'), isset($data['analytics'])?$data['analytics']:null !!}" name='analytics' type="text" placeholder="analytics" class="form-control">
					</div>
					<div class="col-md-6">
						<label >Fb app id </label>
					  	<input value="{!! old('fbapp'), isset($data['fbapp'])?$data['fbapp']:null !!}" name='fbapp' type="text" placeholder="fb app id" class="form-control">
					</div>
					<div class="col-md-6">
						<label>Favicon ( <img src="data/themes/{{$data['img']}}"> )</label>
						<input type="file" name="img">
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="col-md-6">
		<div class="panel panel-default">
            <div class="panel-heading"> Social </div>
            <div class="panel-body">
            	<div class="row">
					<div class="col-md-12">
						<label >Facebook</label>
					  	<input value="{!! old('facebook'), isset($data['facebook'])?$data['facebook']:null !!}" name='facebook' type="text" placeholder="facebook" class="form-control">
					
						<label >google plus</label>
					  	<input value="{!! old('googleplus'), isset($data['googleplus'])?$data['googleplus']:null !!}" name='googleplus' type="text" placeholder="googleplus" class="form-control">
					
						<label >youtube</label>
					  	<input value="{!! old('youtube'), isset($data['youtube'])?$data['youtube']:null !!}" name='youtube' type="text" placeholder="youtube" class="form-control">
					
						<label >twitter</label>
					  	<input value="{!! old('twitter'), isset($data['twitter'])?$data['twitter']:null !!}" name='twitter' type="text" placeholder="twitter" class="form-control">

						<label >Google Maps</label>
						<textarea rows="3" name="maps" class="form-control">{!! old('maps'), isset($data['maps'])?$data['maps']:null !!}</textarea>

					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		@include('admin.layout.seo-edit')
	</div>

	<!-- <div class="col-md-12">
		<div class="panel panel-default">
            <div class="panel-heading"> Hướng dẫn mua hàng </div>
            <div class="panel-body">
			  	<textarea class="form-control form-control ckeditor" id="message" name="sidebar" rows="10" placeholder="sidebar">{!! $data['sidebar'] !!}</textarea>
			</div>
		</div>
	</div> -->
	<div class="col-md-6">
		<div class="panel panel-default">
            <div class="panel-heading"> Code header </div>
            <div class="panel-body">
			  	<textarea class="form-control form-control" id="message" name="codeheader" rows="10" placeholder="Code header">{!! $data['codeheader'] !!}</textarea>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
            <div class="panel-heading"> Code body </div>
            <div class="panel-body">
			  	<textarea class="form-control form-control" id="message" name="codebody" rows="10" placeholder="Code body">{!! $data['codebody'] !!}</textarea>
			</div>
		</div>
	</div>
</div>
</form>

@endsection