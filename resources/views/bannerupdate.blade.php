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
		<div class="pageTop">
			<div class="page">
				<img src="{{asset('img/coin02.png')}}" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">公共管理</a>&nbsp;-</span>&nbsp;意见管理
			</div>
		</div>
		<div class="page ">
			<!-- 上传广告页面样式 -->
			<div class="banneradd bor">
				<div class="baTop">
					<span>上传广告</span>
                </div>
				<div class="baBody">

                <form action="/user/bannerdoupdate" method="post" enctype="multipart/form-data">
                <input type="hidden" value="{{$info->id}}" name="id">
					<div class="bbD">
						品牌名称：<input type="text" class="input1" value="{{$info->name}}" name="name" />
					</div>
					<div class="bbD">
						品牌地址：<input type="text" class="input1" value="{{$info->url}}" name="url" />
					</div>
					<div class="bbD">
						修改图片：
						<div class="bbDd">
							<input  type="file" name="pic" /><img src="http://www.pic.com/{{$info->pic}}" width="100">
						</div>
					</div>
					<div class="bbD">
						是否上架：<label>
						<input type="radio" name="display" @if ($info->display=='1') checked @endif value="1"/>是</label> <label>
						<input type="radio" name="display" @if ($info->display=='2') checked @endif value="2"/>否</label>
					</div>
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;排序：<input class="input2"
							type="text" value="{{$info->p_id}}" name="p_id"/>
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