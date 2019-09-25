<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tools\tools;
use DB;

class ShowController extends Controller
{
    public $tools;         
    public function __construct(Tools $tools)
    {
        $this->tools = $tools;
    }
    public function welogin_login()
    {	
    	//定义地址
    	$redirect_uri='http://www.shop.com/show/code';
    	$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.env('WECHAT_APPID').'&redirect_uri='.urlencode($redirect_uri).'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
    	header('Location:'.$url);
    }
    public function code()
    {
    	$res=request()->all();
    	// dd($res);
    	$result = file_get_contents('https://api.weixin.qq.com/sns/oauth2/access_token?appid='.env('WECHAT_APPID').'&secret='.env('WECHAT_SECRET').'&code='.$res['code'].'&grant_type=authorization_code');
    	$re = json_decode($result,1);
    	$user_info = file_get_contents('https://api.weixin.qq.com/sns/userinfo?access_token='.$re['access_token'].'&openid='.env('WECHAT_APPID').'&lang=zh_CN');  
    	$wechat_user_info = json_decode($user_info,1);
		// dd($wechat_user_info);


		$openid = $re['openid'];
        $wechat_info = DB::table('user')->where(['openid'=>$openid])->first();
        // dd($wechat_info);
        if(!empty($wechat_info)){
            //存在,登陆
            request()->session()->put('uid',$wechat_info->openid);
            // echo "ok";
            return redirect('show/list');  //主页
        }else{
            //不存在,注册,登陆
            //插入user表数据一条
            // DB::connection('mysql_cart')->beginTransaction();  //打开事物
            $uid = DB::table('user')->insertGetId([
                'name'=>$wechat_user_info['nickname'],
                'password'=>'',
				'reg_time'=>time(),
				'openid'=>$openid
            ]);
            $insert_result = DB::table('user_wechat')->insert([
                'uid'=>$uid,
                'openid'=>$openid
            ]);
            //登陆操作
            request()->session()->put('uid',$wechat_info->openid);
            // echo "ok";
             return redirect('show/list');  //主页
        }
    }

    public function get_access_token()
    {
        return $this->get_wechat_access_token();
    }
    public function get_wechat_access_token()
    {
        $redis=new \Redis();
        $redis->connect('127.0.0.1');
        //加入缓存
        $access_token_key='wechat_access_token';
        if ($redis->exists($access_token_key)) {
            //存在
            return $redis->get($access_token_key);
        }else {
            //不存在
            $result=file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxf50e06e2fe696439&secret=1d70de8ea5b8f0f1e477d739ca66344f');
            $re=json_decode($result,1);
            $redis->set($access_token_key,$re['access_token'],$re['expires_in']);//加入缓存
            return $re['access_token'];
        }

    }
    public function list()
    {
        $result = file_get_contents('https://api.weixin.qq.com/cgi-bin/user/get?access_token='.$this->get_wechat_access_token().'&next_openid=');
        $re = json_decode($result,1);
        $last_info = [];
        foreach($re['data']['openid'] as $k=>$v){
            $user_info = file_get_contents('https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$this->get_wechat_access_token().'&openid='.$v.'&lang=zh_CN');
            $user = json_decode($user_info,1);
            $last_info[$k]['nickname'] = $user['nickname'];
            $last_info[$k]['openid'] = $v;
        }
        $last_info=json_encode($last_info);
        $last_info=json_decode($last_info);
        // dd($last_info);
        //dd($re['data']['openid']);
        return view('Show.list',['info'=>$last_info]);
    }
    
    public function do_send_message(Request $request)
    {
        $req = $request->all();
//        dd($req);
        $url = 'https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token='.$this->tools->get_wechat_access_token();
        $data = [
            'touser' =>$req['id'],
            'msgtype' => 'text',
            'text' => [
                'content' => $req['message']
            ]
        ];
    //    dd($data);
        $res = $this->tools->curl_post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        $result = json_decode($res,1);
        if($result['errcode'] == 0){
            echo "<script>alert('发送成功');localtion.href='/show/list'</script>";
        }else{
            dd($result);
        }
    }
}
