<?php

namespace App;

use App\product;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

  public function items()
  {
      return $this->belongsToMany(product::class, 'order_items', 'order_id', 'product_id')->withPivot('quantity','price');

  }

  public function user()
  {
      return $this->belongsTo(User::class);
  }


}
