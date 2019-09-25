<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tools\tools;

class LabelController extends Controller
{
    public $tools;
    public function __construct(Tools $tools)
    {
        $this->tools = $tools;
    }




    public function tag_index()
    {
        $url='https://api.weixin.qq.com/cgi-bin/tags/get?access_token='.$this->tools->get_wechat_access_token();
        $res=file_get_contents($url);
        $data=json_decode($res,true);


        return view('label.tag_index',['info'=>$data['tags']]);
    }


    public function add_tag()
    {
        return view('label.tag_add');
    }

    public function do_add_tag()
    {
        $data=request()->post();
        dd($data);

    }
}
