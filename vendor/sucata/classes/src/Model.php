<?php

namespace Sucata;

class Model
{
    private $values = [];

    public function __call($nome, $paramentros)
    {
        $metodo = substr($nome, 0, 3);
        $nomeCampo = substr($nome, 3, strlen($nome));

        var_dump($metodo, $nomeCampo);
        exit;
    }
}

?>