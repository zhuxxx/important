__layout|public:mini_layout|layout__
<div class="mini-toolbar"  style="margin:3px 3px 0;">
	<table style="width:100%;">
		<tr>	
			<?php if ($this->_var['doact'] != 'search'): ?>
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
				<select name="status" id="soStatus">
					<option value="" selected="selected">=状态=</option>
					<?php echo $this->html_options(array('options'=>$this->_var['status'])); ?>
				</select>
				<span>厂家名称</span>
				<input name="keyword" class="mini-textbox" emptyText="请输入关键词" style="width:140px;" onenter="onKeyEnter"/>
				<a class="mini-button" iconCls="icon-search" onclick="search()">查询</a>
				<span id="searchMsg"></span>
			  </form>
			</td>
		</tr>
	</table>
</div>
<div class="mini-fit" style="padding:3px;">
  <div id="gridCell" class="mini-datagrid" style="width:100%;height:100%;"url="/product/factory/init?action=grid"  idField="fid"
	sizeList="[10,20,50,100]" pageSize="20" multiSelect="true"  onrowdblclick="onRowDblClick" showFilterRow="true" allowCellSelect="true" allowCellEdit="true">
	<div property="columns">
		<div type="checkcolumn"></div>
		<div field="fid" width="30" headerAlign="center" align="center" align="center">ID</div>
		<div field="f_name" width="90" headerAlign="center" align="center">厂家名称
			<input property="editor" class="mini-textbox" style="width:100%;" minWidth="100" />
		</div>
		<div field="input_time" width="90" headerAlign="center" align="center" allowSort="true" dateFormat="yyyy-MM-dd HH:mm" >添加时间</div>
		<div field="input_admin" width="50" headerAlign="center" align="center">创建者</div>
		<div field="update_time" width="90" headerAlign="center" align="center" allowSort="true" dateFormat="yyyy-MM-dd HH:mm">修改时间</div>
		<div field="update_admin" width="50" headerAlign="center" align="center">修改者</div>
		<div field="remark" width="250" headerAlign="center" >备注
			<input property="editor" class="mini-textarea" style="width:100%;" minHeight="50"/>
		</div>
		<div field="status" width="60" headerAlign="center" align="center" allowSort="true">状态</div>
		<div name="action"  width="50" headerAlign="center" align="center" renderer="onLoadHandle">操作</div>
	</div>
  </div>
 </div>
 <div></div>
<?php if ($this->_var['doact'] == 'search'): ?>
	<div class="mini-toolbar" style="text-align:center;padding-top:8px;padding-bottom:8px; border:1px solid #000;" borderStyle="border:0;">
			<a class="mini-button" style="width:60px;" onClick="onComfirm()">确定</a>
			<span style="display:inline-block;width:25px;"></span>
			<a class="mini-button" style="width:60px;" onClick="onCancel()">取消</a>
	</div>
<?php endif; ?>
<div id="admInfo" class="mini-window" title="增加工厂信息" style="width:300px;" 
	showModal="true" allowResize="true" allowDrag="true"
	>
	<div id="addForm" class="form" >
		<table style="width:100%;">
			<input class="mini-hidden" name="fid"/>
			<tr>
				<td style="width:60px;">厂家名称：</td>
				<td><input name="f_name" class="mini-textbox" style="width:200px" required="true"/></td>
			</tr>
			<tr>
				<td>备注：</td>
				<td><input name="remark" class="mini-textarea" style="width:200px;"/></td>
			</tr>
			<tr>
				<td>状态：</td>
				<td><input name="status" class="mini-combobox" data='<?php echo setMiniConfig($this->_var['factory_status']); ?>' textField="name" valueField="id" style="width:90px;" required="true"/>
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
  var record = e.record, state = record.status, s='',tag='',changeid = record.fid;
	tag = state=='正常' ? '锁定' : '正常';
	s += '<a href="javascript:changeState('+changeid+',\''+tag+'\')">'+tag+'</a> ';
  return s;
}
function changeState(changeid,tag)
{
		$.ajax({
			type:"post",
			url:"/product/factory/changeSave",
			data:{changeid:changeid,tag:tag},
			dataType:"json",
			success:function(data){
				if(data.err=='0'){
				  grid.reload();
				}else{
				  alert(data.msg)
				  return false;
				}
			}
		})
}

//删除
function remove() {
	var rows = grid.getSelecteds(),_ids=new Array();
	if(rows.length<1) return;
		for(var i=0;i<rows.length;i++){
	var _id=parseInt(rows[i].fid);
	if(_id<1){
		grid.removeRow(rows[i],false);
	}else{
		_ids.push(_id);
	}
  }
	var ids=_ids.join(',');
	if(ids=='') return;
	mini.confirm("确定删除？", "提示", function(action){
	if(action!='ok') return;
	var callback=function(data){
	if(data.err=='0'){
		grid.reload();
		if(data.result){
			width=300;
			title="操作完成";
			iconCls = 'mini-messagebox-warning';
			html = '以下厂家存在产品无法删除,【ID】：';
			$.each(data.result,function(k,v){
				html += k+" &nbsp;";
			});
			html+="";
		}
		mini.showMessageBox({
			showHeader: false,
			width: width,
			title: title,
			buttons: ["ok"],
			html: html,
			iconCls: iconCls
		});

	}else{
		alert(data.msg)
		return false;
	}
	}
	utils.ajax('/product/factory/remove',{ids:ids},callback,"POST","json");
  });
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
  utils.ajax('/product/factory/ajaxSave',{data:json},callback,"POST","json");
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
  utils.ajax('/product/factory/save',{data:json},callback,"POST","json");
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
function GetData() {
	var row = grid.getSelected();
	return row;
}
</script>