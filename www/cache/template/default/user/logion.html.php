<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>登录,我的塑料网</title>

	<link rel="stylesheet" type="text/css" href="__CSS__/home/style/commons.css"/>
	<link rel="stylesheet" type="text/css" href="__CSS__/home/common.css"/>
	<script src="__JS__/home/jquery-1.8.3.min.js" type="text/javascript"></script>
	<script src="__JS__/home/tab.js" type="text/javascript"></script>
	<script src="__JS__/home/layer-v1.8.5/layer.min.js" type="text/javascript"></script>


</head>
<body class="member">
<?php echo $this->fetch('public:head'); ?>

<!--member-con begin-->
<div class="member-con">
	<!--mem-inner begin-->
	<div class="mem-inner">
		<div class="memlt"><img src="__IMG__/home/img/memlt.png" width="544" height="476"/></div>
		<!--memrt begin-->
		<div class="memrt">
			<!--logo begin-->
        	<div class="logo"><img src="__IMG__/home/img/logo1.png" width="224" height="65"/></div>
            <!--logo end-->
			<!--opt begin-->
			<div class="opt">
				<!--login-tab begin-->
				<ul class="login-tab">
					<li id="tabz1" onclick="setTab('tabz',1,2)" class="hover">密码登录</li>
					<li id="tabz2" onclick="setTab('tabz',2,2)">短信登录<span></span></li>
				</ul>
				<!--login-tab end-->
				<!--login begin-->
				<div class="login">
					<!--con-tabz-1 begin-->
					<div id="con-tabz-1">
						<form name="" method="post"  id="loginForm" onSubmit="return doLogin();" class="loginform" action="">
							<!--opt-wrap begin-->
							<div class="opt-wrap mobile">
								<div class="icon"></div>
								<input type="text" value="" name="username" placeholder="请输入手机号..."/>
							</div>
							<!--opt-wrap end-->
							<!--opt-wrap begin-->
							<div class="opt-wrap pwd">
								<div class="icon"></div>
								<input type="password" maxlength="20"  name="password" placeholder="请输入密码..."/>
							</div>
							<div><span id="tips1" class="tips-error"></span></div>
							<!--opt-wrap end-->
							<!--related begin-->
							<div class="related">
								<div class="reg">还没有账号？去<a href="/user/register">免费注册</a></div>
								<div class="forget"><a href="/user/findpwd">忘记密码？</a></div>
							</div>
							<!--related end-->
							<div class="btn">
								<input type="button" value="登  录" onclick="formsubmit();" />
							</div>
							 <p class="qq-login"><a href="/user/login/auth">使用QQ账号登录</a></p>
						</form>
					</div>
					<!--con-tabz-1 end-->
					<!--con-tabz-2 begin-->
					<div id="con-tabz-2" style="display:none;">
						<form name="" method="post"  id="loginForm2" onSubmit="return doLogin2();" class="loginform" action="">
							<!--opt-wrap begin-->
							<div class="opt-wrap mobile2">
								<div class="icon"></div>
								<input type="text" value="" id="phonenum" name="phonenum" placeholder="请输入手机号..."/>
							</div>
							<!--opt-wrap end-->
							<!--opt-wrap begin-->
							<div class="opt-wrap pwd2">
								<div class="icon"></div>
								<input type="text" id="phonevaild" name="phonevaild" maxlength="20"  placeholder="请输入收到的动态密码..."/>
								<span class="login-get-code enable" data-bool="true">获取动态密码</span>
							</div>
							<div class="opt-wrap2">
								<p class="inp_p2">
									<span class="sp1"><input type="text" id="imgcode" class="input_2" name="captcha"  placeholder="不区分大小写"></span>
									<img class="sp2" id="my-code"  src="/api/vcode?name=regcode" onclick="this.src=this.src+'&t='+Math.random()" alt="看不清，点击刷新" title="看不清，点击刷新">
								</p>
							</div>
							<div><span id="tips2" class="tips-error"></span></div>
							<!--opt-wrap end-->
							<!--related begin-->
							<div class="related">
								<div class="reg">还没有账号？去<a href="/user/register">免费注册</a></div>
								<div class="forget"><a href="/user/findpwd">忘记密码？</a></div>
							</div>
							<!--related end-->
							<div class="btn">
								<input type="button" value="登  录" onclick="formsubmit();" />
							</div>
							 <p class="qq-login"><a href="/user/login/auth">使用QQ账号登录</a></p>
						</form>
					</div>
					<!--con-tabz-2 end-->
				</div>
			</div>
			<!--opt end-->
		</div>
		<!--memrt end-->
	</div>
	<!--mem-inner end-->

</div>
<!--member-con end-->
<?php echo $this->fetch('public:footer'); ?>
</body>
<script>
	var tips1= $("#tips1");
	var tips2= $("#tips2");
	function doLogin(){
		var username=$("input[name='username']").val().trim();
		var password=$("input[name='password']").val().trim();
		//var remember=$("input[name='remember']:checked").val();
		var is_mobile=/^1[0-9]{10}$/;
		if(username==''){
			errMsg('手机号不能为空');
			return false;
		}
		if(!is_mobile.test(username)){
			errMsg('手机号不合规范');
			return false;
		}
		if(password==''){
			errMsg('密码不能为空');
			return false;
		}
//		if(password.trim() < 6){
//			errMsg('账号或密码错误');
//			return false;
//		}
		$.post('/user/login/dolongin',{username:username,password:password},function (data){
			if(data.err>0){
				errMsg(data.msg);
			}else{
				window.location.href="/user";
			}
		},'json');
		errMsg('');
		return false;
	}
	//短信验证码登录
	var doLogin2 = function(){
		var phonenum = $("#phonenum").val();
		var phonevaild = $("#phonevaild").val();
		var  regcode = $.trim($("#imgcode").val());
		//var remember=$("input[name='remember']:checked").val();
		var is_mobile=/^1[0-9]{10}$/;
		if(phonenum==''){
			errMsg('手机号不能为空');
			return false;
		}
		if(!is_mobile.test(phonenum)){
			errMsg('手机号不合规范');
			return false;
		}
		if(phonevaild==''){
			errMsg('短信验证码不能为空');
			return false;
		}
		if(regcode==''){
			errMsg('验证码不能为空');
			return false;
		}
		$.post('/user/login/dolongin2',{phonenum:phonenum,phonevaild:phonevaild,regcode:regcode},function (data){
			if(data.err>0){
				errMsg(data.msg);
			}else{
				window.location.href="/user";
			}
		},'json');
		errMsg('');
		return false;
	}
	
	function errMsg(msg){
		if($(".login-tab .hover").text()=="密码登录"){
			tips1.html(msg);
		}else{
			tips2.html(msg);
		}
	}


   $(".login-get-code").bind("click",function(){
		var phonenum = $("#phonenum").val();
		var phonevaild = $("#phonevaild").val();
		if(phonenum==""){
			errMsg('手机号不能为空!');
			$("#phonenum").focus();
			return false;
		}else{
			var is_mobile=/^1[0-9]{10}$/;
			if(!is_mobile.test(phonenum)){
				errMsg('手机号不合规范');
				return false;
			}
		}
   		var _this = $(this);
   		if(_this.attr("data-bool")=="true") time(_this,60);
		_this.attr("data-bool","false");
		//发送验证码
		$.post('/user/login/sendMobileMsg',{phonenum:phonenum,phonevaild:phonevaild},function(data){
			if(data.err=='0'){
				layer.msg("验证码发送成功",4,-1);
			}else{
				errMsg(data.msg);
			}					   
		},'json');
   });  
   //倒计时
	function time(btn,wait) {
	  if (wait == 0) {
		  btn.removeClass("disabled").addClass("enable").html("获取验证码");
		  btn.attr("data-bool","true");
		  wait = 60;
	  } else {
		  btn.removeClass("enable").addClass("disabled").html("倒计时 "+wait+"S");
		  wait--;
		  setTimeout(function () {
			  time(btn,wait);
		  },
		  1000)
	  }
	}
   var formsubmit = function(){
		if($(".login-tab .hover").text()=="密码登录"){
			$("#loginForm").submit();
		}else{
			$("#loginForm2").submit();
		}
   }
</script>

</html>
