<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// 登陆
Route::get('/admin/login','admin\LoginController@login');
Route::post('/admin/do_login','admin\LoginController@do_login');

// 注册
Route::get('/admin/register','admin\LoginController@register');
Route::post('/admin/do_register','admin\loginController@do_register');

// 展示学生信息
Route::post('/student/do_update','StudentController@do_update');

// 删除学生信息
Route::get('/student/delete','StudentController@delete');


// 添加商品
Route::get('/admin/add_goods','admin\GoodsController@add_goods');
Route::post('/admin/do_add_goods','admin\GoodsController@do_add_goods');

// 展示商品信息
Route::get('/student/index','StudentController@index');

// 处理添加学生信息
Route::post('/student/do_add','StudentController@do_add');

// 修改学生信息
Route::get('/student/update','StudentController@update');
Route::get('/admin/goodslist','admin\GoodsController@goodslist');

// 处理商品修改
Route::post('/admin/do_update','admin\GoodsController@do_update');

// 删除商品
Route::get('/admin/delete','admin\GoodsController@delete');




// 调用中间件
Route::group(['middleware'=>['login']],function(){
	// 展示添加学生信息表单
	Route::get('/student/add','StudentController@add');
});

// 商品修改调用中间件
Route::group(['middleware'=>['update']],function(){
	// 展示商品修改表单
	Route::get('/admin/update','admin\GoodsController@update');
});
// 项目
// ->middleware('checklogin')
Route::prefix('user')->group(function(){
	Route::get('add','UserController@add');
	Route::post('doadd','UserController@doadd');
	Route::get('list','UserController@list');
	Route::get('update','UserController@update');
	Route::post('updatehandle','UserController@updatehandle');
	Route::get('delete','UserController@delete');
	Route::get('index','UserController@index');
	Route::get('main','UserController@main');
	Route::get('head','UserController@head');
	Route::get('left','UserController@left');
	Route::get('banner','UserController@banner');
	Route::get('banneradd','UserController@banneradd');
	Route::post('bannerdoadd','UserController@bannerdoadd');
	Route::get('bannerdelete','UserController@bannerdelete');
	Route::get('bannerupdate','UserController@bannerupdate');
	Route::post('bannerdoupdate','UserController@bannerdoupdate');
	Route::get('shop','UserController@shop');
	Route::get('shopadd','UserController@shopadd');
	Route::post('shopdoadd','UserController@shopdoadd');
	Route::get('shopdelete','UserController@shopdelete');
	Route::get('shopupdate','UserController@shopupdate');
	Route::post('shopdoupdate','UserController@shopdoupdate');
	Route::get('class','UserController@class');
	Route::get('classadd','UserController@classadd');
	Route::post('classdoadd','UserController@classdoadd');
	Route::get('classdelete','UserController@classdelete');
	Route::get('classupdate','UserController@classupdate');
	Route::post('classdoupdate','UserController@classdoupdate');
});
Route::any('mail/send','MailController@send');
Route::any('mail/index','MailController@index');

// Route::get('/user/login','UserController@login');
// Route::post('/user/dologin','UserController@dologin');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/', 'IndexController@index');
Route::get('/login', 'LoginController@index');
Route::get('/reg', 'LoginController@reg');
Route::post('login/zhuce','LoginController@zhuce');
Route::get('/login', 'LoginController@login');
Route::post('/login/dologin','LoginController@dologin');
Route::get('/login/prolist','LoginController@prolist');
Route::get('/login/car','LoginController@car');
Route::get('/login/user','LoginController@user');



// Route::post('/reg/send', 'LoginController@send');
// Route::get('/reg/checkcode', 'LoginController@checkcode');
// Route::get('/reg/checkemail', 'LoginController@checkemail');
// Route::get('/reg/checkemailt', 'LoginController@checkemailt');
// Route::get('/reg/checkpwd', 'LoginController@checkpwd');
// Route::get('/reg/sdenglu', 'LoginController@denglu');


Route::prefix('kaos')->middleware('checklogin')->group(function(){
	Route::get('tianj','KaosController@tianj');
	Route::post('tianjia','KaosController@tianjia');
	Route::get('www','KaosController@www');
	Route::get('aaa','KaosController@aaa');
	Route::get('kkk','KaosController@kkk');
	Route::get('kupdate','KaosController@kupdate');
	Route::post('updatehandle','KaosController@updatehandle');
	Route::get('kdelete','KaosController@kdelete');
	Route::get('huifu','KaosController@huifu');
	// ->middleware('checklogin')
});
Route::get('/kaos/klogin','KaosController@klogin');
Route::post('/kaos/kdologin','KaosController@kdologin');

// Route::prefix('kaoshi')->group(function(){
// 	Route::get('kaoshiadd','KaoshiController@kaoshiadd');
// 	Route::post('kaoshidoadd','KaoshiController@kaoshidoadd');
// 	Route::get('kaoshiindex','KaoshiController@kaoshiindex');
// 	Route::get('kaoshiupdate','KaoshiController@kaoshiupdate');
// 	Route::post('updatehandle','KaoshiController@updatehandle');
// 	Route::get('kaoshidelete','KaoshiController@kaoshidelete');
// 	Route::get('lixiao','KaoshiController@lixiao');
// 	Route::get('huifu','KaoshiController@huifu');
// });
Route::get('/', function () {
    return view('welcome');
});
Route::get('wechat/get_access_token','WechatController@get_access_token'); //获取access_token
Route::get('/wechat/get_user_list','WechatController@get_user_list'); //获取用户列表
Route::get('/wechat/get_user_xiang','WechatController@get_user_xiang'); //详情列表


//微信授权登录
Route::prefix('welogin')->group(function () {
	Route::get('login','WeloginController@login');
	Route::any('welogin_login','WeloginController@welogin_login');
	Route::any('code','WeloginController@code');
});
//微信授权登录
Route::prefix('show')->middleware('showlogin')->group(function () {
	// Route::any('welogin_login','ShowController@welogin_login');
	// Route::any('code','ShowController@code');
	Route::get('list','ShowController@list');
	Route::get('get_access_token','ShowController@get_access_token');
	Route::any('do_send_message','ShowController@do_send_message');
});
Route::any('/show/welogin_login','ShowController@welogin_login');
Route::any('/show/code','ShowController@code');
// ->middleware('showlogin')

//微信标签
Route::prefix('label')->group(function () {
    Route::get('tag_index','LabelController@tag_index');//标签列表
    Route::any('add_tag','LabelController@add_tag');//添加标签
    Route::any('do_add_tag','LabelController@do_add_tag');//处理添加标签


});
Route::get('/wechat/send','WechatController@send_template_massage');
// 微信菜单
Route::prefix('menu')->group(function () {
   Route::any('createmenu','menuController@createmenu');//生成菜单
});

//js
Route::prefix('sign')->group(function () {
	Route::any('location','signController@location');
});


Route::prefix('wechat')->namespace('testone')->group(function(){
    Route::get('login','WechatController@login');                           // 授权登录
    Route::get('code','WechatController@code');                             // 获取信息
    Route::get('create_tag','WechatController@create_tag');                 // 创建标签视图
    Route::post('save_tag','WechatController@save_tag');                    // 创建标签处理
    Route::get('list_tag','WechatController@list_tag');                     // 标签列表
    Route::get('user_list','WechatController@user_list');                   // 用户列表
    Route::post('save_tag_openid','WechatController@save_tag_openid');      // 用户添加标签
    Route::get('send_message','WechatController@send_message');             // 标签发送消息
    Route::post('send_message_do','WechatController@send_message_do');      // 标签发送消息

    Route::get('get_access_token','WechatController@get_access_token');     // 获取token
});


