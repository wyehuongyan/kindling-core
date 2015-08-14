<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShopOrder extends Model {
    use SoftDeletes;

    protected $table = 'shop_orders';
    protected $dates = ['deleted_at'];
    protected $appends = array('created_at_custom_format');

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

    public function shopOrderRefunds() {
        return $this->hasMany('App\Models\ShopOrderRefund');
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

    public function getCreatedAtCustomFormatAttribute()
    {
        if($this->created_at->isToday())
        {
            $created_at_date = 'Today';
        }
        else if($this->created_at->isYesterday())
        {
            $created_at_date = 'Yesterday';
        } else {
            $created_at_date = $this->created_at->format('F jS');
        }

        $created_at_time = $this->created_at->format('h:i A');
        $created_at_human = $this->created_at->diffForHumans(null, true);

        $created_at_custom = array();

        $created_at_custom['created_at_date'] = $created_at_date;
        $created_at_custom['created_at_time'] = $created_at_time;
        $created_at_custom['created_at_human'] = $created_at_human;

        return $created_at_custom;
    }

    public function scopeSearch($query, $search_fields) {
        if (isset($search_fields['id']) && is_numeric($search_fields['id'])) {
            return $query->where('id', '=', $search_fields['id']);
        }
        if (isset($search_fields['user_id']) && is_numeric($search_fields['user_id'])) {
            $query->where('user_id', '=', $search_fields['user_id']);
        }
        if (isset($search_fields['buyer_id']) && is_numeric($search_fields['buyer_id'])) {
            $query->where('buyer_id', '=', $search_fields['buyer_id']);
        }
        if (isset($search_fields['user_order_id']) && is_numeric($search_fields['user_order_id'])) {
            $query->where('user_order_id', '=', $search_fields['user_order_id']);
        }
        return $query;
    }
}