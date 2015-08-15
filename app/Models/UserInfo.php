<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserInfo extends Model {
    protected $table = 'user_info';
    protected $dates = ['deleted_at'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function gender() {
        return $this->belongsTo('App\Models\UserGender');
    }
}