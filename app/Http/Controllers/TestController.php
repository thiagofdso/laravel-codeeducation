<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
    //
    protected function index($nome){
        return view('test.index',['nome'=>$nome]);
    }
    protected function notas(){
        return view('test.notas');
    }
}
