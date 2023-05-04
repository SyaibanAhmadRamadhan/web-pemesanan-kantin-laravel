<?php

namespace App\Http\Controllers;

use App\Models\DaftarMenuModel;
use App\Models\PenjualModel;
use App\Models\PesananModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class MenuController extends Controller
{
    public function menuView()
    {
        $menu = DaftarMenuModel::all();
        $penjual = PenjualModel::all();

        return view('pembeli.menu', [
            'title' => 'menu',
            'menu' => $menu,
            'penjual' => $penjual,
            'search' => null
        ]);
    }

    public function pemesananProcess(Request $request)
    {
        if (!$request->session()->get('pemesanan')) {
            return redirect()->back()->with('info', 'masukan pesanan terlebih dahulu');
        }
        $pemesanan = $request->session()->get('pemesanan');
        $product =  DaftarMenuModel::where(function ($query) use ($pemesanan) {
            foreach ($pemesanan as $key => $x) {
                $query->orWhere('id', substr($key, 3));
            }
        })->get();
        foreach ($product as $key => $x) {
            $idMenu[] = $x->id;
        };
        $implodeMenu = implode(" ", $idMenu);
        $encyrptImplodeMenu = Crypt::encryptString($implodeMenu);
        return redirect()->route('detail.pesanan.view', ['state' => $encyrptImplodeMenu]);
    }

    public function pemesananSession(Request $request)
    {
        if ($request->valQty < 1) {
            return response()->json(['error' => 'pemesanan harus lebih dari 1']);
        }
        if ($request->valQty > $request->stock) {
            return response()->json(['errorRefresh' => 'pemesanan tidak boleh melebihi stock']);
        }
        if (PesananModel::where('id_user', Auth()->user()->id)->where('status_pembayaran', 'belum bayar')->where('status_pesanan', '!=', 'dibatalkan')->first()) {
            return response()->json(['error' => 'silahkan lakukan pembayaran pada pesanan anda sebelumnya']);
        }
        try {
            $obj = [];
            $obj[$request->qty] = $request->valQty;
            if ($request->session()->get('pemesanan')) {
                $result = array_merge($request->session()->get('pemesanan'), $obj);
                $request->session()->forget('pemesanan');
                $request->session()->put('pemesanan', $result);
            } else {
                $request->session()->put('pemesanan', $obj);
                $result = $request->session()->get('pemesanan');
            }
            return response()->json(['data' => $result]);
        } catch (\Throwable $th) {
            return response()->json(['error500' => 'terjadi kesalahan pada server']);
        }
    }

    public function searchView()
    {
        if (isset($_GET['search'])) {
            $searchGet = $_GET['search'];
            $DaftarMenu = DaftarMenuModel::distinct('id_penjual')->where('name_menu', 'LIKE', '%' . $_GET['search'] . '%')->get('id_penjual');
            if (count($DaftarMenu) != 0) {
                $penjual = PenjualModel::where(function ($query) use ($DaftarMenu) {
                    foreach ($DaftarMenu as $key => $x) {
                        $query->orWhere('id_penjual', $x->id_penjual);
                    }
                })->get();
                $menu = DaftarMenuModel::where('name_menu', 'LIKE', '%' . $_GET['search'] . '%')->get();
            } else {
                $penjual = [];
                $menu =  [];
            }
        } else {
            $searchGet = null;
            $menu = [];
            $penjual = [];
        }

        return view('pembeli.menu-search', [
            'title' => 'menu',
            'menu' => $menu,
            'penjual' => $penjual,
            'search' => $searchGet
        ]);
    }
}
