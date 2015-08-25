<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Piece extends Model {
    use SoftDeletes;

    protected $table = "pieces";
    protected $dates = ['deleted_at'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function category() {
        return $this->belongsTo('App\Models\PieceCategory');
    }

    public function brand() {
        return $this->belongsTo('App\Models\PieceBrand');
    }

    public function outfits() {
        return $this->belongsToMany('App\Models\Outfit', 'pieces_outfits');
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
        if (isset($search_fields['type'])) {
            $query->where('type', 'like', '%' . $search_fields['type'] . '%');
        }
        if (isset($search_fields['types'])) {
            $types = $search_fields['types'];

            $query->where(function($query) use ($types) {
                for($i = 0; $i < count($types); $i++) {
                    $type = $types[$i];

                    if ($i == 0) {
                        $query->where('type', 'like', '%' . $type . '%');
                    } else {
                        $query->orWhere('type', 'like', '%' . $type . '%');
                    }
                }
            });
        }
        if (isset($search_fields['full_text'])) {
            $fulltext = $search_fields['full_text'];

            $query->whereRaw("MATCH (name, description) AGAINST ('$fulltext')")->orWhereHas('category', function($query) use ($fulltext) {
                $query->whereRaw("MATCH (name) AGAINST ('$fulltext')");
            })->orWhereHas('brand', function($query) use ($fulltext) {
                $query->whereRaw("MATCH (name) AGAINST ('$fulltext')");
            });
        }
        if (isset($search_fields['description'])) {
            $query->where('description', 'like', '%' . $search_fields['description'] . '%');
        }
        return $query;
    }
}