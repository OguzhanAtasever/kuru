<?php


namespace App\Http\Controllers\Yonetim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnasayfaController extends Controller
{
    public function index(){
        return route('yonetim.anasayfa');

    }
}
