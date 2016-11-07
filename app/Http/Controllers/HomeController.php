<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Import;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $import = Import::where('product_id', '864')->first();
//        echo $import->name; 
        $imports = Import::all();
        foreach($imports as $import){
            echo $import->name;
        }
        
        return view('home');
    }
}
