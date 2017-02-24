<?php 
	class indexAction extends homeBaseAction {
		public function __init(){
			$this->db=M('news:news');
		}

		//取出首页数据
		public function init(){
			$type=sget('type','s','');
			if ($type == 'vip') {
				$this->chkLogin();
			}else{
				//取出广告
				$this->sszcBanner=$this->getAD(8);
				$this->zcssBanner=$this->getAD(9);
				$this->sjjdBanner=$this->getAD(10);
				$this->jpfxBanner=$this->getAD(11);
				$this->middleLeftBanner=$this->getAD(12);
				$this->middleRightBanner=$this->getAD(13);
				$this->middleBanner=$this->getAD(14);
				$this->bottomRightBanner=$this->getAD(15);
				$this->cLeftTopBanner=$this->getAD(17);
				$this->cMiddleBanner=$this->getAD(16);
				//前台显示星期
				$arr=array('星期一','星期二','星期三','星期四','星期五','星期六','星期日',);
				$this->date=$arr[date('N')-1].'&nbsp;&nbsp;'.date('Y-m-d',time());
			}
			//导航栏选中状态
			$this->nav=$type;
			//取出首页数据
			$data=$this->db->getIndex($type);			
			//由于首页和pvc页面相同，pe和pp页面相同，所以为了区分，通过type进行区分判断该显示哪一块
			if(empty($type))$type='public';
			if($type=='pp')$type='pe';	
			$this->assign(array(
				'data'=>$data,
				'type'=>$type,
			));
			$this->display('index');
		}

		//取广告函数
		private function getAD($id){
			return array_slice(array_reverse(M('system:block')->getBlock($id,1000)),0,1);
		}

		//取出列表页数据
		public function lst(){
			//分页
				$page=sget('page','i',1);
				$page_size=10;
			//获取搜索值
			$keywords=sget('keywords','s');
			if($keywords){
				//Sphinx取出关键词搜索数据
					$sphinx = new SphinxClient;
					$sphinx->SetServer('localhost',9312);
					$sphinx->SetMatchMode(SPH_MATCH_BOOLEAN);
					$sphinx->SetSortMode(SPH_SORT_EXTENDED, "input_time DESC, @id DESC" );
					$sphinx->setLimits(abs($page-1)*$page_size,$page_size,1000);
					$result = $sphinx->query("$keywords",'news');
					$ids = array_keys($result['matches']);
					$data['data'] = $this->db->search($ids);
					$this->pages = pages($result['total'], $page, $page_size);

					foreach ($data['data'] as $k => $v) {
						$data['data'][$k]['spell']=$this->db->model('news_cate')->select('spell')->where('cate_id ='.$v['cate_id'])->getOne();
					}
				//取出排行榜文章
					$chartsData=$this->db->charts('','',$keywords);
					foreach ($chartsData as $k => $v) {
						$chartsData[$k]['spell']=$this->db->model('news_cate')->select('spell')->where('cate_id ='.$v['cate_id'])->getOne();
					}
			}else{
				$type=sget('type','s');
				//导航栏选中状态
					$this->nav=$type;
				$cate=sget('cate','s');
				if($cate=='djjd'){
					$this->cate_name='独家解读';
				}
				//取出该分类对应的分类ID，用于取出相对应的文章
				$where=' 1 ';
				if ($type=='vip') {
					$where.='and pid=33';
					$this->upperType='行情内参';
				}else{
					$this->upperType=strtoupper($type);
				}
				$cate_id=M('public:common')->model('news_cate')->select('cate_id')->where($where.' and spell="'.$cate.'"')->getOne();	
				//取出列表页数据
					$data=$this->db->getList($type,$cate_id,$page,$page_size);
				//取出排行榜文章
					$chartsData=$this->db->charts($type,$cate_id);
				//分页	
					$this->pages=pages($data['count'],$page,$page_size);
			}
			//截取示例文章文字
				foreach ($data['data'] as $key=>$v) {
						$data['data'][$key]['content']=mb_substr(strip_tags($v['content']),0,100,'utf-8');
						//取出右键导航分类名称
						$data['data'][$key]['cate_name']=$this->db->model('news_cate')->select('cate_name')->where('cate_id="'.$v['cate_id'].'"')->getOne();
						//判断是否有前缀
						if(array_search($v['cate_id'], array(1,3,4,13,14,15))===false){
							$data['data'][$key]['prefix']=1;
						}
					}
					
				$this->assign(array(
					'data'=>$data,
					'chartsData'=>$chartsData,
					'cate'=>$cate,
					'type'	=>$type,
					'keywords'=>$keywords,
				));
			$this->display('list');
		}
                        
		//取出详情页数据
		public function detail(){
			$type=sget('type','s');
			//导航栏选中状态
				$this->nav=$type;
			$cate=sget('cate','s');
			$id=sget('id','i');
			//如果找不到，跳转404页面
			if(!$id=sget('id','i')) {$this->forward('/page/index/notFind');exit;};
			//获取文章详情数据
			$data=sstripslashes($this->db->getNews($id));
			//获取排行榜文章
			$cate_id=M('public:common')->model('news_cate')->select('cate_id')->where('spell="'.$cate.'"')->getOne();
			$chartsData=$this->db->charts($type,$cate_id);
			//p($data);exit;
			//更新文章访问量
			$data['pageViews']=$this->db->updatePv($id);
			$this->seo = array('title'=>$data['title'],'key'=>$data['keywords'],'desc'=>$data['description']);
			//获取微信接口配置
			$this->wxApi=A('plasticzone:plastic')->headlineApi();
			//p($this->wxApi);exit;
			//详情页导航
			if ($type=='vip') {
				$this->upperType='行情内参';
			}else{
				$this->upperType=strtoupper($type);
			}
			$this->assign(array(
				'data'=>$data,
				'chartsData'=>$chartsData,
				'cate'=>$cate,
				'type'	=>$type,
			));
			$this->display('detail');
		}

		//阿里头条抓取数据
		public function newsXML(){
			$sTime=CORE_TIME-3600;
			$eTime=CORE_TIME+3600;
			$data=$this->db->model('news_content')->select('id,title,content,cate_id,author,type')->where('input_time between '.$sTime.' and '.$eTime.' and cate_id not in (7,19) and status=1')->getAll();
			foreach ($data as $k => $v) {
				$data[$k]['spell']=$this->db->model('news_cate')->select('spell')->where('cate_id='.$v['cate_id'])->getOne();
			}
			header("Content-Type:text/xml");
			echo '<?xml version="1.0" encoding="utf-8"?>';
			echo '<rss version="2.0">';
			echo '<channel>';	
			echo '<title>我的塑料网</title>';		
			echo '<pubDate>'.date('Y-m-d H:i:s',CORE_TIME).'</pubDate>';
			foreach ($data as $key => $value) {
				echo "<item>";
				echo "<id>{$value['id']}</id>";
				echo "<title>{$value['title']}</title>";
				echo "<author><![CDATA[我的塑料网]]></author>";
				$content=sstripslashes($value['content']);
				echo "<description><![CDATA[{$content}]]></description>";
				echo "<link><![CDATA[http://news.myplas.com/{$value['type']}/{$value['spell']}/{$value['id']}.html]]></link>";		
				echo "</item>";				
			}
			echo "</channel>";
			echo "</rss>";			
		}

		//百度站长提交链接
		public function webSubmitLink(){
			$sTime=sget('sTime','i');
			$eTime=sget('eTime','i');
			if (empty($sTime) || empty($eTime)) {
				echo '丁公子，你URL时间戳格式不正确！';
			}else{
				$data=$this->db->model('news_content')->select('id,cate_id,type')->where('input_time between '.$sTime.' and '.$eTime.' and status=1')->getAll();
				$str='&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;【1】<br /><br />';
				foreach ($data as $k => $v) {
					$spell=$this->db->model('news_cate')->select('spell')->where('cate_id='.$v['cate_id'])->getOne();
					$str.='news.myplas.com/'.$v['type'].'/'.$spell.'/'.$v['id'].'.html<br />';
					$num=($k+1)/20;
					if (is_int($num)) {
						$str.='<br />&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;【'.($num+1).'】<br /><br />';				
					}				
				}
				echo $str;				
			}

		}

		//行情内参权限控制
		public function accessControl(){		
			$this->is_ajax=true;
			$userid=sget('id','i',0);
			if($userid>0){
				$vip=$this->db->model('customer_contact')->select('headline_vip,closing_date')->where('user_id='.$userid)->getRow();
				if ($vip['headline_vip']==0) {
					json_output(array('err'=>2,'msg'=>'您好，您所查看资讯为收费咨询，请您先注册会员！'));
				}elseif($vip['closing_date']>0 && $vip['closing_date']<=CORE_TIME){
					json_output(array('err'=>3,'msg'=>'尊敬的客户，您的会员已到期！'));
				}else{
					json_output(array('err'=>4,'msg'=>'尊敬的会员，请您尽情浏览行情内参信息！'));
				}
			}else{
				json_output(array('err'=>1,'msg'=>'您好，请您先登录！'));
			}	
		}

		//跳转行情内参介绍页面
		public function vipIntroduce(){
			$this->nav='vip';
			$this->display('vip_introduce');
		}
	} 
 ?>