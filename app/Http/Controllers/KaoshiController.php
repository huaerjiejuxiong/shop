<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class KaoshiController extends Controller
{
    public function kaoshiadd()
    {
        return view('kaoshiadd');
    }
    public function kaoshidoadd(Request $request)
	{
		
		$store_result=$request->all();
		//  dd($res);
		$res = DB::table('kaoshi')->insertGetId($store_result);
		if ($res) {
			return redirect('kaoshi/kaoshiindex');
		}
		
		
    }
    public function kaoshiindex(Request $request)
	{
        $where=[];
        $where[]=['status','=',1];
			$data = DB::table('kaoshi')->where($where)->get();
        
        return view('kaoshiindex',['data'=>$data]);
       
		
    }
    public function kaoshiupdate(Request $request)
	{
		$id=request()->all();
		//  dd($id);
		$info=DB::table('kaoshi')->where('id',$id)->get();
		$info=$info[0];
	
		return view('kaoshiupdate',['info'=>$info]);
	}

	public function updatehandle(Request $request){
		$data=request()->post();
        
            $res=DB::table('kaoshi')->where('id',$data['id'])->update($data);
			if($res){
				echo "<script>alert('修改成功！');location.href='/kaoshi/kaoshiindex'</script>";
			}
	}
    public function kaoshidelete(Request $request)
    {
        $req=request()->input();
        $where=[];
        $where[]=['id','=',$req['id']];
        $data=DB::table('kaoshi')->where($where)->update(['status'=>'0']);
        if ($data){
            return redirect('kaoshi/kaoshiindex');
        }
    }
    public function lixiao(Request $request)
	{
        $where=[];
        $where[]=['status','=',0];
			$data = DB::table('kaoshi')->where($where)->get();
        
		return view('lixiao',['data'=>$data]);
		
    }
    public function huifu(Request $request)
    {
        $req=request()->input();
        $where=[];
        $where[]=['id','=',$req['id']];
        $data=DB::table('kaoshi')->where($where)->update(['status'=>'1']);
        if ($data){
            return redirect('kaoshi/kaoshiindex');
        }
    }




}
?>