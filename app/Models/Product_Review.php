<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Product_Review extends Model
{
    //
    protected $fillable = [
		'user_id', 'product_id', 'description', 'rating'
	];

	public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }
}
