<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class suratController extends Controller
{
    public function index()
    {
        return view('user.surat.index');
    }
}
