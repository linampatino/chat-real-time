<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\BoardEvent;

class BoardController extends Controller
{
    public function sendBoard(Request $request){
        //dd($request->figure);
        event( new BoardEvent($request->figure) );
        return $request->all();
    }
}
