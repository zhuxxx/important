__layout|public:mini_layout|layout__
<div class="mini-toolbar"  style="margin:3px 3px 0;">
	<table style="width:100%;">
		<tr>
			<td style="white-space:nowrap;">
				<a class="mini-button" iconCls="icon-save" onclick="saveData()" plain="true">保存</a>
			</td>
			<td style="float:right;">
			    <form id="soform">
			    <span id="searchMsg"></span>
			    开票日期
				<input name="startTime" class="mini-datepicker" style="width:100px;"/> -
				<input name="endTime" class="mini-datepicker" style="width:100px;"/>
				<!-- <select name="bile_type" id="bile_type">
					<option value="" selected="selected">=票据类型=</option>
					<?php echo $this->html_options(array('options'=>$this->_var['bile_type'])); ?>
				</select> -->
				<select name="order_name" id="order_name">
					<option value="" selected="selected">=合同主题=</option>
					<?php echo $this->html_options(array('options'=>$this->_var['company_account'])); ?>
				</select>
				<select name="invoice_one_status" id="invoice_one_status">
					<option value="" selected="selected">=开票状态=</option>
					<?php echo $this->html_options(array('options'=>$this->_var['invoice_one_status'])); ?>
				</select>
				<select name="key_type">
					<option value="c_name">公司名称</option>
					<option value="admin">交易员</option>
					<option value="invoice_sn">发票号</option>
					<option value="order_sn">订单号</option>
					<option value="total_price">订单金额</option>

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
  <div id="gridCell" class="mini-datagrid" style="width:100%;height:100%;"
  <?php if ($this->_var['type'] == '1'): ?> url="/product/billing/init?action=grid&type=<?php echo $this->_var['type']; ?>"<?php else: ?>  url="/product/billing/itin?action=grid&type=<?php echo $this->_var['type']; ?>" <?php endif; ?> idField="id"
	sizeList="[10,20,50,100]" pageSize="20" multiSelect="true" showFilterRow="true" allowCellSelect="true" allowCellEdit="true" allowCellWrap="true">
	<div property="columns">
		<div type="checkcolumn"></div>
		<div field="o_id" width="30" headerAlign="center" align="center" allowSort="true" renderer="onLoadHandle">订单ID</div>
		<div field="invoice_sn" width="60" headerAlign="center" align="center" align="center">发票号</div>
		<div field="billing_sn" width="60" headerAlign="center" align="center" align="center">开票号</div>
		<div field="order_sn" renderer="tips" width="80" headerAlign="center" align="center" align="center">订单号</div>
		<div field="c_name" width="120" headerAlign="center" align="center" align="center">公司名</div>
		<div field="total_price" width="40" headerAlign="center" align="center" align="center">总金额</div>
		<div field="billing_price" width="40" headerAlign="center" align="center" align="center">本次开票金额</div>
		<div field="unbilling_price" width="40" headerAlign="center" align="center" align="center">未开票金额</div>
		<!-- <div field="tax_price" width="40" headerAlign="center" align="center" align="center">税额</div> -->
		<!-- <div field="rise" width="40" headerAlign="center" align="center" align="center">抬头</div> -->
		<div field="order_name" width="30" headerAlign="center" align="center" align="center">合同主题</div>
		<div field="accessory" width="25" headerAlign="center" align="center" align="center" renderer="down">附件</div>
		<!-- <div field="bile_type" renderer="setBile" width="45" headerAlign="center" allowSort="true" align="center">票据类型</div> -->

		<div field="invoice_status" renderer="setInv" width="40" headerAlign="center" align="center" allowSort="true"><?php if ($this->_var['type'] == '1'): ?>销售开票状态<?php else: ?>采购开票状态<?php endif; ?></div>

		<!-- <div field="paying_info" width="90" headerAlign="center" >付款信息<span style="color:red">*</span>
			<input property="editor" class="mini-textarea" style="width:100%;" minHeight="50"/>
		</div>
		<div field="receipt_info" width="90" headerAlign="center" >收款信息<span style="color:red">*</span>
			<input property="editor" class="mini-textarea" style="width:100%;" minHeight="50"/>
		</div> -->
		<div field="remark" width="70" headerAlign="center" >备注<span style="color:red">*</span>
			<input property="editor" class="mini-textarea" style="width:100%;" minHeight="50"/>
		</div>
		<div field="payment_time" width="50" headerAlign="center" align="center" allowSort="true" dateFormat="yyyy-MM-dd HH:mm" >开票日期</div>

		<div field="input_time" width="50" headerAlign="center" align="center" allowSort="true" dateFormat="yyyy-MM-dd HH:mm">创建时间</div>
		<div field="input_admin" width="30" headerAlign="center" align="center">交易员</div>
		<div field="update_time" width="50" headerAlign="center" align="center" allowSort="true" dateFormat="yyyy-MM-dd HH:mm">修改时间</div>
		<!-- <div field="update_admin" width="30" headerAlign="center" align="center">修改者</div> -->
		<?php if ($this->_var['type'] == 1): ?>
			<div width="40" headerAlign="center" renderer="relevance" align="center">关联采购</div>
		<?php endif; ?>
		<div action='do' width="40" headerAlign="center" renderer="viewhander" align="center">操作</div>

	</div>
  </div>
 </div>
 <div></div>


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
	var record = e.record,s='',oid = record.o_id;
	var o_type=<?php echo $this->_var['type']; ?>;
	s += '<a href="javascript:viewOrdInfo('+oid+','+o_type+')">'+oid+'</a> ';
	return s;
}

//备注含有“退款”或者“赔偿”，订单号标红
function tips(e) {
	var record = e.record,s='',order_sn = record.order_sn,remark=record.remark;
	var reg= new RegExp("退款|破损");
	if (remark && reg.test(remark)) {
		return '<span style="color:red;">'+order_sn+'</span>';
	}
	return order_sn;
}

//追加操作，关联销售订单
function relevance(e){
	var record = e.record,oid=record.o_id,s='';
	var order_type = 1;
	//传值表示是查看销售订单
	var sale = 1;
		s += '<a href="javascript:viewOrdInfo('+oid+','+order_type+','+sale+')">查看</a>';
	return s;
}

function down(e){
	var record = e.record, accessory =  record.accessory, s = '';
	if(accessory != ''){
		return '<a href="'+accessory+'">下载</a>';
	}
	return s;

}

//查看订单相关信息
function viewOrdInfo(oid,o_type,sale){
	mini.open({
		url: "/product/order/info?oid="+oid+'&o_type='+o_type+'&sale='+sale,
		showMaxButton:true,
		title: "查看订单相关信息",
		width: 800, height:430
	});
}

//追加操作，退款和下载按钮
function viewhander(e){
	var record = e.record,oid=record.o_id, b_price=record.billing_price,total_price=record.total_price, o_sn=record.order_sn,i_status=record.invoice_status,id=record.id, s='',red_status=record.red_status;
	var order_type=<?php echo $this->_var['type']; ?>;
	if (i_status ==1) {
		s = '<a href="javascript:addInvoice('+oid+','+order_type+','+id+')">审核</a>';
	}else if(i_status == 2){
		s = '<a href="javascript:changeRed('+id+')">红字更正</a>';
	}else{
		s="-";
	}

	return s;
}

//开票审核
function addInvoice(oid,order_type,id){
	var width=800, height=680,type=order_type,finance=1,invoice='1';
		title="开票申请审核";
	mini.open({
		//有invoice表示是开票,有finance表示是审核
		url: "/product/billing/transactionInfo?o_id="+oid+"&order_type="+type+"&invoice="+invoice+"&finance="+finance+"&id="+id,
		showMaxButton:true,
		 title: title, width: width, height:height,
		ondestroy: function (action) {
			if(action=='save'){ //重新加载
				grid.reload();
			}
		}
	});
}

//查看
function changeRed(id){
	if(!confirm('确定要更正这条信息吗?')) return;
	$.post('/product/billing/changeRed',{id:id},function(data){
		if(data.err==0){
			alert('操作成功');
			grid.reload();
		}
	},'json');
}

//设置状态

function setInv(e){
	var inv= e.record.invoice_status;
	return $("#invoice_one_status").find("option[value="+inv+"]").text();
}
function setBile(e){
	var pay= e.record.bile_type;
	return $("#bile_type").find("option[value="+pay+"]").text();
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
  utils.ajax('/product/billing/save',{data:json},callback,"POST","json");
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