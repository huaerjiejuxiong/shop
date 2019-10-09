<?php

namespace App\Model;

class Curl
{
    public function get($url)
    {
        //初始化
        $ch = curl_init();
        //设置选项
        curl_setopt($ch,CURLOPT_URL, "http://www.shop.com");
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_HEADER, 0);
        //执行
        $output = curl_exec($ch);
        //关闭
        curl_close($ch);
        return $output;
    }
    public function post($url,$postData)
    {
        //初始化
        $ch =curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$postData);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        //执行
        $output = curl_exec($ch);
        //关闭
        curl_close($ch);
        return $output;
    }
    
}
