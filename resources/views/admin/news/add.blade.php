@extends('admin.layout.index')

@section('news') class="active" @endsection

@section('content')

<form action="admin/news/add" method="POST" enctype="multipart/form-data">
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
            	Add news
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
	                    <label>Name</label>
                        <input required name='name' type="text" placeholder="Name ..." class="form-control ">
	                </div>
		        	<div class="col-md-12">
		        		<label>Detail</label>
	            		<textarea rows="3" name="detail" class="form-control"></textarea>

			            <label>Content</label>
	            		<textarea name="content" class="form-control" id="ckeditor"></textarea>
		        	</div>
              	</div>
			</div>
		</div>
		@include('admin.layout.seo-add')
	</div>

	<div class="col-md-3 col-sm-3 col-xs-3">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
	                    <label>Category</label>
                        <select required name='cat' class="form-control">
                        	<option value="">-- Select --</option>
                        	<?php addeditcat ($category,0,$str='',old('parent')); ?>
					  	</select>
	                </div>
					<div class="col-md-12">
	                    <label>Product</label>
                        <select required name='p_id' class="form-control" id='select2'>
                        	<option value="">-- Select --</option>
							@foreach($product as $val)
                        	<option value="{{$val->id}}">{{$val->name}}</option>
							@endforeach
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
	                <div class="col-md-12">
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

@section('function')
<?php 
	function addeditcat ($data, $parent=0, $str='',$select=0)
	{
		foreach ($data as $value) {
			if ($value['parent'] == $parent) {
				if($select != 0 && $value['id'] == $select )
				{ ?>
					<option value="<?php echo $value['id']; ?>" selected> <?php echo $str.$value['name']; ?> </option>
				<?php } else { ?>
					<option value="<?php echo $value['id']; ?>" > <?php echo $str.$value['name']; ?> </option>
				<?php }
				
				addeditcat ($data, $value['id'], $str.'__',$select);
			}
		}
	}
?>
@endsection




