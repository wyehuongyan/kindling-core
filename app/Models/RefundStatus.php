<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RefundStatus extends Model {
    use SoftDeletes;

    protected $table = 'refund_statuses';
    protected $dates = ['deleted_at'];
}