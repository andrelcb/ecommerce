<?php

namespace Sucata;

class Model
{
    private $values = [];

    public function __call($nome, $paramentros)
    {
        $metodoGetSet = substr($nome, 0, 3);
        $nomeCampo = substr($nome, 3, strlen($nome));

        switch ($metodoGetSet)
        {
            case "get":
                $this->values[$nomeCampo];
                break;

            case "set":
                $this->values[$nomeCampo] = $paramentros[0];
                break;
            
            default:
                break;
        }
    }

    public function setDados($data = [])
    {
        foreach ($data as $key => $value)
        {
            $this->{"set".$key}($value);
        }
    }

    public function getValues()
    {
        return $this->values;
    }
}

?>