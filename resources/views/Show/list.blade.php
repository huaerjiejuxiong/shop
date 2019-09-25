<html>
    <head>
        <title>用户列表</title>
    </head>
    <body>
        <center>
        
            <table border="1">
            <form action="do_send_message" method="post" >

                <tr>
                    <td></td>
                    <td>用户昵称</td>
                    <td>用户openid</td>
                    <td>操作</td>
                </tr>
                @foreach($info as $v)
                    <tr>
                    <td><input type="checkbox" name="id[]" value="{{$v->openid}}"></td>
                        <td>{{$v->nickname}}</td>
                        <td>{{$v->openid}}</td>
                        <td><a href="{{'/wechat/get_user_xiang'}}">查询详情</a></td>
                    </tr>

                @endforeach
                <p> 
                    消息：<input type="text" name="message">
                    <button>发送</button>
                </p>
                </form>
            </table>
        </center>
    </body>
</html>