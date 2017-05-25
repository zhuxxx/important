__layout|public:main_layout|layout__
<script type="text/javascript" src="__JS__/home/MSClass.js"></script>
<script type="text/javascript">
    var oil1 = <?php echo json_encode($this->_var['oil1']); ?>;        //WIT
    var oil2 = <?php echo json_encode($this->_var['oil2']); ?>;        //布油
    var quotation = <?php echo json_encode($this->_var['quotation']); ?>;
</script>

<!--banner begin-->
<div class="banner">
    <!--bannerSlidePlayer begin-->
    <div id="bannerSlidePlayer" class="main_visual">
        <ul class="main_image clearfix">
            <?php $_from = $this->_var['banners']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->_push_vars('', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['value']):
?>
            <li class="element">
                <a href="<?php echo $this->_var['value']['url']; ?>" target="_blank">
                    <img src="__UPLOAD__/<?php echo $this->_var['value']['img']; ?>" alt="<?php echo $this->_var['value']['title']; ?>">
                </a>
            </li>
            <?php endforeach; endif; unset($_from); ?><?php $this->_pop_vars();; ?>
        </ul>
        <div class="flicking_con"></div>
        <a href="javascript:void(0);" id="btn_prev" class="hidden"></a>
        <a href="javascript:void(0);" id="btn_next" class="hidden"></a>
    </div>
    <!--bannerSlidePlayer begin-->
     <!--banner-menu begin-->
        <div class="banner-menu">
            <!--left begin-->
            <div class="left flt">
                <ul>
                    <li id="tab1" onmouseover="setTab('tab',1,6)"  class="hover"><span></span>供应信息</li>
                    <li id="tab2" onmouseover="setTab('tab',2,6)"><span></span>求购信息</li>
                    <li id="tab3" onmouseover="setTab('tab',3,6)"><span></span>中晨物流</li>
                    <li id="tab4" onmouseover="setTab('tab',4,6)"><span></span>塑料金融</li>
                    <li id="tab5" onmouseover="setTab('tab',5,6)"><span></span>我要求购</li>
                    <li id="tab6" onmouseover="setTab('tab',6,6)"><span></span>用户登录</li>
                </ul>
            </div>
            <!--left end-->
            <!--right begin-->
            <div class="right frt">
                <!--con-tab-1 begin-->
                <div id="con-tab-1">
                    <!--search begin-->
                    <div class="search">
                        <form method="get" action="/offers">
                            <input type="text" name="keywords" placeholder="请输入牌号、厂家等搜索关键词" class="serch-ipt"/>
                            <input type="submit" class="search-smt" value=""/>
                        </form>
                    </div>
                    <!--search end-->
                    <!--variety begin-->
                    <ul class="variety">
                        <li class="variety1"><b></b><span><a href="/offers?type=1">高密度聚乙烯 HDPE</a></span></li>
                        <li class="variety2 cancel-margin"><b></b><span><a href="/offers?type=2">低密度聚乙烯 LDPE</a></span></li>
                        <li class="variety3"><b></b><span><a href="/offers?type=3">线性聚乙烯 LLDPE</a></span></li>
                        <li class="variety4 cancel-margin"><b></b><span><a href="/offers?type=4">聚丙烯 PP</a></span></li>
                        <li class="variety5"><b></b><span><a href="/offers?type=5">聚氯乙烯 PVC</a></span></li>
                        <li class="variety6 cancel-margin"><b></b><span><a href="/offers">其他</a></span></li>
                    </ul>
                    <!--variety end-->
                    <!--use begin-->
                    <ul class="use other">
                        <?php $_from = $this->_var['process_level']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->_push_vars('key', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['value']):
?>
                        <?php if ($this->_var['key'] <= 7): ?>
                        <li><a href="/offers?process=<?php echo $this->_var['key']; ?>"><?php echo $this->_var['value']; ?></a></li>
                        <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?><?php $this->_pop_vars();; ?>
                        <a href="/offers"><li class="menu-more"></li></a>
                        <!--<a href="/opus"><li class="menu-more"></li></a>-->
                    </ul>
                    <!--use end-->
                    <!--region begin-->
                    <ul class="region other">
                        <?php $_from = $this->_var['area']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->_push_vars('key', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['value']):
?>
                        <?php if ($this->_var['key'] <= 6): ?>
                        <li><a href="/offers?ct=<?php echo $this->_var['value']['id']; ?>"><?php echo $this->_var['value']['name']; ?></a></li>
                        <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?><?php $this->_pop_vars();; ?>
                        <a href="/offers"><li class="menu-more"></li></a>
                        <!--<a href="/opus"><li class="menu-more"></li></a>-->
                    </ul>
                    <!--region end-->
                </div>
                <!--con-tab-1 end-->
                <!--con-tab-2 begin-->
                <div id="con-tab-2" style="display:none;" class="color3">
                    <!--search begin-->
                    <div class="search">
                        <form name="" method="get" action="/purchase">
                            <input type="text" placeholder="请输入牌号、厂家等搜索关键词" name="keywords" class="serch-ipt"/>
                            <input type="submit" class="search-smt" value=""/>
                        </form>
                    </div>
                    <!--search end-->
                    <h3>牌号新采购</h3>
                    <!--<ul>-->
                        <!--<?php $_from = $this->_var['newPur']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->_push_vars('', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['value']):
?>-->
                        <!--<li><?php echo witchType($this->_var['value']['product_type']); ?> <?php echo $this->_var['value']['model']; ?> <?php echo $this->_var['value']['f_name']; ?> <?php echo floatval($this->_var['value']['number']); ?>吨  <?php echo $this->_var['value']['cityname']; ?>  <?php echo date("Y-m-d",$this->_var['value']['input_time']); ?></li>-->
                        <!--<?php endforeach; endif; unset($_from); ?><?php $this->_pop_vars();; ?>-->
                    <!--</ul>-->
                    <ul>
                        <?php $_from = $this->_var['newPurs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->_push_vars('', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['value']):
?>
                        <li><?php echo witchType($this->_var['value']['product_type']); ?><b><?php echo $this->_var['value']['model']; ?></b><b><?php echo $this->_var['value']['f_name']; ?></b> <?php echo floatval($this->_var['value']['number']); ?>吨<b><?php echo $this->_var['value']['pickup_location']; ?></b><span><?php echo date("Y-m-d",$this->_var['value']['update_time']); ?></span></li>
                        <?php endforeach; endif; unset($_from); ?><?php $this->_pop_vars();; ?>
                    </ul>
                    <p><a href="/purchase">更多求购>></a></p>
                </div>
                <!--con-tab-2 end-->
                <!--con-tab-3 begin-->
                <div id="con-tab-3" style="display:none;">
                    <!--transport begin-->
                    <div class="transport">
                        <form name="" method="post" action="">
                            <ul class="search-inner">
                                <!--addr-from begin-->
                                <li class="input addr addr-from">
                                    <input type="text" placeholder="选择装点..."/>
                                    <div class="sub-from">
                                        <div class="arrow"></div>
                                        <ul>
                                            <li><b></b><span>上海宝山区</span></li>
                                            <li><b></b><span>上海外高桥保税仓库</span></li>
                                            <li><b></b><span>上海洋山地区</span></li>
                                            <li><b></b><span>上海金山区</span></li>
                                            <li><b></b><span>上海奉贤区</span></li>
                                        </ul>
                                    </div>
                                    <!--error-msg begin-->
                                    <div class="error-msg">
                                        <div class="arrow"></div>
                                        <p>请先选择装点</p>
                                    </div>
                                    <!--error-msg end-->
                                </li>
                                <!--addr-from end-->
                                <!--addr-to begin-->
                                <li class="input addr addr-to">
                                    <input type="text" placeholder="选择卸点..."/>
                                     <!--sub-to begin-->
                                    <div class="sub-to">
                                        <div class="arrow"></div>
                                        <!--sub-to-con begin-->
                                        <div class="sub-to-con">
                                            <!--xl begin-->
                                            <div class="xl">
                                                 <!--xl-tr begin-->
                                                 <div class="xl-tr">
                                                    <!--xl-td begin-->
                                                    <div class="xl-td">
                                                        <div class="one"><b>A</b><span data-index="0">安庆</span></div>
                                                        <div class="two"></div>
                                                    </div>
                                                    <!--xl-td end-->
                                                    <!--xl-td begin-->
                                                    <div class="xl-td">
                                                        <div class="one">
                                                            <b>Q</b>
                                                            <span data-index="1">衢州</span>
                                                        </div>
                                                        <div class="two"></div>
                                                    </div>
                                                    <!--xl-td end-->
                                                </div>
                                                <!--xl-tr end-->
                                                <!--xl-tr begin-->
                                                <div class="xl-tr">
                                                    <!--xl-td begin-->
                                                    <div class="xl-td">
                                                        <div class="one"><b>B</b><span data-index="2">蚌埠</span></div>
                                                        <div class="two"></div>
                                                    </div>
                                                    <!--xl-td end-->
                                                    <!--xl-td begin-->
                                                    <div class="xl-td">
                                                        <div class="one">
                                                            <b>S</b>
                                                            <span data-index="3">上海</span>
                                                            <span data-index="4">绍兴</span>
                                                            <span data-index="5">苏州</span>
                                                            <span data-index="6">宿迁</span>
                                                        </div>
                                                        <div class="two"></div>
                                                    </div>
                                                    <!--xl-td end-->
                                                </div>
                                                <!--xl-tr end-->
                                                <!--xl-tr begin-->
                                                <div class="xl-tr">
                                                    <!--xl-td begin-->
                                                    <div class="xl-td">
                                                        <div class="one">
                                                            <b>C</b>
                                                            <span data-index="7">常州</span>
                                                            <span data-index="8">滁州</span>
                                                        </div>
                                                        <div class="two"></div>
                                                    </div>
                                                    <!--xl-td end-->
                                                    <!--xl-td begin-->
                                                    <div class="xl-td">
                                                        <div class="one">
                                                            <b>T</b>
                                                            <span data-index="9">台州</span>
                                                            <span data-index="10">泰州</span>
                                                        </div>
                                                        <div class="two"></div>
                                                    </div>
                                                    <!--xl-td end-->
                                                </div>
                                                <!--xl-tr end-->
                                                <!--xl-tr begin-->
                                                <div class="xl-tr">
                                                    <!--xl-td begin-->
                                                    <div class="xl-td">
                                                        <div class="one">
                                                            <b>H</b>
                                                            <span data-index="11">杭州</span>
                                                            <span data-index="12">湖州</span>
                                                            <span data-index="13">淮安</span>
                                                            <span data-index="14">合肥</span>
                                                            <span data-index="15">黄山</span>
                                                        </div>
                                                        <div class="two"></div>
                                                    </div>
                                                    <!--xl-td end-->
                                                    <!--xl-td begin-->
                                                    <div class="xl-td">
                                                        <div class="one">
                                                            <b>W</b>
                                                            <span data-index="16">温州</span>
                                                            <span data-index="17">无锡</span>
                                                            <span data-index="18">芜湖</span>
                                                        </div>
                                                        <div class="two"></div>
                                                    </div>
                                                    <!--xl-td end-->
                                                </div>
                                                <!--xl-tr end-->
                                                <!--xl-tr begin-->
                                                <div class="xl-tr">
                                                    <!--xl-td begin-->
                                                    <div class="xl-td">
                                                        <div class="one">
                                                            <b>J</b>
                                                            <span data-index="19">嘉兴</span>
                                                            <span data-index="20">金华</span>
                                                        </div>
                                                        <div class="two"></div>
                                                    </div>
                                                    <!--xl-td end-->
                                                    <!--xl-td begin-->
                                                    <div class="xl-td">
                                                        <div class="one">
                                                            <b>X</b>
                                                            <span data-index="21">徐州</span>
                                                            <span data-index="22">宣城</span>
                                                        </div>
                                                        <div class="two"></div>
                                                    </div>
                                                    <!--xl-td end-->
                                                </div>
                                                <!--xl-tr end-->
                                                <!--xl-tr begin-->
                                                <div class="xl-tr">
                                                    <!--xl-td begin-->
                                                    <div class="xl-td">
                                                        <div class="one">
                                                            <b>L</b>
                                                            <span data-index="23">连云港</span>
                                                            <span data-index="24">六安</span>
                                                        </div>
                                                        <div class="two"></div>
                                                    </div>
                                                    <!--xl-td end-->
                                                    <!--xl-td begin-->
                                                    <div class="xl-td">
                                                        <div class="one">
                                                            <b>Y</b>
                                                            <span data-index="25">盐城</span>
                                                            <span data-index="26">扬州</span>
                                                        </div>
                                                        <div class="two"></div>
                                                    </div>
                                                    <!--xl-td end-->
                                                </div>
                                                <!--xl-tr end-->
                                                <!--xl-tr begin-->
                                                <div class="xl-tr">
                                                    <!--xl-td begin-->
                                                    <div class="xl-td">
                                                        <div class="one">
                                                            <b>M</b>
                                                            <span data-index="27">马鞍山</span>
                                                        </div>
                                                        <div class="two"></div>
                                                    </div>
                                                    <!--xl-td end-->
                                                    <!--xl-td begin-->
                                                    <div class="xl-td">
                                                        <div class="one">
                                                            <b>Z</b>
                                                            <span data-index="28">镇江</span>
                                                        </div>
                                                        <div class="two"></div>
                                                    </div>
                                                    <!--xl-td end-->
                                                </div>
                                                <!--xl-tr end-->
                                                <!--xl-tr begin-->
                                                <div class="xl-tr">
                                                    <!--xl-td begin-->
                                                    <div class="xl-td">
                                                        <div class="one">
                                                            <b>N</b>
                                                            <span data-index="29">宁波</span>
                                                            <span data-index="30">南京</span>
                                                            <span data-index="31">南通</span>
                                                        </div>
                                                        <div class="two"></div>
                                                    </div>
                                                    <!--xl-td end-->
                                                </div>
                                                <!--xl-tr end-->
                                            </div>
                                            <!--xl end-->
                                        </div>
                                        <!--sub-to-con end-->
                                    </div>
                                    <!--sub-to end-->
                                </li>
                                <!--addr-to end-->
                                <!--num begin-->
                                <li class="input num">
                                    <input type="text" placeholder="输入吨数" onkeyup="setCon(this)"/>
                                    <!--error-msg begin-->
                                    <div class="error-msg">
                                        <div class="arrow"></div>
                                        <p></p>
                                    </div>
                                    <!--error-msg end-->
                                </li>
                                <!--num end-->
                                <li class="btn">查运价</li>
                            </ul>
                        </form>
                    </div>
                    <!--transport end-->
                    <!--trans-other begin-->
                    <ul class="trans-other">
                        <li class="other1"><div></div><p>安全交易</p></li>
                        <li class="other2"><div></div><p>合作物流</p></li>
                        <li class="other3"><div></div><p>最低价格</p></li>
                        <li class="other4"><div></div><p>真人找车</p></li>
                    </ul>
                    <!--trans-other end-->
                    <!--trans-result begin-->
                    <div class="trans-result">
                        <h4>运价查询结果</h4>
                        <table border="0" cellpadding="0" cellspacing="0">
                            <tr>
                                <td class="name">装点</td>
                                <td class="from">上海外高桥保税仓库</td>
                            </tr>
                            <tr>
                                <td class="name">卸点</td>
                                <td class="to">衢州|龙游县</td>
                            </tr>
                            <tr>
                                <td class="name">吨数</td>
                                <td class="weight">12</td>
                            </tr>
                            <tr>
                                <td class="name">预计运费</td>
                                <td class="trans-price"><b>￥<span class="price"></span></b>（该报价含<span>开票费</span>和<span>上车费</span>）</td>
                            </tr>
                            <tr align="center">
                                <td colspan="2">
                                    <div class="order-car-btn"><a style="color:#fff;" href="/ship">我要订车</a></div>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <!--trans-result end-->
                </div>
                <!--con-tab-3 end-->
                <!--con-tab-4 begin-->
                <div id="con-tab-4" style="display:none;">
                    <!--menu-spy-chn begin-->
                    <div class="menu-spy-chn">
                        <!--business1 begin-->
                        <div class="business business1">
                            <h4>针对<span>仓单融资</span>业务</h4>
                            <ul>
                                <li class="item1"><p><b></b></p><span>最高预付<i>80%</i>货款</span></li>
                                <li class="item2"><p><b></b></p><span>按天计算月息低至<i>1%</i></span></li>
                                <li class="item3"><p><b></b></p><span><i>48</i>小时内货款到账</span></li>
                            </ul>
                        </div>
                        <!--business1 end-->
                        <!--business1 begin-->
                        <div class="business business2">
                            <h4>针对<span>订单融资</span>业务</h4>
                            <ul>
                                <li class="item1"><p><b></b></p><span>无需<i>抵押</i> 无需<i>担保</i></span></li>
                                <li class="item2"><p><b></b></p><span>订单货物<i>先行</i>提取</span></li>
                                <li class="item3"><p><b></b></p><span>按天计算收费低至<i>8元/吨</i></span></li>
                            </ul>
                        </div>
                        <!--business1 end-->
                    </div>
                    <!--menu-spy-chn end-->
                    <div class="apply"><a href="/finance">立即申请</a></div>
                </div>
                <!--con-tab-4 end-->
                <!--con-tab-5 begin-->
                <div id="con-tab-5" style="display:none;">
                    <h3>快速发布采购</h3>
                    <p class="how color3">委托发货>>选择保价>>交易完成</p>
                    <p class="msg"></p>
                    <table border="0" cellpadding="0" cellspacing="0">
                        <form name="" id="contentForm" method="post" action="">
                            <tr>
                                <td class="name">牌号</td>
                                <td><input type="text" name="model" class="input border-gray grade" maxlength="15" /></td>
                            </tr>
                            <tr class="num">
                                <td class="name">数量</td>
                                <td><input type="text" name="num" class="input border-gray amount" onkeyup="setCon(this)"/>吨</td>
                            </tr>
                            <tr class="num">
                                <td class="name">意向价格</td>
                                <td><input type="text" name="price" class="input border-gray price" onkeyup="setCon(this)"/>元</td>
                            </tr>
                            <tr>
                                <td class="name">交货地</td>
                                <td><input type="text" name="place" class="input border-gray place" maxlength="40" /></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="button" value="免费委托发布" class="submit"/>
                                </td>
                            </tr>
                        </form>
                    </table>
                </div>
                <!--con-tab-5 end-->
                <!--con-tab-6 begin-->
                <div id="con-tab-6" style="display:none;">
                <if condition="$_SESSION['webUserId'] neq ''">
                <?php if ($_SESSION['userid'] > 0): ?>
                    <h2 style="margin: 141px auto;text-align: center;">已登录，<a href="/user/logout" style="color:#fc6621;">退出登录</a>。</h2>
                <?php else: ?>
                    <!--login-title begin-->
                    <div class="login-title">
                        <h3>登录我的塑料网</h3>
                        <span>还没有账号？<a href="/user/register">30秒注册</a></span>
                    </div>
                    <!--login-title end-->
                    <p class="msg"></p>
                    <table border="0" cellpadding="0" cellspacing="0">
                        <form name="" id="loginForm" method="post" action="">
                            <tr>
                                <td>
                                    <div class="login-wrap">
                                        <div class="login-icon"><img src="__IMG__/home/iconLog1.png" width="17" height="17"/></div>
                                        <div class="login-input"><input type="text" name="username" id="user" class="user" value="" placeholder="请输入账号"/></div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="login-wrap pwd">
                                        <div class="login-icon"><img src="__IMG__/home/iconLog2.png" width="14" height="17"/></div>
                                        <div class="login-input"><input type="password" name="password" id="pwd" class="pwd" placeholder="请输入密码"/></div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="forget link3">
                                <td><a href="/user/findpwd">忘记密码？</a></td>
                            </tr>
                            <tr>
                                <td><input type="submit" value="登录" class="submit"/></td>
                            </tr>
                            <tr class="other link3">
                                <td>
                                    <div class="qq">
                                        <a href="/user/login/auth">QQ登录</a>
                                    </div>
                                    <!--&lt;!&ndash; <div class="blog"><a href="javascript:;">微博登录</a></div> &ndash;&gt;-->
                                </td>
                            </tr>
                        </form>
                    </table>
                <?php endif; ?>
                </if>
                </div>
                <!--con-tab-6 end-->
            </div>
            <!--right end-->
        </div>
        <!--banner-menu end-->
</div>
<!--banner end-->
<!--price-dynamic begin-->
<div class="price-dynamic w1220">
	<!--left begin-->
    <div class="left flt">
    	<div class="title">行情中心</div>
        <!--slider begin-->
        <!--slider begin-->
        <div class="slider">
            <div class="mr_frbox">
                 <img class="mr_btn mr_frBtnL prev" src="__IMG__/home/arrowsLt.png" width="46" height="46"/>
                  <div class="mr_frUl">
                  <ul>
                        <?php $_from = $this->_var['readjust']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->_push_vars('', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['value']):
?>
                       <li class="<?php if ($this->_var['value']['type'] == 1): ?>up<?php elseif ($this->_var['value']['type'] == 2): ?>down<?php else: ?>tie<?php endif; ?>">

                            <h3><span><?php echo $this->_var['value']['cj']; ?></span><?php echo $this->_var['value']['ph']; ?></h3>
                            <div class="data">
                                <div class="data-lt"><span></span><?php echo $this->_var['value']['price']; ?></div>
                                <div class="data-rt">
                                    <p><?php if ($this->_var['value']['type'] == 1): ?>+<?php else: ?>-<?php endif; ?><?php echo $this->_var['value']['num']; ?></p>
                                    <p><?php echo $this->_var['value']['rate']; ?>%</p>
                                </div>
                            </div>
                            <p class="time"><span><?php echo date("m月d日",$this->_var['value']['input_time']); ?></span><?php echo date("H:i",$this->_var['value']['input_time']); ?></p>
                        </li>
                        <?php endforeach; endif; unset($_from); ?><?php $this->_pop_vars();; ?>
                  </ul>
                  </div>
                <img class="mr_btn mr_frBtnR next" src="__IMG__/home/arrowsRt.png" width="46" height="46"/>
            </div>
            <!-- <div class="track example-1">
                <div class="inner">
                    <div class="view-port">
                        <div class="slider-container"  id="example-1">
                            <?php $_from = $this->_var['readjust']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->_push_vars('', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['value']):
?>
                            <div class="item <?php if ($this->_var['value']['type'] == 1): ?>up<?php elseif ($this->_var['value']['type'] == 2): ?>down<?php else: ?>tie<?php endif; ?>">
                                <h3><span><?php echo $this->_var['value']['cj']; ?></span><?php echo $this->_var['value']['ph']; ?></h3>
                                <div class="data">
                                    <div class="data-lt"><span></span><?php echo $this->_var['value']['price']; ?></div>
                                    <div class="data-rt">
                                        <p><?php if ($this->_var['value']['type'] == 1): ?>+<?php else: ?>-<?php endif; ?><?php echo $this->_var['value']['num']; ?></p>
                                        <p><?php echo $this->_var['value']['rate']; ?>%</p>
                                    </div>
                                </div>
                                <p class="time"><span><?php echo date("m月d日",$this->_var['value']['input_time']); ?></span><?php echo date("H:i",$this->_var['value']['input_time']); ?></p>
                            </div>
                            <?php endforeach; endif; unset($_from); ?><?php $this->_pop_vars();; ?>
                        </div>
                  </div>
                </div>
                <div class="pagination">
                    <a href="#" class="prev disabled"></a>
                    <a href="#" class="next disabled"></a>
                </div>
            </div> -->
        </div>
        <!---slider end-->
    </div>
    <!--left end-->
    <!--right begin-->
    <div class="right frt">
        <div class="title">
            <ul>
                <li id="taba1" onmouseover="setTab('taba',1,3)" class="hover"><span>网站指数</span><b></b>/</li>
                <li id="taba2" onmouseover="setTab('taba',2,3)"><span>WTI</span><b></b>/</li>
                <li id="taba3" onmouseover="setTab('taba',3,3)"><span>布油</span><b></b></li>
                <!-- <li id="taba4" onmouseover="setTab('taba',4,8)"><span>LDPE</span><b></b>/</li>
                <li id="taba5" onmouseover="setTab('taba',5,8)"><span>LLDPE</span><b></b>/</li>
                <li id="taba6" onmouseover="setTab('taba',6,8)"><span>PP</span><b></b>/</li>
                <li id="taba7" onmouseover="setTab('taba',7,8)"><span>PVC</span><b></b>/</li>
                <li id="taba8" onmouseover="setTab('taba',8,8)"><span>HDPE</span><b></b></li> -->
            </ul>
        </div>
        <!--taba begin-->
        <div class="taba">
            <!--con-taba-1 begin-->
            <div class="taba-con" id="con-taba-1">
                <!--web-index begin-->
                <ul class="web-index">
                    <li>
                         <dl class="web-index-lt flt web-index-supply">
                             <dt class="icon"></dt>
                             <dd>
                                 <p class="explain">供应总量</p>
                                 <p class="num"><span><?php echo $this->_var['service']['0']; ?></span>吨</p>
                             </dd>
                         </dl>
                         <dl class="web-index-rt flt web-index-demand">
                             <dt class="icon"></dt>
                             <dd>
                                 <p class="explain">需求总量</p>
                                 <p class="num"><span><?php echo $this->_var['service']['1']; ?></span>吨</p>
                             </dd>
                         </dl>
                     </li>
                     <li>
                         <dl class="web-index-total">
                             <dt class="icon"></dt>
                             <dd>
                                 <p class="explain">交易总额</p>
                                 <p class="num"><span><?php echo $this->_var['service']['2']; ?></span>元</p>
                             </dd>
                         </dl>
                     </li>
                </ul>
                <!--web-index end-->
            </div>
            <!--con-taba-1 end-->
            <div class="taba-con" id="con-taba-2"></div>
            <div class="taba-con" id="con-taba-3"></div>
            <!-- <div class="taba-con" id="con-taba-4"></div>
            <div class="taba-con" id="con-taba-5"></div>
            <div class="taba-con" id="con-taba-6"></div>
            <div class="taba-con" id="con-taba-7"></div>
            <div class="taba-con" id="con-taba-8"></div> -->
        </div>
        <!--taba end-->
        <div class="title">网站指数</div>
        <!--web-index begin-->
        <!-- <ul class="web-index">
            <li>
                 <dl class="web-index-lt flt web-index-supply">
                     <dt class="icon"></dt>
                     <dd>
                         <p class="explain">供应总量</p>
                         <p class="num"><span><?php echo $this->_var['service']['0']; ?></span>吨</p>
                     </dd>
                 </dl>
                 <dl class="web-index-rt flt web-index-demand">
                     <dt class="icon"></dt>
                     <dd>
                         <p class="explain">需求总量</p>
                         <p class="num"><span><?php echo $this->_var['service']['1']; ?></span>吨</p>
                     </dd>
                 </dl>
             </li>
             <li>
                 <dl class="web-index-total">
                     <dt class="icon"></dt>
                     <dd>
                         <p class="explain">交易总额</p>
                         <p class="num"><span><?php echo $this->_var['service']['2']; ?></span>元</p>
                     </dd>
                 </dl>
             </li>
        </ul> -->
        <!--web-index end-->
    </div>
    <!--right end-->
</div>
<!--price-dynamic end-->
<!--index begin-->
<!-- <div class="index w1220">
    <div class="left flt">
        <div class="title">原油指数</div>
        <div class="oil-index">
            <div class="oil-k oil-blt">
                <div class="oil-k-title">
                    <h3>WTI</h3>
                    <span class="data"><?php echo $this->_var['oil1']['last']['price']; ?></span>
                    <span class="time"><b><?php echo date("m月d日",$this->_var['oil1']['last']['input_time']); ?></b></span>
                </div>
                <div class="oil-con" id="oil-blt-con"></div>
            </div>
            <div class="oil-k oil-wti">
                <div class="oil-k-title">
                    <h3>布油</h3>
                    <span class="data"><?php echo $this->_var['oil2']['last']['price']; ?></span>
                    <span class="time"><b><?php echo date("m月d日",$this->_var['oil2']['last']['input_time']); ?></b></span>
                </div>
                <div class="oil-con" id="oil-wti-con"></div>
            </div>
        </div>
    </div>
    <div class="right frt">
        <div class="title">
            <ul>
                <?php $_from = $this->_var['product_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->_push_vars('key', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['value']):
?>
                <li id="taba<?php echo $this->_var['key']; ?>" onmouseover="setTab('taba',<?php echo $this->_var['key']; ?>,6)" <?php if ($this->_var['key'] == 1): ?>class="hover"<?php endif; ?>><span><?php echo $this->_var['value']; ?></span><b></b>/
                </li>
                <?php endforeach; endif; unset($_from); ?><?php $this->_pop_vars();; ?>
            </ul>
        </div>
        <div class="taba">
            <div class="taba-con" id="con-taba-1"></div>
            <div class="taba-con" id="con-taba-2"></div>
            <div class="taba-con" id="con-taba-3"></div>
            <div class="taba-con" id="con-taba-4"></div>
            <div class="taba-con" id="con-taba-5"></div>
            <div class="taba-con" id="con-taba-6"></div>
        </div>
    </div>
</div> -->
<!--index end-->
<!--floor1 begin-->
<div class="floor floor1 w1220">
	<!--floor-title begin-->
    <div class="floor-title">
        <!--left begin-->
        <div class="left flt">
            <span>1F 供货信息</span>
            <b>实时成交价：</b>
            <ul id="news-text">
                <?php $_from = $this->_var['deals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->_push_vars('key', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['value']):
?>
                <li>
                    <span class="time"><?php echo date("m-d H:i",$this->_var['value']['input_time']); ?></span>
                    <span><?php echo witchType($this->_var['value']['product_type']); ?>   <?php echo $this->_var['value']['model']; ?></span>
                    <span><?php echo $this->_var['value']['f_name']; ?></span>
                    <span class="amount"><?php echo $this->_var['value']['unit_price']; ?>/吨</span>
                </li>
                <?php endforeach; endif; unset($_from); ?><?php $this->_pop_vars();; ?>
            </ul>
            <script type="text/javascript">new Marquee("news-text","down",2,370,15,0,4000)</script>
            <!--<a href="javascript:;">更多成交价>></a>-->
        </div>
        <!--left end-->
         <!--right begin-->
        <div class="right flt">即时抢货</div>
        <!--right end-->
    </div>
    <!--floor-title end-->
    <!--supply-demand begin-->
    <div class="supply-demand info">
    	<!--left begin-->
        <div class="left flt">
        	<!--info-title begin-->
        	<ul class="info-title color3">
            	<li class="breed">品种</li>
                <li class="grade">牌号</li>
                <li class="level">加工级别</li>
                <li class="factory">厂家</li>
                <li class="amount">数量（吨）</li>
                <li class="price">价格（元 / 吨）</li>
                <li class="place">交货地</li>
                <li class="time">时间</li>
                <li class="opt">操作</li>
            </ul>
            <!--info-title end-->
            <!--info-con begin-->
            <ul class="info-con color6">
                <?php $_from = $this->_var['purSale']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->_push_vars('', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['value']):
?>

            	<li class="supply">
                	<div class="breed"><?php if ($this->_var['value']['cargo_type'] == 1): ?><span class="xian"></span><?php else: ?> <span class="qi"></span> <?php endif; ?><?php if ($this->_var['value']['product_type']): ?><?php echo witchType($this->_var['value']['product_type']); ?><?php else: ?>&nbsp;<?php endif; ?></div>
                    <div class="grade"><?php if ($this->_var['value']['model']): ?><?php echo $this->_var['value']['model']; ?><?php else: ?>&nbsp;<?php endif; ?></div>
                    <div class="level"><?php if ($this->_var['value']['process_type']): ?><?php echo setOption(process_level,$this->_var['value']['process_type']); ?><?php else: ?>&nbsp;<?php endif; ?></div>
                    <div class="factory"><?php if ($this->_var['value']['f_name']): ?><?php echo $this->_var['value']['f_name']; ?><?php else: ?>&nbsp;<?php endif; ?></div>
                    <div class="amount"><?php if ($this->_var['value']['number'] == 0.00): ?>&nbsp;<?php else: ?><?php echo floatval($this->_var['value']['number']); ?><?php endif; ?></div>
                    <div class="price">￥<?php if ($this->_var['value']['unit_price']): ?><?php echo floatval($this->_var['value']['unit_price']); ?><?php else: ?>&nbsp;<?php endif; ?></div>
                    <div class="place"><?php if ($this->_var['value']['city']): ?><?php echo $this->_var['value']['city']; ?><?php else: ?>&nbsp;<?php endif; ?></div>
                    <div class="time"><?php if ($this->_var['value']['input_time']): ?><?php echo date("H:i",$this->_var['value']['input_time']); ?><?php else: ?>&nbsp;<?php endif; ?></div>
                    <div class="opt"><a href="/offers">查看</a></div>
                </li>
                <?php endforeach; endif; unset($_from); ?><?php $this->_pop_vars();; ?>
            </ul>
            <!--info-con end-->
            <div class="more"><a href="/offers"></a></div>
            <!--<div class="more"><a href="/opus/index/t/1"></a></div>-->
        </div>
        <!--left end-->
        <!--right begin-->
        <div class="right frt">
            <h4>免费发布求购需求</h4>
            <!--release begin-->
            <div class="release">
                <form name="" method="post" action="" class="addform">
                    <textarea  placeholder="写下您的真实需求，包括牌号、吨数等，收到后我们会立即
给您会点确认，剩下的就交给我们吧。"></textarea>
                    <input type="submit" value="发布采购需求"/>
                </form>
            </div>
            <!--release end-->
            <ul>
                <?php $_from = $this->_var['grabList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->_push_vars('', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['value']):
?>
                <li>
                    <div class="rob-lt">
                        <div class="rob-person">
                            <div class="nickname">
                                <p><img src="http://q2.qlogo.cn/headimg_dl?bs=qq&amp;dst_uin=<?php echo $this->_var['value']['user_qq']; ?>&amp;src_uin=*&amp;fid=*&amp;spec=100&amp;url_enc=0&amp;referer=bu_interface&amp;term_type=PC" width="20" height="20"/></p>
                                <?php if ($this->_var['value']['user_nick'] == ''): ?><?php echo $this->_var['value']['realname']; ?><?php else: ?><?php echo $this->_var['value']['user_nick']; ?><?php endif; ?>
                            </div>
                            <div class="qq">
                                <span class="qq_img"></span>
                                <?php if ($_SESSION['userid'] > 0): ?><?php echo $this->_var['value']['user_qq']; ?><?php else: ?><?php echo $this->_var['value']['user_qqs']; ?><?php endif; ?>
                            </div>
                        </div>
                      <div class="rob-info color6"><?php echo $this->_var['value']['content']; ?></div>
                    </div>
                    <a href="javascript:rush();"><div class="rob-rt frt"><p><?php echo date("H:i",$this->_var['value']['input_time']); ?></p></div></a>
                </li>
                <?php endforeach; endif; unset($_from); ?><?php $this->_pop_vars();; ?>
            </ul>
            <div class="more"><a href="/resource"></a></div>
        </div>
        <!--right end-->
    </div>
    <!--supply-demand end-->
</div>
<!--floor1 end-->
<!--floor2 begin-->
<div class="floor floor2 w1220">
	<!--floor-title begin-->
    <div class="floor-title link3">
        <span>2F</span>
        <a href="/" target="_blank">求购信息</a>
        <div class="floor-ad-lt ads"><img src="__IMG__/home/floorAdLt.png"></div>
        <div class="floor-ad-rt ads"><img src="__IMG__/home/floorAdRt.png"><span>广告</span></div>
    </div>
    <!--floor-title end-->
     <!--supply-demand begin-->
    <div class="supply-demand supply-demand2 info">
    	<!--left begin-->
        <div class="left flt">
            <!--info-title begin-->
            <ul class="info-title color3">
                <li class="breed">品种</li>
                <li class="grade">牌号</li>
                <li class="level">加工级别</li>
                <li class="factory">厂家</li>
                <li class="amount">数量（吨）</li>
                <li class="price">价格（元 / 吨）</li>
                <li class="place">交货地</li>
                <li class="time">时间</li>
                <li class="opt">操作</li>
            </ul>
            <!--info-title end-->
            <!--info-con begin-->
            <ul class="info-con color6">
                <?php $_from = $this->_var['purBuy']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->_push_vars('', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['value']):
?>
                <li class="demand">
                    <div class="breed"><?php if ($this->_var['value']['cargo_type'] == 1): ?><span class="xian"></span><?php else: ?> <span class="qi"></span> <?php endif; ?><?php if ($this->_var['value']['product_type']): ?><?php echo witchType($this->_var['value']['product_type']); ?><?php else: ?>&nbsp;<?php endif; ?></div>
                    <div class="grade"><?php if ($this->_var['value']['model']): ?><?php echo $this->_var['value']['model']; ?><?php else: ?>&nbsp;<?php endif; ?></div>
                    <div class="level"><?php if ($this->_var['value']['process_type']): ?><?php echo setOption(process_level,$this->_var['value']['process_type']); ?><?php else: ?>&nbsp;<?php endif; ?></div>
                    <div class="factory"><?php if ($this->_var['value']['f_name']): ?><?php echo $this->_var['value']['f_name']; ?><?php else: ?>&nbsp;<?php endif; ?></div>
                    <div class="amount"><?php if ($this->_var['value']['number'] == 0.00): ?>&nbsp;<?php else: ?><?php echo floatval($this->_var['value']['number']); ?><?php endif; ?></div>
                    <div class="price">￥<?php if ($this->_var['value']['unit_price']): ?><?php echo floatval($this->_var['value']['unit_price']); ?><?php else: ?>&nbsp;<?php endif; ?></div>
                    <div class="place"><?php if ($this->_var['value']['city']): ?><?php echo $this->_var['value']['city']; ?><?php else: ?>&nbsp;<?php endif; ?></div>
                    <div class="time"><?php if ($this->_var['value']['input_time']): ?><?php echo date("H:i",$this->_var['value']['input_time']); ?><?php else: ?>&nbsp;<?php endif; ?></div>

                    <div class="opt"><a href="javascript:doTalk(<?php echo $this->_var['value']['id']; ?>);">供货</a></div>
                </li>
                <?php endforeach; endif; unset($_from); ?><?php $this->_pop_vars();; ?>
            </ul>
            <!--info-con end-->
            <div class="more"><a href="/purchase"></a></div>
            <!--<div class="more"><a href="/opus/index/t/1"></a></div>-->
        </div>
        <!--left end-->
        <!--right begin-->
   	 	<div class="right new-order frt">
            <div class="big-title">最新订单</div>
            <div class="new-order-title">
                <p class="col1">类型</p>
                <p class="col2">采购内容</p>
                <p class="col3">数量</p>
                <p class="col4">时间</p>
            </div>
            <!--new-order-con begin-->
            <div class="new-order-con">
                <!--无间断滚动开始-->
                <div id="demo">
                    <div id="indemo">
                        <!--demo1 begin-->
                        <div id="demo1">
                            <?php $_from = $this->_var['deals']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->_push_vars('', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['value']):
?>
                            <div class="cols">
                                <p class="col1"><?php echo witchType($this->_var['value']['product_type']); ?></p>
                                <p class="col2"><?php echo $this->_var['value']['model']; ?>  <?php echo $this->_var['value']['f_name']; ?></p>
                                <p class="col3"><?php echo $this->_var['value']['number']; ?></p>
                                <p class="col4"><?php if ($this->_var['value']['input_time']): ?><?php echo date("H:i",$this->_var['value']['input_time']); ?><?php else: ?>&nbsp;<?php endif; ?></p>
                            </div>
                            <?php endforeach; endif; unset($_from); ?><?php $this->_pop_vars();; ?>
                        </div>
                        <!--demo1 end-->
                        <div id="demo2"></div>
                    </div>
                </div>
                <!--无间断滚动结束-->
                <script type="text/javascript">
                    var speed=40; //数字越大速度越慢
                    var tab=document.getElementById("demo");
                    var tab1=document.getElementById("demo1");
                    var tab2=document.getElementById("demo2");
                    tab2.innerHTML=tab1.innerHTML;
                    function Marquee(){
                        if(tab2.offsetHeight-tab.scrollTop<=0)
                            tab.scrollTop-=tab1.offsetHeight;
                        else{
                            tab.scrollTop++;
                        }
                    }
                    var MyMar=setInterval(Marquee,speed);
                    tab.onmouseover=function() {clearInterval(MyMar)};
                    tab.onmouseout=function() {MyMar=setInterval(Marquee,speed)};
                </script>
            </div>
            <!--new-order-con end-->
        </div>
        <!--right end-->
    </div>
    <!--supply-demand end-->
</div>
<!--floor2 end-->
<!--floor3 begin-->
<div class="floor floor3 w1220">
	<!--floor-title begin-->
    <div class="floor-title link3">
        <span>3F</span> <a href="/ship" target="_blank">中晨物流</a>
        <p><a href="/ship" target="_blank">更多物流></a></p>
    </div>
    <!--floor-title end-->
    <!--ship begin-->
    <div class="ship info">
    	<!--left begin-->
        <div class="left flt">
        	<h2>优质<span>线路推荐</span></h2>
            <!--rount begin-->
        	<ul class="rount">
                <?php $_from = $this->_var['shipList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->_push_vars('', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['value']):
?>
                <li>
                    <h3 class="color6"><?php echo $this->_var['value']['start']; ?></h3>
                    <p><?php echo $this->_var['value']['cities']; ?>-<?php echo $this->_var['value']['end']; ?></p>
                    <p>货物重量：<?php echo $this->_var['value']['weight']; ?>吨</p>
                    <p>运费：<?php echo $this->_var['value']['price']; ?>元</p>
                </li>
                <?php endforeach; endif; unset($_from); ?><?php $this->_pop_vars();; ?>
            </ul>
            <!--rount end-->
            <h2>物流<span>优势</span></h2>
            <!--advantage begin-->
            <ul class="advantage">
            	<li>价格透明</li>
                <li>运货快</li>
                <li>可视化</li>
                <li>服务好</li>
                <li>车队多</li>
            </ul>
            <!--advantage end-->
        </div>
        <!--left end-->
        <!--right begin-->
        <div class="right frt"><img src="__IMG__/home/ship.jpg" width="398" height="332" alt="中晨物流"/></div>
        <!--right end-->
    </div>
    <!--ship end-->
</div>
<!--floor3 end-->
<!--floor4 begin-->
<div class="floor floor4 w1220">
	<!--floor-title begin-->
    <div class="floor-title link3">
        <span>4F</span> <a href="/finance" target="_blank">塑料金融</a>
        <p><a href="finance/index" target="_blank">塑料金融></a></p>
    </div>
    <!--floor-title end-->
    <!--supply-chain begin-->
    <div class="supply-chain info">
    	<!--left begin-->
        <div class="left flt">
            <h2>我的塑料网的<span>供应链金融</span></h2>
            <ul>
                <li>
                    <!--thumb begin-->
                    <div class="thumb"><img src="__IMG__/home/slyChain1.jpg" width="144" height="133"/></div>
                    <!--thumb end-->
                    <p>塑料代采</p>
                    <span>有大生意，货款不够？</span>
                    <a href="/finance/mining" target="_blank"><span>我要申请<br/>我要申请</span></a>
                </li>
                <li>
                    <!--thumb begin-->
                    <div class="thumb"><img src="__IMG__/home/slyChain2.jpg" width="144" height="133"/></div>
                    <!--thumb end-->
                    <p>塑料白条</p>
                    <span>有订单，钱未回款？</span>
                    <a href="finance/ious" target="_blank"><span>我要申请<br/>我要申请</span></a>
                </li>
                <li>
                    <!--thumb begin-->
                    <div class="thumb"><img src="__IMG__/home/slyChain3.jpg" width="144" height="133"/></div>
                    <!--thumb end-->
                    <p>仓单融资</p>
                    <span>有塑料，缺流动资金？</span>
                    <a href="finance/financing" target="_blank"><span>我要申请<br/>我要申请</span></a>
                </li> 
            </ul>
        	<!-- <h2>针对<span>仓单融资</span>业务</h2>
                        <ul class="business business1">
                            <li class="item1"><p><b></b></p><span>最高预付<i>80%</i>货款</span></li>
                            <li class="item2"><p><b></b></p><span>按天计算月息低至<i>1%</i></span></li>
                            <li class="item3"><p><b></b></p><span><i>48</i>小时内货款到账</span></li>
                        </ul>
                        <h2>针对<span>订单融资</span>业务</h2>
                        <ul class="business business2">
                            <li class="item1"><p><b></b></p><span>无需<i>抵押</i> 无需<i>担保</i></span></li>
                            <li class="item2"><p><b></b></p><span>订单货物<i>先行</i>提取</span></li>
                            <li class="item3"><p><b></b></p><span>按天收费低至<i>8</i>元/吨</span></li>
                        </ul>
                        <h2>供应链金融<span>优势</span></h2>
                        <ul class="advantage">
                            <li>放款速度快</li>
                            <li>赎货灵活便捷</li>
                            <li>准入门槛低</li>
                            <li>融资方式多样</li>
                        </ul> -->
        </div>
        <!--left begin-->
        <!--right begin-->
        <div class="right frt"><a href="finance/index"  target="_blank"><img src="__IMG__/home/slyChain.jpg" width="398" height="397" alt="中晨塑料金融" /></a></div>
        <!--right begin-->
    </div>
    <!--supply-chain end-->
</div>
<div class="floor floor5 w1220">
    <div class="floor-title link3">
        <span>5F</span> <a href="http://news.myplas.com/" target="_blank">塑料头条</a>
        <p><a href="http://news.myplas.com/" target="_blank">更多></a></p>
    </div>
    <div class="headline">
        <div class="left flt">
            <div class="headline-title color6">
                <foreach name="articleList" item="value" key="key">
                <?php $_from = $this->_var['articleList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->_push_vars('key', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['value']):
?>
            	<h3 id="tabb<?php echo $this->_var['value']['num']; ?>" onmouseover="setTab('tabb',<?php echo $this->_var['value']['num']; ?>,5)" <?php if ($this->_var['value']['num'] == 1): ?>class="hover"<?php endif; ?> ><?php echo $this->_var['key']; ?></h3>
                <?php endforeach; endif; unset($_from); ?><?php $this->_pop_vars();; ?>
                </foreach>
            </div>
            <div class="headline-con link6 color9">
                <?php $_from = $this->_var['articleList']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->_push_vars('key', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['value']):
?>
            	<div id="con-tabb-<?php echo $this->_var['value']['num']; ?>" <?php if ($this->_var['value']['num'] != 1): ?>style="display:none;"<?php endif; ?> >
                    <?php $_from = $this->_var['value']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->_push_vars('kk', 'vv');if (count($_from)):
    foreach ($_from AS $this->_var['kk'] => $this->_var['vv']):
?>
                        <?php if ($this->_var['kk'] !== 'num'): ?>
                            <div class="headline-list <?php if ($this->_var['kk'] != 0): ?>last<?php endif; ?> ">
                                <ul>
                                    <?php $_from = $this->_var['vv']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->_push_vars('k', 'v');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['v']):
?>
                                    <li><a href="/<?php echo $this->_var['v']['type']; ?>/<?php echo $this->_var['v']['spell']; ?>/<?php echo $this->_var['v']['id']; ?>.html" title="<?php echo $this->_var['v']['title']; ?>"><?php echo sub_str($this->_var['v']['title'],22); ?></a><?php echo date("m-d",$this->_var['v']['input_time']); ?></li>
                                    <?php endforeach; endif; unset($_from); ?><?php $this->_pop_vars();; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?><?php $this->_pop_vars();; ?>
                </div>
                <?php endforeach; endif; unset($_from); ?><?php $this->_pop_vars();; ?>
            </div>
        </div>
        <div class="right frt"><img src="__IMG__/home/headline.jpg" width="400" height="243" alt="塑料头条"/></div>
    </div>
</div>
<!--<div class="aside-ad ads"><span>广告</span></div>-->
<script type="text/javascript" src="__JS__/home/tab.js"></script>
<script type="text/javascript" src="__JS__/home/dist/echarts.js"></script>
<script type="text/javascript" src="__JS__/home/chart.mine.js"></script>
<script type="text/javascript" src="__JS__/home/address.js"></script>
<script type="text/javascript" src="__JS__/home/uc-resource-pack.js"></script>
<script type="text/javascript" src="__JS__/home/jquery.touchSlider.js"></script>
<script type="text/javascript" src="__JS__/home/home.js"></script>
<script type="text/javascript" src="__JS__/home/ss.js"></script>
<script type="text/javascript">
$(function(){


//行情中心滚动特效
	$(".go-top").bind("click",function(){
		$('html,body').animate({'scrollTop':0},300,function(){
			$(".go-top").hide();
		});
	});

	if($(window).scrollTop()<200){
			$(".go-top").hide();
		}

	$(window).bind("scroll",function(){
		if($(window).scrollTop()>=200){
			$(".go-top").show();
		}
	});
    //免费发布求购需求
    var release = $(".release textarea"),
        releaseStr = "写下您的真实需求，包括牌号、吨数等，收到后我们会立即给您会点确认，剩下的就交给我们吧。";
    release.bind("focus",function(){
        $(this).attr("placeholder","");
    });
    release.bind("blur",function(){
        $(this).attr("placeholder",releaseStr);
    });


    $('.addform').submit(function(){
        var content = $('.addform textarea').val().trim();
        var tips=1;
        var type=1;
        if(content ==''){
            layer.msg('请填写发布内容');
            return false;
        }
        $.post('/purchase/index/contentPurchase', {content:content,tips:tips}, function (data){
            if(data.err==1){
                loginbox('home');
            }else{
                layer.msg('发布成功');
                window.location.reload();
            }
        },'json')
        return false;
    })


	//发布采购
	var buy = $("#con-tab-5"),
	    grade = buy.find(".grade"),
		amount = buy.find(".amount"),
		price = buy.find(".price"),
		place = buy.find(".place"),
		linkman = buy.find(".linkman"),
		tel = buy.find(".tel");
	buy.find(".submit").bind("click",function(){
        var user=$("#user_name").html();
        if(!user){
            loginbox('home');
            return false;
        }
		msg = buy.find(".msg");
		if(grade.val()==""){
			msg.html("请输入牌号！");
			grade.focus();
			return;
		}
		if(amount.val()==""){
			msg.html("请输入数量！");
			amount.focus();
			return;
		}
        else if(amount.val()>2000){
            msg.html("数量不应超过2000吨！");
            amount.focus();
            return;
        }
		if(price.val()==""){
			msg.html("请输入价格！");
			price.focus();
			return;
		}
        else if(price.val()>20000){
            msg.html("价格不应超过20000！");
            price.focus();
            return;
        }
		if(place.val()==""){
			msg.html("请输入交货地！");
			place.focus();
			return;
		}
		msg.html("");
        var data=$("#contentForm").serialize();
        $.post('/purchase/index/contentPurchase',data,function (data){
            if(data.err==0){
                layer.msg(data.msg);
                document.getElementById('contentForm').reset();
            }else{
                layer.msg(data.msg);
            }
        },'json');
        return false;

	});

	//登录验证
    $("#loginForm").submit(function(){
        var username=$("#user").val();
        var password=$("#pwd").val();
        msg = $('.msg');
        if(username==""){
            msg.html("请输入正确的账号");
            return false;
        }
        if(password==""){
            msg.html("请输入密码！");
            return false;
        }
        $.post('/user/login/dolongin',{username:username,password:password},function (data){
            if(data.err>0){
                msg.html(data.msg);
            }else{
                layer.msg('登录成功');
//                alert('登录成功');
                window.location.reload();
            }
        },'json');
        return false;
    })
    $(".login-wrap input").focus(function(){
        $('.msg').html('');
    })
	// var loginSubmit = $("#con-tab-6"),
	//     user = loginSubmit.find("input.user"),
	// 	pwd = loginSubmit.find("input.pwd");
	//     loginSubmit.find(".submit").bind("click",function(){
	// 	msg = loginSubmit.find(".msg");
	// 	if(user.val()==""){
	// 		msg.html("请输入手机号或者邮箱！");
	// 		user.focus();
	// 		return;
	// 	}
	// 	if(pwd.val()==""){
	// 		msg.html("请输入密码！");
	// 		pwd.focus();
	// 		return;
	// 	}
	// 	msg.html("");
	// 	loginSubmit.find("form").submit();
	// });


    var addrFrom = $("#con-tab-3 .transport .addr-from"),

        addrFromInput = addrFrom.find("input"),

        subFrom = addrFromInput.next(".sub-from"),

        addToInput = $("#con-tab-3 .transport .addr-to input"),

        subTo = $("#con-tab-3 .transport .sub-to"),

        num = $("#con-tab-3 .transport .num"),

        numInput = num.find("input"),

        transOther = $("#con-tab-3 .trans-other"),

        transResult = $("#con-tab-3 .trans-result");

    addrFromInput.bind("focus",function(){

        subFrom.show();
        if(subTo.is(":visible")) subTo.hide();

        //如果错误提示是显示的,则隐藏掉

        if(addrFrom.find(".error-msg").is(":visible")) addrFrom.find(".error-msg").hide();

    });

    subFrom.find("li").bind("click",function(){

        addrFromInput.val($(this).find("span").html());

        subFrom.hide();

        if(addToInput.val()=="") subTo.show();

    })

    //打开选择卸点中二级地址
    addToInput.bind("focus",function(){

        subTo.show();

        if(subFrom.is(":visible")) subFrom.hide();
    });

    $(".sub-to-con .xl-tr .xl-td:nth-child(2n) .two").css({"left":"-161px"});
    $("#con-tab-3 .transport .sub-to .xl-tr .one span").bind("click",function(){

        var str = "",selAddr = "", tempAddr = $(this).html();
        var index = ($(this).attr("data-index"));

        $("#con-tab-3 .transport .sub-to .xl-tr .one").find("span").removeClass("hover");
        $(".one").removeClass("z-index-up");
        $(".two").hide();
        $(this).addClass("hover").parent().addClass("z-index-up").next(".two").show();

        //显示数据
        for(var i=1;i<address[index].length;i++){
            str+="<span>"+address[index][i]+"</span>";
        }
        $(this).closest(".xl-tr").find(".two").html(str);

        //点击某一个具体的地址
        $(this).closest(".xl-tr").find(".two span").bind("click",function(){
            selAddr = tempAddr +'|'+ $(this).html();
            addToInput.val(selAddr);
            subTo.hide();
            subTo.find(".two").hide();
            subTo.find(".one").find("span").removeClass("hover");
            if(addrFromInput.val()=="") subFrom.show();
        });
    });

    //点击差运价
    $("#con-tab-3 .transport .btn").bind("click",function(){

        //判断是否选择了装点

        if(addrFromInput.val()==""){

            addrFrom.find(".error-msg").show()

            return;

        }

        //判断是否输入了吨数

        if(numInput.val()==""){

            num.find(".error-msg p").html("输入吨数");

            num.find(".error-msg").show();

            return;

        }

        else if(numInput.val()<5){

            num.find(".error-msg p").html("吨数>=5");

            num.find(".error-msg").show();

            return;

        }

        else{
            //异步获取价格信息
            var form =addrFromInput.val();
            var to = addToInput.val().split('|')[1];
            var pr = addToInput.val().split('|')[0];
            var weight = numInput.val();
            $.ajax({
                url: "/ship/index/get_price",
                type : 'post',
                dataType : 'json',
                data : {s : form, e : to, w : weight, p : pr},
                success:function(data){
                    if(data.err==0){
                        num.find(".error-msg").hide();
                        transOther.hide();
                        transResult.find('.from').html(form);
                        transResult.find('.to').html(pr+'|'+to);
                        transResult.find('.weight').html(weight);
                        transResult.find('.price').html(data.msg);
                        transResult.show();
                    }else{
                        alert(data.msg);
                    }
                }
            })
        }
    });

    // alert(cc(<?php echo $this->_var['server']['dealyAll']; ?>));
    $(".pagination a.next").bind("mousedown",function(){
        $(this).css({
            "right":"-19px"
        });
    });

    $(".pagination a.next").bind("mouseup",function(){
        $(this).css({
            "right":"3px"
        });
    });
});

function setCon(myThis){

     myThis.value = myThis.value.replace(/[^\d.]/g,"");
}

function rush(){
    var _user = $("#_user").val();
    if(_user == ''){
        $.layer({
            type: 2,
            border: [0],
            title: false,
            fix:true,
            iframe: {src : "/login/loginbox?type=new"},
            area: ['360px', '340px']
        });
        return;
    }else{
        window.location.href='/resource';
    }
}

function Addme(title, url) {
  url = document.URL;  //你自己的主页地址
  title = "我的塑料网";  //你自己的主页名称
  try {
      window.external.addFavorite(url, title);
  }
catch (e) {
     try {
       window.sidebar.addPanel(title, url, "");
    }
     catch (e) {
         alert("抱歉，您所使用的浏览器无法完成此操作。nn加入收藏失败，请使用Ctrl+D进行添加");
     }
  }
}

$(".mr_frbox").slide({
    titCell:"",
    mainCell:".mr_frUl ul",
    autoPage:true,
    effect:"leftLoop",
    autoPlay:true,
    vis:4,
    scroll:2,
    interTime:4000
});

function doTalk(id)
{
    var user=$("#user_name").html();
    if(!user){
        loginbox('home');
        return;
    }
    window.location.href="/purchase/index/wantBuy?purid="+id;
}

</script>
