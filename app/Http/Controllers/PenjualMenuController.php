<?php

namespace App\Http\Controllers;

use App\Models\DaftarMenuModel;
use App\Models\NotifPenjualModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PenjualMenuController extends Controller
{
    public function dataMenuView()
    {
        $menu = DaftarMenuModel::where('id_penjual', Auth()->user()->id)->get();
        $notif = NotifPenjualModel::where('status', 'unread')->where('id_penjual', Auth()->user()->id)->get();
        return view('penjual.menu.read-menu', [
            'title' => 'data-menu',
            'menu' => $menu,
            'notif' => $notif,
        ]);
    }

    public function addMenuView()
    {
        $notif = NotifPenjualModel::where('status', 'unread')->where('id_penjual', Auth()->user()->id)->get();
        return view('penjual.menu.create-menu', [
            'title' => 'tambah-menu',
            'notif' => $notif
        ]);
    }

    public function addMenuProcess(Request $request)
    {
        $request->validate([
            'name_menu' => 'required|unique:daftar_menu',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time() . '.' . $request->picture->extension();
        try {
            DaftarMenuModel::create([
                'id_penjual' => Auth()->user()->id,
                'name_menu' => $request->name_menu,
                'price' => $request->price,
                'stock' => $request->stock,
                'picture' => $imageName,
            ]);
            $request->picture->move(public_path('menu'), $imageName);
            return redirect()->route('menu.add.view')->with('success', 'menu berhasil ditambahkan');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function editMenuView($id)
    {
        $menu = DaftarMenuModel::where('id', $id)->where('id_penjual', Auth()->user()->id)->first();
        if (!$menu) {
            return redirect()->route('menu.data.view')->with('info', 'menu tidak ditemukan');
        }
        $notif = NotifPenjualModel::where('status', 'unread')->where('id_penjual', Auth()->user()->id)->get();
        return view('penjual.menu.update-menu', [
            'title' => 'edit-menu',
            'menu' => $menu,
            'notif' => $notif
        ]);
    }

    public function editMenuProcess(Request $request, $id)
    {
        $request->validate([
            'name_menu' => 'required|unique:daftar_menu,name_menu,' . $id,
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            if ($request->picture) {
                $imageName = time() . '.' . $request->picture->extension();
                DaftarMenuModel::where('id', $id)->where('id_penjual', Auth()->user()->id)->update([
                    'id_penjual' => Auth()->user()->id,
                    'name_menu' => $request->name_menu,
                    'price' => $request->price,
                    'stock' => $request->stock,
                    'picture' => $imageName,
                ]);
                $request->picture->move(public_path('menu'), $imageName);
                if (File::exists(public_path('menu/' . $request->oldPic))) {
                    File::delete(public_path('menu/' . $request->oldPic));
                }
            } else {
                DaftarMenuModel::where('id', $id)->where('id_penjual', Auth()->user()->id)->update([
                    'id_penjual' => Auth()->user()->id,
                    'name_menu' => $request->name_menu,
                    'price' => $request->price,
                    'stock' => $request->stock,
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->route('menu.data.view')->with('info', $th);
        }
        return redirect()->route('menu.data.view')->with('success', 'menu berhasil ditambahkan');
    }
    public function deleteMenuProcess($id)
    {
        $menu = DaftarMenuModel::find($id);
        if ($menu) {
            Storage::delete('public/' . $menu->picture);
            if (File::exists(public_path('menu/' . $menu->picture))) {
                File::delete(public_path('menu/' . $menu->picture));
            }
            $menu->delete();
            return redirect()->route('menu.data.view')->with('success', 'Menu Berhasil Didelete');
        } else {
            return redirect()->route('menu.data.view')->with('info', 'Menu Tidak Ditemukan');
        }
    }
}
