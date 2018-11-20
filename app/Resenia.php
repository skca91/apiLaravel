<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resenia extends Model
{
    protected $table = 'resenias';

    public function producto()
    {
    	return $this->belongsTo(Producto::class);
    }
}
