<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/admin');
        }

        return back()->with("login-error", "Login Failed");
    }

    public function register()
    {
        $res = Http::withHeaders([
            'key' => 'f26ecb1fd37bc662a35832e653f4a3fa',
        ])->get('https://api.rajaongkir.com/starter/province');

        if ($res->failed()) {
            return abort(404);
        }

        $data = $res->json();
        $listProvince = $data['rajaongkir']['results'];

        return view('auth.register', [
            'listProvince' => $listProvince
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8|max:255',
            'address' => 'required',
            'province_id' => 'required',
            'province' => 'required',
            'city_id' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'phone' => 'required'
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        User::create($validatedData);

        return redirect()->route('login')->with("success", "Registration Success, Please Login");
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function forgot_password()
    {
        return view('auth.forgot-password');
    }

    public function email_password(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function reset_password($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function get_cities()
    {
        $res = Http::withHeaders([
            'key' => 'f26ecb1fd37bc662a35832e653f4a3fa',
        ])->get('https://api.rajaongkir.com/starter/city', [
            'province' => request('province_id')
        ]);

        if ($res->failed()) {
            return response('Failed', 404);
        }

        $data = $res->json();
        // dd($data['rajaongkir']['results']);
        $listCity = $data['rajaongkir']['results'];

        return response()->json($listCity);
    }
}
