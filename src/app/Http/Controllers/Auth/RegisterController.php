<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
  
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * ユーザー登録後、投稿画面に遷移する
     * @param Request $request
     * @return RedirectResponse
     */
    public function register(UserCreateRequest $request)
{
    $user = User::create([
        'name' =>  $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);
              // ここでログイン状態にする
                $this->guard()->login($user);

    return redirect()->route('memo.index');
}
}
