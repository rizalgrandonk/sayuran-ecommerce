<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile.index', [
            'title' => 'User Profile'
        ]);
    }

    public function edit()
    {
        $provRes = Http::withHeaders([
            'key' => 'f26ecb1fd37bc662a35832e653f4a3fa',
        ])->get('https://api.rajaongkir.com/starter/province');

        if ($provRes->failed()) {
            return abort(404);
        }

        $provData = $provRes->json();
        $listProvince = $provData['rajaongkir']['results'];

        $cityRes = Http::withHeaders([
            'key' => 'f26ecb1fd37bc662a35832e653f4a3fa',
        ])->get('https://api.rajaongkir.com/starter/city', [
            'province' => auth()->user()->province_id
        ]);

        if ($cityRes->failed()) {
            return abort(404);
        }

        $cityData = $cityRes->json();
        // dd($data['rajaongkir']['results']);
        $listCity = $cityData['rajaongkir']['results'];

        return view('admin.profile.edit', [
            'title' => 'Edit Profile',
            'listProvince' => $listProvince,
            'listCity' => $listCity
        ]);
    }

    public function update(Request $request)
    {
        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'address' => 'required',
            'province_id' => 'required',
            'province' => 'required',
            'city_id' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'phone' => 'required'
        ];

        if ($request->email != auth()->user()->email) {
            $rules['email'] = 'required|unique:users,email';
        }

        $validatedData = $request->validate($rules);

        User::where("id", auth()->user()->id)->update($validatedData);

        return redirect()->route('admin.profile.index')->with("success", "Data Updated");
    }

    public function transaction()
    {
        $transactions = Transaction::with(['orders', 'user'])
            ->where('user_id', auth()->user()->id)
            ->get();

        // dd($transactions);

        return view('admin.transaction.index', [
            'title' => "User Transaction",
            'transactions' => $transactions
        ]);
    }
}
