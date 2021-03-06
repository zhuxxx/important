<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php if ($this->_var['seo']['cate_name']): ?>
<title><?php echo $this->_var['seo']['title']; ?>_<?php echo $this->_var['seo']['cate_name']; ?> <?php echo $this->_var['sys']['site_title']; ?></title>
	<?php else: ?>
	<title><?php echo $this->_var['seo']['title']; ?> <?php echo $this->_var['sys']['site_title']; ?></title>
	<?php endif; ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta property="qc:admins" content="3477461216651041363757" />
<!--<meta property="qc:admins" content="347746133667745354117636" />-->
	<?php if ($this->_var['seo']['status'] == 1): ?>
<meta name="keywords" content="<?php if ($this->_var['seo']['keywords']): ?><?php echo $this->_var['seo']['keywords']; ?><?php else: ?><?php echo $this->_var['sys']['site_keywords']; ?><?php endif; ?>" />
<meta name="description" content="<?php if ($this->_var['seo']['description']): ?><?php echo $this->_var['seo']['description']; ?><?php else: ?><?php echo $this->_var['sys']['site_desc']; ?><?php endif; ?>" />
	<?php elseif ($this->_var['seo']['status'] == 2): ?>
<meta name="keywords" content="<?php if ($this->_var['seo']['keywords']): ?><?php echo $this->_var['seo']['keywords']; ?><?php else: ?><?php echo $this->_var['sys']['site_keywords']; ?><?php endif; ?>" />
<meta name="description" content="<?php if ($this->_var['seo']['description']): ?><?php echo $this->_var['seo']['description']; ?><?php else: ?><?php echo $this->_var['sys']['site_desc']; ?><?php endif; ?>" />
	<?php elseif ($this->_var['seo']['status'] == 3): ?>
<meta name="keywords" content="<?php if ($this->_var['seo']['keywords']): ?><?php echo $this->_var['seo']['keywords']; ?><?php else: ?><?php echo $this->_var['sys']['site_keywords']; ?><?php endif; ?>" />
<meta name="description" content="<?php if ($this->_var['seo']['description']): ?><?php echo $this->_var['seo']['description']; ?><?php else: ?><?php echo $this->_var['sys']['site_desc']; ?><?php endif; ?>" />
	<?php elseif ($this->_var['seo']['status'] == 4): ?>
<meta name="keywords" content="<?php if ($this->_var['seo']['keywords']): ?><?php echo $this->_var['seo']['keywords']; ?><?php else: ?><?php echo $this->_var['sys']['site_keywords']; ?><?php endif; ?>" />
<meta name="description" content="<?php if ($this->_var['seo']['description']): ?><?php echo $this->_var['seo']['description']; ?><?php else: ?><?php echo $this->_var['sys']['site_desc']; ?><?php endif; ?>" />
	<?php elseif ($this->_var['seo']['status'] == 5): ?>
<meta name="keywords" content="<?php if ($this->_var['seo']['keywords']): ?><?php echo $this->_var['seo']['keywords']; ?><?php else: ?><?php echo $this->_var['sys']['site_keywords']; ?><?php endif; ?>" />
<meta name="description" content="<?php if ($this->_var['seo']['description']): ?><?php echo $this->_var['seo']['description']; ?><?php else: ?><?php echo $this->_var['sys']['site_desc']; ?><?php endif; ?>" />
	<?php elseif ($this->_var['seo']['status'] == 6): ?>
<meta name="keywords" content="<?php if ($this->_var['seo']['keywords']): ?><?php echo $this->_var['seo']['keywords']; ?><?php else: ?><?php echo $this->_var['sys']['site_keywords']; ?><?php endif; ?>" />
<meta name="description" content="<?php if ($this->_var['seo']['description']): ?><?php echo $this->_var['seo']['description']; ?><?php else: ?><?php echo $this->_var['sys']['site_desc']; ?><?php endif; ?>" />
	<?php elseif ($this->_var['seo']['status'] == 7): ?>
	<meta name="keywords" content="<?php if ($this->_var['seo']['keywords']): ?><?php echo $this->_var['seo']['keywords']; ?><?php else: ?><?php echo $this->_var['sys']['site_keywords']; ?><?php endif; ?>" />
	<meta name="description" content="<?php if ($this->_var['seo']['description']): ?><?php echo $this->_var['seo']['description']; ?><?php else: ?><?php echo $this->_var['sys']['site_desc']; ?><?php endif; ?>" />
	<?php elseif ($this->_var['seo']['status'] == 10): ?>
	<meta name="keywords" content="<?php if ($this->_var['seo']['keywords']): ?><?php echo $this->_var['seo']['keywords']; ?><?php else: ?><?php echo $this->_var['sys']['site_keywords']; ?><?php endif; ?>" />
	<meta name="description" content="<?php if ($this->_var['seo']['description']): ?><?php echo $this->_var['seo']['description']; ?><?php else: ?><?php echo $this->_var['sys']['site_desc']; ?><?php endif; ?>" />
	<?php else: ?>
	<meta name="keywords" content="<?php echo $this->_var['sys']['site_keywords']; ?>" />
	<meta name="description" content="<?php echo $this->_var['sys']['site_desc']; ?>" />
	<?php endif; ?>
<link rel="shortcut icon" href="__UPLOAD__/<?php echo $this->_var['sys']['site_icon']; ?>" />
<link rel="stylesheet" type="text/css" href="__CSS__/home/common.css"/>
<style type="text/css">
.copyright img{display:inline;}
</style>
<script type="text/javascript" src="__JS__/home/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="__JS__/home/layer-v1.8.5/layer.min.js"></script>
<script type="text/javascript" src="__JS__/home/common.js"></script>
<script type="text/javascript" src="__JS__/home/zeroclipboard/ZeroClipboard.js"></script>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?4808bff4f0276952e006e0f3ec054483";
  var s = document.getElementsByTagName("script")[0];
  s.parentNode.insertBefore(hm, s);
})();
</script>
</head>
<body>
<!--top begin-->
<div class="top color9 link9">
	<div class="w1220">
		<!--top-lt begin-->
		<ul class="top-lt flt">
			<li>欢迎光临<a href="/">我的塑料网</a>！</li>
			<li class="collect"><a rel="nofollow" href="javascript:Addme();">收藏本站</a></li>
			<li class="blog"><a rel="nofollow" target="_blank" href="<?php echo $this->_var['sys']['weibo']['link']; ?>">官方微博</a></li>
			<?php if ($_SESSION['userid'] > 0): ?>
				<li><a rel="nofollow" href="/user/myHomeWeb/getMyWeb">我的门户网站</a></li>
				<?php else: ?>
				<li><a rel="nofollow" href="/user/myHomeWeb/getMyWeb">我的门户网站</a></li>
			<?php endif; ?>
		</ul>
		<!--top-lt end-->
		<!--top-rt begin-->
		<ul class="top-rt frt">
			<?php if (! empty ( $this->_var['auth_info'] )): ?>
				 <li><?php echo $this->_var['auth_info']['name']; ?></li>
				 <?php else: ?>
				<?php if ($_SESSION['userid'] > 0): ?>
				<li><a rel="nofollow" id="user_name" href="/user"><?php echo $_SESSION['uinfo']['name']; ?> 个人中心</a></li>
				<li class="login"><a rel="nofollow" href="/user/logout"  >退出登录</a></li>
				   <?php else: ?>
				<li class="login"><a rel="nofollow" href="/user/login">您好，请登录</a></li>
				<li><a rel="nofollow" href="/user/register">免费注册</a></li>
				<?php endif; ?>
			<?php endif; ?>

			<!-- <li class="app"><a href="javascript:;">手机网站</a></li> -->
			<li><a rel="nofollow" href="/page">常见问题</a></li>
			<li><a rel="nofollow" href="/page?id=5601">联系我们</a></li>
			<li><a rel="nofollow" href="/page/index/feedBack">意见反馈</a></li>
			<li class="lang">
				<a rel="nofollow" href="/">中文</a> | <a rel="nofollow" href="javascript:;">EN</a>
			</li>
		</ul>
		<!--top-rt end-->
	</div>
</div>
<!--top end-->
<!--header begin-->
<div class="header">
	<!-- <div class="logo flt"><a href="/"><img src="__UPLOAD__/<?php echo $this->_var['sys']['site_logo']; ?>" width="211" height="37"/></a></div> -->
	<div class="logo flt">
		<h1><a href="/"><img src="__UPLOAD__/<?php echo $this->_var['sys']['site_logo']; ?>" width="121" height="75" alt="logo"/></a></h1>
	</div>
	<div class="logo-brand flt"><img src="__IMG__/home/logo2Brand.jpg" width="79" height="32"/></div>
	<!--nav begin-->
	<ul class="nav link3 flt">
		<li ><a href="/offers"  target="_blank" <?php if ($this->_var['on'] == offers): ?> class="hover" <?php endif; ?> >商城报价</a></li>
		<li><a href="/finance"  target="_blank" <?php if ($this->_var['on_4'] == finance): ?> class="hover" <?php endif; ?>>塑料金融</a></li>
		<li style="display:none;"><a href="/client"   target="_blank" <?php if ($this->_var['on_1'] == client): ?> class="hover" <?php endif; ?>>大户报价</a></li>
		<li><a href="/purchase" target="_blank" <?php if ($this->_var['on_2'] == purchase): ?> class="hover" <?php endif; ?>>采购单</a></li>
		<li><a href="/resource" target="_blank" <?php if ($this->_var['on_3'] == resource): ?> class="hover" <?php endif; ?>>资源库</a></li>
		<li><a href="http://56.myplas.com/" target="_blank">物流专区</a></li>
		<li><a href="/physical" target="_blank" <?php if ($this->_var['on_6'] == physical): ?> class="hover" <?php endif; ?>>物性表</a></li>
		<li style="display:none;"><a href="/article" target="_blank" <?php if ($this->_var['on_7'] == article): ?> class="hover" <?php endif; ?>>塑料头条</a></li>
		<li><a href="http://news.myplas.com/" target="_blank">塑料头条</a></li>
		<li><a href="/pointshop" target="_blank">积分商城</a></li>
		<li><a href="/q.html" target="_blank">塑料圈</a></li>
		<li><a href="/pc_plastic" target="_blank">PC塑料圈</a></li>
	</ul>
	<!--nav end-->
	<div class="download frt"><a href="/download.html">手机客户端</a></div>
</div>
<!--header end-->

 {__CONTENT__}

<!--footer begin-->
<div class="footer">
	<div class="w1220">
		<div class="left link3 flt">
			<ul>
				<?php $_from = $this->_var['footer']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->_push_vars('', 'value_0_70596100_1495086278');if (count($_from)):
    foreach ($_from AS $this->_var['value_0_70596100_1495086278']):
?>
				<li>
					<h4><?php echo $this->_var['value_0_70596100_1495086278']['cate_name']; ?></h4>
					<?php $_from = $this->_var['value_0_70596100_1495086278']['son']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->_push_vars('', 'v');if (count($_from)):
    foreach ($_from AS $this->_var['v']):
?>
					<p><a href="/page/<?php echo $this->_var['v']['id']; ?>.html"><?php echo $this->_var['v']['title']; ?></a></p>
					<?php endforeach; endif; unset($_from); ?><?php $this->_pop_vars();; ?>
				</li>
				<?php endforeach; endif; unset($_from); ?><?php $this->_pop_vars();; ?>
			</ul>
		</div>
		<div class="right frt">
			<ul class="ewm color3">
				<li>
					<p><img src="__UPLOAD__/<?php echo $this->_var['sys']['weixin']['qrcode']; ?>" width="84" height="84"/></p>
					<span>官方微信</span>
				</li>
				<li>
					<p><img src="__UPLOAD__/<?php echo $this->_var['sys']['app']['itemtips']['icon']; ?>" width="81" height="81"/></p>
					<span><?php echo $this->_var['sys']['app']['itemtips']['text']; ?></span>
				</li>
			</ul>
		</div>
	</div>
</div>
<!--footer end-->
<!--friend-links begin-->
<div class="friend-links link3">
	<div class="friend-links-inner height w1220">
		<ul>
			<li>友情链接:</li>
			<?php $_from = $this->_var['friendshipLink']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->_push_vars('', 'value_0_70796100_1495086278');if (count($_from)):
    foreach ($_from AS $this->_var['value_0_70796100_1495086278']):
?>
			<li><a href="<?php echo $this->_var['value_0_70796100_1495086278']['url']; ?>" target="_blank"><?php echo $this->_var['value_0_70796100_1495086278']['title']; ?></a></li>
			<?php endforeach; endif; unset($_from); ?><?php $this->_pop_vars();; ?>
		</ul>
		<!--links-more begin-->
		<p class="links-more">+</p>
		<!--links-more end-->
	</div>
</div>
<!--friend-links end-->
<!--footer-nav begin-->
<!-- Piwik -->
<script type="text/javascript">
  var _paq = _paq || [];
  _paq.push(["setDocumentTitle", document.domain + "/" + document.title]);
  _paq.push(["setCookieDomain", "*.test.myplas.com"]);
  _paq.push(["setDomains", ["*.test.myplas.com"]]);
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="//wa.myplas.com/";
    _paq.push(['setTrackerUrl', u+'piwik.php']);
    _paq.push(['setSiteId', '1']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<noscript><p><img src="//wa.myplas.com/piwik.php?idsite=1" style="border:0;" alt="" /></p></noscript>
<!-- End Piwik Code -->
 <div class="footer-nav link3">
    <ul>
        <!--<li><a rel="nofollow"><?php echo $this->_var['aboutUs']['cate_name']; ?></a>|</li>关于我们-->
		   <?php $_from = $this->_var['aboutUs']['son']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->_push_vars('', 'v');if (count($_from)):
    foreach ($_from AS $this->_var['v']):
?>
        <li><a rel="nofollow" href="/page/<?php echo $this->_var['v']['id']; ?>.html"><?php echo $this->_var['v']['title']; ?></a>|</li>
		   <?php endforeach; endif; unset($_from); ?><?php $this->_pop_vars();; ?>
		<li class="last"><a rel="nofollow" href="/page/index/feedBack">意见反馈</a></li>
    </ul>
</div>
<!--footer-nav end-->
<!--copyright begin-->
<p class="copyright color3"><?php echo $this->_var['sys']['icp_number']; ?>
	<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_1259304101'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "s11.cnzz.com/z_stat.php%3Fid%3D1259304101%26show%3Dpic' type='text/javascript'%3E%3C/script%3E"));</script>
</p>
<!--copyright end-->
<div class="renzheng">
	<ul>
		<?php $_from = $this->_var['Partner']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->_push_vars('key', 'value_0_70896100_1495086278');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['value_0_70896100_1495086278']):
?>
		<li>
			<a href="<?php echo $this->_var['value_0_70896100_1495086278']['url']; ?>" target="_blank">
				<img border="0" src="__UPLOAD__/<?php echo $this->_var['value_0_70896100_1495086278']['img']; ?>"/>
			</a>
		</li>
		<?php endforeach; endif; unset($_from); ?><?php $this->_pop_vars();; ?>
		<li style="height:40px;border:1px solid #6BE61A;">
            			<a  key ="58de04eaefbfb02ba9c3c220"  logo_size="124x47"  logo_type="business"  href="http://www.anquan.org" ><script src="//static.anquan.org/static/outer/js/aq_auth.js"></script></a>
        	      	</li>
	</ul>
</div>
<script charset="utf-8" src="http://wpa.b.qq.com/cgi/wpa.php"></script>
<!--zt-contact begin-->

<div class="zt-contact">
	<ul>
		<li class="opt">
			<div id="BizQQWPA">
				<div class="zt-slide bg-gray">在线咨询</div>
				<div class="zt-mouseover icon-qq bg-gray"></div>
			</div>
		</li>
		<li>
			<div class="ewm bg-gray"><img src="__IMG__/home/zt-wx-ewm.jpg" width="200" height="200"></div>
			<div class="icon-ewm icon-wx bg-gray"></div>
		</li>
		<li>
			<div class="ewm bg-gray"><img src="__IMG__/home/zt-ios-ewm.png" width="200" height="200"></div>
			<div class="icon-ewm icon-ios bg-gray"></div>
		</li>
		<li class="opt">
			<a href="/page/index/feedBack">
				<div class="zt-slide bg-gray">意见反馈</div>
				<div class="zt-mouseover icon-suggest bg-gray"></div>
			</a>
		</li>
		<li class="go-top"></li>
	</ul>
</div>
<!--zt-contact end-->
<script>
$(function(){
	 var ztContact = $(".zt-contact");
		ztContact.find(".icon-qq").bind("mouseover",function(){
			$(this).closest("li").find(".zt-slide").removeClass("bg-gray").addClass("bg-orge");
			$(this).removeClass("bg-gray").addClass("bg-orge");
			$(this).closest("li").find(".zt-slide").stop().animate({
				"left":"0px"
			});
		});
		ztContact.find(".opt").bind("mouseleave",function(){

			$(this).find(".zt-slide").removeClass("bg-orge").addClass("bg-gray");
			$(this).find(".zt-mouseover").removeClass("bg-orge").addClass("bg-gray");
			$(this).find(".zt-slide").stop().animate({
				"left":"60px"
			});
		});
		ztContact.find(".icon-suggest").bind("mouseover",function(){
			$(this).closest("li").find(".zt-slide").removeClass("bg-gray").addClass("bg-orge");
			$(this).removeClass("bg-gray").addClass("bg-orge");
			$(this).closest("li").find(".zt-slide").stop().animate({
				"left":"0px"
			});
		});
		ztContact.find(".icon-ewm").bind("mouseover",function(){
			$(this).prev(".ewm").show();
			$(this).removeClass("bg-gray").addClass("bg-orge");
		});

		ztContact.find(".icon-ewm").bind("mouseleave",function(){
			$(this).prev(".ewm").hide();
			$(this).removeClass("bg-orge").addClass("bg-gray");
		});

		//返回顶部
		$(".go-top").bind("click",function(){
			$('html,body').animate({'scrollTop':0},300,function(){
				$(".go-top").hide();
			});
		});

		$(window).bind("scroll",function(){
			if($(window).scrollTop()>=300){
				$(".go-top").show();
			}
			if($(window).scrollTop()<300){
				$(".go-top").hide();
			}
		});

		//友情链接
		$(".links-more").bind("click",function(){
		    var linksInner = $(".friend-links-inner");
		    var moreThis = $(this);
		    if(linksInner.hasClass("height")){
                linksInner.removeClass("height").addClass("auto");
                moreThis.html("-");
			}
			else{
                linksInner.removeClass("auto").addClass("height");
                moreThis.html("+");
			}
		});
});

BizQQWPA.addCustom({aty: '0', a: '0', nameAccount: 4000677611, selector: 'BizQQWPA'});
</script>
</body>