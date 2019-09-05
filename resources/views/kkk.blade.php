<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>出库表</title>
	 <link rel="stylesheet" href="{{ URL::asset('bootstrap.min.css') }}">
</head>
<body>
	<center>
		<h1>本页为出库日志</h1>
		<a  href="{{url('kaos/www')}}"><h2>查看入库日志</h2></a>
		<table width="600" border="1">
			<tr align="center">
				<td width="50">操作用户ID</td>
				<td width="70">货物ID</td>
				<td width="70">操作时间</td>
                <td width="70">操作类型</td>
		
			</tr>
			@foreach($data as $v)
			<tr align="center">
				<td>admin</td>
				<td>{{ $v->id }}</td>
				<td>{{ $v->ti }}</td>
				<td>出库</td>
			</tr>
			@endforeach
		</table>

	</center>
</body>
</html>