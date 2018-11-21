<?php

namespace App\Http\Resources\Producto;

use Illuminate\Http\Resources\Json\Resource;

class ProductoCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'nombre' => $this->nombre,
            'precioTotal' => round(((1 - ($this->descuento/100)) * $this->precio), 2),
            'clasificacion' => $this->resenia->count() > 0 ? round($this->resenia->sum('estrella')/$this->resenia->count(),2) : 'No tiene clasificacion',
            'href' => [
                'enlace' => route('productos.show', $this->id)
            ]
        ];
    }
}
