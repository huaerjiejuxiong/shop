<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>标签列表页</title>
</head>
<body>
    <h1>标签列表页</h1>
    <a href="{{url('label/add_tag')}}">去添加吧</a>
	<table border="1" align="center" width="500">
        <th>ID</th>
        <th>姓名</th>
        <th>旗下用户</th>
        <th>操作</th>
        @foreach($info as $v)
        <tr align="center">
            <td>{{$v['id']}}</td>
            <td>{{$v['name']}}</td>
            <td>{{$v['count']}}</td>
            <td><a href="">删除</a>|<a href="">修改</a></td>
        </tr>
        @endforeach
    </table>
</body>
</html>
