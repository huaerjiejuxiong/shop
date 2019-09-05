<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WechatController extends Controller
{
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

    public function get_user_list()
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
        return view('Wechat.list',['info'=>$last_info]);
    }
    public function get_user_xiang()
    {
        $result = file_get_contents('https://api.weixin.qq.com/cgi-bin/user/get?access_token='.$this->get_wechat_access_token().'&next_openid=');
        $re = json_decode($result,1);
        $last_info = [];
        foreach($re['data']['openid'] as $k=>$v){
            $user_info = file_get_contents('https://api.weixin.qq.com/cgi-bin/user/info?access_token='.$this->get_wechat_access_token().'&openid='.$v.'&lang=zh_CN');
            $user = json_decode($user_info,1);
            $last_info[$k]['headimgurl'] = $user['headimgurl'];
            $last_info[$k]['city'] = $user['city'];
            $last_info[$k]['nickname'] = $user['nickname'];
            $last_info[$k]['openid'] = $v;
        }
        $last_info=json_encode($last_info);
        $last_info=json_decode($last_info);
        // dd($last_info);
        //dd($re['data']['openid']);
        return view('wechat.xiang',['info'=>$last_info]);
    }



}
