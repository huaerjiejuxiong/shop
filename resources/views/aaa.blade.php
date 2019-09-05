
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>列表页</title>
</head>
<body>
<form action="">
<div id="pageAll" >
<!-- <div class="add">
				新闻名称：<input type="text" name="search" value="{{$search}}">
			 	<input type="submit" name="" value="搜索">
				</div> -->

				<div class="conShow">
				<a  href="{{url('kaos/tianj')}}"><h2>添加货物入库</h2></a>
				<a  href="{{url('kaos/www')}}"><h2>查看出入库操作日志</h2></a>
					<table border="1" cellspacing="0" cellpadding="0">
						<tr >
							<td width="300px" class="tdColor">id</td>
							<td width="300px" class="tdColor">货物名称</td>
							<td width="300px" class="tdColor">货物图片</td>
							<td width="300px" class="tdColor">库存数量</td>
							<td width="300px" class="tdColor">入库时间</td>	
							<td width="300px" class="tdColor">操作</td>
						
						</tr>
						@foreach($kaos as $v)
						<tr height="40px">
						<td>{{ $v->id }}</td>
                        <td>{{ $v->name }}</td>
						<td><img src="http://www.pic.com/{{$v->pic}}" width="300px"></td>
						<td>{{ $v->shuliang }}</td>
						<td>{{ $v->ti}}</td>
						<td><a href="{{url('kaos/huifu')}}?id={{$v->id}}">出库</a></td>
						</tr>
						@endforeach
					</table>
					{{ $kaos->appends(['search'=>$search])->links() }}
				<!-- user 表格 显示 end-->
			</div>
			<!-- user页面样式end -->
            </form>
		</div>

</body>
</form>
</html>