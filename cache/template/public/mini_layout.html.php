<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $this->_var['page_title']; ?></title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<script src="__JS__/miniui/boot.js" type="text/javascript"></script>
<script src="__JS__/jquery/utils.js" type="text/javascript"></script>
<script src="__JS__/miniui/ad.common.js" type="text/javascript"></script>
<style type="text/css">
html, body{
	margin:0;padding:0;border:0;
	<?php if ($this->_var['mini_list']): ?>
	width:100%;height:100%;overflow:hidden;
	<?php else: ?> width:98%;
	<?php endif; ?>
} 
</style>
</head>
<body>
{__CONTENT__}
<script type="text/javascript">
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
</script>
</body>
</html>
