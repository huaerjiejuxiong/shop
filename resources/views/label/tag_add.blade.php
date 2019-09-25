<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>添加标签</title>
</head>
<body>
	<form method="post" action="{{url('label/do_add_tag')}}">
		<p>
			标签名:<input type="text" name="tag">
		</p>
		<p>
			<button>添加</button>
		</p>
	</form>
</body>
</html>
