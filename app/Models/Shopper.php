<?php namespace App\Models;

class Shopper extends User {
    protected $table = 'shoppers';

    public function user() {
        return $this->morphOne('App\Models\User', 'shoppable');
    }

    public function gender() {
        return $this->belongsTo('App\Models\ShopperGender');
    }
}