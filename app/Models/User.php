<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token', 'firebase_token', 'deleted_at'];

    public function outfits() {
        return $this->hasMany('App\Models\Outfit');
    }

    public function inspired() {
        return $this->hasMany('App\Models\Outfit');
    }

    public function pieces() {
        return $this->hasMany('App\Models\Piece');
    }

    public function following() {
        // who do i follow
        return $this->belongsToMany('App\Models\User', 'follows', 'follower_id', 'following_id');
    }

    public function followers() {
        // who is following me
        return $this->belongsToMany('App\Models\User', 'follows', 'following_id', 'follower_id');
    }

    public function scopeSearch($query, $search_fields) {
        if (isset($search_fields['id']) && is_numeric($search_fields['id'])) {
            return $query->where('id', '=', $search_fields['id']);
        }
        if (isset($search_fields['username'])) {
            $query->where('username', 'like', '%' . $search_fields['username'] . '%');
        }
        if (isset($search_fields['email'])) {
            return $query->where('email', '=', $search_fields['email']);
        }
        return $query;
    }
}
