<div class="tet">
<p>Sắp Tết rồi !! Chỉ còn ...</p>
<div id="dongho"></div>
<div class="clr"></div>
<p>Kỷ Hợi 2019</p>
</div>

<style type="text/css">
.tet{
	background: radial-gradient(ellipse at bottom, red 10%, #000 100%);    
	text-align: center;    
	padding: 20px 10px;
}
	
.tet p{
	color:#fff;
	padding:20px;
	margin:20px ;
    font-family: 'Dancing Script', cursive;
	font-size:30px;
}
.clr{
	clear: both;
}
#dongho{
	/*padding-left: 170px;*/
}
#dongho .khung{
	border: 1px solid #ddd;
	/*float: left;*/
	padding: 20px 30px 35px 30px;
	border-radius: 25px;    
	margin-right: 10px;   
	background-color: #fff;
	font-size: 24px;    
	position: relative;
	font-family: 'Charmonman', cursive;
	font-weight: bold;
	color: #000;
}
#dongho .khung span{
	position: absolute;
    bottom: 0;
    background-color: #ddd;
    width: 100%;
    left: 0;
    border-radius: 0px 0px 25px 25px;
    font-size: 12px;
    padding: 5px;
	font-family: 'Charmonman', cursive;
	color: #000;
}

</style>
<link href="https://fonts.googleapis.com/css?family=Charmonman" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Bungee+Shade" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Dancing+Script" rel="stylesheet">
<script>
var countDownDate = new Date("Feb 5, 2019 00:00:00").getTime();
var x = setInterval(function() {
var now = new Date().getTime();
var distance = countDownDate - now;
var days = Math.floor(distance / (1000 * 60 * 60 * 24));
var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((distance % (1000 * 60)) / 1000);
document.getElementById("dongho").innerHTML = "<div class='col-md-2'></div><div class='khung col-md-2'>"+days+"<span>NGÀY</span> </div>" + "<div class='khung col-md-2'>"+hours+"<span>GIỜ</span> </div>" + "<div class='khung col-md-2'>"+minutes+"<span>PHÚT</span> </div>" + "<div class='khung col-md-2'>"+seconds+"<span>GIÂY</span> </div>";
if (distance < 0) {
clearInterval(x);
document.getElementById("dongho").innerHTML = "Thời gian đếm ngược đã kết thúc";
}
}, 1000);
</script>