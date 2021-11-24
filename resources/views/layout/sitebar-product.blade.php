<div class="uk-width-large-1-4 uk-visible-large">
    <aside class="aside" style='margin-top: 40px;'>
        <section class="aside-prd-detail aside-whyus">
            <div class='prd-detail'>
                <div class="call-groups">
                    <a class="btn uk-flex uk-flex-middle uk-flex-space-between" href="tel:{{$head_setting->hotline}}" title="Showroom 1">
                        <div class="text">
                            <span class="title">{{$head_setting->hotline}}</span>
                        </div>
                    </a>
					@if($head_setting['hotline1'])
                    <a class="btn uk-flex uk-flex-middle uk-flex-space-between" href="tel:{{$head_setting->hotline1}}" title="Showroom 2">
                        <div class="text">
                            <span class="title">{{$head_setting->hotline1}}</span>
                        </div>
                    </a>
					@endif
                </div>
            </div>
        </section><!-- .aside-prd-detail -->
		
		
		
        @foreach($citys as $val)  
		<section class="aside-prd-detail">
			<header class="panel-head">
				<a href='location/{{$val->slug}}'><h3 class="heading"><span>{{$val->name}}</span></h3></a>
			</header>
			<section class="panel-body">
				<ul class="uk-list list">
					@foreach($val->district as $val1)
					<li style='padding: 5px; border-bottom: dashed 1px #ddd;'><a href='location/{{$val1->city->slug}}/{{$val1->slug}}'>{{$val1->name}}</a></li>
					@endforeach
				</ul>
			</section>
		</section><!-- .aside-prd-detail -->
		@endforeach
        
        
		
        <section class="aside-prd-detail aside-product" data-uk-sticky="{top: 50}" style='background-color: #fff;'>
            <header class="panel-head">
                <h3 class="heading"><span>Đăng ký tải tài liệu dự án</span></h3>
            </header>
            <section class="panel-body">
                <form class="dangky" action="dang-ky" method="POST">
					<input type="hidden" name="_token" value="{{csrf_token()}}" />
					<input type="hidden" name="link" value="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" />
                    <input type="text" name="name" placeholder='Nhập tên' />
                    <input required type="tel" name="tel" placeholder='Nhập số điện thoại (*)' />
                    <input type="mail" name="email" placeholder='Nhập email' />
                    <input type="submit" name="btlsubmit" value="ĐĂNG KÝ" />
                </form>
            </section>
        </section><!-- .aside-panel -->
		
		<section class="aside-prd-detail aside-product" data-uk-sticky="{top: 318}">
            <header class="panel-head">
                <h3 class="heading"><span>Tin dự án</span></h3>
            </header>
            <section class="panel-body">
                <ul class="uk-list list-product">
                    @foreach($news_product as $val)                                                           
                    <li>
                        <div class="product uk-clearfix">
                            <div class="thumb">
                                <a class="image img-cover" href="{{$val->category->slug}}/{{$val->slug}}/{{$val->id}}.html" title="{{$val->name}}"><img src="data/news/80-60/{{$val->img}}" alt="{{$val->name}}"></a>
                            </div>
                            <div class="infor">
                                <h4 class="title"><a href="{{$val->category->slug}}/{{$val->slug}}/{{$val->id}}.html" title="{{$val->name}}">{{$val->name}}</a></h4>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </section>
        </section><!-- .aside-panel -->


        
    </aside>
</div>