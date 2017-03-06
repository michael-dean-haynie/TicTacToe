<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
  public function getStart(Request $req){
    return view('start');
  }

  public function getPlayOnline(){
    return view('play-online');
  }
}
