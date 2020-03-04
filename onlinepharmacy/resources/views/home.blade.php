@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Products</h2>
        <div class="row">

    @foreach ($allproducts as $product)

            <div class="col-3">
                <div class="card">
                    <img class="card-img-top" src="{{asset('dafult.jpg')}}" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title">{{$product->name}}</h4>
                        <p class="card-text">{{$product->description}}</p>
                    </div>

                    <div class="card-body">
                        <a href="#" class="card-link">Add to Cart</a>
                    </div>

                </div>
            </div>
        @endforeach

         </div>
</div>
@endsection
