@extends('admin.layout.index')

@section('product') class="active" @endsection

@section('content')
<?php use App\product_images; ?>
<form action="admin/product/edit/{{$data->id}}" method="POST" enctype="multipart/form-data">
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
                Thông tin chi tiết
            </div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
	                    <label>Tên dự án</label>
                        <input value="{{$data->name}}" required name='name' type="text" placeholder="Name ..." class="form-control ">
	               	</div>
	               	<div class="col-md-3">
	               		<label>Danh mục</label>
	                    <select required name='cat' class="form-control">
	                    	<?php addeditcat ($category,0, $str='',$data['cat_id']) ?>
					  	</select>
				  	</div>
				  	<div class="col-md-3">
	                    <label>Giá</label>
                        <input value="{{$data->price}}" name='price' type="text" placeholder="Price ..." class="form-control">
	                </div>
				  	<div class="col-md-6">
	                    <label>Địa chỉ</label>
                        <input value="{{$data->address}}" name='address' type="text" placeholder="Address ..." class="form-control ">
	               	</div>
				  	<div class="col-md-3">
	                    <label>Tỉnh/thành</label>
                        <select name='city' class="form-control" id="city">
                        	<option value="">--Tỉnh/Thành--</option>
                        	@foreach($city as $city)
							<option <?php if($city->id == $data->district->city_id){echo "selected";} ?> value="{{$city->id}}">{{$city->name}}</option>
							@endforeach
					  	</select>
	                </div>
	                <div class="col-md-3">
	                    <label>Quận/huyện</label>
                        <select required name='dis' class="form-control" id="dis">
                        	@foreach($district as $dis)
							<option <?php if($dis->id == $data->dis_id){echo "selected";} ?> value="{{$dis->id}}">{{$dis->name}}</option>
							@endforeach
					  	</select>
	                </div>
              	</div>
			</div>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">
                Nội dung chính
            </div>
			<div class="panel-body">
				<!-- Nav tabs -->
                <ul class="nav nav-tabs">
                    @for ($i = 1; $i < 8; $i++)
                    <li @if($i=='1') class="active" @endif >
                    	<a href="#Section{{$i}}" data-toggle="tab">
                    		@if($i=='1') Chi tiết dự án @endif
                    		@if($i=='2') Vị trí @endif
                    		@if($i=='3') Tiện ích @endif
                    		@if($i=='4') Mặt bằng @endif
                    		@if($i=='5') Nội thất @endif
                    		@if($i=='6') Tiến độ @endif
                    		@if($i=='7') Chính sách @endif
                    	</a>
                    </li>
                    @endfor
                    <li>
                    	<a href="#Section8" data-toggle="tab">Mô tả</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    @for ($i = 1; $i < 8; $i++)
                    <div class="tab-pane fade in @if($i=='1') active @endif " id="Section{{$i}}">
                        <div class="row">
							<div class="col-md-12">
			                    <label>Tiêu đề</label>
		                        <input value="<?php echo $data['heading'.$i]; ?>" name='heading{{$i}}' type="text" placeholder="Heading ..." class="form-control ">
			                </div>
				        	<div class="col-md-12">
					            <!-- <label>Nội dung</label> -->
			            		<textarea name="content{{$i}}" class="form-control" id="ckeditor{{$i}}"><?php echo $data['content'.$i]; ?></textarea>
				        	</div>
		              	</div>
                    </div>
                    @endfor
                    <div class="tab-pane fade in" id="Section8">
                        <div class="row">
				        	<div class="col-md-12">
					            <!-- <label>Nội dung</label> -->
			            		<textarea name="detail" class="form-control" id="ckeditor">{!!$data->detail!!}</textarea>
				        	</div>
		              	</div>
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
						<div class="file-upload">
							<button class="btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Thêm ảnh đại diện</button>
							<div class="image-upload-wrap">
								<input name="img" class="file-upload-input" type='file' onchange="readURL(this);" accept="image/*" />
							</div>
							<div class="file-upload-content" style="display: block;">
								<img class="file-upload-image" src="data/product/thumbnail/{{$data->img}}" />
							</div>
						</div>
		        	</div>
              	</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="row">
		        	<div class="col-md-12">
		        		<div class="form-wrapper">
						    <div class="form-group add-img">
						    	<a href="javascript:void(0)" class="add_button">
						            <img src="admin_asset/dist/img/add-icon.png" />
						        </a>
						        <input type="file" name="imgdetail[]" /> 
						    </div>
						</div>
		        	</div>
		        	<?php $product_images = product_images::where('p_id',$data->id)->where('p_note',0)->orderBy('id','desc')->get(); ?>
		        	<div id="imgdetail">
		        		@foreach($product_images as $key => $product_images)
			        	<div class="col-md-6 detail-img">
			        		<input type="hidden" name="id" value="{{$product_images->id}}" />
			        		<img style="height: 65px;" src="data/product/detail/{{$product_images->img}}">
			        		<input type="button" id="del" value="xóa" />
			        	</div>
			        	@endforeach
		        	</div>
              	</div>
			</div>
		</div>
	</div>
</div>
</form>

<style type="text/css">
	#cke_1_contents {
	    height: 200px !important;
	}
	.add-img input{
		width: 90%;
    	display: initial;
	}
	.detail-img{position: relative;}
	.detail-img img{width: 100%; object-fit: cover;border: 1px solid #ddd;margin-top: 10px;}
	.detail-img input{
	    position: absolute;
	    top: 10px;
	    right: 15px;
	    border: none;
	    background-color: red;
	    color: #fff;
	}
</style>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        
        var fieldHTML = '<div class="form-group add-img"> <a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="admin_asset/dist/img/remove-icon.png"></a> <input type="file" name="imgdetail[]" /> </div>';
        var x = 1;
        $('.add_button').click(function(){
            $('.form-wrapper').append(fieldHTML);
        });

        @for ($i = 1; $i < 8; $i++)
        var fieldHTML{{$i}} = '<div class="col-md-4 form-group add-img"> <a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="admin_asset/dist/img/remove-icon.png"></a> <input type="file" name="imgdetail{{$i}}[]" /> </div>';
        var x = 1;
        $('.add_button{{$i}}').click(function(){
            $('.form-wrapper{{$i}}').append(fieldHTML{{$i}});
        });
        @endfor

        $(document).on('click', '.remove_button', function(e){ 
            e.preventDefault();
            $(this).parent('.form-group').remove();
            x--;
        });

        $(document).on('click', '#del', function(e){ 
            e.preventDefault();
            $(this).parent('.detail-img').remove();
            x--;
        });


    });
</script>

@endsection

@section('function')
	<?php 
		function addeditcat ($data, $parent=0, $str='',$select=0)
		{
			foreach ($data as $value) {
				if ($value['parent'] == $parent) {
					if(in_array($value['id'], explode(',', $select)) )
					{ ?>
						<option value="<?php echo $value['id']; ?>" selected > <?php echo $str.$value['name']; ?> </option>
					<?php } else { ?>
						<option value="<?php echo $value['id']; ?>" > <?php echo $str.$value['name']; ?> </option>
					<?php }
					
					addeditcat ($data, $value['id'], $str.'---',$select);
				}
			}
		}
	?>
@endsection