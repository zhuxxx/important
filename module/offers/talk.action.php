<?php

class talkAction extends homeBaseAction{

	protected $db;
	public function __init(){
		$this->db=M('public:common');
	}
	public function init()
	{
		if($this->user_id<=0) $this->forward('/user/login');
		$id=sget('id','i',0);
		$data=M('product:purchase')->getPurchaseById($id);
		$this->title=$data['type']==1?'我要供货':'委托洽谈';
		$contact=M('user:customerContact')->getContactByuserid($data['user_id']);
		if(!$contact) $contact=array();

		$var=$this->db->model('lib_region')->select('id,name')->where('id='.$data['store_house'])->getRow();
		$data['city']=(!empty($var['name']))?$var['name']:$data['store_house'];
		//运输方式
		$this->ship_type=L('ship_type');
		//配送地点
		$this->area=M('system:region')->get_regions(1);
		//产品类型
		$product_type=L('product_type');
		$data['product_type']=$product_type[$data['product_type']];

		$data=$data+$contact;
		$this->assign('data',$data);
		$this->display('talk.html');
	}

//联营下订单
	public function addorder()
	{
		if($_POST){
			$this->is_ajax=true;
			$data=saddslashes($_POST);
			if($this->user_id==$data['user_id']) $this->error('采购人和供货人不能相同');
			if(!$data['price']||!$data['delivery_date']||!$data['pur_id']||!$data['city']||!$data['ship_type']) $this->error('信息填写不完整');
			$pur_id=$data['pur_id'];
			$model=M('product:purchase');
			$purData=$model->getPurchaseById($pur_id);
			if( !$purData ) $this->error('请求错误,信息不存在');
			$data['p_id']=$pur_id;//报价id
			$data['c_id']=$_SESSION['uinfo']['c_id'];                          //供货方客户id
			$data['customer_manager']=$_SESSION['uinfo']['customer_manager'];  //供货方交易员id
			$data['delivery_date']=strtotime($data['delivery_date']);
//			$data['delivery_place']=$data['delivery_place'].'|';               //交货地
			$data['delivery_place']=$data['city'];
			$data['ship_type']=$data['ship_type'];
			$data['input_time']=CORE_TIME;
			$data['status']=1;
			$data['user_id']=$this->user_id;
			$data['sn']='UO'.genOrderSn();

			$this->db->model('sale_buy')->add($data);
//			$model->where("id=$p_id")->update("supply_count=supply_count+1");
			// //发送站内信
			$name=$purData['type']==1?'采购':'报价';
			$msgType=$purData['type']==1?2:3;
			$msg=L('msg_template.offers');
			$msg=sprintf($msg,$name,$purData['id'],$purData['model'],$purData['unit_price'],$_SESSION['uinfo']['name'],$purData['id'],$purData['type']);
			M("system:sysMsg")->sendMsg($purData['user_id'],$msg,$msgType);
			$_SESSION['order_success']=true;
			$this->success('提交成功');
		}else{
			$this->error('请求错误');
		}

	}


	public function msg()
	{
		if(!$_SESSION['order_success'] || $this->user_id<=0) $this->forward('/');
		$_SESSION['order_success']=null;
		$customer_manager=$this->db->model('admin')
			->where("admin_id={$_SESSION['uinfo']['customer_manager']}")
			->select('admin_id,name,mobile')
			->getRow();
		$this->assign('customer_manager',$customer_manager);
		$this->display('success');
	}
}