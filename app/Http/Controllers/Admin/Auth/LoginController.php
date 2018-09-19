<?php
namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // protected $guard = 'admin';
    protected $loginView = 'admin.auth.login';

    protected $guard = 'admin';

    protected $redirectTo = null;

    public function __construct()
    {
       $this->redirectTo = route('admin.dashboard');
    }

    public function showLoginForm()
    {

        //if admin is loged, redirect to dashboard
        if(Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        else {
            return view($this->loginView);
        }
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}