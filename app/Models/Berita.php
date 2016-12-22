<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $fillable= ['judul','body'];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
