<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Piece extends Model {
    protected $table = "pieces";

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function outfits() {
        return $this->belongsToMany('App\Models\Outfit', 'pieces_outfits');
    }

    public function scopeSearch($query, $search_fields) {
        if (isset($search_fields['id']) && is_numeric($search_fields['id'])) {
            return $query->where('id', '=', $search_fields['id']);
        }
        if (isset($search_fields['name'])) {
            $query->where('name', 'like', '%' . $search_fields['name'] . '%');
        }
        if (isset($search_fields['type'])) {
            $query->where('type', 'like', '%' . $search_fields['type'] . '%');
        }
        if (isset($search_fields['description'])) {
            $query->where('description', 'like', '%' . $search_fields['description'] . '%');
        }
        return $query;
    }
}