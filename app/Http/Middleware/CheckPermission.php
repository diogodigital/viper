<?php

namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\Models\Auth\User;

class CheckPermission
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * @var
     */
    private $status = false;

    /**
     * Create a new middleware instance.
     *
     *
     * @param  Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $roles
     * @return mixed
     */
    public function handle($request, Closure $next, $roles)
    {
        if (\Auth::check()) {
            if(strripos($roles, "|"))
            {
                $roles = explode("|", $roles);
                if(in_array(\Auth::user()->role_id, $roles)):
                    $this->status = true;
                endif;
            }else if(!empty($roles)) {
                if(\Auth::user()->role_id == $roles):
                    $this->status = true;
                endif;
            }

            if($this->status) {
                return $next($request);
            }else{
                \Auth::logout();
                return back()->with('error', 'Você não tem permissão para acessar essa área!');
            }
        }else{
            return redirect()->guest('/');
        }
    }






}
