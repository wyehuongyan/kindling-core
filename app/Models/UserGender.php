<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserGender extends Model {
    use SoftDeletes;

    protected $table = 'user_gender';
    protected $dates = ['deleted_at'];

    public function users() {
        $this->hasMany('App\Models\User');
    }
}