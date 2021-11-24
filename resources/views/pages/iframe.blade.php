<form action="dang-ky" method="POST" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{csrf_token()}}" />
<input type="hidden" name="link" value="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" />
<input type="hidden" name="_token" value="{{csrf_token()}}" />
<p><input type="text" placeholder="Họ và tên" class="" name="name">
<input required type="tel" placeholder="Số điện thoại (*)" class="" name="phone"><input type="email" placeholder="Địa chỉ email" class="" name="email"><p>
<p><input style="margin-right: 20px;" type="submit" value="NHẬN NGAY"></p>
</form>