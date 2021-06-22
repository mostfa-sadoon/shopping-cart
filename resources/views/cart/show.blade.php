@extends('layouts.app')
@section('content')
   <div class="container">
      <div class="row">
      @if($cart)
            <div class="col-md-8">
            @if($errors->any())
               <div class="alert alert-danger">
                  <ul>
                     @foreach($errors->all() as $error)
                       <li>{{$error}}</li>
                     @endforeach
                  </ul>
               </div>
             @endif
                @foreach($cart->items as $product)
                   <div class="card mb-2">
                     <div class="card-body">
                         <div class="card-title">
                          <h5>{{ $product['title']}}</h5>
                         </div>
               
                         <div class="card-text">
                          <h5>{{$product['price']}}</h5>

                          
                          <form method="POST" action="{{route('product.update',$product['id'])}}">
                             @csrf
                             @method('put')
                             <input type="text" name="qty" id="qty" value="{{$product['qty']}}">
                            <button type="submit" class="btn btn-secondary ml-4 btn-sm ">change</button>
                          </form>
                          <form method="POST" action="{{route('product.delete',$product['id'])}}">
                             @csrf
                             @method('delete')
                            <button type="submit" class="btn btn-danger ml-4 btn-sm float-right">remove</button>
                          </form>
                          <a href="#" class="btn  btn-sm">change</a>
                         </div>
                     </div>
                   </div>
                @endforeach
               <p>total price: ${{$cart->totalprice}}</p>
            </div>
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h3 class="card-title">
                            your cart
                        </h3>
                        <div class="text">
                           <p>
                           total Amount is ${{$cart->totalprice}}
                           </p>
                           <p>
                             total quanities is{{$cart->totalqty}}
                           </p>
                           <a href="{{route('cart.checkout',$cart->totalprice)}}" class="btn btn-success">check out</a>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <p>there no item in cart</p>
            @endif
      </div>
   </div>
@endsection