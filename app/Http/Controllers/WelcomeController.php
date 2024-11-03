<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function landingPage(){
        // $breadcrumb = (object)[
        //     'title' => 'Selamat Datang',
        //     'list' => ['Home', 'Welcome']
        // ];
        // $activeMenu = 'Dashboard';

        return view('landingpage');
    }
}
