<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;

class DenglController extends Controller
{
    public function index()
    {
        return view('api.index');
    }

    public function Login()
    {
        return view('api.login'); 
    }
    public function dologin(Request $request)
    {
        $data = $request->all();
    	// $data['pwd'] = md5($data['pwd']);
    	// unset($data['_token']);
    	$where=[
	        ['name','=',$data['name']],
	        ['password','=',$data['password']],
	    ];

		//  dd($data);
		$info = DB::table('user')->where($where)->get();
		
    	//  dd($info);
    	if (!$info) {
    		echo "<script>alert('账号或密码错误');history.back()</script>";die;
    	}
    	$userinfo = [
    		'id' => $info[0]->id,
			'name' => $info[0]->name,
			
    		
    	];
		request()->session()->put('userinfo',$userinfo);
    	echo "<script>alert('登陆成功');location='www.shop.com/admin/index'</script>";
    }

    public function send()
    {
        $user_name=\request()->all('name');
        $pass_word=\request()->all('password');
        $where=[];
        $where[]=[
            'name'=>$user_name,
            'password'=>$pass_word
        ];
    
   $res=DB::table('user')->where($where)->first();
   $openid=$res['openid'];
   $code=rand(1000,9999);
   $url = 'https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$res['access_token'];
   $args=[
    'touser'=>$openid,
    'template_id'=>'YI0LrmQrdUIhicnUUM-CdHoyFWXaCyqjNBqzpaVa1HE',
    'url'=>'http://www.wechat.com',
    'data'=>[
        'code'=>[
            'value'=>$code,
            'color'=>'red'
        ],
        'name'=>[
            'value'=>'$name',
            'color'=>'black'
        ],
        'time'=>[
            'value'=>'time',
            'color'=>'red'
        ]
    ]
   ];
   Curl::post($url,$args);
    }

    
}
