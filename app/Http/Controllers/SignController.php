<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tools\tools;

class SignController extends Controller
{
    public $tools;         
    public function __construct(Tools $tools)
    {
        $this->tools = $tools;
    }
    public function location()
    {
        $appid=env('WECHAT_APPID');
        
        $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $jsapi_ticket = $this->tools->get_wechat_jsapi_ticket();
        $timestamp = time();
        $nonceStr = rand(1000,9999).'suibian';
        $sign_str = 'jsapi_ticket='.$jsapi_ticket.'&noncestr='.$nonceStr.'&timestamp='.$timestamp.'&url='.$url;
        $signature = sha1($sign_str);
        return view('Wechat.location',['nonceStr'=>$nonceStr,'timestamp'=>$timestamp,'signature'=>$signature]);
    }
}
