<?php
  
namespace App\Http\Middleware;
  
use Closure;
   
class IsEditor
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
        if(auth()->check() && auth()->user()->is_admin == 3){
            return $next($request);
        }
   
        return redirect('/')->with('status',"You do not have admin access.");
    }
}