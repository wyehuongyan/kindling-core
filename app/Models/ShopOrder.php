<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShopOrder extends Model {
    use SoftDeletes;

    protected $table = 'shop_orders';
    protected $dates = ['deleted_at'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function buyer() {
        return $this->belongsTo('App\Models\User', 'buyer_id');
    }

    public function userOrder() {
        return $this->belongsTo('App\Models\UserOrder');
    }

    public function orderStatus() {
        return $this->belongsTo('App\Models\OrderStatus', 'order_status_id');
    }

    public function deliveryOption() {
        return $this->belongsTo('App\Models\DeliveryOption');
    }

    public function shippingAddress() {
        return $this->belongsTo('App\Models\UserShippingAddress', 'user_shipping_address_id');
    }

    public function paymentMethod() {
        return $this->belongsTo('App\Models\UserPaymentMethod', 'user_payment_method_id');
    }

    public function cartItems() {
        return $this->hasMany('App\Models\CartItem');
    }

    public function scopeSearch($query, $search_fields) {
        if (isset($search_fields['id']) && is_numeric($search_fields['id'])) {
            return $query->where('id', '=', $search_fields['id']);
        }
        if (isset($search_fields['user_id']) && is_numeric($search_fields['user_id'])) {
            $query->where('user_id', '=', $search_fields['user_id']);
        }
        return $query;
    }
}