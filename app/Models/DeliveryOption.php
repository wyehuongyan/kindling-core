<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryOption extends Model {
    use SoftDeletes;

    protected $table = 'delivery_options';
    protected $dates = ['deleted_at'];

//    public function shopOrders() {
//        $this->hasMany('App\Models\ShopOrder');
//    }

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function scopeSearch($query, $search_fields) {
        if (isset($search_fields['id']) && is_numeric($search_fields['id'])) {
            return $query->where('id', '=', $search_fields['id']);
        }
        if (isset($search_fields['user_id']) && is_numeric($search_fields['user_id'])) {
            $query->where('user_id', '=', $search_fields['user_id']);
        }
        if (isset($search_fields['name'])) {
            $query->where('name', 'like', '%' . $search_fields['name'] . '%');
        }
        return $query;
    }
}