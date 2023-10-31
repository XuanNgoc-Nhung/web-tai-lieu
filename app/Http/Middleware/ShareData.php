<?php

namespace App\Http\Middleware;

use App\monHoc;
use Closure;

class ShareData
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
        $ds_mon_hoc = monHoc::all();
        $data = [
            'ds_mon_hoc' => $ds_mon_hoc,
        ];

        // Chia sẻ biến với tất cả các view
        view()->share('data', $data);

        return $next($request);
    }
}
