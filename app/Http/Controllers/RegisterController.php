<?php

namespace App\Http\Controllers;

use App\Models\PenjualModel;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class RegisterController extends Controller
{
    public function registerView()
    {
        return view('authentication.register', [
            'title' => 'register'
        ]);
    }

    public function registerProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|unique:users',
            'email' => 'email:rfc,dns|unique:users',
            'password' => 'min:6|confirmed',
        ]);

        if ($validator->passes()) {
            try {
                if ($request->role == 'pembeli') {
                    User::create([
                        'username' => $request->username,
                        'role' => $request->role,
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                    ]);
                } elseif ($request->role == 'penjual') {
                    User::create([
                        'username' => $request->username,
                        'role' => $request->role,
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                    ]);
                }
            } catch (\Throwable $th) {
                return response()->json(['error500' => 'terjadi kesalahan']);
            }
            return response()->json(['success' => 'pendaftaran berhasil']);
        }
        return response()->json(['error' => $validator->errors()]);
    }
}
