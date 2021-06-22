@extends('layouts.app')
@section('content')

   <div class="container">
       @if(session()->has('success'))
         <div class="alert alert-success">{{session()->get('success')}}</div>
       @endif
      <section>
          <div class="row">
          @if(count($products)>0)
             @foreach($products as $product)
                 <div class="col-md-4 mb-2">
                 <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{$product->image}}" >
                    <div class="card-body">
                        <h5 class="card-title">{{$product->title}}</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <p class="card-text">${{$product->price}}</p>
                        <a href="{{route('cart.add',$product->id)}}" class="btn btn-primary">buy</a>
                    </div>
                    </div>
                 </div>
             @endforeach
          @endif
          </div>
      </section>
               <div class=" d-flex justify-content-center">
                   {!!$products->links()!!}
              </div>
      
   </div>
@endsection