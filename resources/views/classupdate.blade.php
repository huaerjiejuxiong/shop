<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>头部-有点</title>
<link rel="stylesheet" type="text/css" href="{{asset('css/css.css')}}" />
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
</head>
<body>
	<div id="pageAll">
		<div class="page ">
			<!-- 上传广告页面样式 -->
			<div class="banneradd bor">
			
				<div class="baBody">

                <form action="{{url('user/classdoupdate')}}" method="post">
					<div class="bbD">
						分类名称：<input type="text" class="input1" name="name" />
					</div>
					
					<div class="bbD">
						<p class="bbDP">
							<button class="btn_ok btn_yes" href="{{url('user/shopdoupdate')}}">提交</button>
							<a class="btn_ok btn_no" href="#">取消</a>
						</p>
                    </div>
                    </form>
				</div>
			</div>

			<!-- 上传广告页面样式end -->
		</div>
	</div>
</body>
</html>