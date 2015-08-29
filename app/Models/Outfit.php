<?php  namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Outfit extends Model {
    use SoftDeletes;

    protected $table = "outfits";
    protected $dates = ['deleted_at'];
    protected $appends = array('created_at_custom_format');

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function categories() {
        return $this->belongsToMany('App\Models\OutfitCategory', 'outfits_categories');
    }

    public function inspiredBy() {
        return $this->belongsTo('App\Models\User', 'inspired_by');
    }

    public function pieces() {
        return $this->belongsToMany('App\Models\Piece', 'pieces_outfits')->orderBy('position', 'asc');
    }

    public function getCreatedAtCustomFormatAttribute()
    {
        if($this->created_at->isToday())
        {
            $created_at_date = 'Today';
        }
        else if($this->created_at->isYesterday())
        {
            $created_at_date = 'Yesterday';
        } else {
            $created_at_date = $this->created_at->format('F jS');
        }

        $created_at_time = $this->created_at->format('h:i A');
        $created_at_human = $this->created_at->diffForHumans(null, true);

        $created_at_custom = array();

        $created_at_custom['created_at_date'] = $created_at_date;
        $created_at_custom['created_at_time'] = $created_at_time;
        $created_at_custom['created_at_human'] = $created_at_human;

        return $created_at_custom;
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
        if (isset($search_fields['full_text'])) {
            $fulltext = $search_fields['full_text'];

            $query->whereRaw("MATCH (description) AGAINST ('$fulltext')");
        }
        return $query;
    }
}