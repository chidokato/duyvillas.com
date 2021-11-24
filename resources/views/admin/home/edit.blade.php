@extends('admin.layout.index')

@section('home') class="active" @endsection

@section('content')

<form action="admin/home/edit/{{$home->id}}" method="POST" enctype="multipart/form-data">
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
                add home
            </div>
            <div class="panel-body">
                <div class="row">
					<div class="col-md-6">
	                    <label>Name</label>
                        <input value="{{$home->name}}" name='name' type="text" placeholder="Tên home ..." class="form-control" />
	                </div>
	                <div class="col-md-6">
	                    <label>Icon</label>
                        <input value="{{$home->icon}}" name='icon' type="text" placeholder="Icon ..." class="form-control" />
	                </div>
	                <div class="col-md-6">
			            <label>Sort by</label>
	            		<select name="sort_by" class="select2_group form-control" id="sort_by">
					  		<option value="{{$home->sort_by}}">
					  		@if($home->sort_by ==1) Product @endif
					  		@if($home->sort_by ==2) News @endif
					  		@if($home->sort_by ==3) Pages @endif
					  		</option>
                      	</select>
                  	</div>
                  	<div class="col-md-6">
			            <label>Parent</label>
	            		<select id="parent" name="parent" class="select2_group form-control">
					  		<option value="0">-- ROOT --</option>
					  		<?php addedithome ($datahome,0,$str='',$home['parent']); ?>
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
		            		<textarea name="content" class="form-control ckeditor">{{$home->content}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
        	<div class="panel-heading">
                SEO option
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                    	<div class="form-group">
                            <label>Title</label>
                            <input value="{{$home->title}}" name='title' type="text" placeholder="Title ..." class="form-control ">
                        </div>
                    </div>
                    <div class="col-lg-12">
                    	<div class="form-group">
                            <label>Description</label>
                            <input value="{{$home->description}}" name='description' type="text" placeholder="Description ..." class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-12">
                    	<div class="form-group">
                            <label>keywords</label>
                            <input value="{{$home->keywords}}" name='keywords' type="text" placeholder="keywords ..." class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-12">
                    	<div class="form-group">
                            <label>Robots</label>
                            <select name='robot' class="form-control">
								<option <?php if($home->robot == 'index, follow'){echo "selected";} ?> value="index, follow">index, follow</option>
								<option <?php if($home->robot == 'noindex, nofollow'){echo "selected";} ?> value="noindex, nofollow">noindex, nofollow</option>
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
	                <div class="col-md-12">
						<div class="file-upload">
							<button class="btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>
							<div class="image-upload-wrap">
								<input name="img" class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
							</div>
							<div class="file-upload-content" style="display: block;">
								<img class="file-upload-image" src="data/home/thumbnail/{{$home->img}}" />
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
		function addedithome ($data, $parent=0, $str='',$select=0)
{
	foreach ($data as $value) {
		if ($value['parent'] == $parent) {
			if($select != 0 && $value['id'] == $select )
			{ ?>
				<option value="<?php echo $value['id']; ?>" selected> <?php echo $str.$value['name']; ?> </option>
			<?php } else { ?>
				<option value="<?php echo $value['id']; ?>" > <?php echo $str.$value['name']; ?> </option>
			<?php }
			
			addedithome ($data, $value['id'], $str.'---',$select);
		}
	}
}
	?>
@endsection