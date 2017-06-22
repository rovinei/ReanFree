<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class AdminLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show login form page to user (admin)
     *
     * @return resources/view/admin/auth/login
     */
    public function showLoginForm(Request $request){
        if(Auth::guard('admin')->check()){
            return redirect()->route('admin.dashboard.alias');
        }
        return view('admin.auth.login');
    }

    public function login(Request $request){

        // Validate form data
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // Attempt to log user in
        if(Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password
            ], $request->remember)){

            // if successful, then redirect to their intent location
            return redirect()->intended(route('admin.dashboard.alias'));

        }

        // if unsuccessful, then redirect them to login form again
        return redirect(route('admin.login'))->withInput($request->only('email', 'remember'));

    }


    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect(route('admin.login'));
    }

}
