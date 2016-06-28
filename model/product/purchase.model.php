<?php 
//订单模型
class purchaseModel extends model{
	public function __construct() {
		parent::__construct(C('db_default'), 'purchase');
	}
	//根据pid获取指定的字段值
	public function getColById($pid=0,$col='id',$value = 'p_id'){
		$result=$this->select("$col")->where("$value =".$pid)->getOne();
		return $result>0 ? $result : 0;
	}
	public function getInfoById($id=0){
		return $this->where("`id` = '$id'")->getRow();
	}
	/**
	 * 获取报价单关联信息
	 */
	public function getPurchaseById($id=0){
		return $this->from('purchase pur')
			->join('product pro','pur.p_id=pro.id')
			->join('factory fa','pro.f_id=fa.fid')
			->join('lib_region reg','pur.provinces=reg.id')
			->where("pur.id={$id}")
			->select('pur.id,pur.user_id,pur.type,pur.cargo_type,pur.unit_price,pur.number,pur.store_house,pro.model,pro.product_type,fa.f_name,reg.name as city')
			->getRow();
	}
	/**
	 * 获取交易订单的所有信息
	 */
	public function getPurchaseInfo($id=0){
		return $this->select('p.*,pd.model, pd.f_id as pdf_id, pd.product_type, pd.process_type, pd.status as pdstatus, pd.remark as pdremark, f.f_name')->from('purchase p')->leftjoin('product pd','p.p_id=pd.id')->leftjoin('factory f','f.fid = pd.f_id')->where("p.id = $id")->getRow();
	}

	public function getPurPage($where=1,$page=1,$pageSize=10){
		return $this->from('purchase pur')
			->join('product pro','pur.p_id=pro.id')
			->join('factory fa','pro.f_id=fa.fid')
			->join('lib_region reg','pur.provinces=reg.id')
			->where($where)
			->order('input_time desc')
			->page($page,$pageSize)
			->select('pur.id,pur.supply_count,pur.bargain,pur.user_id,pur.shelve_type,pur.is_union,pur.unit_price,pur.c_id,pur.number,pur.provinces,pur.status,pur.cargo_type,pur.period,pur.input_time,pur.type,pro.model,pro.f_id,pro.product_type,pro.process_type,fa.f_name,reg.name as cityname')
			->getPage();
	}


	/**
	 * 根据条件查询我的购货信息
	 * @param $where
	 * @param $page
	 * @param $pageSize
     */
	public function getWantBuy($where, $page, $pageSize)
	{
		$this->from('sale_buy as s')
			->join('purchase as pur ', 's.p_id=pur.id')
			->join('lib_region as reg', 'pur.province=reg.id')
			->join('product as p', 'p.id=pur.p_id')
			->join('customer as c', 'c.c_id=s.c_id')
			->join('factory as f', 'p.f_id=f.fid')
			->join('union_order as u', 's.id=u.p_sale_id')
			->where($where.'and pur.last_buy_sale=s.id')
			->order('input_time desc')
			->page($page, $pageSize)
			->select('c.c_name,s.number,s.price,s.delivery_date,s.status,s.update_time,s.remark, pur.store_house,pur.cargo_type,reg.name,p.product_type,p.model,p.process_type, f.f_name`,u.id AS oid')
			->getPage();
	}




	/**
	 * 根据关注商品的pid 获取最低价格差
	 * @param $pid
     */
	public function footPrice($arr){

	    	$this->from('purchase  as  pur')
			->where("pur.p_id={$arr['pid']}")
			->order('pur.update_time DESC')
			->select('pur.p_id,pur.unit_price')
			->getAll();
		//showTrace();

	}


}