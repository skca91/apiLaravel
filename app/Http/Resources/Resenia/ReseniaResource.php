<?php

namespace App\Http\Resources\Resenia;

use Illuminate\Http\Resources\Json\JsonResource;

class ReseniaResource extends JsonResource
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
            'id' => $this->id,
            'cliente' => $this->cliente,
            'mensaje' => $this->resenia,
            'estrella' => $this->estrella,
        ];
    }
}
