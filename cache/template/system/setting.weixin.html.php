__layout|public:main_layout|layout__
<div class="tblform" style="margin:5px;">
  <h4>微信设置</h4>
  <form method="post" action="__A__" id="theForm" enctype="multipart/form-data">
  <div class="part">
    <table cellspacing="0" cellpadding="0" border="0">
      <tbody>
        <tr>
          <th>二维码: </th>
          <td id="qrcode_previewer">
            <input name="qrcode" type="hidden" value="<?php echo $this->_var['qrcode']; ?>" />
            <input id="upimg" type="file" name="uplogo" onchange="uploadLogo(this);" style="width:68px;" /><br />
          </td>
        </tr>
        <tr>
          <th>appid: </th>
          <td>
            <input name="appid" value="<?php echo $this->_var['appid']; ?>" class="mini-textbox" style="width:380px;"  />
          </td>
        </tr>
        <tr>
          <th>secret: </th>
          <td>
            <input name="secret" value="<?php echo $this->_var['secret']; ?>" class="mini-textbox" style="width:380px;"  />
          </td>
        </tr>
        <tr>
          <th>token: </th>
          <td>
            <input name="token" value="<?php echo $this->_var['token']; ?>" class="mini-textbox" style="width:380px;"  />
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="tblbtn">
      <a class="mini-button" iconCls="icon-ok" onclick="frmSubmit">提交</a>
      <a class="mini-button" iconCls="icon-undo" onclick="frmRest">重置</a>
      <input type="reset" style="display:none;">
      <span id="returnMsg" style="padding-left:5px; color:#F00;"></span>
  </div>
  </form>
</div>
<script src="__JS__/jquery/jquery.upload.js" type="text/javascript"></script>
<script type="text/javascript">
mini.parse();

function uploadLogo(obj) {
  var $obj=$(obj);
  var $input=$obj.prev('input:hidden');
  $.ajaxFileUpload({
    url:'/system/sysUpload/images?type=block',
      secureuri:false,
      fileElementId:$obj.attr('id'),
      dataType: 'json',
      success: function (data, status) {
        if(data.err=='0'){
          $input.val(data.msg);
          previewLogo();
        }
      },
      error: function (data, status, e){
        alert(e);
      }
    }
  );
  return false;
}

function previewLogo(){
  $('#qrcode_previewer').each(function(){
    var $previewer = $(this);
    var src = $previewer.children('input:hidden').val();
    if(src)
      $previewer.children('img').remove().end()
                .append($('<img />',{src: '__UPLOAD__/'+src, css: {maxHeight:'50px'}}));
  });
}
previewLogo();
</script>
