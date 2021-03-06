<?php
/**
*应用首页-web-app
*/
class mainPageAction extends homeBaseAction
{
	public function __init() {
		$this->db=M('public:common')->model('info');
    }
    //app更新页面
    public function enUpdate(){
        $this->display('update');
    }
    //app下载页面
    public function enDownLoad(){
        $this->display('download');
    }
    //进入首页
    public function enMainPage(){
    	$this->display('index');
    }
    //进入banner后的链接页面
    public function enBannerPage(){
        $this->display('info_banner');
    }
    //获取移动端的banner->position=4
    public function getAppBanner(){
        if(!$banners=M('system:block')->getBlock(4,5)) $this->json_output(array('err'=>2,'msg'=>'没有相关数据'));
        foreach ($banners as &$v) {
                $v['img']=FILE_URL."/upload/".$v['img'];
            }
        $this->json_output(array('err'=>0,'banners'=>$banners));
    }
    //获取首页数据
    public function getMainPage(){
        $this->is_ajax = true;
    	$type = sget('type','i',1);//type为1:今日头条,2:原油价格
    	if($infos = M('myapp:mainPage')->getInfos($type)) $this->json_output(array('err'=>0,'infos'=>$infos));
    	$this->json_output(array('err'=>2,'msg'=>'没有相关资讯或原油价'));
    }
    //进入今日资讯
    //点击获取今日资讯
    //进入资讯详情
    //获取资讯详情
    //进入调价动态
    //点击获取更多调价动态
    //进入首页搜素页
    public function enMainSearch(){
    	$this->display('appSearch');
    }
    //获取历史搜索和热门搜索
    public function getHisAndHot(){
        $this->is_ajax = true;
        //if($this->user_id<=0) $this->error('账户错误');
    	//历史搜索结果
    	$hisData = $this->_history();
    	//热门搜索结果
    	$hotData = $this->_hotSearch();
    	$this->json_output(array('err'=>0,'hisData'=>$hisData,'hotData'=>$hotData));
    }
    //历史搜索方法
    private function _history(){
	    //判断cookie类里面是否有浏览记录
	    if($_cfrom=cookie::get('_keyWords'))
	    return unserialize($_cfrom);
    }
    //热门搜索方法
    private function _hotSearch(){
    	$_key='hotWords';
		$cache=cache::startMemcache();
        $cache->delete($_key);
		$data=$cache->get($_key);
		if(empty($data)){
			$param = array(
				'HDPE',
				'LDPE',
				'LLDPE',
				'PP',
				'PVC',
				'2426H',
				'FB1460',
				'7042',
				'15803',
				'BL3',
				'RE420MO',
				'神华',
				'北欧化工',
				'阿塞拜疆',
				'伊朗国家石化',
				'中石油大庆',
				);
			$cache->set($_key,$param,0); //加入缓存
			$data = $param;
		}
		return $data;
    }
    //进入搜索结果页(通过首页搜索)
    public function enSearchRes(){
    	//cookie保存输入框的关键字
		$_cfrom=sget('keywords','s');//将搜索的关键字传入
		$history = array();
        if(!empty($_cfrom))
		array_push($history, $_cfrom);
		/* 去除重复记录 */
        $rows = array();
        foreach ($history as $v)
        {
            if(in_array($v, $rows))
            {
                continue;
            }
            $rows[] = $v;
        }

        /* 如果记录数量多余5则去除后面的元素 */
        if (count($rows) > 5)
        {
            $newRows = array_slice($rows, 0, 5);
            $keyWords = serialize($newRows);
            cookie::set('_keyWords',$keyWords,time()+1800);
        }
    	//
    	$this->display('appSearchResult');
    }
    //获取搜索结果数据（通过首页搜索），包括：搜索框，历史搜索，热门搜索
    //结果数据按价格排序(1从低到高,2从高到低，3默认时间)
    public function getResByPrice(){
        $this->is_ajax = true;
        //if($this->user_id<=0) $this->error('账户错误');
        $keywords = sget('keywords','s');
        $stype = sget('stype','i',3);
        $page = sget('page','i',1);
        $size = sget('size','i',8);
        if(!$sdata=M('myapp:mainPage')->getSortedData($keywords,$stype,$page,$size)) $this->json_output(array('err'=>2,'msg'=>'排序查找失败'));
        $this->json_output(array('err'=>0,'sdata'=>$sdata['data']));
    }
    //按报价或求购信息筛选
    public function getResByQuOPu(){
        $this->is_ajax = true;
        //if($this->user_id<=0) $this->error('账户错误');
        $keywords = sget('keywords','s');
        $ctype = sget('ctype','i',1);//1采购 2报价
        $page = sget('page','i',1);
        $size = sget('size','i',8);
        if(!$cdata=M('myapp:mainPage')->getCheckeddData($keywords,$ctype,$page,$size)) $this->json_output(array('err'=>2,'msg'=>'筛选查找失败'));
        $this->json_output(array('err'=>0,'sdata'=>$cdata['data']));
    }
    //搜索结果的操作,下三角(合到上面)
    //进入查看
    public function enCheckForm(){
        $this->display('supplyDemand_detail');
    }
    //进入委托
    public function enDelegateForm(){
        $this->display('supplyDemand_trade');
    }
    //搜索结果的操作，查看/委托洽谈
    public function getCheckDelegate(){
        $this->is_ajax = true;
        //if($this->user_id<=0) $this->error('账户错误');
        $otype = sget('otype','i');//1查看,2委托洽谈
        if($otype==2 && $this->user_id<=0) $this->error('账户错误');
        $id = sget('id','i');//当前这一条报价或求购的id,purchase表
        if(!$chDeRes=M('mobi:myDelegate')->getCheckDelegate($otype,$id,$this->user_id)) $this->json_output(array('err'=>2,'msg'=>'没有查看/委托的数据'));
        $this->json_output(array('err'=>0,'chDeRes'=>$chDeRes));
    }
    //点击委托洽谈,返回到搜索结果页--->仍然调用搜索页的模板和数据获取方法
    //点击左侧的分类按钮进入
    public function enProductType(){
        $this->display('appClassify');
    }
    //获取分类的数据
    public function getProductType(){
        $this->is_ajax = true;
        if(!$ptypes = M('myapp:mainPage')->getProductTypes()) $this->json_output(array('err'=>2,'msg'=>'获取分类失败'));
        $this->json_output(array('err'=>0,'ptypes'=>$ptypes));
    }
    //点击进入分类详情页
    public function enProductTypeDetail(){
        $this->display('appClassify_detail');
    }
    //获取分类详情页数据
    public function getProductTypeDetail(){
        $this->is_ajax = true;
        $protype = sget('type','i');//整形下标，每点击一次传1,2,3,4,5,6,7,8,9
        if(!$typeData = M('myapp:mainPage')->getProductTypeData($protype)) $this->json_output(array('err'=>2,'msg'=>'获取分类关键字失败'));
        $this->json_output(array('err'=>0,'typeData'=>$typeData));
    }
    //进入三个关键字出结果  获取搜索结果数据（通过首页搜索），包括：搜索框，历史搜索，热门搜索
    public function enKeyWordsRes(){
        $this->display('appSearchResult2');
    }
    //获取点击三个关键字出结果
    public function getKeyWordsRes(){
        $this->is_ajax = true;
        $source = sget('source','i',2);//搜索来源 1左侧 2中间
        //
        $protype = sget('type','i');//整形下标，每点击一次传1,2,3,4,5,6,7,8,9
        $apply = sget('apply','s');
        $factory = sget('factory','s');
        $region = sget('region','s');
        //
        $keywords = sget('keywords','s');//常规关键字搜索
        //
        $ctype = sget('ctype','i',3);//1报价(供货) 2采购(求购) 3全部
        $otype = sget('otype','i',3);//1价格升2价格降3默认(时间)
        //
        $page = sget('page','i',1);
        $size = sget('size','i',10);
        if(!$data = M('myapp:mainPage')->getKeyWordsData($protype,$apply,$factory,$region,$keywords,$ctype,$otype,$page,$size,$source)) $this->json_output(array('err'=>2,'msg'=>'获取搜索结果失败'));
        $this->_checkLastPage($data['count'],$size,$page);
        //去掉包含有空元素的数
        $result = array();
        foreach ($data['data'] as $key=>$value) {
            if($value['f_name'] && $value['model'] && $value['product_type'] && $value['unit_price']){
                $result[]=$value;
            }
        }
        $this->json_output(array('err'=>0,'data'=>$result));
    }
    //首页点击获取我的关注(5条),其实和个人中心里的关注的代码相同,下个版本再合并
    public function getMyShortAttention(){
        $this->is_ajax = true;
        if($this->user_id<=0) $this->error('账户错误');
        $products = $this->db->model('concerned_product')->where("user_id=$this->user_id and status=1")->select('product_id,product_name,model,factory_name')->limit('0,5')->getAll();
        foreach ($products as $key => $value) {
            $factory = $this->db->model('factory')->where("f_name='{$value['factory_name']}'")->getRow();
            $pro = $this->db->model('product')->where("model='{$value['model']}' and f_id={$factory['fid']}")->getRow();
            $pur = $this->db->model('purchase')->where('p_id='.$pro['id'])->order('input_time desc,unit_price asc')->limit('0,2')->getAll();//取最近的两条数据,实际上有多条
            $palph = $pur[1]['unit_price']==0 ? 0 : intval($pur[0]['unit_price']-$pur[1]['unit_price']);
            //价格差，涨跌
            $talph = $pur[1]['input_time']==0 ? 0 : $pur[0]['input_time']-$pur[1]['input_time'];
            //时间差，分钟以前
            $products[$key]['unit_price'] = $pur[0]['unit_price'];
            $products[$key]['floor_up'] = $palph;
            $products[$key]['time_al'] = $talph;
        }
        if(empty($products)) $this->json_output(array('err'=>2,'msg'=>'获取我的关注失败'));
        $this->json_output(array('err'=>0,'products'=>$products));
    }
    //点击查看更多,直接调用到enMyAttention()-myAttention()
    //点击添加关注,直接调用到addMyAttention()-addProAttention()
    /**
     *大户报价
     */
    //进入大户报价专区
    public function enLargeBid(){
        $this->display('bigCustomer');
    }
    //获取大户报价数据,包括:默认，价格排序 以及获取大客户点击确定筛选结果
    public function getLargeBid(){
        $this->is_ajax = true;
        //条件筛选
        $company = sget('company','s');
        $factory = sget('factory','s');
        $address = sget('address','s');
        //普通筛选
        $otype = sget('otype','i',3);//3,默认(时间)，1，价格升序 2，价格降序
        //
        $ctype = sget('ctype','i',1);//1:普通筛选 2:条件筛选
        $page = sget('page','i',1);
        $size = sget('size','i',10);
        $largrBid = M('myapp:mainPage')->getLargeChoseRes($ctype,$company,$factory,$address,$otype,$page,$size);
        if(empty($largrBid['data'])) $this->json_output(array('err'=>2,'msg'=>'没有大户报价数据'));
        $this->_checkLastPage($largrBid['count'],$size,$page);
        $this->json_output(array('err'=>0,'largrBid'=>$largrBid['data']));
    }
    //获取大客户筛选条件:公司，厂家，交货地
    public function getLargeChose(){
        $this->is_ajax = true;
        if(!$choseData = M('myapp:mainPage')->getLargeChoseData()) $this->json_output(array('err'=>2,'msg'=>'获取大户筛选条件失败'));
        $this->json_output(array('err'=>0,'choseData'=>$choseData));
    }
    //进入大客户详情页面
    public function enBigBidDetail(){
        $this->display('bigCustomer_detail');
    }
    //进入大客户的委托洽谈
    public function enBigBidDelegate(){
        $this->display('supplyDemand_trade2');
    }
    //获取大客户详情数据
    public function getBigBidDetail(){
        $this->is_ajax = true;
        $otype = sget('otype','i');//1详情,2委托洽谈
        if($otype==2 && $this->user_id<=0) $this->error('账户错误');
        $id = sget('id','i');//当前这一条报价或求购的id,big_offers表
        if(!$chDeRes=M('myapp:mainPage')->getBigBidDetailData($otype,$id,$this->user_id)) $this->json_output(array('err'=>2,'msg'=>'没有查看/委托的数据'));
        $this->json_output(array('err'=>0,'chDeRes'=>$chDeRes));
    }
    /**
     *物性表
     */
    //进入物性表
    public function enPhysical(){
        //cookie保存输入框的关键字
        $_cfrom=sget('keywords','s');//将搜索的关键字传入
        $history = array();
        if(!empty($_cfrom))
        array_push($history, $_cfrom);
        /* 去除重复记录 */
        $rows = array();
        foreach ($history as $v)
        {
            if(in_array($v, $rows))
            {
                continue;
            }
            $rows[] = $v;
        }

        /* 如果记录数量多余5则去除后面的元素 */
        if (count($rows) > 5)
        {
            $newRows = array_slice($rows, 0, 5);
            $keyWords = serialize($newRows);
            cookie::set('_keyWords',$keyWords,time()+1800);
        }
        $this->display('wxb');
    }
    //获取物性表搜索页
    public function getPhysical(){
        $this->is_ajax = true;
        //历史搜索结果
        $hisData = $this->_history();
        //热门搜索结果
        $phyHotData = $this->_physicalHot();
        $this->json_output(array('err'=>0,'hisData'=>$hisData,'phyHotData'=>$phyHotData));
    }
    //物性表的热词搜索
    private function _physicalHot(){
        $_key='hotWords';
        $cache=cache::startMemcache();
        $data=$cache->get($_key);
        if(empty($data)){
            $param = array(
                '2426H',
                'FB1460',
                '7042',
                '15803',
                '2420H',
                'RE420MO',
                '2102TX00',
                'EX5',
                'BF970MO',
                '7000F',
                '9450F',
                '21HN',
                );
            $cache->set($_key,$param,0); //加入缓存
            $data = $param;
        }
        return $data;
    }
    //进入物性表搜索结果页
    public function enPhysicalRes(){
        $this->display('wxb_search');
    }
    //获取物性表搜索页结果数据
    public function getPhysicalRes(){
        $this->is_ajax = true;
        $keywords = sget('keywords','s');
        $page = sget('page','i',1);
        $size = sget('size','i',10);
        if(!$phyData = M('myapp:mainPage')->getPhysicalResData($keywords,$page,$size)) $this->json_output(array('err'=>2,'msg'=>'获取物性表搜索页失败'));
        $this->json_output(array('err'=>0,'phyData'=>$phyData['data']));
    }
    //进入物性表搜索详情页
    public function enPhysicalDetail(){
         $this->display('wxb_detail');
    }
    //获取物性表搜索页详情数据
    public function getPhysicalDetail(){
        $this->is_ajax = true;
        $lid = sget('lid','i',1);
        if(!$phyDetail = M('myapp:mainPage')->getPhysicalDetailData($lid)) $this->json_output(array('err'=>2,'msg'=>'获取物性表详情失败'));
        $this->json_output(array('err'=>0,'phyDetail'=>$phyDetail));
    }
    //进入资讯页
    public function enArticle(){
        $this->display('info');
    }
    //获取资讯页
    public function getArticleInfo(){
        $this->is_ajax = true;
        $pid=sget('pid','i',29);
        $page = sget('page','i',1);
        $size = sget('size','i',30);
        $articles = array();
        $tempArr = array();
        if(!$articleInfo = M('myapp:mainPage')->getPlasticDayInfo($pid,$page,$size)) $this->json_output(array('err'=>2,'msg'=>'获取资讯页失败'));
        foreach ($articleInfo['data'] as $key => $value) {
            $tempArr['id']=$value['id'];
            $tempArr['title']=$value['title'];
            $tempArr['brief']=mb_substr($value['description'],0,20,'utf-8')."...";
            $tempArr['input_time']=$value['input_time'];
            $articles[]=$tempArr;
            unset($tempArr);
        }
        $this->json_output(array('err'=>0,'articleInfo'=>$articles));
    }
    //进入资讯详情页
    public function enArticleDetail(){
        $this->display('info_detail');
    }
    //获取资讯详情页
    public function getArticleDetail(){
        $this->is_ajax = true;
        //if($this->user_id<=0) $this->error('账户错误');
        $id=sget('id','i',0);
         if(!$articleDetail=$this->db->model('news_content')->where("id=$id")->getRow()) $this->json_output(array('err'=>2,'msg'=>'获取资讯详情页失败'));
        $articleDetail['input_time'] = date("Y-m-d",$articleDetail['input_time']);
        $articleDetail['source']= empty($articleDetail['source_from'])?'本站':$articleDetail['source_from'];
        $this->json_output(array('err'=>0,'articleDetail'=>sstripslashes($articleDetail)));
    }
    //进入发布报价
    public function enReleaseSale(){
        $this->display('releaseSale');
    }
    //进入发布报价时验证是否登录
    public function checkReleaseLogin(){
        $this->is_ajax = true;
        if($this->user_id<=0) $this->error('账户错误');
        $this->json_output(array('err'=>0,'msg'=>'用户已登录'));
    }
    //进入物性表的发布采购
    //物性表的发布采购(委托洽谈),单独写一个方法physical表(getPhysicalDelegateData)和搜索中的不能共用
    //判断提交的发布报价(采购1、报价2)数据/user/mypurchase/pub(现已修改到下面的方法)
    public function pub(){
        if($this->user_id<=0) $this->error('账户错误');
        if($data=$_POST['data']){
            $this->is_ajax=true;
            $data=saddslashes($data);
            $pt = $data[0]['pt'];//平台,1:塑料圈(6) 空:其他(本接口下为app(4))
            $remark = $data[0]['remark'];//备注
            $content = $data[0]['content'];//客户直接填写的求购内容，无格式
            $cargo_type=$data[0]['cargo_type'];//现货、期货
            $type=$data[0]['type'];//采购1、报价2
            $pur_model=M('product:purchase');
            $fac_model=M('product:factory');
            $pro_model=M('product:product');
            //判断是否只有content
            if(empty($data[0]['model']) && empty($data[0]['f_name']) && empty($data[0]['store_house'])){
                $_content = array(
                    'user_id'=>$this->user_id,//用户id
                    'c_id'=>$_SESSION['uinfo']['c_id'],//客户id
                    'status'=>$type==1?1:2,//状态，报价不需要审核，采购需要审核
                    'sync'=>$pt==1?6:4,//报价来源平台
                    'type'=>$type,//采购、报价
                    'content'=>str_replace(PHP_EOL, '', $content),//客户直接填写的求购内容
                    'input_time'=>CORE_TIME,//创建时间
                    'remark'=>$remark,//备注
                    );
                if(!$pur_model->add($_content)) $this->json_output(array('err'=>3,'msg'=>'插入数据失败'));
                $this->addPlasticPurSalPoints($this->user_id,$type);
                $this->success('提交成功');
            }
            //
            foreach ($data as $key => $value) {
                //是否已有该产品
                $model=$this->db->from('product p')
                    ->join('factory f','p.f_id=f.fid');
//                 $where="p.model='{$value['model']}' and p.product_type={$value['product_type']} and f.f_name='{$value['f_name']}'";
                $where="p.model='{$value['model']}'  and f.f_name='{$value['f_name']}'";
                $pid=$model->where($where)->select('p.id')->getOne();

                $_data=array(
                    'user_id'=>$this->user_id,//用户id
                    'c_id'=>$_SESSION['uinfo']['c_id'],//客户id
                    'customer_manager'=>$_SESSION['uinfo']['customer_manager'],//交易员
                    'number'=>$value['number'],//吨数
                    'unit_price'=>$value['price'],//单价
                    'provinces'=>$value['provinces'],//省份id
                    'store_house'=>$value['store_house'],//仓库
                    'cargo_type'=>$cargo_type,//现货期货
                    'period'=>$value['period'],//期货周期
                    'bargain'=>$value['bargain'],//是否实价
                    'type'=>$type,//采购、报价
                    'sync'=>$pt==1?6:4,//报价来源平台
                    'status'=>$type==1?1:2,//状态，报价不需要审核，采购需要审核
                    'input_time'=>CORE_TIME,//创建时间
                    'remark'=>$remark,//备注
                    'content'=>str_replace(PHP_EOL, '', $content),//客户直接填写的求购内容
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
            $this->addPlasticPurSalPoints($this->user_id,$type);
            $this->success('提交成功');
        }
    }
    //发布报价或采购的时候添加积分
    public function addPlasticPurSalPoints($userid,$type){
        $billModel=M('points:pointsBill');
        $today=strtotime(date('Y-m-d',time()));
        $points = 0;
        switch ($type) {
            case 1:
                $where = "uid=$userid and type=6 and addtime>$today";
                $points = intval($this->plastic_points['pur']);
                $type = 6;
                break;
            case 2:
                $where = "uid=$userid and type=3 and addtime>$today";
                $points = intval($this->plastic_points['sale']);
                $type = 3;
                break;
        }
        $is_pur_sale=$billModel->where($where)->getRow();
        if(!$is_pur_sale){
            $billModel->addPoints($points,$userid,$type,1);
        }
    }
    //判断发布报价时候牌号是否存在，存在直接却，不存在自己选择一个(下面方法在本版本app没有使用，下个版本使用)
    public function checkReleaseModel(){
        $this->is_ajax = true;
        if($this->user_id<=0) $this->error('账户错误');
        $model = sget('model','s');
        $process_level =  $this->db->model('product')->select('process_type')->where('model='.$model)->limit('0,1')->getRow();
        if($process_level){
            $this->json_output(array('err'=>0,'process_level'=>$process_level));
        }else{
            $this->json_output(array('err'=>2,'msg'=>'所填牌号没有加工级别,请选择'));
        }

    }
    //进入商城报价(公海的商城报价和采购单)
    public function enQuotation(){
        $this->display('supplyDemand');
    }
    //进入采购单(公海的商城报价和采购单)
    public function enSelect(){
        $this->display('purchaseOrders');
    }
    //获取供求(公海的商城报价和采购单)
    //获取供求的筛选条件
    public function getSupplyCondition(){
        $this->is_ajax = true;
        $ptype = sget('ptype','i',0);//类型下标1,2,3,4....
        if(!$typeData=M('myapp:mainPage')->getSupplyConditionData($ptype)) $this->json_output(array('err'=>2,'msg'=>'没有相关的数据'));
        $this->json_output(array('err'=>0,'typeData'=>$typeData));
    }
    //获取供求(公海的商城报价和采购单)以及根据供求的筛选条件渲染数据
    public function getSupplyCondData(){
        $this->is_ajax = true;
        //筛选条件
        $model = sget('model','s');//牌号
        $f_name = sget('f_name','s');//厂家名称
        $provinces = sget('provinces','s');//地区
        $product_type = sget('product_type','i');//类型1/2/3/4/5/6/7/8/9
        $cargo_type = sget('cargo_type','i');//货物属性1现货 2期货
        //普通条件
        $type = sget('type','i',2);//1求(采)购 2报价(供应)
        $otype = sget('otype','i',3);//1价格升2价格降3默认(时间)
        $page = sget('page','i',1);
        $size = sget('size','i',10);
        if(!$data = M('myapp:mainPage')->getSupplyCondDatas($model,$f_name,$product_type,$provinces,$cargo_type,$type,$otype,$page,$size)) $this->json_output(array('err'=>2,'msg'=>'没有相关的数据'));
        $this->_checkLastPage($data['count'],$size,$page);
        $this->json_output(array('err'=>0,'data'=>$data['data']));
    }
    //由采购单进入查看->我要供货
    public function enCheckForm2(){
        $this->display('supplyDemand_detail2');
    }
    //进入我要供货
    public function enMySupply(){
        $this->display('supplyDemand_trade3');
    }
    //供求中的查看和委托和搜索结果页中的方法相同
    //供求中我要供货和搜索结果页中的方法相同
    //进入资源库
    public function enResource(){
        $this->display('appResource');
    }
    //获取资源库数据
    public function getResource(){
        $this->is_ajax = true;
        //关键字
        $keywords = sget('keywords','s');
        //普通
        $type = sget('type','i',3);//1求(采)购 2报价(供应) 3全部
        $page = sget('page','i',1);
        $size = sget('size','i',10);
        if(!$resData = M('myapp:mainPage')->getResourceData($keywords,$type,$page,$size)) $this->json_output(array('err'=>2,'msg'=>'没有相关的数据'));
        foreach ($resData['data'] as &$value) {
            $value['input_time'] = $this->_changeTime($value['input_time']);
        }
        $this->_checkLastPage($resData['count'],$size,$page);
        $this->json_output(array('err'=>0,'resData'=>$resData['data']));
    }
    //发布资源库的方法和pc相同/resource/index/release
    //获取资源库搜索数据
    //进入委托采购
    public function enPurchase(){
        $this->display('purchase');
    }
    //点击委托采购
    public function getPurchase(){
        $this->is_ajax = true;
        if($this->user_id<=0) $this->error('账户错误');
        $contact_info = M('user:customerContact')->getListByUserid($this->user_id);
        if(!$purchase['content'] = sget('content','s')) $this->json_output(array('err'=>3,'msg'=>'委托采购不能为空'));
        $purchase['user_id'] = $this->user_id;
        $purchase['c_id'] = $contact_info['c_id'];
        $purchase['input_time'] = CORE_TIME;
        if($this->db->model('purchase')->add($purchase)) $this->json_output(array('err'=>0,'msg'=>'委托采购成功'));
        $this->json_output(array('err'=>2,'msg'=>'委托采购失败'));

    }
    //点击委托交易保存提交数据
    public function savaComission(){
        $this->is_ajax = true;
        if($this->user_id<=0) $this->error('账户错误');
        $comData['p_id'] = sget('p_id','i',0);
        $comData['sn'] = $this->buildOrderId();
        $comData['user_id'] = $this->user_id;
        $comData['c_id'] = sget('c_id','i',0);
        $comData['number'] = sget('number','i');
        $comData['price'] = sget('price','f');
        $comData['delivery_place'] = sget('delivery_place','i');
        //$delivery_date = sget('delivery_date','i');
        $comData['customer_manager'] = M('user:customerContact')->getListByUserid($this->user_id)['customer_manager'];
        $comData['ship_type'] = sget('ship_type','i');
        //$expiry_date = sget('expiry_date','i');
        $comData['status'] = 2;
        //$remark = sget('remark','i');
        $comData['input_time'] = CORE_TIME;
        //$chk_time = sget('chk_time','i');
        if(M('myapp:mainPage')->savaComissionData($comData)) $this->json_output(array('err'=>0,'msg'=>'委托洽谈成功'));
        $this->json_output(array('err'=>2,'msg'=>'委托洽谈失败'));
    }
    //生产订单号
    protected function buildOrderId(){
        return date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    }
    //判断是否到最后一页
    private function _checkLastPage($count,$size,$page){
        if($count>0){
            if($count%$size==0 && ceil($count/$size)<$page){
                $this->json_output(array('err'=>3,'msg'=>'没有更多数据'));
            }elseif ($count%$size!=0 && ceil($count/$size)<$page) {
                $this->json_output(array('err'=>3,'msg'=>'没有更多数据'));
            }
        }
    }
    //时间戳转换为秒-分钟-小时-天
    private function  _changeTime($time) {
        $int = time() - $time;
        $str = '';
        if ($int <= 2){
            $str = sprintf('刚刚', $int);
        }elseif ($int < 60){
            $str = sprintf('%d秒前', $int);
        }elseif ($int < 3600){
            $str = sprintf('%d分钟前', floor($int/60));
        }elseif ($int < 86400){
            $str = sprintf('%d小时前', floor($int/3600));
        }elseif ($int < 2592000){
            $str = sprintf('%d天前', floor($int/86400));
        }else{
            $str = date('Y-m-d H:i:s', $time);
        }
        return $str;
    }
}