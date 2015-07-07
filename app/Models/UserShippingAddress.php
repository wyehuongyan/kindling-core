<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserShippingAddress extends Model {
    use SoftDeletes;

    protected $table = 'user_shipping_addresses';
    protected $dates = ['deleted_at'];
    protected $hidden = ['deleted_at'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function scopeSearch($query, $search_fields) {
        if (isset($search_fields['id']) && is_numeric($search_fields['id'])) {
            return $query->where('id', '=', $search_fields['id']);
        }

        return $query;
    }
}