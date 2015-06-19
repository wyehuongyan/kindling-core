<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OutfitCategory extends Model {
    use SoftDeletes;

    protected $table = 'outfit_categories';
    protected $dates = ['deleted_at'];
    protected $hidden = ['deleted_at'];

    public function outfits() {
        $this->belongsToMany('App\Models\Outfit', 'outfits_categories');
    }
}