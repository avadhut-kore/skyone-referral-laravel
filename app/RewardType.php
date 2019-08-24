<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RewardType extends Model
{
    public function products() {
        return $this->belongsTo('App\Product','reward_type_id');
    }
}
