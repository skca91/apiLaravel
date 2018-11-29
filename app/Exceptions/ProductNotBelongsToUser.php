<?php

namespace App\Exceptions;

use Exception;

class ProductNotBelongsToUser extends Exception
{
    public function render()
    {

    	return ['error' => 'El producto no pertenece al usuario'];
    }

}
