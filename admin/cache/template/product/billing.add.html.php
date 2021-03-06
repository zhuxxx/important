__layout|public:mini_layout|layout__
<div id="admInfo" title="" style="padding:10px;" showModal="true" allowResize="true" allowDrag="true">
  <div id="addForm" class="form" >
		<table style="width:100%;">
		<!-- 加token防止并发 -->
		<input class="mini-hidden" value='<?php echo E('RedisCluster',APP_LIB.'class')->get("billing_token"); ?>' name="billing_token">

		<input class="mini-hidden" name="billing_type"  value="<?php echo $this->_var['type']; ?>"/>
		<input class="mini-hidden" name="order_sn"  value="<?php echo $this->_var['headData']['order_sn']; ?>"/>
		<input class="mini-hidden" name="o_id"  value="<?php echo $this->_var['o_id']; ?>"/>
		<input class="mini-hidden" name="c_id"  value="<?php echo $this->_var['headData']['c_id']; ?>"/>

		<!-- 审核所需字段 -->
		<input class="mini-hidden" name="id"  value="<?php echo $this->_var['id']; ?>"/>
		<input class="mini-hidden" name="finance"  value="<?php echo $this->_var['finance']; ?>"/>
		<!-- <input class="mini-hidden" name="unbilling_price"  value="<?php echo $this->_var['unbilling_price']; ?>"/> -->
			<?php if ($this->_var['finance']): ?>
			<tr>
				<td>发票号<span style="color:red">*</span></td>
				<td><input id='invoice_sn'  name="invoice_sn" class="mini-textbox" maxlength="50" value="" style="width:250px;" required="true"/></td>
			</tr>
			<?php endif; ?>
			<tr>
				<td>开票单位</td>
				<td><input name="rise" class="mini-textbox" maxlength="12" value="<?php echo $this->_var['headData']['c_name']; ?>" style="width:250px;"allowInput="false"/></td>
			</tr>
			<!-- <tr>
				<td>开票日期<span style="color:red">*</span></td>
				<td><input name="payment_time" class="mini-datepicker" value="<?php echo date('Y-m-d H:i:s'); ?>" style="width:150px;" format="yyyy-MM-dd" showTime="true" required="true"/></td>
			</tr> -->
			<tr>
				<td>收款日期</td>
				<td><input name="" class="mini-textbox" value="<?php echo $this->_var['payment_time']; ?>" style="width:250px;" required="true" allowInput="false"/></td>
			</tr>
			<tr>
				<td><?php if ($this->_var['type'] == '1'): ?>销售合同主题<?php else: ?>采购合同主题<?php endif; ?></td>
				<td><?php echo $this->_var['company_account'][$this->_var['headData']['order_name']]; ?></td>
				<td><input name="title" class="mini-hidden" maxlength="12" value="<?php echo $this->_var['headData']['order_name']; ?>" style="width:250px;" required="true" allowInput="false"/></td>
			</tr>
			<tr>
				<td>合同金额</td>
				<td><input name="total_price" class="mini-textbox" maxlength="12" value="<?php echo $this->_var['headData']['total_price']; ?>" style="width:250px;" allowInput="false"/></td>
			</tr>

			<?php if ($this->_var['finance']): ?>
			<tr>
				<td>未开票金额</td>
				<td><input name="unbilling_price" class="mini-textbox" maxlength="12" value="<?php echo $this->_var['headData']['unbilling_price']; ?>"style="width:250px;" allowInput="false"/></td>
			</tr>
			<tr>
				<td>申请票据金额<span style="color:red">*</span></td>
				<td><input id="billing_price" name="billing_price" class="mini-textbox" maxlength="12" value="<?php echo $this->_var['headData']['billing_price']; ?>" style="width:250px;" required="true" allowInput="false"/></td>
			</tr>
			<!-- <tr>
				<td>税额<span style="color:red">*</span></td>
				<td><input name="tax_price" class="mini-textbox" maxlength="12" value="" style="width:150px;" required="true"/></td>
			</tr>
			<tr>
				<td>票据类型<span style="color:red">*</span></td>
				<td><input name="bile_type" class="mini-combobox" data='<?php echo setMiniConfig($this->_var['bile_type']); ?>' textField="name" valueField="id" style="width:150px;" required="true"/></td>
			</tr> -->
			<?php else: ?>
			<tr>
				<td>未开票金额</td>
				<td><input name="unbilling_price" class="mini-textbox" maxlength="12" value="<?php echo $this->_var['un_pay']; ?>" style="width:250px;" allowInput="false"/></td>
			</tr>

			<tr>
				<td>票据金额<span style="color:red">*</span></td>
				<td><input id="billing_price" name="billing_price" class="mini-textbox" maxlength="12" value="<?php echo $this->_var['un_pay']; ?>"style="width:250px;" required="true" allowInput="false"/></td>
			</tr>
			<?php endif; ?>

			<tr>
				<td>附件</td>
				<td>
					<input id="file_url"  name="accessory" class="mini-textbox" value="" style="width:200px"/>
					<input id="upfileId" type="file" name="upFile" style="width:105px" onChange="fileUpload();">
				</td>
			</tr>
			<!-- <tr>
				<td>付款信息</td>
				<td><input name="paying_info" class="mini-textarea" style="width:300px; height:40px;"/></td>
			</tr>
			<tr>
				<td>收款信息</td>
				<td><input name="receipt_info" class="mini-textarea" style="width:300px; height:40px;"/></td>
			</tr> -->
			<tr>
				<td>备注</td>
				<td><input name="remark" class="mini-textarea" style="width:300px; height:50px;"/></td>
			</tr>
			<tr>
			<td style="text-align:center;padding-top:15px;padding-right:20px; margin-top:20px;" colspan="2">
				<a class="mini-button" iconCls="icon-ok" onclick="submitForm(billing=<?php echo $this->_var['type']; ?>)">提交</a>
				<a class="mini-button" iconCls="icon-cancel" onclick="onCancel">关闭</a>
				<span id="returnMsg" style="padding-left:5px; color:#F00;"></span>
			</td>
			</tr>
		</table>
	</div>
</div>
<?php if ($this->_var['type'] == 1): ?>
<fieldset style="width:760px;border:solid 1px #aaa;position:relative;">
		<legend>公司开票资料</legend>
		<div id="editForm1" style="padding:5px;">
			<input class="mini-hidden" name="id"/>
			<table style="width:100%;">
				<tr>
					<td>纳税人识别号</td>
					<td><input name="tax_id" class="mini-textbox" style="width:240px;" value="<?php echo $this->_var['companyInfo']['tax_id']; ?>" allowInput="false"/></td>
					<td>开票地址</td>
					<td><input name="invoice_address" class="mini-textbox" style="width:240px;" value="<?php echo $this->_var['companyInfo']['invoice_address']; ?>" allowInput="false"/></td>
				</tr>
				<tr>
					<td>开票银行</td>
					<td><input name="invoice_bank" class="mini-textbox" style="width:240px;" value="<?php echo $this->_var['companyInfo']['invoice_bank']; ?>" allowInput="false"/></td>
					<td>开票帐号</td>
					<td><input name="invoice_account" class="mini-textbox" style="width:240px;" value="<?php echo $this->_var['invoice_account']; ?>" allowInput="false"/></td>
				</tr>
				<tr>
					<td>开票电话</td>
					<td><input name="invoice_tel" class="mini-textbox" style="width:240px;" value="<?php echo $this->_var['companyInfo']['invoice_tel']; ?>" allowInput="false"/></td>
				</tr>
			</table>
		</div>
	</fieldset>
<?php endif; ?>

<fieldset style="width:760px;border:solid 1px #aaa;position:relative;">
<legend>详细信息</legend>
	<div id="investGrid" class="mini-datagrid" style="width:auto;height:200px;" idField="id" url="/product/billing/billingLog?id=<?php echo $this->_var['id']; ?>&o_id=<?php echo $this->_var['o_id']; ?>&type=<?php echo $this->_var['type']; ?>&is_head=<?php echo $this->_var['is_head']; ?>" sizeList="[10,20,50,100]" showFooter="false" pageSize="20" multiSelect="true" showFilterRow="true" allowCellSelect="true" allowCellEdit="true">
		<div property="columns">
			<!-- <div field="id" width="30" headerAlign="center" align="center" allowSort="true" >ID</div> -->
			<?php if ($this->_var['finance']): ?>
			<div field="f_type" width="50" headerAlign="center" align="center">品种</div>
			<div field="type" width="50" headerAlign="center" align="center">类型</div>
			<?php else: ?>
			<div field="type" width="50" headerAlign="center" align="center">类型</div>
			<?php endif; ?>
			<div field="model" width="90" headerAlign="center" align="center">牌号</div>
			<div field="f_name" width="50" headerAlign="center" allowSort="true" align="center">厂家</div>

			<div field="b_number" width="50" headerAlign="center" align="center">数量<span style="color:red">*</span>
				<input property="editor" onvaluechanged="onValidation"  class="mini-textbox" style="width:100%;"/>
			</div>
			<div field="un_number" width="50" headerAlign="center" align="center">未开票数量</div>
			<div field="number" width="50" headerAlign="center" align="center">订单数量</div>

			<div field="unit_price" id="unit_price" width="50" headerAlign="center" allowSort="true" align="center">单价</div>
			<?php if ($this->_var['type'] == '1'): ?>
			<div field="lot_num" width="50" headerAlign="center" allowSort="true" align="center">批次号</div>
			<div field="store_name" width="50" headerAlign="center" allowSort="true" align="center">仓库</div>
			<?php else: ?>
			<!-- <div field="f_name" width="50" headerAlign="center" allowSort="true" align="center">厂家</div> -->
			<?php endif; ?>
			<div field="sum" id="sum" width="50" headerAlign="center" allowSort="true" align="center">小计</div>
			<div name="exact" field="exact" id="exact">小计精确值</div>
			<div action='do' width="40" headerAlign="center" renderer="viewhander" align="center">操作</div>

		</div>
		<div style="display: none">
			<div id="exact"></div>
		</div>

	</div>
</fieldset>
<script src="__JS__/jquery/jquery.upload.js" type="text/javascript"></script>
<script type="text/javascript">
mini.parse();
var noStockData;
//搜索或刷新
var admInfo = mini.get("admInfo");
var form = new mini.Form("#addForm");
var grid = mini.get("investGrid");
// noStockData=grid.getData();
function search() {
	grid.load($("#soform").serializeObject(),function(e){
		$("#searchMsg").html(e.msg);
	});
}
search();
function onKeyEnter(e) {
	search();
}

//隐藏列
grid.hideColumn("exact");


//修改数量改变值方法
function onValidation(e){
	var number=e.value;
	var index=grid.getSelected()._index;//行号
	e.sender.setValue(parseFloat(number).toFixed(4));

	noStockData=grid.getData();
	if( !number || parseFloat(number)<=0){
		number=1;
		e.sender.setValue(number);
	}
	if(parseFloat(number)>parseFloat(noStockData[index].un_number)){
		number=noStockData[index].un_number;
		e.sender.setValue(number);
	}

	noStockData[index].b_number=parseFloat(number);
	noStockData[index].sum=parseFloat(noStockData[index].unit_price*number).toFixed(2);//用于显示
	noStockData[index].exact=parseFloat(noStockData[index].unit_price*number);//精确数据，用于计算
	grid.setData(noStockData);
	var total=0;
	data=grid.getData();
	for (var i = 0; i < data.length; i++) {
		total+=parseFloat(data[i].exact);
	}
	mini.get('billing_price').setValue(total.toFixed(2));
 }

//追加操作，删除按钮
function viewhander(e){
	var record = e.record,s='';
	s += '<a href="javascript:removeRow()">删除</a>';
	return s;
}
//删除操作
function removeRow() {
	var rows = grid.getSelecteds();
	if (rows.length > 0) {
		grid.removeRows(rows, true);
	}
	noStockData=grid.getData();
	var total=0;
	for (var i = 0; i < noStockData.length; i++) {
		total+=parseFloat(noStockData[i].sum);
	}
	mini.get('billing_price').setValue(total.toFixed(2));
}

//增加后提交数据(保存)
function submitForm(billing) {
	form.validate();
	if (form.isValid() == false) return;
	//提交数据
	var data=grid.getData();
	if(data.length==0){
		$("#returnMsg").text("明细不能为空");
		return;
	}
	var o = form.getData();
	$.extend(o, {detail:data});
	var json = mini.encode(o);

	form.loading("数据提交中，请稍后......");
	$.post('/product/billing/ajaxSave',{data:json,do:billing},function(data){
		form.unmask();
		$("#returnMsg").text(data.msg);
		if(data.err=='0'){
			CloseWindow("save");
		}else{
			return false;
		}
	},'json');
}

function fileUpload() {
	$.ajaxFileUpload({
		url:'/system/sysUpload/upload',
			secureuri:false,
			fileElementId:'upfileId',
			dataType:'json',
			success: function (data) {
				if(data.error=='0'){
					mini.get("file_url").setValue(data.url);
				}
			},
			error: function (data, status, e){
				$("#picResult").html(e);
			}
		})
	return false;
}

function GetData() {
	var row = form.getSelected();
	return row;
}

function CloseWindow(action) {
	if (window.CloseOwnerWindow) return window.CloseOwnerWindow(action);
	else window.close();
}
function onCancel(e) {
	CloseWindow("cancel");
}

//销售发票号去重,采购不去重
<?php if ($this->_var['type'] == '1'): ?>
	$(function(){
		$("#invoice_sn").bind("change",function(){
			var sn = mini.get("invoice_sn").getValue();
			var urlstr = '/product/billing/curUnique';
			$.post(urlstr,{data:sn},function(data){
				if(data.err=='1'){
					alert(data.msg);
				}
			},'json');
		});
	});
<?php endif; ?>

</script>