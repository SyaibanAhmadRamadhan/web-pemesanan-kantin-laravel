<?php

namespace App\Http\Controllers;

use App\Models\DaftarMenuModel;
use App\Models\NotifPenjualModel;
use App\Models\PesananModel;
use Illuminate\Http\Request;

class PenjualDashboardController extends Controller
{
    public function dashboardView()
    {
        $notif = NotifPenjualModel::where('status', 'unread')->where('id_penjual', Auth()->user()->id)->get();
        $countPesanan = PesananModel::where('id_penjual', Auth()->user()->id)->count();
        $countPembeli = PesananModel::distinct('id_user')->where('id_penjual', Auth()->user()->id)->select('id_user')->where('status_pembayaran', 'sudah bayar')->where('status_pesanan', 'pesanan selesai')->count();
        $countMenu = DaftarMenuModel::where('id_penjual', Auth()->user()->id)->count();
        return view('penjual.dashboard', [
            'title' => 'dashboard',
            'notif' => $notif,
            'countPesanan' => $countPesanan,
            'countPembeli' => $countPembeli,
            'countMenu' => $countMenu,
        ]);
    }
}
