@extends('admin.layout.index')

@section('category') class="active" @endsection

@section('content')

<form action="admin/category/add" method="POST" enctype="multipart/form-data">
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
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Name</label>
                            <input  name='name' type="text" placeholder="Category ..." class="form-control" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Icon</label>
                            <input  name='icon' type="text" placeholder="Icon ..." class="form-control" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Sort by</label>
		            		<select name="sort_by" class="select2_group form-control" id="sort_by">
						  		<option value="1">Product</option>
						  		<option value="2">News</option>
						  		<option value="3">pages</option>
                          	</select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Parent</label>
		            		<select id="parent" name="parent" class="select2_group form-control">
						  		<option value="0">-- ROOT --</option>
					  			<?php addeditcat ($data,0,$str='',old('parent')); ?>
                          	</select>
                        </div>
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
		            		<textarea name="content" class="form-control ckeditor"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                    	<div class="form-group">
                            <label>Title</label>
                            <input name='title' type="text" placeholder="Name ..." class="form-control ">
                        </div>
                    </div>
                    <div class="col-lg-12">
                    	<div class="form-group">
                            <label>Description</label>
                            <input name='description' type="text" placeholder="Description ..." class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-12">
                    	<div class="form-group">
                            <label>keywords</label>
                            <input name='keywords' type="text" placeholder="keywords ..." class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-12">
                    	<div class="form-group">
                            <label>Robots</label>
                            <select name='robot' class="form-control">
								<option value="index, follow">index, follow</option>
								<option value="noindex, nofollow">noindex, nofollow</option>
						  	</select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
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

<script type="text/javascript">
    
</script>

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
				
				addeditcat ($data, $value['id'], $str.'___',$select);
			}
		}
	}
?>
@endsection

