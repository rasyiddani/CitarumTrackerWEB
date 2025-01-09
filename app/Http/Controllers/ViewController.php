<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewController extends Controller
{
    public function index()
    {
        $data = [
            'script'    => 'components.scripts.dashboard.index',
            'title'     => 'Dashboard'
        ];

        return view('dashboard.index', $data);
    }

    public function login()
    {
        $data = ['title' => 'Login'];

        return view('auth', $data);
    }

    public function setting()
    {
        $limits = DB::table('settings')->first();

        $data = [
            'limits'    => $limits,
            'title'     => 'Setting'
        ];

        return view('dashboard.setting', $data);
    }
}
