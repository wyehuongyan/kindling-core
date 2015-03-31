<?php  namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Outfit extends Model {
    protected $table = "outfits";

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function pieces() {
        return $this->belongsToMany('App\Models\Piece', 'pieces_outfits')->orderBy('position', 'asc');
    }

    public function scopeSearch($query, $search_fields)
    {
        if (isset($search_fields['id']) && is_numeric($search_fields['id'])) {
            return $query->where('id', '=', $search_fields['id']);
        }
        if (isset($search_fields['name'])) {
            $query->where('name', 'like', '%' . $search_fields['name'] . '%');
        }
        if (isset($search_fields['description'])) {
            $query->where('description', 'like', '%' . $search_fields['description'] . '%');
        }
        return $query;
    }
}