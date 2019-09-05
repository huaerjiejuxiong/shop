<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>修改学生</title>
</head>
<body>
	
		@if($errors->any())
			@foreach($errors->all() as $error)
				{{ $error }}
			@endforeach
		@endif
		<h1>学生修改</h1>
		
		<form method="post" action="{{url('kaoshi/updatehandle')}}">
      
        <input type="hidden" value="{{$info->id}}" name="id">
        <p>
            学生姓名：<input type="text" name="name" value="{{$info->name}}">
        </p>
        <p>
            年龄：<select name="age" id="">
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
            </select>
        </p>
        <p>
            住址：<select name="address" id="">
                <option value="昌平">昌平</option>
                <option value="房山">房山</option>
            </select>
        </p>
        <p>
            学生状态：<label><input type="radio" checked="checked"  name="status" value="1"/>在校</label>
                    <label><input type="radio" name="status" value="0"/>离校</label>	
							
						
					
        </p>
		
		


			<input type="submit" name="" value="提交">
		</form>


</body>
</html>