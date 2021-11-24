@extends('admin.layout.index')

@section('themes') class="active" @endsection

@section('content')
<form action="admin/themes/edit/{{$themes->id}}" method="POST" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{csrf_token()}}" />
<div class="row">
    <div class="col-md-12">
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
				Add Product
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
	                    <label>Name</label>
                        <input value="{{$themes->name}}" required name='name' type="text" placeholder="Name ..." class="form-control ">
	                </div>
	                <div class="col-md-12">
	                    <label>Link</label>
                        <input value="{{$themes->link}}" name='link' type="text" placeholder="Link ..." class="form-control ">
	                </div>
	                <div class="col-md-12">
			            <label>Content</label>
	            		<textarea name="content" rows="4" class="form-control">{{$themes->content}}</textarea>
		        	</div>
              	</div>
			</div>
		</div>
	</div>

	

	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
	                <div class="col-md-12">
	                	<!--div class="form-group">
                            <div class="radio">
                                <label style="margin-right: 20px;">
                                    <input <?php if($themes->note == 'logo'){echo "checked";} ?> type="radio" name="note" value="logo" checked="">Logo
                                </label>
                                <label style="margin-right: 20px;">
                                    <input <?php if($themes->note == 'slide'){echo "checked";} ?> type="radio" name="note" value="slide">Slide
                                </label>
								<label style="margin-right: 20px;">
                                    <input <?php if($themes->note == 'slide'){echo "checked";} ?> type="radio" name="note" value="banner">Banner
                                </label>
                                <label>
                                    <input <?php if($themes->note == 'logo-doitac'){echo "checked";} ?> type="radio" name="note" value="logo-doitac">Logo đối tác
                                </label>
                            </div>
                        </div-->
						<div class="file-upload">
							<button class="btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>
							<div class="image-upload-wrap">
								<input name="img" class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
							</div>
							<div class="file-upload-content" style="display: block;">
								<img class="file-upload-image" src="data/themes/{{$themes->img}}" />
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

