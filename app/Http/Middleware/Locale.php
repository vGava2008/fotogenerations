<?php 

namespace App\Http\Middleware; 

use App; 
use Config; 
use Cookie; 
use Closure; 
use Illuminate\Http\Request; 

class Locale { 
    /** 
     * Handle an incoming request. 
     * 
     * @param \Illuminate\Http\Request $request 
     * @param \Closure $next 
     * @return mixed 
     */ 
     
    public function handle($request, Closure $next) 
    { 
        $raw_locale = $request->cookie('lang'); 
       
        //in_array
        if (in_array($raw_locale, Config::get('app.locales'))) 
        { 
            $locale = $raw_locale; 
            App::setLocale($locale); 
            $request->cookie('lang'); 
            return $next($request); 
        }
        else 
        {
            $locale = Config::get('app.locale'); 
            App::setLocale($locale); 
            $request->cookie('lang'); 
            return $next($request); 
        }
    }
}