<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

  //  use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
         // $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'struct_id' => ['required', 'integer'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'role' => $data['role'],
            'struct_id' => $data['struct_id'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    // Определите метод register
    public function register(Request $request)
    {
        //dd($request->all());
        try {
            $this->validator($request->all())->validate();

            // Создайте нового пользователя
            $this->create($request->all());
            // Вы можете добавить сообщение об успешной регистрации, если необходимо
            return redirect('/ma/admins')->with('status', 'Регистрация прошла успешно. Пожалуйста, войдите в свой аккаунт.');
        }
       catch (\Exception $e) {

            return redirect()->withErrors('sa.employee')->with('error', 'Ошибка при создании. Пожалуйста, попробуйте еще раз или обратитесь к администратору.');
        }
    }

    // Определите метод showRegistrationForm
    public function showRegistrationForm()
    {
        $Structures= DB::table('main_structs')
            ->select('main_structs.id', 'main_structs.structName')
            ->get();

        return view('auth.register' , compact('Structures') );
    }
}
