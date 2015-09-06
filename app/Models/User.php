<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use SoftDeletes;
	use Authenticatable, CanResetPassword;

    protected $dates = ['deleted_at'];
    protected $appends = array('num_outfits', 'num_followers', 'num_following', 'followed');

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
	protected $hidden = ['password', 'device_token', 'remember_token', 'firebase_token', 'braintree_cust_id', 'mandrill_subaccount_id', 'suspended_at', 'deleted_at'];

    public function userInfo() {
        return $this->hasOne('App\Models\UserInfo');
    }

    public function cart() {
        return $this->hasOne('App\Models\Cart');
    }

    public function points() {
        return $this->hasOne('App\Models\UserPoints');
    }

    public function outfits() {
        return $this->hasMany('App\Models\Outfit');
    }

    public function inspired() {
        return $this->hasMany('App\Models\Outfit');
    }

    public function pieces() {
        return $this->hasMany('App\Models\Piece');
    }

    public function paymentMethods() {
        return $this->hasMany('App\Models\UserPaymentMethod');
    }

    public function following() {
        // who am i following
        return $this->belongsToMany('App\Models\User', 'follows', 'follower_id', 'following_id');
    }

    public function followers() {
        // who are my followers
        return $this->belongsToMany('App\Models\User', 'follows', 'following_id', 'follower_id');
    }

    public function shoppable() {
        return $this->morphTo();
    }

    public function deliveryOptions() {
        return $this->hasMany('App\Models\DeliveryOptions');
    }

    public function shippingAddresses() {
        return $this->hasMany('App\Models\UserShippingAddress');
    }

    public function owns() {
        return $this->hasMany('App\Models\Shop');
    }

    public function orders() {
        return $this->hasMany('App\Models\UserOrder');
    }

    public function shopOrders() {
        return $this->hasMany('App\Models\ShopOrder');
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
        if (isset($search_fields['full_text'])) {
            $fulltext = $search_fields['full_text'];

            $query->whereRaw("MATCH (username, name) AGAINST ('$fulltext' IN BOOLEAN MODE)");
        }
        return $query;
    }

    // username must match letter for letter
    public function scopePreciseSearch($query, $search_fields) {
        if (isset($search_fields['id']) && is_numeric($search_fields['id'])) {
            return $query->where('id', '=', $search_fields['id']);
        }
        if (isset($search_fields['username'])) {
            $query->where('username', '=', $search_fields['username']);
        }
        if (isset($search_fields['email'])) {
            return $query->where('email', '=', $search_fields['email']);
        }
        return $query;
    }

    // appended attributes
    public function getNumOutfitsAttribute() {
        return $this->outfits()->count();
    }

    public function getNumFollowersAttribute() {
        return $this->followers()->where('follower_id', '!=', $this->id)->count();
    }

    public function getNumFollowingAttribute(){
        return $this->following()->where('following_id', '!=', $this->id)->count();
    }

    public function getFollowedAttribute() {
        $user = Auth::user();

        return $this->followers()->get()->contains($user->id);
    }
}
