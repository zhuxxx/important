__layout|public:mini_layout|layout__
<div class="mini-toolbar" style="margin:3px 3px 0;">
    <table style="width:100%;">
        <tr>
            <td style="white-space:nowrap;<?php if ($this->_var['position']): ?>display:none;<?php endif; ?>">
            <form id="soform">
            	<select name="position" id="soPosition">
                    <option value="">=选择栏目=</option>
                    <?php $_from = $this->_var['positions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->_push_vars('k', 'v');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['v']):
?><option value="<?php echo $this->_var['k']; ?>"<?php if ($this->_var['k'] == $this->_var['position']): ?> selected="selected" <?php endif; ?>><?php echo $this->_var['v']['name']; ?></option><?php endforeach; endif; unset($_from); ?><?php $this->_pop_vars();; ?>
                </select>
                <select name="status">
                    <option value="">=状态=</option>
                    <option value="2">可用</option>
                    <option value="1">禁用</option>
                </select>
                <a class="mini-button" iconCls="icon-search" onclick="search()">查询</a>
                <span id="searchMsg"></span></form>
            </td>
        </tr>
        
        <tr>
            <td style="white-space:nowrap;">
                <a class="mini-button" iconCls="icon-add" plain="true" onclick="add(0)">新增</a>
                <a class="mini-button" iconCls="icon-edit" plain="true" onclick="edit()">编辑</a>
                <a class="mini-button" iconCls="icon-remove" plain="true" onclick="removeRow()">删除</a>     
                <span class="separator"></span>             
                <a class="mini-button" iconCls="icon-save" plain="true" onclick="saveData()">保存</a> 
            </td>
        </tr>
    </table>           
</div>

<div class="mini-fit" style="padding:1px 3px 3px;">
    <div id="gridCell" class="mini-datagrid" style="width:100%;height:100%;"  sizeList="[10,20,50,100]" pageSize="20"
        url="/system/block/init?action=grid&position=<?php echo $this->_var['position']; ?>"
        showFilterRow="true" allowCellSelect="true" allowCellEdit="true" idField="id" multiSelect="true"
        onrowdblclick="onRowDblClick"
        >
        <div property="columns">    
            <div type="checkcolumn"></div>
      		<div field="id" width="50" headerAlign="center" align="center" allowSort="true">ID</div>
            <div field="name" width="120" headerAlign="center">名称                        
                <input property="editor" class="mini-textbox" style="width:100%;"/>
            </div>
            <div field="osition" width="100" headerAlign="center" renderer="onLoadPosition">位置</div>          
            <div field="sort_order" width="60" headerAlign="center" allowSort="true" align="center">排序
                <input property="editor" class="mini-spinner" minValue="0" maxValue="1000" style="width:100%;"/>
            </div>      
            <div field="status" width="60" headerAlign="center" type="comboboxcolumn" autoShowPopup="true" align="center">状态
                <input property="editor" class="mini-combobox" style="width:100%;" data="dStatus" />     
            </div>
            <div field="start_time" width="110" headerAlign="center" dateFormat="yyyy-MM-dd HH:mm" allowSort="true" align="center">开始日期</div>
            <div field="end_time" width="110" headerAlign="center" dateFormat="yyyy-MM-dd HH:mm" allowSort="true" align="center">截止日期</div>
        </div>
    </div>
</div>
<script type="text/javascript">
mini.parse();
var grid = mini.get("gridCell");
grid.load();
var dStatus=[{id: 1, text: '可用'}, {id: 0, text: '禁用'}];

function onLoadPosition(e) {
	var record = e.record.position; //record.id
	return $("#soPosition").find("option[value="+record+"]").text();
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
	edit();
}
function edit() {
	var row = grid.getSelected();
	if (row) {
		add(row.id)
	}
}
//删除数据
function removeRow() {
    var rows = grid.getSelecteds(),_ids=new Array(),_pos=new Array();
	if(rows.length<1) return;
	for(var i=0;i<rows.length;i++){
		_ids[i]=parseInt(rows[i].id);
		_pos[i]=parseInt(rows[i].position);
	}
	var ids=_ids.join(','),pos=_pos.join(',');
	if(ids=='') return;
	mini.confirm("确定删除内容？", "提示",	function(action){
			if(action!='ok') return;
			var callback=function(data){
	  			if(data.err!='0'){
					alert(data.msg)
					return false;
				}else{
					grid.reload();
				}
			}
			utils.ajax('/system/block/remove',{ids:ids,pos:pos},callback,"POST","json");
		}
	);
}


//查看编辑卡片信息
function add(id){
	var position=$("#soPosition").val();
	if(id==0 && position==''){
		alert("请选择栏目")
		return false;
	}
	mini.open({
		url: "/system/block/info?position="+position+"&id="+id,
		showMaxButton:true,
		title: '信息编辑', width: 850, height:550,
		ondestroy: function (action) {
			if(action=='save'){ //重新加载
				grid.reload();
			}
		}
	});		
}

//行内编辑后保存数据
function saveData() {
	var data = grid.getChanges();
	var json = mini.encode(data);
	if(json.length<10) return false;
	grid.loading("保存中，请稍后......");
	var callback=function(data){
		if(data.err!='0'){
			alert(data.msg)
			return false;
		}else{
			grid.reload();
		}
	}
	utils.ajax('/system/block/save',{data:json},callback,"POST","json");
}
</script>
