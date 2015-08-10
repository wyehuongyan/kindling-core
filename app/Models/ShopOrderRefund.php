<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShopOrderRefunds extends Model {
    use SoftDeletes;

    protected $table = 'shop_order_refunds';
    protected $dates = ['deleted_at'];
    protected $appends = array('created_at_custom_format');

    public function shopOrder() {
        return $this->belongsTo('App\Models\ShopOrder');
    }

    public function refundStatus() {
        return $this->belongsTo('App\Models\RefundStatus', 'refund_status_id');
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
}