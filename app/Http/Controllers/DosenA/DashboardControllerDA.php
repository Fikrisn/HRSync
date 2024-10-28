<?php

namespace App\Http\Controllers\DosenA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardControllerDA extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Selamat Datang',
            'list' => ['Home', 'dashboardDA']
        ];
        $activeMenu = 'dashboardDA';

        return view('DosenA.dashboardDA', ['breadcrumb'=> $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
