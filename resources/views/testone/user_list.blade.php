<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>用户列表</title>
</head>
<body>
    <br>
    <h2 align="center">用户列表</h2>
    <br>
    <form action="{{url('wechat/save_tag_openid')}}" method="post">
        @csrf
        <table align="center" border="1" width="700px">
            <tr align="center">
                <td></td>
                <td>昵称</td>
                <td>openid</td>
            </tr>
            <input type="hidden" name="tagid" value="{{$tagid}}">
            @foreach($info as $v)
            <tr align="center">
                <td>
                    <input type="checkbox" name="openid_list[]" value="{{$v['openid']}}">
                </td>
                <td>{{$v['nickname']}}</td>
                <td>{{$v['openid']}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="3" align="left">
                    <button>提交</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
