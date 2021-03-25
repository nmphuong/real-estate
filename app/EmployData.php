<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


use Illuminate\Database\Eloquent\SoftDeletes;

class EmployData extends Model
{
	use SoftDeletes;
    public $table = 'employ_data';
}
