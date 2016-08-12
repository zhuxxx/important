<?php
/**
* 微信红包入口文件
*/
class hbIndexAction extends homeBaseAction{

	protected $openid;
	protected $AppID,$AppSecret;
	public $authorize_url="";
	public function __construct(){
		if( !isset($_SESSION['weixinAuth']) ) {
			if( isset($_GET['code']) && isset($_GET['state']) ){
				$code = $_GET['code'];
				$userinfo = $this->get_author_access_token($code);
				$info=$this->get_user_info($userinfo['openid'],$userinfo['access_token']);
				if($info){
					$_SESSION['weixinAuth'] = $info;
				}else{
					exit('authError');
				}
			}else{
				$this->AppID = 'wxbe66e37905d73815';
				$this->AppSecret = '7eb6cc579a7d39a0e123273913daedb0';
				$url = $this->get_url();
			             $this->$authorize_url =$this->get_authorize_url($url);
			}
		}
		$this->openid=$_SESSION['weixinAuth']['openid'];
		// $this->openid="o1SYHw7UuAqoEoM1Yoyk7DEoqp7g";
		$this->update_times();
	}
	public function __init(){
		$this->debug = false;
		$this->db = M('public:common');
	}
	//活动页面
	public function enHbPage(){
		file_put_contents('1.txt', $this->$authorize_url);
	          $this->assign('authorize_url',$this->$authorize_url);
		$this->display('index');
	}
	//规则页面
	public function enRuler(){
		$this->display('rule');
	}
	//更新抽奖次数以及关联微信用户
	protected function update_times(){
		$userinfo=$_SESSION['weixinAuth'];
		M('wx:hb')->updateTimes($this->openid,$userinfo);
	}
	//获取授权的token
	protected function get_author_access_token($code=''){
		if($code == '') return false;
		$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->AppID}&secret={$this->AppSecret}&code={$code}&grant_type=authorization_code";
		$result = $this->http($url);
		if( $result ) $result = json_decode($result, true);
		if( isset($result['errcode']) ){
			return false;
		}else{
			return $result;
		}

	}
	//通过openid 和 token获取用户信息
	protected function get_user_info($openid,$access_token){
		$url = "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$openid}&lang=zh_CN";
		$result = json_decode($this->http($url), true);
		if(!isset($result['errcode']))
		{
			return $result;
		}else
		{
			return false;
		}
	}
	//http-->curl
	protected function http($url){
	    $ch = curl_init($url);
	    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
	    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($ch, CURLOPT_HEADER, false);
	    $output = curl_exec($ch);//输出内容
	    curl_close($ch);
	    return $output;
	}
	//获取当前用户的url
	protected function get_url(){
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		return $url;
	}
// 	//通过回调方法获取用户的code
// 	protected function get_authorize_url($redirect_uri = '', $state = ''){
//        $redirect_uri = urlencode($redirect_uri);
//        // $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->AppID}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_userinfo&state={$state}#wechat_redirect";
//        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->AppID}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
//        echo "<script language='javascript' type='text/javascript'>";
//        echo "window.location.href='$url'";
//        echo "</script>";
//    }
   
   /**
    * 获取微信授权链接
    *
    * @param string $redirect_uri 跳转地址
    * @param mixed $state 参数
    */
   public function get_authorize_url($redirect_uri = '', $state = '')
   {
       $redirect_uri = urlencode($redirect_uri);
       return "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->app_id}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_userinfo&state={$state}#wechat_redirect";
   }

   //用户登录和微信账号绑定
   public function dologin(){
		$this->is_ajax=true;
		$username=sget('username','s');
		$password=sget('password','s');
		if($username==''||$password=='') $this->error('手机号或密码格式不正确');
		$chanel=2; //app渠道
		$where="mobile='$username'";
		$uinfo=M('user:passport')->where($where)->getRow();
		$npassword=M('system:sysUser')->genPassword($password.$uinfo['salt']);
		if(!M('user:passport')->where(array('mobile'=>$username,'password'=>$npassword))->getRow()) $this->json_output(array('err'=>2,'msg'=>'用户名或密码错误'));

		//判断是否分配交易员
		$cinfo=$this->db->model('customer')->where("c_id={$uinfo['c_id']}")->select('customer_manager,status')->getRow();
		if($cinfo['status']==1) $this->json_output(array('err'=>3,'msg'=>'账号等待审核中，请稍候再试'));
		if($cinfo['status']==3) $this->json_output(array('err'=>4,'msg'=>'账号审核未通过，请联系客服'));
		if(!$cinfo['customer_manager']) $this->json_output(array('err'=>5,'msg'=>'正在等待分配交易员，请稍候再试'));

		//检查绑定是否微信
		$data=M('wx:hb')->where(array('openid'=>$this->openid))->getRow();
			if(!$data['username']){
				$_data=array(
				'username'=>$uinfo['mobile'],
				'uid'=>$uinfo['user_id'],
				// 'base_num'=>3,
				// 'times'=>$data['times']+2,
				);
				M('wx:hb')->where(array('openid'=>$this->openid))->update($_data);
		}
		//绑定后更新抽奖次数
		$this->update_times();
		$this->json_output(array('err'=>0,'msg'=>'登录成功'));
	}
	//每次点击活动按钮
	public function comeback(){
		$userinfo = M('wx:hb')->where(array('openid'=>$this->openid))->getRow();
		if($userinfo['times']<=0&&$userinfo['username']=='') $this->json_output(array('err'=>2,'msg'=>'次数用完，未登录账号'));
		if($userinfo['times']<=0&&$userinfo['username']!='') $this->json_output(array('err'=>3,'msg'=>'次数用完，已登录账号'));
		//更新抽奖次数
		M('wx:hb')->where(array('id'=>$userinfo['id']))->update(array('times'=>$userinfo['times']-1));

		$prize_name=array('未中奖','微信红包');
		$prize_arr = array(
		    '0' => array('id'=>1,'prize'=>1,'v'=>0),
		    '1' => array('id'=>2,'prize'=>0,'v'=>0),
		    '2' => array('id'=>3,'prize'=>0,'v'=>0),
		    '3' => array('id'=>4,'prize'=>1,'v'=>40),
		    '4' => array('id'=>5,'prize'=>1,'v'=>0),
		    '5' => array('id'=>6,'prize'=>1,'v'=>0),
		    '6' => array('id'=>7,'prize'=>1,'v'=>0),
		    '7' => array('id'=>8,'prize'=>1,'v'=>0),
		    '8' => array('id'=>9,'prize'=>0,'v'=>60),
		);
		foreach ($prize_arr as $key => $val) {
		  $arr[$val['id']] = $val['v'];
		}
		$rid = $this->get_rand($arr); //根据概率获取奖项id
		$res['yes'] = $prize_arr[$rid-1]['prize']; //中奖项,只有$rid=4的时候才有奖
		$res['prize_name']=$prize_name[$res['yes']];//$prize_name[1],微信红包
		//获取当天红包总数
		$count= M('wx:wxcount')->getRow();
		$price=0;
		$hold=0;
		// $count=$countModel->find();
		if($count['count']<=0){
			$res['yes']=0;
			$hold=1;//拦截红包
		}
		if($userinfo['id']>8000){
			$res['yes']=0;
			$hold=2;
		}
		if($res['yes']==1){
			if(!$userinfo['username']){
				$price=rand(20,30);//未登录的时候奖
			}else{
				$price=rand(30,80);//登录时候的奖
			}
			$res['price']=$price/100;//中的奖金额度
		}
		//红包模型
		$countModel = M('wx:wxcount');
		$prizeModel = M('wx:wxprice');
		$countModel->startTrans();
		try {
			if(!$countModel->where("1=1")->update(array('count'=>$count['count']-($price/100),'input_time'=>time()))) throw new Exception("系统错误。code:102");
			if(!$prizeModel->add(array('oid'=>$userinfo['id'],'openid'=>$this->openid,'prize'=>$res['yes'],'price'=>$price,'addtime'=>time(),'prize_name'=>$prize_name[$res['yes']],'is_hold'=>$hold))) throw new Exception("系统错误。code:102");
			$countModel->commit();
		} catch (Exception $e) {
			$res=array('yes'=>0,'prize_name'=>'未中奖');
			$countModel->rollback();
		}
		$res['times']=M('wx:hb')->select('times')->where(array('id'=>$userinfo['id']))->getOne();//剩余抽奖的次数
		$res['name']=$userinfo['name'];//微信用户名
		$this->json_output(array('err'=>4,'res'=>$res));//返回抽奖的结果
	}
	//算法
	public function get_rand($proArr){
		$result = '';
		//概率数组的总概率精度
		$proSum = array_sum($proArr);
		//概率数组循环
		foreach ($proArr as $key => $proCur) {
			$randNum = mt_rand(1, $proSum);
			if ($randNum <= $proCur) {
				$result = $key;
				break;
			} else {
				$proSum -= $proCur;
			}
		}
		unset ($proArr);
		return $result;
	}

}