<?php
namespace App\Http\Controllers;
use App\Product;
use Alert;
use Illuminate\Http\Request;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('store');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        return view('home');
        
    }

    public function store()
    {
        if(session('success'))
        {
            Alert::success('Success Title', 'the product charged succesfully');
        }
       
        $latestproducts=Product::latest()->take(3)->get();
        return view('store',compact('latestproducts'));
    }
}
