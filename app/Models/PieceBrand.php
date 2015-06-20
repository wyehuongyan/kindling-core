<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PieceBrand extends Model {
    use SoftDeletes;

    protected $table = 'piece_brands';
    protected $dates = ['deleted_at'];
    protected $hidden = ['deleted_at'];

    public function pieces() {
        $this->hasMany('App\Models\Piece');
    }

    public function scopeSearch($query, $search_fields) {
        if (isset($search_fields['id']) && is_numeric($search_fields['id'])) {
            return $query->where('id', '=', $search_fields['id']);
        }
        if (isset($search_fields['name'])) {
            $query->where('name', 'like', '%' . $search_fields['name'] . '%');
        }
        return $query;
    }
}