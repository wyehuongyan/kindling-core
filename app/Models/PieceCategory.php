<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PieceCategory extends Model {
    use SoftDeletes;

    protected $table = 'piece_categories';
    protected $dates = ['deleted_at'];
    protected $hidden = ['deleted_at'];

    public function pieces() {
        $this->hasMany('App\Models\Piece');
    }
}