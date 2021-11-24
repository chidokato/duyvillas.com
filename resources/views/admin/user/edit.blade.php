@extends('admin.layout.index')

@section('content')

<form action="admin/user/edit/{{$user->id}}" method="POST" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{csrf_token()}}" />

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            <button type="submit" class="btn btn-primary btn-sm"><i class='fa fa-save'></i> SAVE</button>
        </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
@include('admin.errors.alerts')
<!-- /.row -->

<div class="row">
	<div class="col-md-9 col-sm-9 col-xs-9">
		<div class="panel panel-default">
            <div class="panel-heading">
                edit user
            </div>
			<div class="panel-body">
                <label class="control-label">Tên người dùng</label>
          		<input value="{{$user->name}}" name='name' type="text" placeholder="Name ..." class="form-control">
				
				<label class="control-label">Email</label>
			  	<input required value="{{$user->email}}" name='email' type="email" placeholder="Email ..." class="form-control">
					
				<label class="control-label"></label>
			  	<input type="checkbox" id='changepassword' name="changepassword" />  Edit password

				<label class="control-label">Password</label>
			  	<input disabled name='password' type="Password" placeholder="Password ..." class="form-control pass">

				<label class="control-label">Password</label>
			  	<input disabled name='passwordagain' type="Password" placeholder="Password ..." class="form-control pass">

				<label class="control-label">Permission</label>
			  	<select name='permission' class="form-control">
					<option <?php if ($user->permission == 0) { echo "selected"; } ?> value="0">superadmin</option>
					<option <?php if ($user->permission == 1) { echo "selected"; } ?> value="1">admin</option>
					<option <?php if ($user->permission == 2) { echo "selected"; } ?> value="2">author</option>
					<option <?php if ($user->permission == 3) { echo "selected"; } ?> value="3">member</option>
			  	</select>
			</div>
		</div>
		<div class="panel panel-default">
            <div class="panel-heading">
                Thông tin phụ
            </div>
			<div class="panel-body">
				<div class="form-group">
            		<label class="control-label">Số điện thoại</label>
              		<input value="{{$user->phone}}" name='phone' type="text" placeholder="phone ..." class="form-control">

              		<label class="control-label">Link facebook</label>
              		<input value="{{$user->facebook}}" name='facebook' type="text" placeholder="facebook ..." class="form-control">
              	</div>
          	</div>
      	</div>
	</div>
	<div class="col-md-3 col-sm-3 col-xs-3">
    	<div class="panel panel-default">
            <div class="panel-body">
            	<div class="row">
            		<div class="col-lg-12">
                    	<div class="file-upload">
                            <button class="btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>
                            <div class="image-upload-wrap">
                                <input name="img" class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                            </div>
                            <div class="file-upload-content" style="display: block;">
                                <img class="file-upload-image" src="data/themes/{{$user->avatar}}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
	$(document).ready(function(){
		$('#changepassword').change(function(){
			if ($(this).is(":checked")) {
				$(".pass").removeAttr('disabled');
			}
			else
			{
				$(".pass").attr('disabled','');
			}
		});
	});
</script>		

@endsection

