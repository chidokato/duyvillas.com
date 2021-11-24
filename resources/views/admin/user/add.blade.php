@extends('admin.layout.index')

@section('content')

<form action="admin/user/add" method="POST" enctype="multipart/form-data">
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
                add user
            </div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
	                    <label>Tên người dùng</label>
                        <input name='name' type="text" placeholder="Name ..." class="form-control ">
	                </div>
	                <div class="col-md-12">
	                    <label>Email</label>
                        <input name='email' type="email" placeholder="Email ..." class="form-control">
	                </div>
	                <div class="col-md-12">
	                    <label>Password</label>
                        <input name='password' type="Password" placeholder="Password ..." class="form-control">
	                </div>
	                <div class="col-md-12">
	                    <label>Password</label>
                        <input name='passwordagain' type="Password" placeholder="Password ..." class="form-control">
	                </div>
	                <div class="col-md-12">
	                    <label>Permission</label>
                        <select name='permission' class="form-control">
							<option value="0">superadmin</option>
							<option value="1">admin</option>
							<option value="2">author</option>
							<option value="3">member</option>
					  	</select>
	                </div>
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
							<div class="file-upload-content">
								<img class="file-upload-image" src="#" />
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
@endsection