<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class UserController extends Controller
{
	public function login()
	{
		return view('login');
	}
	public function dologin(Request $request)
    {
    	$data = $request->all();
    	// $data['pwd'] = md5($data['pwd']);
    	// unset($data['_token']);
    	$where=[
	        ['name','=',$data['name']],
	        ['pwd','=',$data['pwd']],
	    ];

		// dd($data);
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
    	echo "<script>alert('登陆成功');location='/user/index'</script>";
    }

	public function index()
	{
		return view('index');
	}
    public function add()
	{
		return view('add');
	}

	public function doadd()
	{
		$req = request()->all();
		$res = DB::table('user')->insert([
			'name'=>$req['name'],
			'pwd'=>$req['pwd'],
			'grade'=>$req['grade'],
			'create_time'=>time()
		]);
		if ($res) {
			return redirect('user/list');
		}else{
			echo "未知错误";
		}
	}
	public function list(Request $request)
	{
		$req = $request->all();
		$search = "";
		if (!empty($req['search'])) {
			$search = $req['search'];
			$data = DB::table('user')->where('name','grade','%'.$req['search'].'%')->paginate(5);
		}else{
			$data = DB::table('user')->paginate(5);
		}
		/* 展示列表 */
		
		return view('list',['user'=>$data,'search'=>$search]);
	}


	public function update()
	{
		$id=request()->all();
		// dd($id);
		$info=DB::table('user')->where('id',$id)->get();
		$info=$info[0];
	
		return view('update',['info'=>$info]);
	}

	public function updatehandle(){
		$data=request()->post();
		// dd($data);
		

		$res=DB::table('user')->where('id',$data['id'])->update($data);
		if($res){
			echo "<script>alert('修改成功！');location.href='/user/list'</script>";
		}
	}


	public function delete(Request $request)
	{
		$req = $request->all();
		$res = DB::table('user')->where(['id'=>$req['id']])->delete();
		// dd($res);
		if ($res) {
			return redirect('user/list');
		} else {
			echo "删除失败";
		}
		
	}
	public function main()
	{
		return view('main');
	}
	public function head()
	{
		return view('head');
	}
	public function left()
	{
		return view('left');
	}
	public function banner(Request $request)
	{
		$req = $request->all();
		$search = "";
		if (!empty($req['search'])) {
			$search = $req['search'];
			
		}else{
			$data = DB::table('adv')->paginate(5);
		}
		return view('banner',['adv'=>$data,'search'=>$search]);
		
	}
	public function banneradd()
	{
		return view('banneradd');
		
	}
	public function bannerdoadd(Request $request)
	{
		
		$store_result=$request->all();
		// dd($res);
		if (request()->hasFile('pic')) {
			$store_result['pic'] = $this->upload('pic');
		}
		$res = DB::table('adv')->insertGetId($store_result);
		if ($res) {
			return redirect('user/banner');
		}
		
		
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
	//第二种方法
	// $data = $request->all();
	
	// $files = $request->file('pic');
    //     if(empty($files)){
    //         // 未上传图片
    //         echo ("<script>alert('未上传图片');</script>");
    //     }else{
    //         // 上传图片
    //         $path = $files->store('pic');
    //         // dd($path);
    //         $data['pic'] = asset('storage').'/'.$path;
    //         // dd($data['goods_pic']);
    //     }    	
       
	// }
	public function bannerdelete(Request $request)
	{
		$req = $request->all();
		$res = DB::table('adv')->where(['id'=>$req['id']])->delete();
		// dd($res);
		if ($res) {
			return redirect('user/banner');
		} else {
			echo "删除失败";
		}
		
	}

	//修改信息页面
	public function bannerupdate(Request $request)
	{
		$id=request()->all();
		// dd($id);
		//查数据，进行修改数据的展示
		$info=DB::table('adv')->where('id',$id)->get();
		// dd($info);
		$info=$info[0];
	
		return view('bannerupdate',['info'=>$info]);
	}


	//修改信息处理页面
	public function bannerdoupdate(Request $request){
		$data=request()->post();
		$pic=request()->file();
    	if(empty($pic)){
			// 未上传图片
			//直接修改入库
            $res=DB::table('adv')->where('id',$data['id'])->update($data);
			if($res){
				echo "<script>alert('修改成功！');location.href='/user/banner'</script>";
			}
        }else{
			if (request()->hasFile('pic')) {
				$data['pic']=$this->upload('pic');
				
			}
			// dd($data);
			$res=DB::table('adv')->where('id',$data['id'])->update($data);
			echo "<script>alert('修改成功！');location.href='/user/banner'</script>";
		}   
	}
	public function shop(Request $request)
	{
		$req = $request->all();
		$search = "";
		if (!empty($req['search'])) {
			$search = $req['search'];
			
		}else{
			$data = DB::table('shop')->paginate(3);
		}
		return view('shop',['shop'=>$data,'search'=>$search]);
		
	}
	public function shopadd()
	{
		return view('shopadd');
		
	}
	public function shopdoadd(Request $request)
	{
		
		$store_result=$request->all();
		// dd($res);
		if (request()->hasFile('pic')) {
			$store_result['pic'] = $this->upload('pic');
		}
		$res = DB::table('shop')->insertGetId($store_result);
		if ($res) {
			return redirect('user/shop');
		}
		
		
	}
	public function shopdelete(Request $request)
	{
		$req = $request->all();
		$res = DB::table('shop')->where(['id'=>$req['id']])->delete();
		// dd($res);
		if ($res) {
			return redirect('user/shop');
		} else {
			echo "删除失败";
		}
		
	}

	//修改信息页面
	public function shopupdate(Request $request)
	{
		$id=request()->all();
		// dd($id);
		//查数据，进行修改数据的展示
		$info=DB::table('shop')->where('id',$id)->get();
		// dd($info);
		$info=$info[0];
	
		return view('shopupdate',['info'=>$info]);
	}


	//修改信息处理页面
	public function shopdoupdate(Request $request){
		$data=request()->post();
		$pic=request()->file();
    	if(empty($pic)){
			// 未上传图片
			//直接修改入库
            $res=DB::table('shop')->where('id',$data['id'])->update($data);
			if($res){
				echo "<script>alert('修改成功！');location.href='/user/shop'</script>";
			}
        }else{
			if (request()->hasFile('pic')) {
				$data['pic']=$this->upload('pic');
				
			}
			// dd($data);
			$res=DB::table('shop')->where('id',$data['id'])->update($data);
			echo "<script>alert('修改成功！');location.href='/user/shop'</script>";
		}   
	}
	public function class(Request $request)
	{
		$req = $request->all();
		$search = "";
		if (!empty($req['search'])) {
			$search = $req['search'];
			
		}else{
			$data = DB::table('class')->paginate(3);
		}
		return view('class',['class'=>$data,'search'=>$search]);
		
	}
	public function classadd()
	{
		return view('classadd');
		
	}
	public function classdoadd(Request $request)
	{
		
		$store_result=$request->all();
		// dd($res);
		if (request()->hasFile('pic')) {
			$store_result['pic'] = $this->upload('pic');
		}
		$res = DB::table('class')->insertGetId($store_result);
		if ($res) {
			return redirect('user/class');
		}
		
		
	}
	public function classdelete(Request $request)
	{
		$req = $request->all();
		$res = DB::table('class')->where(['id'=>$req['id']])->delete();
		// dd($res);
		if ($res) {
			return redirect('user/class');
		} else {
			echo "删除失败";
		}
		
	}

	//修改信息页面
	public function classupdate(Request $request)
	{
		$id=request()->all();
		// dd($id);
		//查数据，进行修改数据的展示
		$info=DB::table('class')->where('id',$id)->get();
		// dd($info);
		$info=$info[0];
	
		return view('classupdate',['info'=>$info]);
	}


	//修改信息处理页面
	public function classdoupdate(Request $request){
		$data=request()->post();
		$pic=request()->file();
    	if(empty($pic)){
			// 未上传图片
			//直接修改入库
            $res=DB::table('class')->where('id',$data['id'])->update($data);
			if($res){
				echo "<script>alert('修改成功！');location.href='/user/class'</script>";
			}
        }else{
			if (request()->hasFile('pic')) {
				$data['pic']=$this->upload('pic');
				
			}
			// dd($data);
		 	$res=DB::table('class')->where('id',$data['id'])->update($data);
			echo "<script>alert('修改成功！');location.href='/user/class'</script>";
		}   
	}
	
	
}
