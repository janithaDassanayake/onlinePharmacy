<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;


use App\Product;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Product $product)
    {
        // add the product to cart
        //we use \ to import

        \Cart::session(auth()->id())->add(array(
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array(),
            'associatedModel' => $product
        ));

        return redirect()->route('cart.index');

    }

    public function index()
    {

        $cartItems = \Cart::session(auth()->id())->getContent();
        return view('cart.index', compact('cartItems'));
    }

    public function destroy($itemId)
    {
       \Cart::session(auth()->id())->remove($itemId);

        return back();
    }

    public function update($rowId)
    {

        //i used quatity array because when i incress the quantity it will added to the cureent value
        //'quantity'=> request('quantity') is worrng
        //to solve that a make relative as false.

        \Cart::session(auth()->id())->update($rowId, [
            'quantity' => [
                'relative' => false,
                'value' => request('quantity')
            ]
        ]);

        return back();
    }

    public function checkout()
    {
        return view('cart.checkout');
    }
}
