<?php

namespace App\Model;

use PDO;
use PDOException;
use App\Traits\LoggerTrait;

class Conexion
{
    use LoggerTrait;


    public static function conectar()
    {
        try {
            $link = new PDO("mysql:host=localhost;dbname=menus", "root", "root");
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $link->exec("set names utf8");
            return $link;
        } catch (PDOException $e) {
            self::logError($e->getMessage());
            throw new \Exception("Error de conexión: " . $e->getMessage());
        }
    }
}
