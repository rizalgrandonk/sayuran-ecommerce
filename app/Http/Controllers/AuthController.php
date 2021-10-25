<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
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

        return view('register', [
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
