<?php

namespace App\Model;

abstract class BaseModel
{
    protected $conexion;

    public function __construct()
    {
        $this->conexion = Conexion::conectar();
    }

    public function __destruct()
    {
        $this->conexion = null;
    }
}
