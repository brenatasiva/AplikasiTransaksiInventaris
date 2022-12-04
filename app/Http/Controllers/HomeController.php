<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Item;
use App\Models\Invoice;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [];
        $u = user::all()->count();
        $i = item::all()->count();
        $in = invoice::all()->count();

        $data['user'] = $u;
        $data['item'] = $i;
        $data['invoice'] = $in;
        
        return view('home', compact('data'));
    }
}
