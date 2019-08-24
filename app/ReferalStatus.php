<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferalStatus extends Model
{
    public function referal() {
        return $this->belongsTo('App\Referal','referal_id');
    }
}
