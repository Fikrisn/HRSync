<?php

namespace App\Http\Controllers\DosenP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardControllerDP extends Controller
{
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Selamat Datang',
            'list' => ['Home', 'dashboardDP']
        ];
        $activeMenu = 'dashboardDP';

        return view('DosenP.dashboardDP', ['breadcrumb'=> $breadcrumb, 'activeMenu' => $activeMenu]);
    }
}
