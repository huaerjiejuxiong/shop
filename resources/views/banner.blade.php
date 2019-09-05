<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>广告-有点</title>
<link rel="stylesheet" type="text/css" href="{{asset('css/css.css')}}" />
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<!-- <script type="text/javascript" src="js/page.js" ></script> -->
</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="{{asset('img/coin02.png')}}" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">公共管理</a>&nbsp;-</span>&nbsp;意见管理
			</div>
		</div>
		<div class="page">
			<!-- banner页面样式 -->
			<div class="banner">
				<div class="add">
					<a class="addA" href="{{url('user/shopadd')}}">上传品牌&nbsp;&nbsp;+</a>
				</div>
				<!-- banner 表格 显示 -->
				<div class="banShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="66px" class="tdColor tdC">序号</td>
							<td width="315px" class="tdColor">品牌图片</td>
							<td width="308px" class="tdColor">品牌名称</td>
							<td width="450px" class="tdColor">品牌链接</td>
							<td width="215px" class="tdColor">是否上架</td>
							<td width="180px" class="tdColor">排序</td>
							<td width="125px" class="tdColor">操作</td>
						</tr>
						@foreach($adv as $v)
						<tr>
							<td>{{ $v->id }}</td>
							<td><img src="http://www.pic.com/{{$v->pic}}"width="150" height="120"></td>
							<td>{{ $v->name }}</td>
							<td><a class="bsA" href="#">{{ $v->url }}</a></td>
							<td>{{ $v->display }}</td>
							<td>{{ $v->p_id }}</td>
							<td><a href="{{url('user/bannerupdate')}}?id={{$v->id}}"><img class="operation"
									src="{{asset('img/update.png')}}"></a> <img class="operation delban"
								src="{{asset('img/delete.png')}}"></td>
						</tr>
						@endforeach
					</table>
					{{ $adv->appends(['search'=>$search])->links() }}
					<div class="paging">此处是分页</div>
				</div>
				<!-- banner 表格 显示 end-->
			</div>
			<!-- banner页面样式end -->
		</div>

	</div>


	<!-- 删除弹出框 -->
	<div class="banDel">
		<div class="delete">
			<div class="close">
				<a><img src="{{asset('img/shanchu.png')}}" /></a>
			</div>
			<p class="delP1">你确定要删除此条记录吗？</p>
			<p class="delP2">
				<a href="{{url('user/bannerdelete')}}?id={{$v->id}}" class="ok yes">确定</a><a class="ok no">取消</a>
			</p>
		</div>
	</div>
	<!-- 删除弹出框  end-->
</body>

<script type="text/javascript">
// 广告弹出框
$(".delban").click(function(){
  $(".banDel").show();
});
$(".close").click(function(){
  $(".banDel").hide();
});
$(".no").click(function(){
  $(".banDel").hide();
});
// 广告弹出框 end

// function del(){
//     var input=document.getElementsByName("check[]");
//     for(var i=input.length-1; i>=0;i--){
//        if(input[i].checked==true){
//            //获取td节点
//            var td=input[i].parentNode;
//           //获取tr节点
//           var tr=td.parentNode;
//           //获取table
//           var table=tr.parentNode;
//           //移除子节点
//           table.removeChild(tr);
//         }
//     }     
// }
</script>
</html>