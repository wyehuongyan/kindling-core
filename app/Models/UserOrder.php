<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserOrder extends Model {
    use SoftDeletes;

    protected $table = 'user_orders';
    protected $dates = ['deleted_at'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function orderStatus() {
        return $this->belongsTo('App\Models\OrderStatus');
    }

    public function shopOrders() {
        return $this->hasMany('App\Models\ShopOrder');
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