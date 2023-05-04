<?php

namespace App\Http\Controllers;

use App\Models\DaftarMenuModel;
use App\Models\PembeliModel;
use App\Models\PenjualModel;
use App\Models\PesananModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class NotaPesananController extends Controller
{
    public function notaView($id)
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
        $pesanan = PesananModel::where('nomer_pesanan', $id)->get();
        $menu = PenjualModel::where(function ($query) use ($pesanan) {
            foreach ($pesanan as $key => $x) {
                $query->orWhere('id_penjual', $x->id_penjual);
            }
        })->get();
        return view('pembeli.nota-pemesanan', [
            'title' => 'nota-pesanan',
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
                PesananModel::where('nomer_pesanan', $x->nomer_pesanan)->update([
                    'status_pesanan' => 'pesanan selesai',
                ]);
            }
            return redirect()->route('nota.pesanan.view', ['id' => $request->nomer_pesanan])->with('success', 'pesanan berhasil diupdate');
        } catch (\Throwable $th) {
            return back()->with('error', 'terjadi kesalahan pada server');
        }
    }
}
