<?php
/**
 * 产品报价与采购管理
 */
class purchaseAction extends adminBaseAction {
	public function __init(){
		$this->debug = false;
		$this->doact = sget('doact','s');
		//产品信息表
		$this->db=M('public:common')->model('purchase');
		$this->assign('product_type',L('product_type'));//产品分类语言包
		$this->assign('product_status',L('product_status'));//产品状态
		$this->assign('process_type',L('process_level'));//加工级别
		$this->assign('period',L('period'));//交货周期
		$this->assign('status',L('purchase_status'));//采购状态
		$this->assign('ctype',sget('ctype'));//采购状态
	}
	/**
	 * 会员列表 期货采购
	 * @access public 
	 * @return html
	 */
	public function init(){
		$action=sget('action','s');
		if($action=='grid'){ //获取列表
			$this->_grid();exit;
		}elseif($action=='remove'){ //获取列表
			$this->_remove();exit;
		}elseif($action=='submit'){ //获取列表
			$this->_submit();exit;
		}elseif($action=='save'){ //获取列表
			$this->_save();exit;
		}elseif($action=='info'){ //获取列表
			$this->_info();exit;
		}
		$this->assign('id',sget('id','i',''));
		$this->assign('doact',$this->doact);
		$this->assign('slt','slt');
		$this->assign('ctype','2');
		$this->assign('page_title','期货采购列表');
		$this->display('purchase.list.html');
	}
	/**
	 *现货采购
	 */
	public function cargo(){
		$action=sget('action','s');
		if($action=='grid'){ //获取列表
			$this->_grid();exit;
		}
		$this->assign('ctype','1');
		$this->assign('page_title','现货采购列表');
		$this->display('purchase.list.html');
	}
	/**
	 * Ajax获取列表内容
	 * @access private
	 * @return html
	 */
	private function _grid(){
		$slt = sget("do",'s','');
		$page = sget("pageIndex",'i',0); //页码
		$size = sget("pageSize",'i',20); //每页数
		$sortField = sget("sortField",'s','p.input_time'); //排序字段
		$sortOrder = sget("sortOrder",'s','desc'); //排序
		//搜索条件
		$where=" 1  and p.`type` = 1 and p.`is_union` = 0 ";   //1 采购
		if($this->doact != 'search'){
			if($slt){
				$where .=" and p.`cargo_type` = 2 "; //期货采购
			}else{
				$where .=" and p.`cargo_type` = 1 "; //现货采购
			}
		}
		$sTime = sget("sTime",'s','p.input_time'); //搜索时间类型
		$where.= getTimeFilter($sTime); //时间筛选
		// 状态
		$status = sget("status",'s',''); 
		if($status!='') $where.=" and p.status='$status' ";
		//品种
		$product_type = sget('product_type','s','');
		if($product_type!='') $where.=" and pd.product_type = '$product_type' ";
		//周期
		$period = sget('period','s','');
		if($period!='') $where.=" and p.period = '$period' ";
		//关键词搜索
		$key_type=sget('key_type','s','p.period');
		$keyword=sget('keyword','s');
		if(!empty($keyword)){
			if($key_type == 'f_name'){
				$result = M('product:factory')->getIdsByName($keyword);
				$result = implode($result,',');
				$where.=" and pd.f_id in ($result) ";
			}else if($key_type == 'username'){
				//方法是getOne,所以不考虑同名的情况
				$ids = M('rbac:adm')->getAdmin_Id($keyword);
				$where.=" and `customer_manager`='$ids' ";
			}else{
				$where.=" and `$key_type`='$keyword' ";
			}
			
		}
		//此id是从每日任务统计传来的
		$id=sget('id','i');
		if(!empty($id)){
			$where="1 and p.`id` = '$id' ";
		}

		$list=$this->db->select("p.*,pd.model, pd.f_id, pd.product_type, pd.process_type, pd.unit")
				->from('purchase p')->join('product pd','pd.id = p.p_id')
				->where($where)
				->page($page+1,$size)
				->order("$sortField $sortOrder")
				->getPage();
		foreach($list['data'] as &$v){
			//
			$v['input_time'] = $v['input_time']>1000 ? date("Y-m-d H:i:s",$v['input_time']) : '-';
			$v['update_time'] = $v['update_time']>1000 ? date("Y-m-d H:i:s",$v['update_time']) : '-';
			$v['product_type'] = L('product_type')[$v['product_type']];
			$v['f_id'] = $this->_getFactoryName($v['f_id']);
			$v['process_type'] = L('process_level')[$v['process_type']];
			$v['period'] = L('period')[$v['period']];
			$v['username'] = M('rbac:adm')->getUserByCol($v['customer_manager'],'name');
			$v['c_name'] = M('user:customer')->getColByName($v['c_id']);
			//
			// $list['data'][$k]['input_time']=$v['input_time']>1000 ? date("Y-m-d H:i:s",$v['input_time']) : '-';
			// $list['data'][$k]['update_time']=$v['update_time']>1000 ? date("Y-m-d H:i:s",$v['update_time']) : '-';
			// $list['data'][$k]['product_type'] = L('product_type')[$v['product_type']];
			// $list['data'][$k]['f_id'] = $this->_getFactoryName($v['f_id']);
			// $list['data'][$k]['process_type'] = L('process_level')[$v['process_type']];
			// $list['data'][$k]['period'] = L('period')[$v['period']];
			// $list['data'][$k]['username'] = M('rbac:adm')->getUserByCol($v['customer_manager'],'name');
			// $list['data'][$k]['c_name'] = M('user:customer')->getColByName($v['c_id']);
			// if($v['origin']){
			// 	$areaArr = explode('|', $v['origin']);
			// 	$list['data'][$k]['origin'] = M('system:region')->get_name(array($areaArr[0],$areaArr[1]));
			// }
			if($v['provinces']>0){
				$v['provinces'] = M('system:region')->get_name($v['provinces']);
				// $list['data'][$k]['provinces'] = M('system:region')->get_name($v['provinces']);
			}
		}
		$result=array('total'=>$list['count'],'data'=>$list['data']);
		$this->json_output($result);
	}	

	/**
	 * 编辑已存在的数据
	 * @access public 
	 * @return html
	 */
	private function _save(){
		$this->is_ajax=true; //指定为Ajax输出
		$data = sdata(); //获取UI传递的参数
		$sql=array();
		if(empty($data)){
			$this->error('操作数据为空');
		}
		foreach($data as $k=>$v){
			$_data=array(
				'update_time'=>CORE_TIME,
				'chk_time'=>CORE_TIME,
				'update_admin'=>$_SESSION['username'],
			);
			if(isset($v['_state']) && $v['_state']=='added'){
				$sql[]=$this->db->addSql($_data+array(
					'input_time'=>CORE_TIME,
				));
			}else{
				$sql[]=$this->db->wherePk($v['id'])->updateSql(array('status'=>$v['status'])+$_data);
			}
			
		}
		$result=$this->db->commitTrans($sql);
		if($result){
			$this->success('操作成功');
		}else{
			$this->error('数据处理失败');
		}
	}
	/**
	 * 获取处理订单
	 * @access private 
	 * @return html
	 */
	private function _info(){
		$getReportData = $this->getReportData();//调用adminBase的方法，验证业务员是否设置本月指标
		$this->is_ajax=true;
		$id=sget('id','i');
		if($id>0){
			$info=$this->db->wherePk($id)->getRow();
			$p_info  = $this->db->model('product')->wherePk($info['p_id'])->getRow();
			$info = array_merge($p_info,$info);
			if($info['origin']){
				$areaArr = explode('|', $info['origin']);
				if($info['provinces']>0){
					$info['company_province'] = $info['provinces'];
				}else{
					$info['company_province'] = $areaArr[0];
				}
				$info['company_city']=$areaArr[1];
			}
			$contact=M('user:customerContact')->getListByCid($info['c_id']);
			$c_name = M('user:customer')->getColByName($info['c_id']); //客户名称
			$f_name = M('product:product')->getFnameByPid($info['p_id']); //厂家名称
			if(($info['c_id']==4016)||($info['c_id']==5041)){
			    $this->assign('cc_id',$info['c_id']);
			}else{
			    $this->assign('cc_id',0);
			}
			$this->assign('contact',arrayKeyValues($contact, 'user_id', 'name'));
			$this->assign('data',$info);
			$this->assign('c_name',$c_name);
			$this->assign('f_name',$f_name);
		}else{
		    $this->assign('cc_id',0);
		}
		$this->assign('id',$id);

		$this->assign('regionList', arrayKeyValues(M('system:region')->get_regions(1),'id','name'));//第一级省市
		$this->assign('page_title','手动添加采购信息');
		$this->display('purchase.add.html');
	}
	/**
	 * 提交订单详细信息
	 */
	public function submit(){
		$id=sget('id','i',0); //ID
		$_info=sget('info','a');
		if(empty($_info)){
			$this->error('操作有误');	
		}
		$_info['admin_name']=$_SESSION['username'];
		$_info['update_time']=CORE_TIME;
		$_info['status']=1;
		$_info['provinces'] = $_info['company_province'];
		$_data=saddslashes($_info);
		$this->db->model('ship_collect')->wherePk($id)->update($_data);
		$this->success('操作成功');
	}

	/**
	 * 新增采购信息
	 * @access public 
	 * @return html
	 */
	public function addSubmit() {
		$this->is_ajax=true; //指定为Ajax输出
		$data = sdata(); //获取UI传递的参数
		$id =  $data['id'];
		//$utype = $data['ctype'];
		$data['origin']= $data['company_province'].'|'.$data['company_city'];//组合区域
		$data['provinces'] =  $data['company_province'];
		$data['store_house']= $data['company_city'];
//		if($data['company_province']>0) $data['area'] = M('system:region')->get_area($data['company_province']);//获取华东华南归属
		$model = trim($data['model']);
		//公共数据
		$_data = array(
			'input_time'=>CORE_TIME,
			'input_admin'=>$_SESSION['username'],
		);
		if($id <= 0){
			if($data['f_id']>0  && (!empty($model))){
				$p_id = M('product:product')->getPidByModel($data['model'],$data['f_id']);
				$data['p_id']  = $p_id>0 ? $p_id : M('product:product')->insertProduct(array('status'=>3,)+$data+$_data);
				$data['customer_manager'] = $_SESSION['adminid'];
			} else{
				$this->error('牌号或者厂家不能为空');
			}
		}
		//货物类型
		$data['cargo_type'] = $data['ctype']==1?1:2;
		//数据添加操作
		if($data['id']>0){
			if($this->db->where("id = $id")->update($data+array('update_time'=>CORE_TIME,'update_admin'=>$_SESSION['username'],)))  $this->success('操作成功');		
		}else{
			if($this->db->add($data+$_data)) $this->success('操作成功');	
		}
		$this->error('添加失败');
		
	}
	/**
	 * 根据厂家id获取厂家名称
	 */
	private function _getFactoryName($id){
		$result  = $this->db->model('factory')->select('f_name')->where("`fid` = $id")->getOne();
		return empty($result) ? '-' : $result;
	}
	/**
	 * 弹出审核页面
	 * @Author   cuiyinming
	 * @DateTime 2016-07-01T15:31:38+0800
	 * @return   [type]                   [description]
	 */
	public function chkpage(){
		$id = sget('id','i',0);
		if($id<1) $this->error('信息错误');
		$this->assign('id',$id);
		$this->display('purchase.chk.html');
	}
	//审核结果提交
	public function chkSubmit(){
		$id =sget('id','i',0);
		$status = sget('status','i');
		if($id<1) $this->error('用户信息错误');
		$result = $this->db->wherePk($id)->update(array('status'=>$status,'update_time'=>CORE_TIME,'update_admin'=>$_SESSION['username']));
		if(!$result) $this->error('操作失败');
		$this->success('操作成功');
	}

	/**
	 * Excel导入
	 */

	public function inputExcel(){
		$this->is_ajax = true;
		$ctype = sget('ctype','i',0);
		E('PHPExcel',APP_LIB.'extend');

		if(empty($_FILES['check_file']) || $_FILES['check_file']['error']) $this->error('文件上传失败！');

		$result = array();
		try {
			$objPHPExcel = PHPExcel_IOFactory::load($_FILES['check_file']['tmp_name']);
			$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
			if(empty($sheetData)) $this->error('上传文件不正确，请重新上传');
			if(count(array_shift($sheetData)) !== 10) throw new Exception('Excel表数据格式不匹配');

			$error=array();
 			foreach($sheetData as $row){ 				
				//如果为空或者不是数字则 不检查导入该行
				if(empty($row['A']) || empty($row['B']) || empty($row['C']) || empty($row['D']) || empty($row['E']) || empty($row['F']) || empty($row['G']) || empty($row['H']) || empty($row['I']) || !is_numeric($row['F']) || !is_numeric($row['G']) ){
					$error['number']+=1;
					$error['err'][]='数据不规范';
					continue;
				}
				//获取公司id
				$c_id = $this->db->model('customer')->select('c_id')->where('c_name='.'"'.$row['A'].'"')->getOne();
				if (!$c_id){
					$error['number']+=1;
					$error['err'][]=$row['A'].'公司名有误';
					continue;
				}

				//获取厂家f_id
				$f_id = M('product:factory')->getIdByFName($row['D']);
				if (!$f_id) {
					$error['number']+=1;
					$error['err'][]=$row['D'].'厂家名有误';
					continue;
				}

				//获取产品类型
				$rowB = strtoupper($row['B']);
				$product_type=array_flip(L('product_type'))[$rowB];
				if(!$product_type){
					$error['number']+=1;
					$error['err'][]=$row['B'].'产品类型有误';
					continue;
				}

				//获取期货周期
				$period=array_flip(L('period'));
				if(!$period=$period[$row['I']]){
					$error['number']+=1;
					$error['err'][]=$row['I'].'周期有误';
					continue;
				}

				//获取默认联系人user_id
				// $user_id = $this->db->model('customer_contact')->select('user_id')->where('c_id='.$c_id.' and is_default=1')->getOne();
				$user_id = $this->db->model('customer')->select('contact_id')->where('c_id='.$c_id)->getOne();
				if (!$user_id){
					$error['number']+=1;
					$error['err'][]=$row['A'].'联系人有误';
					continue;
				}

				//获取交货地的id
				$add_id = $this->db->model('lib_region')->select('id')->where('name='."'".$row['H']."'")->getOne();
				if (!$add_id){
					$error['number']+=1;
					$error['err'][]=$row['H'].'交货地有误';
					continue;
				}

				//获取产品的ID
				$p_id = M('product:product')->getPidByModel($row['C'],$f_id);
				if (!$p_id){
					$error['number']+=1;
					$error['err'][]=$row['C'].'对应商品不存在';
					continue;
				}

				//获取产品属性，如：加工级别
				// $process_type=array_flip(L('process_level'));
				// $process_type=isset($process_type[$row['E']])?$process_type[$row['E']]:11;
				$process_type = $this->db->model('product')->select('process_type')->where("id=".$p_id)->getOne();
				if(!empty($row['E'])){
					$process = L('process_level')[$process_type];
					if($row['E'] != $process){
						$error['number']+=1;
						$error['err'][]=$row['C'].'加工级别有误';
						continue;
					}
				}
				//写数据到表中p2p_product
				$_infoData = array(
					'c_id'		=>$c_id,
					'user_id'	=>$user_id,
					'product_type'=>$product_type,
					'model'		=>$row['C'],
					'f_id'		=>$f_id,
					'process_type'=>$process_type,
					'number'	=>$row['F'],
					'unit_price'=>$row['G'],
					'provinces' =>$add_id,					
					'period' 	=>$period,
					'remark' 	=>$row['J'],
					//牌号和厂家id取得商品id
					'p_id'   	=>$p_id,
					'cargo_type'=>$ctype,	//1现货 2期货
					'status' 	=>2,		//审核通过
					'type'		=>1,		//1采购 2报价
					'is_union'	=>0,		//是否是中晨的报价 0否1是
					'sync'		=>1,		//0后台添加 1更新过来
					'customer_manager'=>$_SESSION['adminid'],//谁导入就是谁发的采购信息
					'input_time'=>CORE_TIME,
					'input_admin'=>$_SESSION['username'],
				);
				$this->db->model('purchase')->add($_infoData);
			}
		} catch (Exception $e) {
			$this->error($e->getMessage());			
		}
		$this->json_output(array('err'=>$error['number'],'result'=>!$error['err']?'导入成功':$error['err']));
	}

	/**
	 * 导出excel
	 * @access public 
	 * @return html
	 */
	public function download(){

		//$slt = sget("do",'s','');
		// $roleid = M('rbac:rbac')->model('adm_role_user')->select('role_id')->where("`user_id` = {$_SESSION['adminid']}")->getOne();
		// if(in_array($roleid, array('30','26','27'))){
		// 	$sortField = sget("sortField",'s','update_time'); //排序字段
		// }else{
		// 	$sortField = sget("sortField",'s','input_time'); //排序字段
		// }

		$sortField = sget("sortField",'s','p.input_time'); //排序字段
		$sortOrder = sget("sortOrder",'s','desc'); //排序
		//搜索条件
		$where=" 1  and p.`type` = 1 and p.`is_union` = 0 ";   //1 采购
		if($this->doact != 'search'){
			$ctype = sget('ctype','i',0);
			if ($ctype ==1) {
				$where .=" and p.`cargo_type` = 1 "; //现货采购
			}else{
				$where .=" and p.`cargo_type` = 2 "; //期货采购
			}
		}
		$sTime = sget("sTime",'s','p.input_time'); //搜索时间类型
		$where.= getTimeFilter($sTime); //时间筛选
		
		$status = sget("status",'s',''); // 状态
		if($status!='') $where.=" and p.status='$status' ";
		
		$product_type = sget('product_type','s','');//品种
		if($product_type!='') $where.=" and pd.product_type = '$product_type' ";
		
		$period = sget('period','s','');//周期
		if($period!='') $where.=" and p.period = '$period' ";
		
		$key_type=sget('key_type','s','p.period');//关键词搜索
		$keyword=sget('keyword','s');
		if(!empty($keyword)){
			if($key_type == 'f_name'){
				$result = M('product:factory')->getIdsByName($keyword);
				$result = implode($result,',');
				$where.=" and pd.f_id in ($result) ";
			}else if($key_type == 'username'){
				//方法是getOne,所以不考虑同名的情况
				$ids = M('rbac:adm')->getAdmin_Id($keyword);
				$where.=" and `customer_manager`='$ids' ";
			}else{
				$where.=" and `$key_type`='$keyword' ";
			}			
		}
		//筛选领导级别
		if($_SESSION['adminid'] != 1 && $_SESSION['adminid'] > 0){
			$sons = M('rbac:rbac')->getSons($_SESSION['adminid']);  //领导
			$where .= " and `customer_manager` in ($sons) ";
		}
		$orderby = "$sortField $sortOrder";
		$list=$this->db->select("p.*,pd.model, pd.f_id, pd.product_type, pd.process_type, pd.unit")
			->from('purchase p')->join('product pd','pd.id = p.p_id')
			->where($where)
			->page($page+1,$size)
			->order("$sortField $sortOrder")
			->getAll();

		foreach($list as &$v){
			$v['input_time']=$v['input_time']>1000 ? date("Y-m-d H:i:s",$v['input_time']) : '-';
			$v['update_time']=$v['update_time']>1000 ? date("Y-m-d H:i:s",$v['update_time']) : '-';
			$v['product_type'] = L('product_type')[$v['product_type']];
			$v['f_id'] = $this->_getFactoryName($v['f_id']);
			$v['process_type'] = L('process_level')[$v['process_type']];
			$v['period'] = L('period')[$v['period']];
			$v['username'] = M('rbac:adm')->getUserByCol($v['customer_manager'],'name');
		}
		$str = '<meta http-equiv="Content-Type" content="text/html; charset=utf8" /><table width="100%" border="1" cellspacing="0">';

		$str .= '<tr><td>品种</td><td>牌号</td><td>厂家</td><td>加工级别</td>
					<td>数量【吨】</td><td>预期价格</td><td>交货地</td><td>周期</td>
					<td>报价数</td><td>备注</td><td>创建时间</td><td>更新时间</td>
					<td>交易员</td>
				</tr>';
		foreach($list as $k=>$v){
			$str .= "<tr><td style='vnd.ms-excel.numberformat:@'>".$v['product_type']."</td><td>".$v['model']."</td><td>".$v['f_id']."</td><td>".$v['process_type']."</td>
						<td>".$v['number']."</td><td>".$v['unit_price']."</td><td>".$v['provinces']."</td><td>".$v['period']."</td>
						<td>".$v['supply_count']."</td><td>".$v['remark']."</td><td>".$v['input_time']."</td><td>".$v['update_time']."</td>
						<td>".$v['username']."</td>
					</tr>";
		}
		$str .= '</table>';
		$filename = 'purchase.'.date("Y-m-d");
		header("Content-type: application/vnd.ms-excel; charset=utf-8");
		header("Content-Disposition: attachment; filename=$filename.xls");
		echo $str;
		exit;
	}
	/**
	 * 获取平台自购custom内容
	 * @access public
	 * @return html
	 */
	public function getcustom(){
	    $this->is_ajax=true; //指定为Ajax输出
	    $data = sdata(); //获取UI传递的参数
	    $c_id =  $data['c_id'];
	    $custom=$this->db->model('customer')->select('*')->where("c_id='{$c_id}'")->getRow();
	    if(empty($custom)){
	        $this->error("公司不存在!");
	    }else{
	        $this->success($custom);
	    }
	}
}