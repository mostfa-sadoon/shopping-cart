@extends('layouts.app')

@section('content')
  <div class="container">
   
       @foreach($carts as $cart)
            <div class="card mb-2">
                <div class="card-body">
                     <table class="table table-stripe  mt-2 mb-2">
                        <thead>
                          <tr>
                             <th scope="col">title</th>
                             <th scope="col">price</th>
                             <th scope="col">quantity</th>
                             <th scope="col">status</th>
                          </tr>
                        </thead>
                        <tbody>
                           @foreach($cart->items as $item)
                             <tr>
                                <td>{{$item['title']}}</td>
                                <td>{{$item['price']}}</td>
                                <td>{{$item['qty']}}</td>
                                <td>paid</td>
                             </tr>   
                           @endforeach
                        </tbody>
                     </table>
                </div>
            </div>
           <p class="badge badge-pill badge-info p-3 text-white">totlal price:{{$cart->totalprice}}</p> 
       @endforeach
  </div>
@endsection