<?php

namespace App\Http\Controllers;

use App\Models\DaftarMenuModel;
use App\Models\PesananModel;

class ListPesananController extends Controller
{
    public function listPesananView()
    {
        $pesananAll = PesananModel::all();
        foreach ($pesananAll as $key => $x) {
            if (substr($x->created_at, 0, 10) != date('Y-m-d') && $x->status_pembayaran == 'belum bayar') {
                PesananModel::where('id', $x->id)->update([
                    'status_pesanan' => 'dibatalkan'
                ]);
            }
        }
        $pesanan = PesananModel::where('id_user', Auth()->user()->id)->orderBy('id', 'DESC')->get();
        $nomerPesanan = PesananModel::distinct('nomer_pesanan')->where('id_user', Auth()->user()->id)->select('nomer_pesanan')->get();
        return view('pembeli.list-pesanan', [
            'title' => 'list-pesanan',
            'search' => null,
            'pesanan' => $pesanan,
            'nomerPesanan' => $nomerPesanan
        ]);
    }
}
