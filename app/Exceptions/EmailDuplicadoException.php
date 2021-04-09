<?php

namespace App\Exceptions;

use Exception;

class EmailDuplicadoException extends Exception
{
    //

    public function render($request){

        return response('Este email já está cadastrado no sistema.', 500);
    }
}
