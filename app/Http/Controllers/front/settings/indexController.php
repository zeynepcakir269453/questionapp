<?php

namespace App\Http\Controllers\front\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class indexController extends Controller
{
    public function index(){
        return view('front.settings.index');
    }
}
