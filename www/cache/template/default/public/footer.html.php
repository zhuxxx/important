<!--footer begin-->
<div class="footer">
    <div class="w1220">
        <div class="left link3 flt">
            <ul>
                <?php $_from = $this->_var['footer']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->_push_vars('', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['value']):
?>
                <li>
                    <h4><?php echo $this->_var['value']['cate_name']; ?></h4>
                    <?php $_from = $this->_var['value']['son']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->_push_vars('', 'v');if (count($_from)):
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
                    <p><img src="__IMG__/home/ewmWx.jpg" width="84" height="84"/></p>
                    <span>官方微信</span>
                </li>
                <li>
                    <p><img src="__IMG__/home/ewmApp.jpg" width="81" height="81"/></p>
                    <span>APP</span>
                </li>
            </ul>
        </div>
    </div>
    <p style="text-align:center;" class="copyright color3"><?php echo $this->_var['sys']['icp_number']; ?></p>
</div>
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
<!--footer end-->
<div class="renzheng">
   <ul>
       <?php $_from = $this->_var['Partner']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->_push_vars('key', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['value']):
?>
       <li>
           <a href="<?php echo $this->_var['value']['url']; ?>" target="_blank">
               <img border="0" src="__UPLOAD__/<?php echo $this->_var['value']['img']; ?>"/>
           </a>
       </li>
       <?php endforeach; endif; unset($_from); ?><?php $this->_pop_vars();; ?>
   </ul>
</div>

<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "//hm.baidu.com/hm.js?4808bff4f0276952e006e0f3ec054483";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>