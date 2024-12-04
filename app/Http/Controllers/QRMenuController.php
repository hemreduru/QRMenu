<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QRMenuController extends Controller
{
    public function index()
    {
        return view('qrmenu.index');
    }
}
