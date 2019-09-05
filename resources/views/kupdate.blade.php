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
				<div class="baTop">
					<span>友情链接</span>
                </div>
				<div class="baBody">

                <form action="/kaos/updatehandle" method="post" enctype="multipart/form-data">
                <input type="hidden" value="{{$info->id}}" name="id">
					<div class="bbD">
						网站名称：<input type="text" class="input1" value="{{$info->name}}" name="name" />
					</div>
					<div class="bbD">
						网站地址：<input type="text" class="input1" value="{{$info->url}}" name="url" />
					</div>
					<div class="bbD">
						网站LOGO：
						<div class="bbDd">
							<input  type="file" name="pic" /><img src="http://www.pic.com/{{$info->pic}}" width="100">
						</div>
					</div>
                    <div class="bbD">
						链接类型：<label>
						<input type="radio" name="lx" @if ($info->lx=='图片链接') checked @endif value="图片链接"/>图片链接</label> <label>
						<input type="radio" name="lx" @if ($info->lx=='文字链接') checked @endif value="文字链接"/>文字链接</label>
					</div>
					<div class="bbD">
						是否显示：<label>
						<input type="radio" name="display" @if ($info->display=='是') checked @endif value="是"/>是</label> <label>
						<input type="radio" name="display" @if ($info->display=='否') checked @endif value="否"/>否</label>
					</div>
			
					<div class="bbD">
						<p class="bbDP">
							<button class="btn_ok btn_yes" type="submit">修改</button>
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