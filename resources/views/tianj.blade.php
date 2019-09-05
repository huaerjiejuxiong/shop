
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>货物入库</title>
</head>
<body>
<form action="{{url('kaos/tianjia')}}" method="post" enctype="multipart/form-data">
<pre><h1></h1></pre> 
	<p>
		货物名称<input type="text" name="name" >
	</p>
	<p>
		货物图片<input type="file" name="pic">
	</p>
	<p>
		货物数量<input type="text" name="shuliang" >
	</p>
	<p>
		<input type="hidden" name="ti" value=" 	2019-08-29 11:18:00">
	</p>
	    

		<button>添加</button>
    </form>
</body>
</html>
