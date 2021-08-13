<?php

namespace App\Laravue\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $table = 'application';

    protected $fillable = [
        'user_id','profile_id', 'approver', 'approver_date', 'status'
    ];

    public function profile()
    {
        return $this->belongsTo('App\Laravue\Models\Profile','profile_id','id');
    }
    public function approver()
    {
        return $this->belongsTo('App\Laravue\Models\User','approver','id');
    }
}
