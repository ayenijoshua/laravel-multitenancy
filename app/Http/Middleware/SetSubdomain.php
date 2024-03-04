<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetSubdomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $domainArr = explode('.',request()->getHost());
        if(count($domainArr) > 1){
            $subdomain = \Illuminate\Support\Arr::first($domainArr);
            if($subdomain){
            $exist = (new \App\Repositories\CompanyRepository(new \App\Models\Company))->getModel()->where('domain',$subdomain)->first();
            if(!$exist){
                    return redirect('http://localhost/error');
                    //return view('errors.tenant-404');
            }
            }else{
                $domainArr = explode('.',request()->getHost());
                if(count($domainArr) > 1){
                    $subdomain = \Illuminate\Support\Arr::first($domainArr);
                    
                    if($subdomain !== 'localhost'){
                        info('1',[$subdomain]);
                        config('domain',$subdomain);
                        session()->put('domain',$subdomain);
                    }
                }
            }
        }
        

        return $next($request);
    }
}
