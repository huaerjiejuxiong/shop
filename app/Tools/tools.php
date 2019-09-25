<?php

namespace App\Tools;


class Tools {
    public $redis;
    public function __construct()
    {
        $this->redis = new \Redis();
        $this->redis->connect('127.0.0.1','6379');
    }


     //获取 微信 access_token
    public function get_wechat_access_token()
    {
    	//调用redis
    	$redis = new \Redis();
        $redis->connect('127.0.0.1','6379');

        //加入缓存
        $access_token_key='wechat_access_token';

        if ($redis->exists($access_token_key)) {
        	//如果存在
        	return $redis->get($access_token_key);
        }else{
        	//访问微信接口
        	$result=file_get_contents('https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxf50e06e2fe696439&secret=1d70de8ea5b8f0f1e477d739ca66344f');
        	//转换$result
        	$res=json_decode($result,true);
        	//加入redis缓存 k v time
        	$redis->set($access_token_key,$res['access_token'],$res['expires_in']);
        	return $res['access_token'];
        }

    }

    
    public function curl_post($url,$data)
    {
        $curl = curl_init($url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_POST,true);  //发送post
        curl_setopt($curl,CURLOPT_POSTFIELDS,$data);
        $data = curl_exec($curl);
        $errno = curl_errno($curl);  //错误码
        $err_msg = curl_error($curl); //错误信息
        curl_close($curl);
        return $data;
    }

}
