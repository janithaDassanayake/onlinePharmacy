<?php

namespace App;

use App\product;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

  public function items()
  {
      return $this->belongsToMany(product::class, 'order_items', 'order_id', 'product_id');

    

  }



}
