<?php

namespace App\Http\Controllers;

use App\Models\NotifPenjualModel;
use App\Models\PenjualModel;
use App\Models\User;
use Illuminate\Http\Request;

class PenjualProfileController extends Controller
{
    public function inputDataPenjual()
    {
        return view('penjual.input-data-penjual', [
            'title' => 'data-penjual'
        ]);
    }
    public function inputDataPenjualProccess(Request $request)
    {
        $request->validate([
            'nama_warung' => 'required|unique:penjual',
            'lokasi' => 'required|unique:penjual',
            'nomer_telepon' => 'required|unique:penjual|numeric',
        ]);

        try {
            PenjualModel::create([
                'id_penjual' => Auth()->user()->id,
                'nama_warung' => $request->nama_warung,
                'lokasi' => $request->lokasi,
                'nomer_telepon' => $request->nomer_telepon,
            ]);
            return redirect()->route('dashboard.view')->with('success', 'profile warung anda berhasil diisi');
        } catch (\Throwable $th) {
            return back()->with('error', 'terjadi kesalahan server 500');
        }
    }

    public function viewProfile()
    {
        $dataPenjual = PenjualModel::where('id_penjual', Auth()->user()->id)->first();
        $dataUser = User::where('id', Auth()->user()->id)->first();
        $notif = NotifPenjualModel::where('status', 'unread')->where('id_penjual', Auth()->user()->id)->get();
        return view('penjual.profile', [
            'title' => 'profile',
            'dataPenjual' => $dataPenjual,
            'dataUser' => $dataUser,
            'notif' => $notif
        ]);
    }

    public function editProfileProcess(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users,username,' . Auth()->user()->id . ',id',
            'email' => 'required|unique:users,email,' . Auth()->user()->id . ',id',
            'nama_warung' => 'required|unique:penjual,nama_warung,' . Auth()->user()->id . ',id_penjual',
            'lokasi' => 'required|unique:penjual,lokasi,' . Auth()->user()->id . ',id_penjual',
            'nomer_telepon' => 'required|numeric|unique:penjual,nomer_telepon,' . Auth()->user()->id . ',id_penjual',
        ]);
        try {
            User::where('id', Auth()->user()->id)->update([
                'username' => $request->username,
                'email' => $request->email,
            ]);
            PenjualModel::where('id_penjual', Auth()->user()->id)->update([
                'nama_warung' => $request->nama_warung,
                'lokasi' => $request->lokasi,
                'nomer_telepon' => $request->nomer_telepon,
            ]);
            return redirect()->route('profile.penjual.view')->with(['success' => 'profile berhasil diubah']);
        } catch (\Throwable $th) {
            return redirect()->route('profile.penjual.view')->with(['error' => 'terjadi kesalah error 500']);
        }
    }
}
