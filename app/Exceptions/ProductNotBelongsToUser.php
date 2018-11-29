<?php

namespace App\Exceptions;

use Exception;

class ProductNotBelongsToUser extends Exception
{
    public function render()
    {

    	return ['data' => 'El producto no pertenece al usuario'];
    }

}
