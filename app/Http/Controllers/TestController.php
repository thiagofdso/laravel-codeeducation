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
        $notas = [
            0 => 'Anotação 1',
            1 => 'Anotação 2',
            2 => 'Anotação 3',
            3 => 'Anotação 4',
            4 => 'Anotação 5'
        ];
        return view('test.notas',['notas'=>$notas]);
    }
}
