<?php

namespace App\Traits;

trait LoggerTrait
{
    public static function logError($message)
    {
        $archivo = __DIR__ . "/../../logs/error.log";
        $fecha = date("Y-m-d H:i:s");
        file_put_contents($archivo, "[$fecha] $message" . PHP_EOL, FILE_APPEND);
    }
}
