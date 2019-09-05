<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index');
    }

    public function reg()
    {
        return view('login.reg');
	}
	
	public function zhuce(Request $request)
	{
		$req = request()->all();
		$res = DB::table('qiantai')->insert([
			'email'=>$req['email'],
			'pwd'=>$req['pwd'],
			
		]);
		if ($res) {
			return view('login');
		}else{
			echo "未知错误";
		}
	}
	public function login()
	{
		return view('login/index');
	}
	public function dologin(Request $request)
    {
    	$data = $request->all();
    	// $data['pwd'] = md5($data['pwd']);
    	// unset($data['_token']);
    	$where=[
	        ['email','=',$data['email']],
	        ['pwd','=',$data['pwd']],
	    ];

		//  dd($data);
		$info = DB::table('qiantai')->where($where)->get();
		
    	//  dd($info);
    	if (!$info) {
    		echo "<script>alert('账号或密码错误');history.back()</script>";die;
    	}
    	$userinfo = [
    		'id' => $info[0]->id,
			'email' => $info[0]->email,
			
    		
    	];
		request()->session()->put('userinfo',$userinfo);
    	echo "<script>alert('登陆成功');location='/'</script>";
	}
	public function prolist()
	{
		$top=DB::table('shop')->where('parent_id',0)->get();
		$goods=DB::table('shop')->where('is_show',1)->get()->map(function($msg){
			return (array)$msg;
		})->toArray();

		$num = DB::table('shop')->count();
		$session=request()->session()->get('emailname');

		
		return view('login.prolist',compact('top','goods','num','session'));
	}

	public function car()
	{
		// return view('login.car');
		$goods_id=request()->input('goods_id');
    	// dd($goods_id);
    	if (isset($goods_id) || !empty($goods_id)) {
    		$goods_model=new Goods;
    		$data=$goods_model->where('goods_id',$goods_id)->get()->toArray();
    	}else{
    		$data=[];
    	}
    	$count=count($data);
    	// dd($data);
    	return view('login.car',compact('data','count'));
    
	}
	public function user()
	{
		return view('login.user');
	}
	public function add(Request $request, $goods_id = 0)
    {


        return view('index/jstest');
        // 用户id
        // $request->session('name');
        $user_id = 2;


        // goods_id
        // 数量默认设为1
        if ($goods_id != 0) {
            DB::table('carinfo')->insert([
                'user_id'  => $user_id,
                'goods_id' => $goods_id,
                'num'      => 1
            ]);
        }
        // 展示列表
        $list = DB::table('carinfo')->join('goods', 'goods.goods_id', '=', 'carinfo.goods_id')
        ->where(['user_id' => $user_id])
        ->get()->map(function($msg){
            return (array)$msg;
        })->toArray();


        return view('index/car', ['goods_list' => $list]);
dd($list);

    }


	//邮件发送
    //    	public function send(){
   	// 	$u_email = request()->u_email;
   	// 	// dd($u_email);
    //     $rand=rand(100000,999999);
    //     if($u_email){
    //         \Mail::send('login.emailcode',['code'=>$rand],function($message)use($u_email) {
    //             //设置主题
    //             $message->subject("邮箱注册验证码");
    //             //设置接收方
    //             $message->to($u_email);
    //         });
    //         $data=['u_email'=>$u_email,'code'=>$rand];
    //         request()->session()->put('emailInfo',$data);
    //         return ['msg'=>'邮箱注册成功','code'=>1];
    //     }else{
    //         return ['msg'=>'请选择一个邮箱注册','code'=>2];8 7s'
    //     }
   	// }

   	// //验证验证码
   	// public function checkcode(){
   	// 	$data=request()->all();
   	// 	// dd($data);
   	// 	$u_code=$data['u_code'];
   	// 	// dd($u_code);
   	// 	$emailInfo=request()->session()->get('emailInfo','default');
   	// 	// dd($emailInfo);
   	// 	unset($data['u_pwdr']);
   	// 	// dd($data);
   	// 	if($u_code==$emailInfo['code']){
	// 		$res=DB::table('tp_user')->insert($data);
	// 		return $res=['code'=>1,'font'=>'添加成功'];
   	// 	}else{
   	// 		return $res=['code'=>2,'font'=>'验证码错误'];
   	// 	}
   		
   	// }

   	// //验证邮箱
   	// public function checkemail(){
   	// 	$u_email=request()->u_email;
   	// 	// dd($u_email);
   	// 	$res=DB::table('tp_user')->where('u_email',$u_email)->get()->toArray();
   	// 	if($res){
   	// 		return ['code'=>1,'msg'=>'用户名已存在'];
   	// 	}else{
   	// 		return ['code'=>2,'msg'=>'用户名可用'];
   	// 	}
   	// }

   	// public function checkemailt(){
   	// 	$u_email=request()->u_email;
   	// 	// dd($u_email);
   	// 	$res=DB::table('tp_user')->where('u_email',$u_email)->get()->toArray();
   	// 	if($res){
   	// 		return ['code'=>1,'msg'=>'对'];
   	// 	}else{
   	// 		return ['code'=>2,'msg'=>'错'];
   	// 	}
   	// }

   	// public function checkpwd(){
   	// 	$u_pwd=request()->u_pwd;
   	// 	// dd($u_pwd);
   	// 	$res=DB::table('tp_user')->where('u_pwd',$u_pwd)->get()->toArray();
   	// 	if($res){
   	// 		return ['code'=>1,'msg'=>'对'];
   	// 	}else{
   	// 		return ['code'=>2,'msg'=>'错'];
   	// 	}
   	// }

   	// public function denglu(){
   	// 	$u_email=request()->u_email;
   	// 	$u_pwd=request()->u_pwd;
   	// 	// dd($u_pwd);
   	// 	$res=DB::table('tp_user')->where('u_email',$u_email)->first();
   	// 	// dd($res);
   	// 	if($res){
   	// 		if($u_pwd==$res->u_pwd){
    //            $u_id=$res->u_id;
    //            request()->session()->forget('userInfo');
    //            $data=['u_email'=>$u_email,'u_pwd'=>$u_pwd,'u_id'=>$u_id];
    //            request()->session()->put('userInfo',$data);
    //            // dd(request()->session()->get('userInfo',$data));
   	// 			return ['code'=>1,'msg'=>'对']; 
   	// 		}else{
   	// 			return ['code'=>2,'msg'=>'错'];
   	// 		}
   	// 	}else{
   	// 		return ['code'=>2,'msg'=>'错'];
   	// 	}
   	// }
}
