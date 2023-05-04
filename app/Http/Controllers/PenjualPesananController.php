<?php

namespace App\Http\Controllers;

use App\Models\NotifPenjualModel;
use App\Models\PenjualModel;
use App\Models\PesananModel;
use Illuminate\Http\Request;

class PenjualPesananController extends Controller
{
    public function pesananView()
    {
        $pesananAll = PesananModel::all();
        foreach ($pesananAll as $key => $x) {
            if (substr($x->created_at, 0, 10) != date('Y-m-d') && $x->status_pembayaran == 'belum bayar') {
                PesananModel::where('id', $x->id)->update([
                    'status_pesanan' => 'dibatalkan'
                ]);
            }
        }
        $pesanan = PesananModel::where('id_penjual', Auth()->user()->id)->where('status_pembayaran', 'sudah bayar')->orderBy('id', 'DESC')->get();
        $nomerPesanan = PesananModel::distinct('nomer_pesanan')->select('nomer_pesanan')->get();
        $notif = NotifPenjualModel::where('status', 'unread')->where('id_penjual', Auth()->user()->id)->get();
        return view('penjual.pesanan', [
            'title' => 'pesanan',
            'search' => null,
            'pesanan' => $pesanan,
            'nomerPesanan' => $nomerPesanan,
            'notif' => $notif
        ]);
    }

    public function pesananDetailView($id)
    {
        $pesanan = PesananModel::where('nomer_pesanan', $id)->where('id_penjual', Auth()->user()->id)->get();
        $menu = PenjualModel::where(function ($query) use ($pesanan) {
            foreach ($pesanan as $key => $x) {
                $query->orWhere('id_penjual', $x->id_penjual);
            }
        })->get();
        return view('penjual.detail-pesanan', [
            'title' => 'detail-pesanan',
            'search' => null,
            'pesanan' => $pesanan,
            'menu' => $menu
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
                PesananModel::where('nomer_pesanan', $x->nomer_pesanan)->where('id_penjual', Auth()->user()->id)->update([
                    'status_pesanan' => 'pesanan telah siap',
                ]);
            }
            NotifPenjualModel::where('nomer_pesanan', $request->nomer_pesanan)->where('id_penjual', Auth()->user()->id)->update([
                'status' => 'read'
            ]);
            return back()->with('success', 'pesanan berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('error', 'terjadi kesalahan pada server');
        }
    }
}
