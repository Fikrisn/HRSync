<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardControllerA extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Selamat Datang Admin',
            'list' => ['Home', 'dashboardA']
        ];
        $activeMenu = 'dashboardA';

        return view('Admin.dashboardA', ['breadcrumb'=> $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
