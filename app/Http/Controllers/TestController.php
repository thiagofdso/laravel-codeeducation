<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
    //
    protected function index($nome){
        return "<html><head><title>Olá</title></head><body>Olá $nome</body></html>";
    }
}
