<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Configuration;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
    

        return view("frontend.home");
    }

}
