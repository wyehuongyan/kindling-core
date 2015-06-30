<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model {
    use SoftDeletes;

    protected $table = 'carts';
    protected $dates = ['deleted_at'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function cartItems() {
        return $this->hasMany('App\Models\CartItem');
    }
}