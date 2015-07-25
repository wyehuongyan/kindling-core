<?php namespace App\Models;

class Shopper extends User {
    protected $table = 'shoppers';
    protected $appends = array('order_statuses');

    public function user() {
        return $this->morphOne('App\Models\User', 'shoppable');
    }

    public function gender() {
        return $this->belongsTo('App\Models\ShopperGender');
    }

    public function getOrderStatusesAttribute() {
        // 4: Shipping Received
        // 7: Request to Cancel

        return array(4, 7);
    }
}