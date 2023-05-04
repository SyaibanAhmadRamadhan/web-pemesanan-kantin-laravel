<?php

namespace App\Http\Controllers;

use App\Models\PembeliModel;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profileView()
    {
        $profile = PembeliModel::where('id_pembeli', Auth()->user()->id)->first();
        return view('pembeli.profile', [
            'title' => 'profile',
            'profile' => $profile
        ]);
    }

    public function profileEditProcess(Request $request)
    {
        $credential = $request->validate([
            'username' => 'required|unique:users,username,' . Auth()->user()->id . ',id',
            'email' => 'required|unique:users,email,' . Auth()->user()->id . ',id',
            'mobile_phone' => 'numeric'
        ]);
        try {
            User::where('id', Auth()->user()->id)->update([
                'username' => $request->username,
                'email' => $request->email,
            ]);
            if (PembeliModel::where('id_pembeli', Auth()->user()->id)->first()) {
                PembeliModel::where('id_pembeli', Auth()->user()->id)->update([
                    'name' => $request->name,
                    'mobile_phone' => $request->mobile_phone,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                ]);
            } else {
                PembeliModel::create([
                    'id_pembeli' => Auth()->user()->id,
                    'name' => $request->name,
                    'mobile_phone' => $request->mobile_phone,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'jenis_kelamin' => $request->jenis_kelamin,
                ]);
            }
            return redirect()->route('profile.view')->with(['success' => 'profile berhasil diubah']);
        } catch (\Throwable $th) {
            return redirect()->route('profile.view')->with(['error' => 'terjadi kesalah error 500']);
        }
    }
}
