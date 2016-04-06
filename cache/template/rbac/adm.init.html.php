__layout|public:mini_layout|layout__
<div class="mini-toolbar" style="margin:3px 3px 0;">
    <table style="width:100%;">
        <tr>
            <td style="white-space:nowrap;">
             <a class="mini-button" iconCls="icon-add" onclick="add()" plain="true">新增</a>
             <a class="mini-button" iconCls="icon-edit" onclick="edit()" plain="true">编辑</a>
            </td>
            <td style="float:right">
            	<form id="soform">
            	<select name="depart" id="soDepart">
                    <option value="">=部门=</option>
                    <?php echo $this->html_options(array('options'=>$this->_var['depart'])); ?>
                </select>       
            	<select name="key_type">
                    <option value="name">姓名</option>
                    <option value="username">用户名</option>
                </select>       
                <input name="keyword" class="mini-textbox" emptyText="请输入关键词" style="width:140px;" onenter="onKeyEnter"/>   
                <a class="mini-button" iconCls="icon-search" onclick="search()">查询</a>
                <span id="searchMsg"></span>
                </form>
            </td>
        </tr>
    </table>           
</div>
<div class="mini-fit" style="padding:1px 3px 3px;">
  <div id="gridCell" class="mini-datagrid" style="width:100%;height:100%;" 
            url="/rbac/adm/init?action=grid"  idField="admin_id" <?php if ($this->_var['doact'] != 'search'): ?>multiSelect="true" allowCellEdit="true" allowCellSelect="true"<?php endif; ?>
            sizeList="[10,20,50,100]" pageSize="20" onrowdblclick="onRowDblClick"
   >
    <div property="columns">
      <div field="admin_id" width="30" align="center" headerAlign="center">ID</div>
      <div name="action" width="40" headerAlign="center" renderer="onLoadHandle">操作</div>
      <div field="username" width="80" align="center" headerAlign="center">用户名</div>
      <div field="name" width="70" align="center" headerAlign="center">姓名</div>
      <div field="mobile" width="70" align="center" headerAlign="center">手机号</div>
      <div field="depart" width="50" align="center" headerAlign="center" renderer="onLoadDepart">部门</div>
      <div field="status" width="50" align="center" headerAlign="center" renderer="onLoadStatus">状态</div>
      <div field="last_login" width="80" headerAlign="center" dateFormat="yyyy-MM-dd HH:mm:ss" align="center">最后登录</div>
      <div field="login_times" width="50" headerAlign="center" align="center">登录</div>
      <div field="is_super" width="50" align="center" headerAlign="center" renderer="onLoadSuper">超管</div>
      <div field="user_ip" width="80" headerAlign="center">用户IP</div>
    </div>
  </div>
</div>
<?php if ($this->_var['doact'] == 'search'): ?>
<div class="mini-toolbar" style="text-align:center;padding-top:8px;padding-bottom:8px;" borderStyle="border:0;">
        <a class="mini-button" style="width:60px;" onClick="onComfirm()">确定</a>
        <span style="display:inline-block;width:25px;"></span>
        <a class="mini-button" style="width:60px;" onClick="onCancel()">取消</a>
</div>
<?php endif; ?>
<div id="admInfo" class="mini-window" title="设置管理员" style="width:250px;" 
    showModal="true" allowResize="true" allowDrag="true"
    >
    <div id="addForm" class="form" >
        <table style="width:100%;">
        	<input class="mini-hidden" name="admin_id"/>
            <tr>
                <td style="width:70px;">姓名：</td>
                <td><input name="name" class="mini-textbox" style="width:80px" required="true"/></td>
            </tr>
            <tr>
                <td style="width:70px;">用户名：</td>
                <td><input name="username" class="mini-textbox" style="width:80px" required="true"/></td>
            </tr>
            <tr>
              <td style="width:100px;">手机号：</td>
              <td><input name="mobile" class="mini-textbox" style="width:100px;" maxlength="11" required="true"/></td>
            </tr>
            <tr>
                <td style="width:70px;">密码：</td>
                <td><input name="password" class="mini-textbox" style="width:80px"/></td>
            </tr>
            <tr>
                <td style="width:70px;">所属部门：</td>
                <td><input name="depart" class="mini-combobox"  data='<?php echo $this->_var['depart_json']; ?>' textField="name" valueField="id" style="width:100px;" required="true"/></td>
            </tr>
            <tr>
                <td>帐户状态：</td>
                <td><input name="status" class="mini-combobox" data='[{"id":0,"name":"禁用"},{"id":1,"name":"正常"}]' textField="name" valueField="id" style="width:90px;" required="true"/>
</td>
            </tr>
          <tr>
              <td style="text-align:right;padding-top:5px;padding-right:20px;" colspan="2">
                 <a class="mini-button" iconCls="icon-save" plain="true" href="javascript:submitForm()">保存</a>
              </td>                
          </tr>
        </table>
    </div>
</div>
<script type="text/javascript">
mini.parse();
var grid = mini.get("gridCell");
grid.load();

var admInfo = mini.get("admInfo");
var form = new mini.Form("#addForm");
function add() {
	form.clear();
	admInfo.show();
}
function onRowDblClick(e) {
	<?php if ($this->_var['doact'] != 'search'): ?>
	form.clear();
	edit();
	<?php else: ?>
	onComfirm();
	<?php endif; ?>
}
function edit() {
	var row = grid.getSelected();
	if (row) {
		mini.getbyName('admin_id').setValue(row.admin_id);	
		mini.getbyName('name').setValue(row.name);
		mini.getbyName('mobile').setValue(row.mobile);
		mini.getbyName('depart').setValue(row.depart);
		mini.getbyName('username').setValue(row.username);
		mini.getbyName('status').setValue(row.status);
		admInfo.show();
	}
}

//提交数据
function submitForm() {
	form.validate();
	if (form.isValid() == false) return;
	
	var o = form.getData();
	grid.loading("数据提交中，请稍后......");
	var json = mini.encode(o);

	var callback=function(data){
		if(data.err!='0'){
			grid.unmask();
			alert(data.msg);
			return false;
		}else{
			grid.reload();
			admInfo.hide(); 
		}
	}
	utils.ajax('/rbac/adm/ajaxSave',{data:json},callback,"POST","json");
}


//加载：追加按钮
function onLoadHandle(e) {
	var record = e.record; //record.id
	if(record.is_super=='1'){
		return '-';
	}
	return '<a href="javascript:setRole()">角色</a> ';
}
function onLoadSuper(e){
	var record = e.record; //record.id
	if(record.is_super=='1'){
		return '是';	
	}
	return '否';
}

function onLoadDepart(e){
	var record = e.record.depart;
	return $("#soDepart").find("option[value="+record+"]").text();
}

function onLoadStatus(e){
	var record = e.record; //record.id
	if(record.status=='1'){
		return '正常';	
	}
	return '禁用';
}

//设置管理员角色
function setRole(){
	var row = grid.getSelected();
	mini.open({
		url: '/rbac/access/role?id='+row.admin_id,
		showMaxButton:true,
		title: "设置【"+row.username+"】角色", width: 300, height:300
	});		
}

//筛选数据
function CloseWindow(action) {
	if (window.CloseOwnerWindow) return window.CloseOwnerWindow(action);
	else window.close();
}
function onComfirm() {
	CloseWindow("ok");
}
function onCancel() {
	CloseWindow("cancel");
}
function GetData() {
	var row = grid.getSelected();
	return row;
}
</script>