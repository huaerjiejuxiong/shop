<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tools\tools;
use DB;

class EventController extends Controller
{
    public $tools;
    public function __construct(tools $tools)
    {
        $this->tools = $tools;
    }
    public function event()
    {
//        dd($_POST);
//        echo $_GET['echostr'];
        $xml_string = file_get_contents('php://input'); // 获取微信发过来的xml数据
        $wechat_log_path = storage_path('/logs/wechat/'.date("Y-m-d").'.log');  // 生成日志文件
        file_put_contents($wechat_log_path,"<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<\n",FILE_APPEND);
        file_put_contents($wechat_log_path,$xml_string,FILE_APPEND);
        file_put_contents($wechat_log_path,"\n<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<\n\n",FILE_APPEND);


//        dd($xml_string);
        $xml_obj = simplexml_load_string($xml_string,'SimpleXMLElement',LIBXML_NOCDATA);
        $xml_arr = (array)$xml_obj;
        \Log::Info(json_encode($xml_arr,JSON_UNESCAPED_UNICODE));


        if (!empty($xml_arr['EventKey'])){
            if ($xml_arr['EventKey'] == 'second_one'){
//            $xml_string = (array)$xml_string;
//            $aa=DB::table('wechat_openid')->where(['openid'=>$xml_arr['FromUserName']])->update([
//                'xml'=>$xml_string
//            ]);
//            dd($aa);
                $user_info = DB::table('wechat_openid')->where(['openid'=>$xml_arr['FromUserName']])->first();
                // dd($user_info);
                $message = 'hello'.$user_info->nickname;
                $xml_str = '<xml><ToUserName><![CDATA['.$xml_arr['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$xml_arr['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$message.']]></Content></xml>';
                echo $xml_str;
            }
        }


        if (!empty($xml_arr['Content']))
        {
            $data = [
                'openid' => $xml_arr['FromUserName'],
                'add_time' => $xml_arr['CreateTime'],
                'type' => $xml_arr['MsgType'],
                'content' => $xml_arr['Content'],
                'msgid' => $xml_arr['MsgId']
            ];
            $time = date('Y-m-d H:i:s',$data['add_time']);
            DB::table('msg')->insert($data);
            $message = $time.','.$data['content'];
            $xml_str = '<xml><ToUserName><![CDATA['.$xml_arr['FromUserName'].']]></ToUserName><FromUserName><![CDATA['.$xml_arr['ToUserName'].']]></FromUserName><CreateTime>'.time().'</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA['.$message.']]></Content></xml>';
            echo $xml_str;
        }




    }
}
