<?php

namespace App\Http\Middleware;

use Closure;

class showlogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        // $start = strtotime('9:00:00');
        // $end = strtotime('17:00:00');
        // $now = time();
        // if ($now >= $start && $now<=$end) {
        //     // 可以通过

        // }else{
        //     // 不可以通过
        //     dd('当前时间不可访问');
        // }
        $session=request()->session()->get('uid');
        if  (!$session) {
            echo "<script>alert('请登录');location='welogin_login'</script>";
        }
        return $next($request);
        
        
    }
}
