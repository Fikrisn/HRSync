<?php

namespace App\Http\Controllers\Pimp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardControllerP extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Selamat Datang',
            'list' => ['Home', 'dashboardP']
        ];
        $activeMenu = 'dashboardP';

        return view('Pimp.dashboardP', ['breadcrumb'=> $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
