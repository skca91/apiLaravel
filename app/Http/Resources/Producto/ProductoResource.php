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
    public function toArray($request)
    {
        return [
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'inventario' => $this->inventario,
            'descuento' => $this->descuento,
        ];
    }
}
