<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resenia extends Model
{

    use HasFactory;

    protected $table = 'resenias';

    protected $fillable = ['cliente', 'estrella', 'resenia'];

    public function producto()
    {
    	return $this->belongsTo(Producto::class);
    }
}
