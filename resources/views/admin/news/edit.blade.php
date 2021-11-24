@extends('admin.layout.index')

@section('news') class="active" @endsection

@section('content')

<form action="admin/news/edit/{{$data->id}}" method="POST" enctype="multipart/form-data">
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
                        <input value="{{$data->name}}" name='name' type="text" placeholder="Name ..." class="form-control ">
	                </div>
		        	<div class="col-md-12">
			            <label>Detail</label>
	            		<textarea rows="3" name="detail" class="form-control">{{$data->detail}}</textarea>

	            		<label>Content</label>
	            		<textarea name="content" class="form-control" id="ckeditor">{{$data->content}}</textarea>
		        	</div>
              	</div>
			</div>
		</div>
		@include('admin.layout.seo-edit')
	</div>

	<div class="col-md-3 col-sm-3 col-xs-3">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
	                <div class="col-md-12">
	                    <label>Category</label>
                        <select name='cat' class="form-control">
                        	@foreach($category as $cat)
							<option <?php if($cat->id == $data->cat_id){echo "selected";} ?> value="{{$cat->id}}">{{$cat->name}}</option>
							@endforeach
					  	</select>
	                </div>
					<div class="col-md-12">
	                    <label>Product</label>
                        <select required name='p_id' class="form-control" id='select2'>
                        	<option value="">-- Select --</option>
							@foreach($product as $val)
                        	<option <?php if($val->id == $data->p_id){echo 'selected';} ?> value="{{$val->id}}">{{$val->name}}</option>
							@endforeach
					  	</select>
	                </div>
              	</div>
			</div>
		</div>
		
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
								<img class="file-upload-image" src="data/news/280-175/{{$data->img}}" />
								<!-- <div class="image-title-wrap">
									<button type="button" onclick="removeUpload()" class="remove-image">Remove </button>
								</div> -->
							</div>
						</div>
		        	</div>
              	</div>
			</div>
		</div>
	</div>
</div>
</form>

<script>
$(document).ready(function(){
    $("input#saleof").click(function(){
        $("#price_old").toggleClass("display");
    });
});
</script>
<!-- add img -->
<script>
$(document).ready(function(){
    $("button#addimg").click(function(){
        var img = $(this).parents('#select-img').find('input[name="img"]').val();
        var pid = {{$data->id}}
        if (img == '') { alert('select iamges'); return false; };
        // alert(pid);
        $.ajax({
	        url:  'admin/ajax/addimg/'+pid,
	        type: 'GET',
	        cache: false,
	        data: {"pid":pid,"img":img},
	        success: function(data){
	            $('#select-img').html(data);
	        }
	    });
    });
});
</script>
<!-- add img -->
<!-- del img -->
<script>
$(document).ready(function(){
    $("button#del").click(function(){
        var id_img = $(this).parents('#news_image').find('input[name="id_img"]').val();
        var pid = {{$data->id}}
        // alert(id_img);
        $.ajax({
	        url:  'admin/ajax/delimg/'+id_img,
	        type: 'GET',
	        cache: false,
	        data: {"pid":pid, "id_img":id_img},
	        success: function(data){
	            $('#select-img').html(data);
	        }
	    });
    });
});
</script>

@endsection