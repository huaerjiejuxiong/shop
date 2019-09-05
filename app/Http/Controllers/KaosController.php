<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class KaosController extends Controller
{
   
    public function tianj()
    {
        return view('tianj');
    }
    public function tianjia(Request $request)
	{
		

		$store_result=$request->all();
		
		//  dd($store_result);
		if (request()->hasFile('pic')) {
			$store_result['pic'] = $this->upload('pic');
			// 'create_time'=>time()
		}

		$res = DB::table('kaos')->insertGetId($store_result);
		if ($res) {
			return redirect('kaos/aaa');
		}
		// $req = $request->all();
		// $res = DB::table('kaos')->insert([
		// 	'name'=>$store_result['name'],
		// 	'pic'=>$store_result['pic'],
			// 'shuliang'=>$store_result['shuliang']
			// 'create_time'=>time()
			
		// ]);
		// if ($res) {
		// 	return redirect('kaos/aaa');
		// }
		
		
	}

	/*文件上传*/
	public function upload($name)
	{
		if (request()->file($name)->isValid()) {
			$pic = request()->file($name);
			// $extension = $pic->extension();
			// $store_result = $pic->syore('pic');
			$store_result = $pic->store('','public');
			return $store_result;
		}
		exit('未上传文件');
	}
    public function zhuye(Request $request)
	{
		$req = $request->all();
		$search = "";
		if (!empty($req['search'])) {
			$search = $req['search'];
			$data = DB::table('kaos')->where('name','like','%'.$search.'%')->paginate(2);
		}else{
			$data = DB::table('kaos')->paginate(5);
		}
		return view('zhuye',['kaos'=>$data,'search'=>$search]);
		
	}
	// public function kkk(Request $request)
	// {
	// 	$req = $request->all();
	// 	$search = "";
	// 	if (!empty($req['search'])) {
	// 		$search = $req['search'];
	// 		$data = DB::table('kaos')->where('name','like','%'.$req['search'].'%')->paginate(2);
	// 	}else{
	// 	 	$data = DB::table('kaos')->paginate(5);
	// 	}
	// 	/* 展示列表 */
		
	// 	return view('kkk',['kaos'=>$data,'search'=>$search]);
	// }
	public function aaa(Request $request)
	{
		// $req = $request->all();
		// $search = "";
		// if (!empty($req['search'])) {
		// 	$search = $req['search'];
		// 	$data = DB::table('kaos')->where('name','like','%'.$req['search'].'%')->paginate(2);
		// }else{
		//  	$data = DB::table('kaos')->paginate(5);
		// }

		$req = $request->all();
		$search = "";
		if (!empty($req['search'])) {
			$search = $req['search'];
			
		}else{
			$data = DB::table('kaos')->paginate(5);
		}
		return view('aaa',['kaos'=>$data,'search'=>$search]);
		// /* 展示列表 */
		
		// return view('aaa',['kaos'=>$data,'search'=>$search]);
	}
	public function www(Request $request)
	{
		$where=[];
        $where[]=['status','=',1];
			$data = DB::table('kaos')->where($where)->get();
        
        return view('www',['data'=>$data]);
		
			// return view('www',['kaos'=>$info,'info'=>$info]);
	}
	public function kkk(Request $request)
	{
		$where=[];
        $where[]=['status','=',2];
			$data = DB::table('kaos')->where($where)->get();
        
        return view('kkk',['data'=>$data]);
		
			// return view('www',['kaos'=>$info,'info'=>$info]);
	}
	public function huifu(Request $request)
    {
		$req=request()->input();
		// dd($req);
        $where=[];
        $where[]=['id','=',$req['id']];
        $data=DB::table('kaos')->where($where)->update(['status'=>'2']);
        if ($data){
            return redirect('kaos/aaa');
        }
    }

    // public function kupdate(Request $request)
	// {
	// 	$id=request()->all();
	// 	//   dd($id);
	// 	$info=DB::table('kaos')->where('id',$id)->get();
	// 	$info=$info[0];
	
	// 	return view('kupdate',['info'=>$info]);
	// }

	// public function updatehandle(Request $request){
	// 	$data=request()->post();
    //     $pic=request()->file();
    // 	if(empty($pic)){
	// 		// 未上传图片
	// 		//直接修改入库
    //         $res=DB::table('kaos')->where('id',$data['id'])->update($data);
	// 		if($res){
	// 			echo "<script>alert('修改成功！');location.href='/kaos/zhuye'</script>";
	// 		}
    //     }else{
	// 		if (request()->hasFile('pic')) {
	// 			$data['pic']=$this->upload('pic');
				
	// 		}
	// 		// dd($data);
	// 		$res=DB::table('kaos')->where('id',$data['id'])->update($data);
	// 		echo "<script>alert('修改成功！');location.href='/kaos/zhuye'</script>";
	// 	}   
	
	// }


	public function kdelete(Request $request)
	{
		$req = $request->all();
		$data = DB::table('kaos')->where(['id'=>$req['id']])->delete();
		// dd($res);
		if ($data) {
            $info = ['code'=>1];
			echo json_encode($info);
		} else {
            $info = ['code'=>2];
            echo json_encode($info);
        }
    }
    public function klogin()
	{
		return view('klogin');
	}
	public function kdologin(Request $request)
    {
    	$data = $request->all();
    	// $data['pwd'] = md5($data['pwd']);
    	// unset($data['_token']);
    	$where=[
	        ['name','=',$data['name']],
	        ['pwd','=',$data['pwd']],
	    ];

		// dd($data);
		$info = DB::table('login')->where($where)->get();
		
    	//  dd($info);
    	if (!$info) {
    		echo "<script>alert('账号或密码错误');history.back()</script>";die;
    	}
    	$userinfo = [
    	
            'name' => $info[0]->name,
            'pwd'  => $info[0]->name,
    		
    	];
		request()->session()->put('userinfo',$userinfo);
    	echo "<script>alert('登陆成功');location='/kaos/zhuye'</script>";
    }

}
