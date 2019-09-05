<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="{{asset('css/css.css')}}" />
<!-- <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script> -->
<script type="text/javascript" src="{{asset('js/jquery-1.7.2.min.js')}}"></script>

<!-- <script type="text/javascript" src="js/page.js" ></script> -->
</head>
<form action="/kaos/zhuye" method="get">
<body>
	<div id="pageAll">
		<div class="page">
			<!-- banner页面样式 -->
			<div class="banner">
				<div class="add">
					<a class="addA" href="{{url('kaos/tianj')}}">添加友情链接&nbsp;&nbsp;+</a>
				</div>
				<div class="add">
				网站名称：<input type="text" name="search" value="{{$search}}">
			 	<input type="submit" name="" value="搜索">
				</div>
				
				<!-- banner 表格 显示 -->
				<div class="banShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="66px" class="tdColor tdC">序号</td>
                            <td width="308px" class="tdColor">网站名称</td>
							<td width="315px" class="tdColor">图片LOGO</td>
                            <td width="215px" class="tdColor">网站网址</td>
							<td width="450px" class="tdColor">链接类型</td>
							<td width="215px" class="tdColor">状态</td>
							<td width="125px" class="tdColor">操作</td>
						</tr>
						@foreach($kaos as $v)
						<tr>
							<td>{{ $v->id }}</td>
							<td>{{ $v->name }}</td>
                            <td><img src="http://www.pic.com/{{$v->pic}}"width="150" height="120"></td>
                            <td>{{ $v->url }}</td>
							<td>{{ $v->lx }}</td>
							<td>{{ $v->display }}</td>
							<td><a href="{{url('kaos/kupdate')}}?id={{$v->id}}"><img class="operation"
									src="{{asset('img/update.png')}}"></a>
							<a class="del" id="{{$v->id}}"><img class="operation delban"
								src="{{asset('img/delete.png')}}"></a></td>
						</tr>
						@endforeach
					</table>
					{{ $kaos->appends(['search'=>$search])->links() }}
					
				</div>
				<!-- banner 表格 显示 end-->
			</div>
			<!-- banner页面样式end -->
		</div>

	</div>



	<!-- 删除弹出框  end-->
</body>
</form>

<script type="text/javascript">
// 广告弹出框
// $(".delban").click(function(){
//   $(".banDel").show();
// });
// $(".close").click(function(){
//   $(".banDel").hide();
// });
// $(".no").click(function(){
//   $(".banDel").hide();
// });
// // 广告弹出框 end

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
		$('.del').click(function(){
			var _this=$(this);
			var id = $(this).attr('id');
		
		$.ajax({
			url: "{{url('kaos/kdelete')}}",
			method: 'post',
			data:{id:id},
			dataType:'json',
			async: true,
			success: function(res){
				if (res.code==1) {
					_this.parents('tr').remove();
					location.href="{{url('kaos/zhuye')}}";
				};
			}
		});
		});
</script>
</html>