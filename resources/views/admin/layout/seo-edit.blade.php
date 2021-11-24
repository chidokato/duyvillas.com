<div class="panel panel-default">
	<div class="panel-heading">
        SEO option
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <label>Title</label> ( <span id="chars_title">{{ 70-mb_strlen($data->title) }}</span> characters left )
                <input id="title" onkeyup="changetitle(this);" value="{{$data->title}}" name='title' type="text" placeholder="Title ..." class="form-control ">
            </div>
            <div class="col-lg-12">
                <label >Description</label>( <span id="chars_left">{{ 170-mb_strlen($data->description) }}</span> characters left )
                <input id="description" onkeyup="change(this);" value="{!! old('description'), isset($data['description'])?$data['description']:null !!}" name='description' type="text" placeholder="description" class="form-control">
            </div>
            <div class="col-lg-9">
                <label>keywords</label>
                <input value="{{$data->keywords}}" name='keywords' type="text" placeholder="keywords ..." class="form-control">
            </div>
            <div class="col-lg-3">
                <label>Robots</label>
                <select name='robot' class="form-control">
					<option <?php if($data->robot == 'index, follow'){echo "selected";} ?> value="index, follow">index, follow</option>
					<option <?php if($data->robot == 'noindex, nofollow'){echo "selected";} ?> value="noindex, nofollow">noindex, nofollow</option>
			  	</select>
            </div>
        </div>
    </div>
    <div class="panel-body seo">
        <div class="row">
            <div class="col-md-9">
                <div class="seo-title">{!! old('title'), isset($data['title'])?$data['title']:null !!}</div>
                <div class="seo-link">{{asset('')}} <span class='fa fa-caret-down'></span></div>
                <div class="seo-description">{!! old('description'), isset($data['description'])?$data['description']:null !!}</div>
            </div>
        </div>
    </div>
</div>