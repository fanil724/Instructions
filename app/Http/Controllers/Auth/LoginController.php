<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class LoginController extends Controller
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
    protected $redirectTo = '/';



    public function username()
    {
        return 'name';
    }

    protected function credentials(Request $request)
    {
        return [
            $this->username() => $request->input('name'),
            'password' => $request->input('password'),
            'is_blocked' => 0,
        ];
    }


    protected function sendFailedLoginResponse(Request $request)
    {

        $user = \App\Models\User::where($this->username(), $request->input($this->username()))->first();
        if ($user) {
            if ($user->is_blocked) {
                throw ValidationException::withMessages([
                    'is_blocked' => [trans('auth.is_blocked')],
                ]);
            }
        }

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
