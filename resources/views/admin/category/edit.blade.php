@extends('admin.layout.index')

@section('category') class="active" @endsection

@section('content')

<form action="admin/category/edit/{{$data->id}}" method="POST" enctype="multipart/form-data">
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
    <div class="col-lg-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                add category
            </div>
            <div class="panel-body">
                <div class="row">
					<div class="col-md-6">
	                    <label>Name</label>
                        <input required value="{{$data->name}}" name='name' type="text" placeholder="Tên Category ..." class="form-control" />
	                </div>
	                <div class="col-md-6">
	                    <label>Icon</label>
                        <input value="{{$data->icon}}" name='icon' type="text" placeholder="Icon ..." class="form-control" />
	                </div>
	                <div class="col-md-6">
			            <label>Slug</label>
	            		<input required value="{{$data->slug}}" name='slug' type="text" placeholder="Slug" class="form-control" />
                  	</div>
                  	<div class="col-md-6">
			            <label>Parent</label>
	            		<select id="parent" name="parent" class="select2_group form-control">
					  		<option value="0">-- ROOT --</option>
					  		<?php addeditcategory ($datacategory,0,$str='',$data['parent']); ?>
                      	</select>
                  	</div>
              	</div>
			</div>
		</div>

		<div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                    	<div class="form-group">
                            <label>Content</label>
		            		<textarea name="content" class="form-control" id="ckeditor">{{$data->content}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.layout.seo-edit')
	</div>
	<div class="col-lg-3">
		<!-- <div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
	                <div class="col-md-12">
                        <div class="checkbox">
                            <label>
                                <input <?php if($data->status == 'true'){echo "checked";} ?> name="status" type="checkbox" value="true">Status
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input <?php if($data->hot == 'true'){echo "checked";} ?> name="hot" type="checkbox" value="true">Hot
                            </label>
                        </div>
		        	</div>
              	</div>
			</div>
		</div> -->
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="file-upload">
                            <button class="btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>
                            <div class="image-upload-wrap">
                                <input name="img" class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
                            </div>
                            <div class="file-upload-content" style="display: block;">
                                <img class="file-upload-image" src="data/category/thumbnail/{{$data->img}}" />
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

@section('function')
	<?php 
		function addeditcategory ($data, $parent=0, $str='',$select=0)
{
	foreach ($data as $value) {
		if ($value['parent'] == $parent) {
			if($select != 0 && $value['id'] == $select )
			{ ?>
				<option value="<?php echo $value['id']; ?>" selected> <?php echo $str.$value['name']; ?> </option>
			<?php } else { ?>
				<option value="<?php echo $value['id']; ?>" > <?php echo $str.$value['name']; ?> </option>
			<?php }
			
			addeditcategory ($data, $value['id'], $str.'---',$select);
		}
	}
}
	?>
@endsection