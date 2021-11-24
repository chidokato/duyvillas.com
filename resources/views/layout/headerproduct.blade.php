@include('layout.function')
<header class="pc-header uk-visible-large">
  <section class="upper">
    <div class="uk-container uk-container-center">
      <div class="uk-flex uk-flex-middle uk-flex-space-between container">
        <div class="logo" itemscope itemtype="http://schema.org/Hotel">
          <a itemprop="url" href="{{asset('')}}" title="{{$head_logo->name}}">
            <img src="data/themes/{{$head_logo->img}}" style='height: 80px;' alt="{{$head_logo->name}}" itemprop="logo" />
          </a>
          <span class="uk-hidden">{{$head_logo->name}}</span>
        </div>
        <div class="hd-search header-search">
          <form action="tim-kiem" method="POST" class="uk-form form">
            <input type="hidden" name="_token" value="{{csrf_token()}}" />
            <input type="text" name="key" class="uk-width-1-1 input-text keyword" placeholder="Tìm kiếm sản phẩm..." />
            <button type="submit" name="" class="btn-submit">Tìm kiếm</button>
          </form>
          <div class="searchResult"></div>
        </div>
        <div class="hd-hotline">
          <span class="label">Hotline</span>
          <a class="number" href="tel:{{$head_setting->hotline}}" title="Hotline">{{$head_setting->hotline}}</a>
        </div>
      </div><!-- .container -->
    </div>
  </section><!-- .upper -->
  <div style='background-color: #2b5aa6;'>
  <section class="lower" >
    <div class="uk-container uk-container-center">
      <nav class="main-nav">
        <ul class="uk-navbar-nav uk-clearfix main-menu">
          <li class='<?php if($activemenu == ''){echo 'active';} ?>'>
                        <a  href="{{asset('')}}">Trang chủ</a>
                    </li>
          @foreach($head_category as $item)
              @if($item['parent'] == 0)
                  <li class='<?php if($activemenu == $item->slug){echo 'active';} ?>' >
                      <a href="{{$item->slug}}">{{$item->name}}</a>
                      <?php $count = DB::table('tbl_category')->where('parent',$item->id)->count(); ?>
                      <?php if($count>0) { subcategory ($head_category,$item['id']); } ?>
                  </li>
              @endif
          @endforeach
          <!--li>
              <a href="lien-he">Liên hệ</a>
          </li-->
        </ul>
      </nav><!-- .main-nav -->    
    </div>
  </section><!-- .lower -->
  </div>
</header><!-- .header -->


<!-- MOBILE HEADER -->
<header class="mobile-header uk-hidden-large">
  <section class="upper">
    <a class="moblie-menu-btn skin-1" href="#offcanvas" class="offcanvas" data-uk-offcanvas="{target:'#offcanvas'}">
      <span>Menu</span>
    </a>
    <div class="logo">
      <a href="{{asset('')}}" title="{{$head_logo->name}}"><img src="data/themes/{{$head_logo->img}}" alt="{{$head_logo->name}}" /></a>
    </div>
    <a class="mobile-hotline" href="tel: {{$head_setting->hotline}}" title="Hotline">
      <span class="label">Hotline: </span>
      <span class="value">{{$head_setting->hotline}}</span>
    </a>
  </section><!-- .upper -->
  <section class="lower">
    <div class="mobile-search header-search">
      <form action="#" method="" class="uk-form form">
        <input type="text" name="" class="uk-width-1-1 input-text keyword" placeholder="Bạn muốn tìm gì hôm nay?" />
        <button type="submit" name="" value="" class="btn-submit">Tìm kiếm</button>
      </form>
      <div class="searchResult"></div>
    </div>
  </section>
</header><!-- .mobile-header -->