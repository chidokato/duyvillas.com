<div class="fixed-hotline">
	<div class='iteam-hotline'><a href="tel:{{$head_setting->hotline}}"><i class="fa fa-phone" aria-hidden="true"></i> <span class='uk-visible-large'>Hotline: </span> <strong>{{$head_setting->hotline}}</strong></a></div>
	<div class='iteam-contact'><button id="myBtn"> <i class="fa fa-download" aria-hidden="true"></i> TẢI TÀI LIỆU <span class='uk-visible-large'>DỰ ÁN</span> </button></div>
	<div class='clr'></div>
</div>
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
        <h3>Tải toàn bộ tài liệu dự án! </h3>
        <p>Bảng Giá, Hợp đồng mua bán. Pháp lý dự án. Ưu đãi mới nhất.</p>
        <form class='form-dang-ky' action="dang-ky" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{csrf_token()}}" />
          <input type="hidden" name="link" value="<?php echo 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>" />
          <input type="hidden" name="_token" value="{{csrf_token()}}" />
          <p><input type="text" placeholder="Họ và tên" class="" name="name"></p>
          <p><input required type="tel" placeholder="Số điện thoại (*)" class="" name="phone"><p>
          <p><input type="email" placeholder="Địa chỉ email" class="" name="email"><p>
          <p><input style="margin-right: 20px;" type="submit" value="NHẬN NGAY"></p>
        </form>
  </div>
</div>	



<script type="text/javascript">
// popup
var modal = document.getElementById('myModal');
var btn = document.getElementById("myBtn");

var span = document.getElementsByClassName("close")[0];
btn.onclick = function() {
  modal.style.display = "block";
}
span.onclick = function() {
  modal.style.display = "none";
}
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
// popup
</script>

<style type="text/css">
.form-dang-ky input[type="text"], .form-dang-ky input[type="tel"], .form-dang-ky input[type="email"]{
	width: 100%; 
    padding: 10px;
}
.form-dang-ky input[type="submit"]{
	padding: 10px 25px;
    border-radius: 15px;
    background-color: red;
    border-color: red;
    color: #fff;
    font-weight: bold;
}
.form-dang-ky input[type="submit"]:hover{
	background-color: #fff;
    border-color: #fff;
    color: red;
}

.fixed-hotline{
	width: 100%;
    background-color: #444;
	position: fixed;
    bottom: 0;
	height: 35px;
}
.fixed-hotline .iteam-hotline{
	float: left;
	width: 50%;
	text-align: right;
	line-height: 35px;
    font-size: 21px;
    padding-right: 20px;
}
.fixed-hotline .iteam-hotline a{
	color:#fff;
}
.fixed-hotline .iteam-hotline a i{
	background-color: red;
    padding: 8px 11px;
}

.fixed-hotline .iteam-contact{
	float: right;
	width: 50%;
	text-align: left;
}
.fixed-hotline .iteam-contact button{
	line-height: 35px;
    border: none;
    padding: 0px 20px;
	background-color: red;
    color: #fff;
    font-weight: bold;
}
.modal-content h3{
	color: #fff;
    font-size: 25px;
}
.modal-content p{
	color: #fff;
    font-size: 20px;
}


  /*popup*/
.modal {
  display: none;
  position: fixed;
  z-index: 999;
  padding-top: 100px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgb(0,0,0);
  background-color: rgba(0,0,0,0.76);
}
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 40px;
  border: 1px solid #888;
  width: 40%;
  background: url(public/uploads/icon/popup-pic.jpg) top center no-repeat;
  text-align: center;
}
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}
.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
/*popup*/


@media only screen and (max-width: 600px) {
	.fixed-hotline{
		background: rgba(0,0,0,0.6);    height: 45px;
	}
	.fixed-hotline .iteam-contact{
		text-align: center;
	}
	.fixed-hotline .iteam-contact button{
		border-radius: 10px;
		margin-top: 3px;
		padding: 2px 20px;font-size: 16px;
	}
	.fixed-hotline .iteam-hotline a i{
		padding: 4px 6px;
		font-size: 16px;
		border-radius: 100px;
	}
	.fixed-hotline .iteam-hotline a{
		background-color: #105ea8;
		padding: 7px;
		border-radius: 10px;
	}
	.fixed-hotline .iteam-hotline{
		margin-top: 5px;
	}
	.modal-content{
		width: 90%;padding: 20px;
	}
}

</style>