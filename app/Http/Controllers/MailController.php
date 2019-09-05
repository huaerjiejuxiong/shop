<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class MailController extends Controller
{
    public function index()
    {
        $email = '2656028431@qq.com';
        $this->send($email);
	}
	
    public function send($email)
    {
    	$msg = "您的验证码是".rand(1000,9999)."请不要泄露！";
	    Mail::raw($msg,function($message)use($email){
		    //设置主题
		    $message->subject("华尔街巨熊");
		    //设置接收方
		    $message->to($email);
    	});
	}
 
   
}
