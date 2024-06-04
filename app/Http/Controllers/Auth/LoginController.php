<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;


use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Monolog\Handler\IFTTTHandler;

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
    //protected $redirectTo = '/sa/employee';
    protected function authenticated(Request $request, $user)
    {
        // Проверяем роль пользователя и перенаправляем его на соответствующий маршрут
        if ($user->role == 'admin') {
            return redirect()->route('sa.employee');
        } elseif ($user->role == 'main_admin') {
            return redirect()->route('ma.admins');
        } else {
            return redirect()->route('home');
        }
    }

    protected function loggedOut(Request $request)
    {
        // Переадресация на нужный маршрут после выхода
        return redirect()->route('phoneBook');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('guest')->except('logout');
    }

}
