<?php

namespace App\Http\Controllers;

class SeriesController extends Controller
{
    public function ListarSeries(){
        $series = [
            'Lois e Clark',
            'The Walking Dead',
            'Game Of Thrones'
        ];


        return view('series.index',[
            'series' => $series
        ]);
    }

    public function create()
    {
        return view('series.create'); //create e acordo com as conveções do laravel
    }
}
