<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $this->_var['page_title']; ?></title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<script src="__JS__/miniui/boot.js" type="text/javascript"></script>
<script src="__JS__/miniui/miniui/miniui.js" type="text/javascript"></script>
<script src="__JS__/jquery/utils.js" type="text/javascript"></script>
<script src="__JS__/miniui/ad.common.js" type="text/javascript"></script>
<script src="__JS__/socket.io.js" type="text/javascript"></script>
<style type="text/css">
html, body{
	margin:0;padding:0;border:0;
	<?php if ($this->_var['mini_list']): ?>
	width:100%;height:100%;
	<?php else: ?> width:98%;
	<?php endif; ?>

}
.show-msg{width:300px; height:200px; background:#fff; border:1px solid #ccc; position:absolute; right:0; bottom:0; display:none;}
.show-msg .show-title{width:300px; height:30px; line-height:30px; background:#eee; border-bottom:1px solid #ccc; overflow:hidden;}
.show-msg .show-title p{float:left; margin:0 0 0 15px;}
.show-msg .show-title .show-close{color:#666; cursor:pointer; float:right; margin:0 10px 0 0;}
.show-msg .show-con{width:260px; margin:20px; line-height:25px;}
</style>
</head>
<body>
{__CONTENT__}
<input id="admin_id" type="hidden" value="<?php echo $this->_var['admin_id']; ?>" />
<input id="url_m" type="hidden" value="<?php echo $_GET['m']; ?>" />
<input id="url_c" type="hidden" value="<?php echo $_GET['c']; ?>" />
<input id="url_a" type="hidden" value="<?php echo $_GET['a']; ?>" />
<script type="text/javascript">
$(function(){
	// getLogCurTime();
	$(".show-close").live("click",function(){
		$(this).closest(".show-msg").remove();
	});
});
function onLoadUinfo(e) {
	var record = e.record,uid=e.value; //record.id
	if(uid>0){
		return s = '<a href="javascript:viewUinfo('+uid+')">'+uid+'</a> ';
	}else{
		return uid;
	}
}
//查看用户信息
function viewUinfo(user_id){
	mini.open({
		url: "/user/user/info?id="+user_id,
		showMaxButton:true,
		title: "查看用户信息",
		width: 900, height:650
	});
}

//查看企业相关信息
function viewCinfo(c_id){
	mini.open({
		url: "/user/customer/info?id="+c_id,
		showMaxButton:true,
		title: "查看企业用户相关信息",
		width: 1200, height:650
	});
}

//查看企业联系人相关信息
function viewContactInfo(u_id){
	mini.open({
		url: "/user/contact/viewInfo?id="+u_id,
		showMaxButton:true,
		title: "查看联系人用户相关信息",
		width: 550, height:480
	});
}
//查看公司和牌号

function viewModelAndCompany(uid){
	mini.open({
		url: "/user/contact/viewModel?id="+uid,
		showMaxButton:true,
		title: "查看联系人牌号以及公司信息",
		width: 400, height:350,
		ondestroy: function (action) {
				if(action=='save'){ //重新加载
					grid.reload();
				}
			}
	});
}


//获取状态
function onLoadStatus(e) {
	var record = parseInt(e.record.status)+1; //record.id
	return $("#soStatus").find("option[value="+record+"]").text();
}
//原生状态
function LoadStatus(e) {
	var record = e.record.status; //record.id
	return $("#soStatus").find("option[value="+record+"]").text();
}
//验证浏览器是否支持WebSocket协议
if (!window.WebSocket) {
	alert("WebSocket not supported by this browser!");
}
// 初始化io对象
var socket = io('http://www.myplas.com:2120');
// uid 可以为网站用户的uid，作为例子这里用session_id代替
// 当socket连接后发送登录请求
// console.log($("#admin_id").val());
socket.on('connect', function(){
	socket.emit('login', "pc_"+$("#admin_id").val());
	// socket.emit('login', "pc_"+'9999');
});
// 当服务端推送来消息时触发，这里简单的aler出来，用户可做成自己的展示效果
socket.on('new_msg', function(msg){
	var str = '<div class="show-msg">'+
				'<div class="show-title"><p style="color:#ff4343; font-weight:bold;font-size:14px;">您有新消息请到工作台查看</p><div class="show-close">关闭</div></div>'+
				'<div class="show-con">'+msg+'</div>'+
			  '</div>';
     $("body").append(str);
     $(".show-msg").show();
});
function getLogCurTime(){
	var tag = '/'+$("#url_m").val()+'/'+$("#url_c").val()+'/'+$("#url_a").val();
	// var timestamp = Date.parse(new Date());
	// var n_timest = timestamp/1000;
	var callback=function(res){

	}
	utils.ajax('/public/adminBase/saveTime',{tag:tag},callback,"POST","json");
}
</script>
</body>
</html>
