<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function product() {
        return $this->hasMany('App\Product','category_id');
    }

    // public function childrens() {
    //     return $this->hasMany('App\Category','category_parent_id');
    // }
}
