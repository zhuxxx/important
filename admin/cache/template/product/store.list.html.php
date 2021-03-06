__layout|public:mini_layout|layout__
<div class="mini-toolbar"  style="margin:3px 3px 0;">
	<table style="width:100%;">
		<tr>	
			<?php if ($this->_var['choose'] != '1'): ?>
			<td style="white-space:nowrap;">
				<a class="mini-button" iconCls="icon-add" plain="true" onclick="add()">新增</a>
				<span class="separator"></span>
				<a class="mini-button" iconCls="icon-remove" plain="true" onclick="remove()">删除</a>
				<span class="separator"></span>
				<a class="mini-button" iconCls="icon-save" onclick="saveData()" plain="true">保存</a> 
			</td>
			<?php endif; ?>
			<td style="float:right;">
			  <form id="soform">				
				<select name="key_type">
					<option value="store_name">仓库名字</option>
					<option value="store_tel">仓库电话</option>
					<option value="store_address">仓库地址</option>
				</select>
				<input name="keyword" class="mini-textbox" emptyText="请输入关键词" style="width:140px;" onenter="onKeyEnter"/>
				<a class="mini-button" iconCls="icon-search" onclick="search()">查询</a>
				<span id="searchMsg"></span>
			  </form>
			</td>
		</tr>
	</table>
</div>
<div class="mini-fit" style="padding:3px;">
  <div id="gridCell" class="mini-datagrid" style="width:100%;height:100%;"url="/product/store/init?action=grid"  idField="id"
	sizeList="[10,20,50,100]" pageSize="20" <?php if ($this->_var['choose'] == '1'): ?>multiSelect="false"<?php endif; ?> multiSelect="true"  onrowdblclick="onRowDblClick" showFilterRow="true" allowCellSelect="true" allowCellEdit="true">
	<div property="columns">
		<div type="checkcolumn"></div>
		<div field="id" width="30" headerAlign="center" align="center" align="center">ID</div>
		<div field="store_name" width="90" headerAlign="center" align="center">仓库名字<span style="color:red">*</span>
			<input property="editor" class="mini-textbox" style="width:100%;" minWidth="100" />
		</div>
		<div field="store_tel" width="90" headerAlign="center" align="center">仓库电话<span style="color:red">*</span>
			<input property="editor" class="mini-textbox" style="width:100%;" minWidth="100" />
		</div>
		<div field="store_address" width="90" headerAlign="center" align="center">仓库地址<span style="color:red">*</span>
			<input property="editor" class="mini-textbox" style="width:100%;" minWidth="100" />
		</div>
		<div field="remark" width="250" headerAlign="center" >仓库备注<span style="color:red">*</span>
			<input property="editor" class="mini-textarea" style="width:100%;" minHeight="50"/>
		</div>
		<div field="input_time" width="90" headerAlign="center" align="center" allowSort="true" dateFormat="yyyy-MM-dd HH:mm" >添加时间</div>
		<div field="input_admin" width="50" headerAlign="center" align="center">创建者</div>
		<div field="update_time" width="90" headerAlign="center" align="center" allowSort="true" dateFormat="yyyy-MM-dd HH:mm">修改时间</div>
		<div field="update_admin" width="50" headerAlign="center" align="center">修改者</div>
		<div name="action"  width="50" headerAlign="center" align="center" renderer="onLoadHandle">操作</div>
	</div>
  </div>
 </div>
 
	
<div id="admInfo" class="mini-window" title="增加仓库信息" style="width:300px;" 
	showModal="true" allowResize="true" allowDrag="true"
	>
	<div id="addForm" class="form" >
		<table style="width:100%;">
			<tr>
				<td style="width:60px;">仓库名称：</td>
				<td><input name="store_name" class="mini-textbox" style="width:200px" required="true"/></td>
			</tr>
			<tr>
				<td style="width:60px;">仓库电话：</td>
				<td><input name="store_tel" class="mini-textbox" style="width:200px" required="true"/></td>
			</tr>
			<tr>
				<td style="width:40px;">仓库地址：</td>
				<td><input name="store_address" class="mini-textarea" style="width:200px" required="true"/></td>
			</tr>
			<tr>
				<td>仓库备注：</td>
				<td><input name="remark" class="mini-textarea" style="width:200px;"/></td>
			</tr>
			</tr>
		</table>
	</div>
	<div align="center" style="margin-top:10px;">
	  <a class="mini-button" iconCls="icon-ok" onclick="submitForm">确定</a>
	  <a class="mini-button" iconCls="icon-cancel" onclick="onCancel">关闭</a>
	  <span id="returnMsg" style="padding-left:5px; color:#F00;"></span>
	</div>
</div>
	

<div id="lockInfo" class="mini-window" title="绑定业务员" style="width:300px;" 
	showModal="true" allowResize="true" allowDrag="true"
	>
	<div id="lockForm" class="form">
		<table style="width:100%;">
			<input id="s_id"class="mini-hidden" name="store_id"/>
			<tr>
				<td>选择业务员</td>
				<td>
					<input name="admin_id" class="mini-buttonedit" onbuttonclick="checkedMer" valueField="admin_id" textField="name"  value="" allowInput="false"  style="width:170px" id="id"/>
				</td>
			</tr>

			<tr>
			<td style="text-align:right;padding-top:5px;padding-right:20px;" colspan="2">
				<a class="mini-button" iconCls="icon-save" plain="true" href="javascript:submitLock()">保存</a>
			</td>
			</tr>
			
		</table>

	</div>
</div>
<?php if ($this->_var['doact'] == 'search'): ?>
	<div class="mini-toolbar" style="text-align:center;padding-top:8px;padding-bottom:8px; border:1px solid #000;" borderStyle="border:0;">
			<a class="mini-button" style="width:60px;" onClick="onComfirm()">确定</a>
			<span style="display:inline-block;width:25px;"></span>
			<a class="mini-button" style="width:60px;" onClick="onCancel()">取消</a>
	</div>
<?php endif; ?>

<script type="text/javascript">
//搜索或刷新数据
mini.parse();
var grid = mini.get("gridCell");
function search() {
  grid.load($("#soform").serializeObject(),function(e){
	$("#searchMsg").html(e.msg);
  });
}
search();
function onKeyEnter(e) {
  search();
}

//追加操作按钮
function onLoadHandle(e) {
  var record = e.record, s='',store_id = record.id;
	s += '<a href="javascript:lockAdmin('+store_id+')">绑定</a>&nbsp;|&nbsp;<a href="javascript:lookAdmin('+store_id+')">查看</a>';
  return s;
}

//查看绑定的业务员
function lookAdmin(store_id) {
		var sid = store_id;
		var btn = this;
		mini.open({
		url: "/product/store/info?sid="+sid,
		title: "查看业务员",
		width: 1200,
		height: 550,
		onload: function () {
			var iframe = this.getIFrameEl();
		},
		ondestroy: function (action) {
				if(action=='save'){ //重新加载
					grid.reload();
				}
			}
	});
}

//弹出锁定人选择
var proInfo = mini.get("lockInfo");
var lform = new mini.Form("#lockForm");
function lockAdmin(store_id) {
mini.get("s_id").setValue(store_id)
	proInfo.show();
}
//弹出业务员选择列表
function checkedMer(e){
		var btn = this;
		mini.open({
		url: "/rbac/adm/init?do=search&lock=lockadmin",
		title: "选择业务员",
		width: 1200,
		height: 550,
		onload: function () {
			var iframe = this.getIFrameEl();
		},
		ondestroy: function (action) {
			if (action == "ok") {
				var iframe = this.getIFrameEl();
				var datas = iframe.contentWindow.grid.getSelecteds();
				var _ids=new Array(),_name=new Array();
				datas = mini.clone(datas);    //必须
				if(datas.length<1) return;
				for(var i=0;i<datas.length;i++){
					_ids[i]=parseInt(datas[i].admin_id);
					_name[i]=datas[i].name;
				}
				var ids=_ids.join(','),names=_name.join(',');
				if (ids) {
					btn.setValue(ids);
					btn.setText(names);
				}
			}
		}
	});
}


function GetData() {
	var row = grid.getSelected();
	return row;
}

//提交选定后的业务员
function submitLock() {
var sid = mini.get(s_id).getValue();
	lform.validate();

	if (lform.isValid() == false) return;
	var o = lform.getData();
	grid.loading("数据提交中，请稍后......");
	var json = mini.encode(o);
	var callback=function(data){
		if(data.err!='0'){
			grid.unmask();
			alert(data.msg);
			return false;
		}else{
			grid.reload();
			proInfo.hide();
		}
	}
	utils.ajax('/product/store/checkLock',{data:json,lid:sid},callback,"POST","json");
}


//删除
function remove() {
	var rows = grid.getSelecteds(),_ids=new Array();

	if(rows.length<1) return;
	for(var i=0;i<rows.length;i++){
		_ids[i]=parseInt(rows[i].id);
	}
	var ids=_ids.join(',');
	if(ids=='') return;
	mini.confirm("确定删除内容？", "提示",	function(action){
			if(action!='ok') return;
			var callback=function(data){
				if(data.err!='0'){
					alert(data.msg);
					return false;
				}else{
					grid.reload();
				}
			}
			utils.ajax('/product/store/remove',{ids:ids},callback,"POST","json");
		}
	);
}


//弹出增加form表单
var admInfo = mini.get("admInfo");
var form = new mini.Form("#addForm");
function add() {
	form.clear();
	admInfo.show();
}

//增加后提交数据(保存)
function submitForm() {
	form.validate();
	if (form.isValid() == false) return;  
	var o = form.getData();
	//验证电话
	var str=/^0\d{2,3}-?\d{7,8}$/;
	if(!str.test(o.store_tel)) {
		alert("请输入正确的电话号码");
		return false;
	}
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
  utils.ajax('/product/store/ajaxSave',{data:json},callback,"POST","json");
}

//行内编辑后保存数据
function saveData() {
	var data = grid.getChanges();
	var json = mini.encode(data);
	if(json.length<10) return false;
  
	grid.loading("保存中，请稍后......");
	var callback=function(data){
	grid.unmask();
	if(data.err=='0'){
	  grid.reload();
	}else{
	  alert(data.msg)
	  return false;
	}
  }
	utils.ajax('/product/store/save',{data:json},callback,"POST","json");
}
//筛选数据
function CloseWindow(action) {
	if (window.CloseOwnerWindow) return window.CloseOwnerWindow(action);
	else window.close();
}
//确定并获取数据
function onComfirm() {
	CloseWindow("ok");
}
//取消
function onCancel() {
	CloseWindow("cancel");
}

</script>