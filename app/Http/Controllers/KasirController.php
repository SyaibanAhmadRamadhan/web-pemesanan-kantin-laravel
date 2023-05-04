<?php

namespace App\Http\Controllers;

use App\Models\DaftarMenuModel;
use App\Models\NotifPenjualModel;
use App\Models\PenjualModel;
use App\Models\PesananModel;
use App\Models\User;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function kasirView()
    {
        $pesananAll = PesananModel::all();
        foreach ($pesananAll as $key => $x) {
            if (substr($x->created_at, 0, 10) != date('Y-m-d') && $x->status_pembayaran == 'belum bayar') {
                PesananModel::where('id', $x->id)->update([
                    'status_pesanan' => 'dibatalkan'
                ]);
                $menu = DaftarMenuModel::where('id', $x->id_menu)->first();
                DaftarMenuModel::where('id', $x->id_menu)->update([
                    'stock' => $menu->stock + $x->jumlah_pesanan
                ]);
            }
        }
        $pesanan = PesananModel::orderBy('id', 'DESC')->get();
        $nomerPesanan = PesananModel::distinct('nomer_pesanan')->select('nomer_pesanan')->get();
        return view('kasir.pesanan', [
            'title' => 'pesanan',
            'search' => null,
            'pesanan' => $pesanan,
            'nomerPesanan' => $nomerPesanan
        ]);
    }

    public function detailPesanan($id)
    {
        $pesanan = PesananModel::where('nomer_pesanan', $id)->get();
        $menu = PenjualModel::where(function ($query) use ($pesanan) {
            foreach ($pesanan as $key => $x) {
                $query->orWhere('id_penjual', $x->id_penjual);
            }
        })->get();
        return view('kasir.detail-pesanan', [
            'title' => 'detail-pesanan',
            'search' => null,
            'pesanan' => $pesanan,
            'menu' => $menu
        ]);
    }

    public function kasirSearchView(Request $request)
    {
        $pesananAll = PesananModel::all();
        foreach ($pesananAll as $key => $x) {
            if (substr($x->created_at, 0, 10) != date('Y-m-d') && $x->status_pembayaran == 'belum bayar') {
                PesananModel::where('id', $x->id)->update([
                    'status_pesanan' => 'dibatalkan'
                ]);
            }
        }
        $user = User::where('username', 'LIKE', '%' . $request->search . '%')->get();
        $pesanan = PesananModel::where('nomer_antrian', 'LIKE', '%' . $request->search . '%')->orWhere(function ($query) use ($user) {
            foreach ($user as $key => $x) {
                $query->orWhere('id_user', 'LIKE', '%' . $x->id . '%');
            }
        })->orderBy('id', 'DESC')->get();
        $nomerPesanan = PesananModel::distinct('nomer_pesanan')->select('nomer_pesanan')->get();
        return view('kasir.pesanan', [
            'title' => 'pesanan',
            'search' => null,
            'pesanan' => $pesanan,
            'nomerPesanan' => $nomerPesanan
        ]);
    }

    public function konfirmasiPesanan(Request $request)
    {
        $pesanan = PesananModel::where('nomer_pesanan', $request->nomer_pesanan)->get();
        if (count($pesanan) == 0) {
            return back()->with('info', 'pesanan tidak tersedia');
        }
        try {
            foreach ($pesanan as $key => $x) {
                PesananModel::where('nomer_pesanan', $x->nomer_pesanan)->update([
                    'status_pembayaran' => 'sudah bayar',
                    'status_pesanan' => 'pesanan disiapkan',
                ]);
            }
            $idPenjual = PesananModel::distinct('id_penjual')->where('nomer_pesanan', $request->nomer_pesanan)->select('id_penjual')->get();
            foreach ($idPenjual as $key => $x) {
                NotifPenjualModel::create([
                    'id_penjual' => $x->id_penjual,
                    'message' => 'anda memiliki pesanan baru',
                    'nomer_pesanan' => $request->nomer_pesanan
                ]);
            }
            return redirect()->route('kasir.pesanan.view')->with('success', 'pesanan berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('error', 'terjadi kesalahan pada server');
        }
    }
}
