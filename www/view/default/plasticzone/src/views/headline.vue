<template>
<div class="buyWrap" style="padding: 0 0 70px 0;">
	<header id="bigCustomerHeader">
		塑料发现
	</header>

	<loadingPage :loading="loadingShow"></loadingPage>
	<errorPage :loading="loadingHide"></errorPage>

	<h3 class="plasticfind">
<div style="float: left;">塑料头条</div>
<div class="plasticSearch" style="margin-right: 40px;">
<i class="searchIcon" style="position: absolute; top: 14px; left: 5px; margin: 0;"></i>
<form action="javascript:;">
<input type="text" style="width: 100%;" v-on:keydown.enter="search" v-model="keywords" placeholder="搜你想搜的" />
</form>
</div>
<div v-on:click="search" style="width: 40px; border-radius: 3px; line-height: 30px; font-size: 12px; font-weight: normal; background: #ff5000; color: #FFFFFF; position: absolute; top: 6px; right: 10px; text-align: center;">搜索</div>
</h3>
	<div class="plasticnav">
		<div class="subscribe" v-on:click="subscribe"></div>
		<div style="width: auto; margin: 0 40px 0 0;">
			<div class="swiper-container">
				<div class="swiper-wrapper">
					<div class="swiper-slide">
						<router-link class="on" :to="{name:'headlinelist',params:{id:999}}">
							推荐
						</router-link>
					</div>
					<div class="swiper-slide">
						<router-link :to="{name:'headlinelist',params:{id:2}}">
							塑料上游
						</router-link>
					</div>
					<div class="swiper-slide">
						<router-link :to="{name:'headlinelist',params:{id:1}}">
							早盘预报
						</router-link>
					</div>
					<div class="swiper-slide">
						<router-link :to="{name:'headlinelist',params:{id:9}}">
							企业动态
						</router-link>
					</div>
					<div class="swiper-slide">
						<router-link :to="{name:'headlinelist',params:{id:4}}">
							中晨塑说
						</router-link>
					</div>
					<div class="swiper-slide">
						<router-link :to="{name:'headlinelist',params:{id:5}}">
							美金市场
						</router-link>
					</div>
					<div class="swiper-slide">
						<router-link :to="{name:'headlinelist',params:{id:21}}">
							期货资讯
						</router-link>
					</div>
					<div class="swiper-slide">
						<router-link :to="{name:'headlinelist',params:{id:11}}">
							装置动态
						</router-link>
					</div>
					<div class="swiper-slide">
						<router-link :to="{name:'headlinelist',params:{id:13}}">
							期刊报告
						</router-link>
					</div>
					<div class="swiper-slide">
						<router-link :to="{name:'headlinelist',params:{id:22}}">
							独家解读
						</router-link>
					</div>
				</div>
			</div>
		</div>
	</div>

	<ul class="headlineUl2">
		<li v-for="i in items">
			<router-link :to="{name:'headlinedetail',params:{id:i.id}}">
				<h3 v-if="i.type!=='PUBLIC'">[{{i.type}}]{{i.title}}</h3>
				<h3 v-else>{{i.title}}</h3>
				<p>{{i.description}}</p>
				<p style="text-align: right;"><span style="float: left;">阅读数量:<span style=" color: #ff5000;">{{i.pv}}</span></span>{{i.input_time}}</p>
			</router-link>
		</li>
	</ul>
	<h3 class="plasticfind">
企业信用额度
</h3>
	<ul class="plasticcredit">
		<li>
			<router-link :to="{name:'credit'}">
				<i class="plasticIcon picon"></i><br>查自己
			</router-link>
		</li>
		<li>
			<router-link :to="{name:'searchcompany'}">
				<i class="plasticIcon picon2"></i><br>查别人
			</router-link>
		</li>
		<li>
			<a href="https://www.sobot.com/chat/h5/index.html?sysNum=137f8799efcb49fea05534057318dde0">
				<i class="plasticIcon picon3"></i><br>要授信
			</a>
		</li>
		<li>
			<a href="javascript:;">
				<i v-on:click="plasticlevelShow" class="plasticIcon picon4"></i><br>提额度
			</a>
		</li>
	</ul>
	<h3 class="plasticfind">
塑料配资
</h3>
	<ul class="plasticcredit2">
		<li>
			<a href="javascript:;"><i v-on:click="plasticdefineShow" class="plasticIcon picon5"></i><br>产品定义</a>
		</li>
		<li>
			<a href="javascript:;"><i v-on:click="plasticrateShow" class="plasticIcon picon6"></i><br>费率</a>
		</li>
		<li>
			<a href="https://www.sobot.com/chat/h5/index.html?sysNum=137f8799efcb49fea05534057318dde0"><i class="plasticIcon picon7"></i><br>我要申请</a>
		</li>
	</ul>
	<footerbar></footerbar>
	<div class="subscribelayer" v-show="subscribeshow">
		<h3 class="subscribetitle">
我的频道：
</h3>
		<ul class="mysubscribe">
			<li v-show="mySubscribe.indexOf('2')>=0"><i class="headlineicon hicon"></i><br>塑料上游</li>
			<li v-show="mySubscribe.indexOf('1')>=0"><i class="headlineicon hicon2"></i><br>早盘预报</li>
			<li v-show="mySubscribe.indexOf('9')>=0"><i class="headlineicon hicon3"></i><br>企业动态</li>
			<li v-show="mySubscribe.indexOf('4')>=0"><i class="headlineicon hicon4"></i><br>中晨塑说</li>
			<li v-show="mySubscribe.indexOf('20')>=0"><i class="headlineicon hicon5"></i><br>美金市场</li>
			<li v-show="mySubscribe.indexOf('21')>=0"><i class="headlineicon hicon6"></i><br>期货资讯</li>
			<li v-show="mySubscribe.indexOf('11')>=0"><i class="headlineicon hicon7"></i><br>装置动态</li>
			<li v-show="mySubscribe.indexOf('13')>=0"><i class="headlineicon hicon8"></i><br>期刊报告</li>
			<li v-show="mySubscribe.indexOf('22')>=0"><i class="headlineicon hicon9"></i><br>独家解读</li>
		</ul>
		<h3 class="subscribetitle">
全部频道：
</h3>
		<ul class="mysubscribe">
			<li><i class="headlineicon hicon"></i><br>
				<input class="subscribecheckbox" type="checkbox" disabled="disabled" v-model="subchecked" value="2" />&nbsp;塑料上游</li>
			<li><i class="headlineicon hicon2"></i><br>
				<input class="subscribecheckbox" type="checkbox" v-model="subchecked" value="1" />&nbsp;早盘预报</li>
			<li><i class="headlineicon hicon3"></i><br>
				<input class="subscribecheckbox" type="checkbox" v-model="subchecked" value="9" />&nbsp;企业动态</li>
			<li><i class="headlineicon hicon4"></i><br>
				<input class="subscribecheckbox" type="checkbox" v-model="subchecked" value="4" />&nbsp;中晨塑说</li>
			<li><i class="headlineicon hicon5"></i><br>
				<input class="subscribecheckbox" type="checkbox" disabled="disabled" v-model="subchecked" value="20" />&nbsp;美金市场</li>
			<li><i class="headlineicon hicon6"></i><br>
				<input class="subscribecheckbox" type="checkbox" disabled="disabled" v-model="subchecked" value="21" />&nbsp;期货资讯</li>
			<li><i class="headlineicon hicon7"></i><br>
				<input class="subscribecheckbox" type="checkbox" disabled="disabled" v-model="subchecked" value="11" />&nbsp;装置动态</li>
			<li><i class="headlineicon hicon8"></i><br>
				<input class="subscribecheckbox" type="checkbox" v-model="subchecked" value="13" />&nbsp;期刊报告</li>
			<li><i class="headlineicon hicon9"></i><br>
				<input class="subscribecheckbox" type="checkbox" v-model="subchecked" value="22" />&nbsp;独家解读</li>
		</ul>
		<div class="subscribebtn">
			<span class="subplasticbtn" v-on:click="subscribeSave">保存</span>&nbsp;&nbsp;&nbsp;
			<span class="subplasticbtn" v-on:click="subscribeClose">关闭</span>
		</div>
	</div>
	<div class="plasticdefine" v-if="plasticdefine">
		<div class="plasticdefineWrap" v-on:click="plasticHide"></div>
	</div>
	<div class="plasticlevel" v-if="plasticlevel">
		<div class="plasticlevelWrap" v-on:click="plasticHide"></div>
	</div>
	<div class="plasticrate" v-if="plasticrate">
		<div class="plasticrateWrap" v-on:click="plasticHide"></div>
	</div>
</div>
</template>
<script>
import footer from "../components/footer";
import loadingPage from "../components/loadingPage";
import errorPage from "../components/errorPage";
export default {
	components: {
		'footerbar': footer,
		'loadingPage': loadingPage,
		'errorPage': errorPage
	},
	data: function() {
		return {
			cate: "",
			items: [],
			mySubscribe: [],
			subscribeshow: false,
			subchecked: [],
			keywords: "",
			loadingShow: "",
			loadingHide: "",
			plasticlevel:false,
			plasticdefine:false,
			plasticrate:false
		}
	},
	beforeRouteEnter: function(to, from, next) {
		next(function(vm) {
			vm.loadingShow = true;
		});
	},
	beforeRouteLeave: function(to, from, next) {
		next(function() {});
		this.loadingHide = false;
	},
	methods: {
		plasticlevelShow:function(){
			this.plasticlevel=true;
		},
		plasticdefineShow:function(){
			this.plasticdefine=true;
		},
		plasticrateShow:function(){
			this.plasticrate=true;
		},
		plasticHide:function(){
			this.plasticdefine=false;
			this.plasticlevel=false;
			this.plasticrate=false;
		},
		subscribe: function() {
			this.subscribeshow = true;
		},
		subscribeClose: function() {
			this.subscribeshow = false;
		},
		subscribeSave: function() {
			var _this = this;
			this.subscribeshow = false;
			$.ajax({
				type: "post",
				url: version + '/toutiao/getSelectCate',
				data: {
					token: window.localStorage.getItem("token"),
					cate_id: _this.subchecked,
					type: 1
				},
				headers: {
					'X-UA': window.localStorage.getItem("XUA")
				},
				dataType: 'JSON'
			}).then(function(res) {
				if(res.err == 0) {
					$.ajax({
						type: "post",
						url: version + '/toutiao/getSelectCate',
						data: {
							token: window.localStorage.getItem("token"),
							type: 2
						},
						headers: {
							'X-UA': headers
						},
						dataType: 'JSON'
					}).then(function(res) {
						if(res.err == 0) {
							_this.mySubscribe = res.data;
							_this.subchecked = res.data;
						} else {

						}
					}, function() {

					});
				} else {

				}
			}, function() {

			});
		},
		search: function() {
			var _this = this;
			if(this.keywords) {
				try {
					var piwikTracker = Piwik.getTracker("http://wa.myplas.com/piwik.php", 2);
					piwikTracker.trackSiteSearch(this.keywords, "keywords", 20);
				} catch(err) {}

				$.ajax({
					url: version + '/toutiao/getSubscribe',
					type: 'post',
					data: {
						keywords: _this.keywords,
						page: 1,
						subscribe: 1,
						token: window.localStorage.getItem("token")
					},
					headers: {
						'X-UA': window.localStorage.getItem("XUA")
					},
					dataType: 'JSON'
				}).done(function(res) {
					if(res.err == 0) {
						_this.items = res.data.slice(0, 3);
					}
				}).fail(function() {

				}).always(function() {

				});
			} else {

			}
		}
	},
	activated: function() {
		try {
			var piwikTracker = Piwik.getTracker("http://wa.myplas.com/piwik.php", 2);
			piwikTracker.trackPageView();
		} catch(err) {

		}
		var _this = this;
		window.scrollTo(0, 0);

		$.ajax({
			type: "post",
			url: version + '/toutiao/getSelectCate',
			data: {
				token: window.localStorage.getItem("token"),
				type: 2
			},
			headers: {
				'X-UA': window.localStorage.getItem("XUA")
			},
			dataType: 'JSON'
		}).done(function(res) {
			if(res.err == 0) {
				_this.mySubscribe = res.data;
				_this.subchecked = res.data;
			} else {

			}
		}).fail(function() {

		}).always(function() {

		});

		$.ajax({
			type: "post",
			url: version + '/toutiao/getSubscribe',
			timeout: 15000,
			data: {
				token: window.localStorage.getItem("token"),
				subscribe: 2
			},
			headers: {
				'X-UA': window.localStorage.getItem("XUA")
			},
			dataType: 'JSON'
		}).done(function(res) {
			if(res.err == 0) {
				_this.items = res.data.slice(0, 3);
			} else if(res.err == 1) {
				weui.alert(res.msg, {
					title: '塑料圈通讯录',
					buttons: [{
						label: '确定',
						type: 'parimary',
						onClick: function() {
							_this.$router.push({
								name: 'login'
							});
						}
					}]
				});
			}
		}).fail(function() {
			_this.loadingHide = true;
		}).always(function() {
			_this.loadingShow = false;
		});

		this.$nextTick(function() {
			var swiper = new Swiper('.swiper-container', {
				slidesPerView: 4,
				spaceBetween: 15,
				freeMode: true
			});
		});

	}
}
</script>