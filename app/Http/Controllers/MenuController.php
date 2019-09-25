<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tools\tools;

class MenuController extends Controller
{
    public $tools;         
    public function __construct(Tools $tools)
    {
        $this->tools = $tools;
    }
    public function createmenu()
    {
        $url='https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->tools->get_wechat_access_token();
        $data=[
                "button"=>[
                 [
                     "type"=>"click",
                      "name"=>"华尔街巨熊",
                      "key"=>"V1001_TODAY_MUSIC"
                 ],


                  [
                      "name"=>"菜单",
                       "sub_button"=>[
                        [
                           "type"=>"view",
                           "name"=>"搜索",
                           "url"=>"http://www.baidu.com/"
                        ],
                        [
                           "type"=>"click",
                           "name"=>"赞一下我们",
                           "key"=>"V1001_GOOD"
                        ]]
                  ]]
                 ];


        $result=$this->tools->curl_post($url,json_encode($data,JSON_UNESCAPED_UNICODE));
        $res=json_decode($result,1);
        dd($res);


    }
}
