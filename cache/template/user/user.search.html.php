__layout|public:mini_layout|layout__
<div style="margin:3px 3px 0;">
  <table width="90%" align="center">
      <form id="soform">
	  <tr>
        <td colspan="2">&nbsp;</td>
        </tr>
	  <tr>
        <td width="12%">手机号：</td>
        <td width="88%" align="left"><input type="text" name="mobile" id = "mobile" value="" /></td>
      </tr>
      <tr>
        <td>姓名：</td>
        <td align="left"><input type="text" name="real_name" id = "real_name" value="" /></td>
      </tr>
      <tr>
        <td>会员ID：</td>
        <td align="left"><input type="text" name="user_id" id = "user_id" value="" /></td>
      </tr>
      <tr>
        <td>Email：</td>
        <td align="left"><input type="text" name="email" id = "email" value="" /></td>
      </tr>
      <tr>
        <td>邀请码：</td>
        <td align="left"><input type="text" name="invite_code" id = "invite_code" value="" /></td>
      </tr>
      <tr>
        <td height="24">&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2"><a class="mini-button" style="width:60px;" iconCls="icon-search" onclick="search()">确定</a><a class="mini-button" style="width:60px;" onClick="onCancel()">取消</a></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td><span id="searchMsg"></span></td>
      </tr>
	  </form>
  </table>
</div>
<?php if ($this->_var['doact'] != 'search'): ?>
<div class="mini-fit" style="padding:1px 3px 3px;">
    <div id="gridCell" class="mini-datagrid" style="width:100%;height:100%;"  sizeList="[10,20,50,100]" pageSize="20"
        url="/user/user/search?action=grid&do=<?php echo $this->_var['doact']; ?>" idField="user_id"  onrowdblclick="onRowDblClick"
        <?php if ($this->_var['doact'] != 'search'): ?> allowCellSelect="true" allowCellEdit="true" multiSelect="true"<?php endif; ?>
        >
        <div property="columns">    
            <div name="action" width="120" headerAlign="center" align="right" renderer="onLoadHandle">操作</div>
      		<div field="user_id" width="50" headerAlign="center" align="center" allowSort="true" <?php if ($this->_var['doact'] != 'search'): ?>renderer="onLoadUinfo"<?php endif; ?>>ID</div>
            <div field="mobile" width="100" headerAlign="center">手机</div>
            <div field="email" width="100" headerAlign="center">邮件</div>
            <div field="name" width="100" headerAlign="center">姓名/公司名称</div>
            <div field="status" width="60" headerAlign="center" align="center">状态</div>
            <div field="utype" width="60" headerAlign="center" align="center">类型</div>
            <div field="reg_time" width="110" headerAlign="center" dateFormat="yyyy-MM-dd HH:mm" align="center">注册时间</div>
            <div field="last_login" width="110" headerAlign="center" dateFormat="yyyy-MM-dd HH:mm" align="center">最后登录</div>
            <div field="visit_count" width="50" headerAlign="center" allowSort="true" align="center">登录次数</div>
        </div>
    </div>
</div>
<?php endif; ?>
<script type="text/javascript">
mini.parse();
var grid = mini.get("gridCell");
//grid.load();
//追加查看按钮

function onLoadHandle(e) {
	var s='';
	s += '<a href="javascript:edit(1)">重置密码</a> <a href="javascript:edit(2)">审核用户</a> <a href="javascript:edit(3)">修改用户</a> ';
	return s;
}

function search() {
	grid.load($("#soform").serializeObject(),function(e){
		$("#searchMsg").html(e.msg);
	});
}
function onKeyEnter(e) {
	search();
}

function onRowDblClick(e) {
	<?php if ($this->_var['doact'] != 'search'): ?>
	edit();
	<?php else: ?>
	onComfirm();
	<?php endif; ?>
}
function edit(ctype) {
	var row = grid.getSelected();
	if (row) {
		add(row.user_id,ctype)
	}
}

//查看编辑用户信息
function add(id,ctype){
	var width=700,height=530,title='用户信息';
	if(id==0){
		width=600;
		height=180;
		title='新增筹资机构'
	}
	var urlStr="";
	if(ctype==1){
		urlStr="/user/user/modifyPasswd?id="+id;
	}else if(ctype==2){
		urlStr="/user/user/applyUser?id="+id;
	}else{
		urlStr="/user/user/edit?id="+id;
	}
	mini.open({
		url: urlStr,
		showMaxButton:true,
		title: title, width: width, height:height,
		ondestroy: function (action) {
			if(action=='save'){ //重新加载
				grid.reload();
			}
		}
	});	
}
</script>