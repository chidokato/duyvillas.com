<div class="panel panel-default">
    <div class="panel-heading"> SEO option </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
            	<div class="control-group">
                    <label>Title</label> ( <span id="chars_title">70</span> characters left )
                    <input id="title" onkeyup="changetitle(this);" name='title' type="text" placeholder="Name ..." class="form-control ">
                </div>
            </div>
            <div class="col-lg-12">
                <div class="control-group">
                    <label >Description</label>( <span id="chars_left">170</span> characters left )
                    <input id="description" onkeyup="change(this);" name='description' type="text" placeholder="description" class="form-control">
                </div>
            </div>
            <div class="col-lg-9">
            	<div class="control-group">
                    <label>keywords</label>
                    <input name='keywords' type="text" placeholder="keywords ..." class="form-control">
                </div>
            </div>
            <div class="col-lg-3">
            	<div class="control-group">
                    <label>Robots</label>
                    <select name='robot' class="form-control">
    					<option value="index, follow">index, follow</option>
    					<option value="noindex, nofollow">noindex, nofollow</option>
    			  	</select>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-body seo">
        <div class="row">
            <div class="col-md-6">
                <div class="seo-title"></div>
                <div class="seo-link">{{asset('')}} <span class='fa fa-caret-down'></span></div>
                <div class="seo-description"></div>
            </div>
        </div>
    </div>
</div>