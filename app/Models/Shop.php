<?php namespace App\Models;

class Shop extends User {
    protected $table = 'shops';

    public function user() {
        return $this->morphOne('App\Models\User', 'shoppable');
    }

    public function owner() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function deliveryOptions() {
        return $this->hasMany('App\Models\DeliveryOptions', 'user_id');
    }
}