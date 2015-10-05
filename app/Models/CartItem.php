<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItem extends Model {
    use SoftDeletes;

    protected $table = 'cart_items';
    protected $dates = ['deleted_at'];

    public function cart() {
        return $this->belongsTo('App\Models\Cart');
    }

    public function piece() {
        return $this->belongsTo('App\Models\Piece')->withTrashed();
    }

    public function seller() {
        return $this->belongsTo('App\Models\User', 'seller_id');
    }

    public function outfit() {
        return $this->belongsTo('App\Models\Outfit');
    }

    public function deliveryOption() {
        return $this->belongsTo('App\Models\DeliveryOption');
    }

    public function shopOrder() {
        return $this->belongsTo('App\Models\ShopOrder');
    }

    public function scopeSearch($query, $search_fields) {
        if (isset($search_fields['id']) && is_numeric($search_fields['id'])) {
            return $query->where('id', '=', $search_fields['id']);
        }
        if (isset($search_fields['cart_id']) && is_numeric($search_fields['cart_id'])) {
            $query->where('cart_id', '=', $search_fields['cart_id']);
        }
        if (isset($search_fields['piece_id']) && is_numeric($search_fields['piece_id'])) {
            $query->where('piece_id', '=', $search_fields['piece_id']);
        }
        if (isset($search_fields['seller_id']) && is_numeric($search_fields['piece_id'])) {
            $query->where('seller_id', '=', $search_fields['seller_id']);
        }
        if (isset($search_fields['outfit_id']) && is_numeric($search_fields['outfit_id'])) {
            $query->where('outfit_id', '=', $search_fields['outfit_id']);
        }
        return $query;
    }
}