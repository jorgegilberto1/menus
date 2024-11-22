<?php
date_default_timezone_set('America/Mexico_City');

class Conexion {
    static public function conectar() {
        try {
            $link = new PDO("mysql:host=localhost;dbname=menus", "root", "root");
            $link->exec("set names utf8");
            return $link;
        } catch (PDOException $e) {
            self::logError($e->getMessage());
            die("Error de conexión: " . $e->getMessage());
        }
    }

    static private function logError($mensaje) {
        $archivo = __DIR__ . "/../logs/error.log";
        $fecha = date("Y-m-d H:i:s");
        file_put_contents($archivo, "[$fecha] $mensaje" . PHP_EOL, FILE_APPEND);
    }
}
?>