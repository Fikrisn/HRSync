<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PenggunaModel;

class ProfilController extends Controller
{
    public function edit()
    {
        $pengguna = Auth::user(); // Ambil pengguna yang terautentikasi

        return view('profil', ['pengguna' => $pengguna]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:pengguna,email,' . Auth::id(),
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $pengguna = PenggunaModel::find(Auth::id()); // Ambil pengguna dari model

        if ($pengguna) { // Pastikan pengguna ditemukan
            $pengguna->nama = $request->nama;
            $pengguna->email = $request->email;

            if ($request->hasFile('profile_image')) {
                $file = $request->file('profile_image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/photos', $filename);
                $pengguna->profile_image = $filename;
            }

            $pengguna->save(); // Simpan perubahan

            return redirect()->back()->with('status', 'Profil berhasil diperbarui');
        }

        return redirect()->back()->with('error', 'Pengguna tidak ditemukan');
    }
}
