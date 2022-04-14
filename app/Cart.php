<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public $table = "cart";

    public $fillable = ['id',
        'product_id',
        'created_at', 'updated_at'];

    public $dates = ['created_at', 'updated_at'];
    public $primaryKey = 'id';

    public function Products()
    {
        return $this->belongsTo(Products::class, "product_id", "id");
    }

    public function total()
    {
        $qun = $this->qun;
        $price = $this->Products->new_price();
        $total = (float)$qun * (float)$price;
        return $total;
    }

}
