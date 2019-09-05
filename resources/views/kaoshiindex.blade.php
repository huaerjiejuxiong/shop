<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>学生表</title>
	 <link rel="stylesheet" href="{{ URL::asset('bootstrap.min.css') }}">
</head>
<body>
	<center>
		<a  href="{{url('kaoshi/lixiao')}}"><h2>查看离校学生</h2></a>
		<table width="600" border="1">
			<tr align="center">
				<td width="50">ID</td>
				<td width="70">姓名</td>
				<td width="70">年龄</td>
				<td>住址</td>
                <td>操作</td>
		
			</tr>
			@foreach($data as $v)
			<tr align="center">
				<td>{{ $v->id }}</td>
				<td>{{ $v->name }}</td>
				<td>{{ $v->age }}</td>
				<td>{{ $v->address }}</td>
                
				
				<td>
					<a href="{{url('kaoshi/kaoshiupdate')}}?id={{$v->id}}">修改</a>
					<a href="{{url('kaoshi/kaoshidelete')}}?id={{$v->id}}">删除</a>
				</td>
			</tr>
			@endforeach
		</table>

	</center>
</body>
</html>