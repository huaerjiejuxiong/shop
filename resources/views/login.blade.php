<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录-有点</title>
<link rel="stylesheet" type="text/css" href="{{asset('css/css.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('css/page.css')}}" />
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/public.js')}}"></script>
</head>
<body>

	<!-- 登录页面头部 -->
	<div class="logHead">
		<img src="{{asset('img/logLOGO.png')}}" />
	</div>
	<!-- 登录页面头部结束 -->

	<!-- 登录body -->
	<form action="{{url('user/dologin')}}" method="post">
	<div class="logDiv">
		<img class="logBanner" src="{{asset('img/logBanner.png')}}" />
		<div class="logGet">
			<!-- 头部提示信息 -->
			<div class="logD logDtip">
				<p class="p1">登录
                
                </p>
				<p class="p2">华尔街巨熊登录</p>
			</div>
			<!-- 输入框 -->
			<div class="lgD">
				<img class="img1" src="{{asset('img/logName.png')}}" /><input type="text"
					placeholder="输入用户名" name="name"/>
			</div>
			<div class="lgD">
				<img class="img1" src="{{asset('img/logpwd.png')}}" /><input type="text"
					placeholder="输入用户密码" name="pwd"/>
			</div>
			
			<div class="logC">
				<button>登 录</button>
			</div>
		</div>
	</div>
	</form>
	<!-- 登录body  end -->

	<!-- 登录页面底部 -->
	<div class="logFoot">
		<p class="p1">版权所有：南京设易网络科技有限公司</p>
		<p class="p2">南京设易网络科技有限公司 登记序号：苏ICP备11003578号-2</p>
	</div>
	<!-- 登录页面底部end -->
</body>
</html>