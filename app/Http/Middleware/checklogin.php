<?php

namespace App\Http\Middleware;

use Closure;

class checklogin
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
        
        $start = strtotime('9:00:00');
        $end = strtotime('17:00:00');
        $now = time();
        if ($now >= $start && $now<=$end) {
            // 可以通过

        }else{
            // 不可以通过
            dd('当前时间不可访问');
        }
        $session=request()->session()->get('userinfo');
        if  (!$session) {
            echo "<script>alert('请登录');location='klogin'</script>";
        }
        return $next($request);
        
        
    }
}
