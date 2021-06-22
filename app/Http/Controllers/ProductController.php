<?php

namespace App\Http\Controllers;
use App\Http\Requests\CartRequest;
use App\Product;
use App\Cart;
Use Alert;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
        $products=Product::latest()->paginate(6);
        return view('products.index',compact('products'));  
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(CartRequest $request, $product_id)
    {
        //

        $cart=new cart(session()->get('cart'));
        $cart->updateqty($product_id,$request->qty);
        session()->put('cart',$cart);
        return redirect()->route('cart.show')->with('success','qty of product updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id)
    {
        //
       
        $cart=new cart(session()->get('cart'));
         $cart->remove($product_id);
         if($cart->totalqty<=0)
         {
           session()->forget('cart');
         }else{
             session()->put('cart',$cart);
         }
         return redirect()->route('cart.show')->with('success','product  was remove');
    }
    public function addtocart($product_id)
    { 
        $product=Product::find($product_id);
      if(session()->has('cart'))
      {
        $cart=new cart (session()->get('cart'));
      }else{
          $cart=new cart();
      }
      $cart->add($product);
      //dd($cart);
      session()->put('cart',$cart);
      return redirect()->route('product.index')->with('success','product  added successfully');
    }
    public function showcart()
    {
        if(session()->has('cart'))
        {
            $cart=new cart (session()->get('cart'));
        }else{
            $cart=null;
        }   
       // dd($cart);
        return view('cart.show',compact('cart'));
    }
    public function checkout($amount)
    {
        return view('cart.checkout',compact('amount'));
    }
    public function charge(Request $request)
    {
        
         $charge=Stripe::charges()->create([
            'amount' => $request->amount,
            'currency' => 'usd',
            'description' => 'Example charge',
            'source' => $request->stripeToken,
         ]);

         $chargeid=$charge['id'];
         if($chargeid){
             // save in order table
             auth()->user()->orders()->create([
                 'cart'=>serialize(session()->get('cart'))
             ]);
              
                session()->forget('cart');
                 return redirect()->route('store')->with('success',"payment was done");
         }else{
               return redirect()->back();
         }
    }
}
