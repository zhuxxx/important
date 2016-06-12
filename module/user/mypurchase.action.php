<?php
/**
 * 我的求购信息--黎贤
 */
class mypurchaseAction extends homeBaseAction{


	protected $db;
	public function __init()
	{
		$this->db=M('public:common');
	}

	public function init()
	{
		$this->act='mypurchase';
		$this->name="求购发布";
		$this->type=1;
		
		$this->product_type=L('product_type');//产品类型
		$this->period=L('period');//期货周期
		$this->process_level=L('process_level');//加工级别
		$this->area=M('system:region')->get_regions(1);//地区
		$this->display('mypurchase');
	}

	// 我的采购列表
	public function lists()
	{
		$this->act="purchaselist";
		$this->type=1;
		$this->name="采购管理";
		$this->product_type=L('product_type');//产品类型
		$this->shelve_type=L('shelve_type');//上下架状态
		$this->cargo_type=L('cargo_type');//现货期货
		
		$this->display('mypurchase.list');
	}

	public function tables()
	{
		$type=sget('type','i',1);
		$this->assign('type',$type);
		$where="pur.user_id=$this->user_id and type=$type";

		if($keyword=sget('keyword','s','')){
			$where.=" and (pro.model='{$keyword}' or fa.f_name='{$keyword}')";
		}
		if($product_type=sget('product_type','i',0)){
			$where.=" and pro.product_type={$product_type}";
		}
		if($shelve_type=sget('shelve_type','i',0)){
			$where.=" and pur.shelve_type={$shelve_type}";
		}
		if($cargo_type=sget('cargo_type','i',0)){
			$where.=" and pur.cargo_type={$cargo_type}";
		}

		$page=sget('page','i',1);
		$size=10;
		$list=M('product:purchase')->getPurPage($where,$page,$size);
		// p($list);
		$this->assign('list',$list);
		$this->assign('page',$page);
		$this->assign('count',ceil($list['count']/$size));
		$this->display('mypurchase.table');
	}


	//下架操作
	public function offshelf()
	{
		if($_POST)
		{
			$this->is_ajax=true;
			if(!$ids=sget('ids')) $this->error('信息不存在');
			$this->db->model('purchase')
			->where("user_id=$this->user_id and id in (".implode(',',$ids).")")
			->update(array('shelve_type'=>2,'update_time'=>CORE_TIME));
			$this->success('操作成功');
		}
	}

	public function reshelf()
	{	
		$this->is_ajax=true;
		if($data=$_POST['data'])
		{
			$model=$this->db->model('purchase');
			foreach ($data as $key => $value) {
				// if($value['on']){
				// 	$_data=array(
				// 		'input_time'=>CORE_TIME,
				// 		'update_time'=>CORE_TIME,
				// 		'shelve_type'=>1,
				// 		'number'=>$value['num'],
				// 		'unit_price'=>$value['price'],
				// 	);
				// 	$model->where("user_id=$this->user_id and id=$key")->update($_data);
				// }
				if($value['on']){
					$_data=$model->getPk($value['on']);
					unset($_data['id']);
					$_data['supply_count']=0;
					$_data['last_buy_sale']=0;
					$_data['input_time']=CORE_TIME;
					$_data['update_time']=CORE_TIME;
					$_data['shelve_type']=1;
					$_data['number']=$value['num'];
					$_data['unit_price']=$value['price'];
					$_data['status']=1;
					$model->add($_data);
				}
			}
			$this->success('操作成功');
		}else{
			$this->error('信息不存在');
		}
	}

	//采购发布
	public function pub()
	{

		if($data=$_POST['data'])
		{
			$this->is_ajax=true;
			$cargo_type=sget('cargo_type','i',1);//现货、期货
			$type=sget('type','i',1);//采购、报价
			$pur_model=M('product:purchase');
			$fac_model=M('product:factory');
			$pro_model=M('product:product');

			$model=$this->db->from('product p')
				->join('factory f','p.f_id=f.fid');
			$data=saddslashes($data);
			foreach ($data as $key => $value) {
				//是否已有该产品
				$where="p.model='{$value['model']}' and p.product_type={$value['product_type']} and f.f_name='{$value['f_name']}'";
				$pid=$model->where($where)->select('p.id')->getOne();

				$_data=array(
					'user_id'=>$this->user_id,//用户id
					'c_id'=>$_SESSION['uinfo']['c_id'],//客户id
					'number'=>$value['number'],//吨数
					'unit_price'=>$value['price'],//单价
					'provinces'=>$value['provinces'],//省份id
					'store_house'=>$value['store_house'],//仓库
					'cargo_type'=>$cargo_type,//现货期货
					'period'=>$value['period'],//期货周期
					'bargain'=>$value['bargain'],//是否实价
					'type'=>$type,//采购、报价
					'input_time'=>CORE_TIME,//创建时间
				);
				if($pid){
					//已有产品直接添加采购信息
					$_data['p_id']=$pid;//产品id
					$pur_model->add($_data);
				}else{
					//没有产品则新增一个产品
					$pur_model->startTrans();
					try {
						// 是否已有厂家
						$f_id=$fac_model->where("f_name='{$value['f_name']}'")->select('fid')->getOne();
						if(!$f_id){
							//创建新厂家
							$_factory=array(
								'f_name'=>$value['f_name'],//厂家名称
								'input_time'=>CORE_TIME,//创建时间
							);
							if(!$fac_model->add($_factory)) throw new Exception("系统错误 pubpur:101");
							$f_id=$fac_model->getLastID();
						}
						$_product=array(
							'model'=>$value['model'],//牌号
							'product_type'=>$value['product_type'],//产品类型
							'process_type'=>$value['process_level'],//加工级别
							'f_id'=>$f_id,//厂家id
							'input_time'=>CORE_TIME,//创建时间
							'status'=>3,//审核状态
						);
						if(!$pro_model->add($_product)) throw new Exception("系统错误 pubpur:102");
						$pid=$pro_model->getLastID();
						$_data['p_id']=$pid;
						if(!$pur_model->add($_data)) throw new Exception("系统错误 pubpur:103");
					} catch (Exception $e) {
						$pur_model->rollback();
						$this->error($e->getMessage());
					}
					$pur_model->commit();
				}
			}
			$this->success('提交成功');
		}
	}
}