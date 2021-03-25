<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    public $table = 'banners';
    use SoftDeletes;
}
