<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Producto extends Model
{
    use HasFactory;

	protected $fillable = ['nombre', 'descripcion','precio','inventario','descuento'];
	
    protected $table = 'productos';

    public function resenia()
    {
    	return $this->hasMany(Resenia::class);
    }
}
