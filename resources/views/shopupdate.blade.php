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
					<span>上传商品</span>
                </div>
				<div class="baBody">

                <form action="{{url('user/shopdoupdate')}}" method="post" enctype="multipart/form-data">
					<div class="bbD">
						商品名称：<input type="text" class="input1" name="name" />
					</div>
					<div class="bbD">
						商品地址：<input type="text" class="input1" name="url" />
					</div>
					<div class="bbD">
						商品图片：
						<div class="bbDd">
							<div class="bbDImg">+</div>
							<input type="file" class="file" name="pic" /> <a class="bbDDel" href="#">删除</a>
						</div>
					</div>
					<div class="bbD">
						是否有货：<label><input type="radio" checked="checked"  name="stock" value="有"/>有</label> <label><input
							type="radio" name="stock" value="无"/>无</label>
					</div>
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;分类：<input class="input2"
							type="text" name="class"/>
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