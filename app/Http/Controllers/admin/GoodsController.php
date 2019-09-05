<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Goods;

class GoodsController extends Controller
{
	/* 添加商品表单 */
    public function add_goods()
    {
    	return view('admin.add_goods');
    }

    /* 添加入库 */
    public function do_add_goods(Request $request)
    {
    	$data = $request->all();
    	$data['add_time'] = time();
    	unset($data['_token']);
    	$files = $request->file('goods_pic');
        if(empty($files)){
            // 未上传图片
            echo ("<script>alert('未上传图片');location='/admin/add_goods'</script>");
        }else{
            // 上传图片
            $path = $files->store('goods_pic');
            // dd($path);
            $data['goods_pic'] = asset('storage').'/'.$path;
            // dd($data['goods_pic']);
        }    	
        $info = Goods::insert($data);
    	if ($info) {
    		echo ("<script>alert('添加成功，正在跳转');location='/admin/goodslist'</script>");
    	}else{
    		echo ("<script>alert('添加失败，未知错误');location='/admin/add_goods'</script>");
    	}
    	// $path = $request->file('goods_pic')->store('goods_pic');
    	// echo asset('storage').'/'.$path;
    }

    /* 展示商品表单 */
    public function goodslist(Request $request){
        // 访问次数
        $redis = new \redis();
        $redis->connect('127.0.0.1','6379');
        $redis->incr('num');
        $num = $redis->get('num');
        echo "访问次数".$num;
        // 接收搜索的值
        $req = $request->all();
        $search = '';

        if(!empty($req['search'])){
            $search = $req['search'];
            // dd($search);
            // 条件
            $data = Goods::where('goods_name','like',"%".$req['search']."%")->paginate(2);
        }else{
            $data = Goods::paginate(2);
        }
    	return view('admin.goodslist',['data'=>$data,'search'=>$search]);
    }

    /* 修改商品 */
    public function update(Request $request)
    {
    	$info = $request->all();
    	$data = Goods::where(['goods_id'=>$info['goods_id']])->first();
    	return view('admin.update',['data'=>$data]);
    }

    /* 修改商品入库 */
    public function do_update(Request $request)
    {
    	$data = $request->all();
    	unset($data['_token']);
    	$goods_id = $data['goods_id'];
    	$file = $request->file('goods_pic');
    	$path = '';
    	if(empty($file)){
            // 未上传图片
            echo ("<script>alert('未上传图片');location='/admin/update?goods_id=$goods_id'</script>");
        }else{
            // 上传图片
            $path = $file->store('goods_pic');
            $data['goods_pic'] = asset('storage').'/'.$path;
        }   
    	$res = Goods::where(['goods_id'=>$data['goods_id']])->update($data);
    	dd($res);
    }

    /* 删除商品 */
    public function delete(Request $request)
    {
    	$data = $request->all();
    	$res = Goods::where(['goods_id'=>$data['goods_id']])->delete();
    	if ($res) {
    		echo ("<script>alert('删除成功，正在跳转');location='/admin/goodslist'</script>");
    	}else{
    		echo ("<script>alert('删除失败，未知错误');location='/admin/goodslist'</script>");
    	}
    }
}
