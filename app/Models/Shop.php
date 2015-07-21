<?php namespace App\Models;

class Shop extends User {
    protected $table = 'shops';
    protected $appends = array('order_statuses');

    public function user() {
        return $this->morphOne('App\Models\User', 'shoppable');
    }

    public function owner() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function getOrderStatusesAttribute() {
        // 3: Shipping Posted
        // 6: Shipping Delayed
        // 7: Cancelled

        return array(3, 6, 7);
    }
}