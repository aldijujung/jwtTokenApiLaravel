<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuaccessController extends Controller
{
    public function AccessMenu()
    {
        // $menu = DB::select('select * from menuaccess');

        return view('app.menu.accessmenurole');
        // return view('');
    }
}
