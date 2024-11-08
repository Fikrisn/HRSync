<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PoinDosenController extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Daftar Pengguna',
            'list' => ['Home', 'Pengguna'],
        ];

        $page = (object)[
            'title' => 'Daftar pengguna yang terdaftar dalam sistem'
        ];
        $activeMenu = 'poindosen';

        return view('poindosen.index', ['breadcrumb'=> $breadcrumb, 'activeMenu' => $activeMenu]);

    }
}
