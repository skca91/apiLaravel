<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    public function resenia()
    {
    	return $this->hasMany(Resenia::class);
    }
}
