@extends('layouts.app')


@section('content')

<div class="container ">
<h2>Your cart</h2>


<table class="table ">
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>

            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cartItems as $item)

        <tr>
            <td scope="row">{{ $item->name }}</td>
            <td>
                {{Cart::session(auth()->id())->get($item->id)->getPriceSum()}}
            </td>
            <td>
                <form action="{{route('cart.update', $item->id)}}">
                    <input name="quantity" type="number" value="{{ $item->quantity }}">

                    <input type="submit" value="save">

                </form>

            </td>

            <td>
                <a  href="{{ route('cart.destroy', $item->id) }}"> Cancel </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


<br><hr>
<div class="container text-center ">
    <br>
    <h3>
        Total Price : Rs {{\Cart::session(auth()->id())->getTotal()}} /=
    </h3>
<br>
<a  class="btn btn-primary" href="{{ route('cart.checkout') }}" role="button">Proceed to checkout</a>
</div>

<a  class="btn btn-danger" href="{{ route('home') }}" role="button">back to store</a>
</div>
@endsection
