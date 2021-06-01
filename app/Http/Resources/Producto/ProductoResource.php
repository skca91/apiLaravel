<?php

namespace App\Http\Resources\Producto;

use Illuminate\Http\Resources\Json\JsonResource;


class ProductoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public static $wrap = 'producto';

    public function toArray($request)
    {
        return [
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'inventario' => $this->inventario > 0 ? $this->inventario : 'No hay inventario',
            'descuento' => $this->descuento,
            'precioTotal' => round(((1 - ($this->descuento/100)) * $this->precio), 2),
            'clasificacion' => $this->resenia->count() > 0 ? round($this->resenia->sum('estrella')/$this->resenia->count(),2) : 'No tiene clasificacion',
            'href' => [
                'resenias' => route('resenias.index', $this->id)
            ]
        ];
    }
}
