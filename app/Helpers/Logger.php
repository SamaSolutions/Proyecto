<?php
namespace App\Helpers;

class Logger {
    /**
     * Escribe un mensaje en el log de sesiones.
     * Incluye manejo de errores si la escritura falla (típicamente por permisos).
     *
     * @param string $mensaje El mensaje a registrar.
     */
    public static function log($mensaje) {
        // Ruta del archivo de log
        $ruta = '/var/www/Proyecto/storage/sesiones.log';
        $fecha = date('Y-m-d H:i:s');
        
        // Obtener la IP del cliente para logs de sesión
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN_IP'; 
        
        // Formato de la línea de log: [Fecha] [IP] Mensaje
        $linea = "[$fecha] [$ip] $mensaje" . PHP_EOL;
        
        // Intentar escribir el archivo usando @ para suprimir errores si los permisos fallan
        // Luego verificamos el resultado.
        $resultado = @file_put_contents($ruta, $linea, FILE_APPEND | LOCK_EX);

        // Si file_put_contents devuelve false, significa que falló.
        if ($resultado === false) {
            // Registra el fallo en el log de errores principal de PHP (ej: /var/log/php_errors.log)
            error_log("FALLO CRÍTICO AL ESCRIBIR LOG DE SESIONES: No se pudo escribir en el archivo '$ruta'. Revise los permisos del sistema operativo. USUARIO WEB NO PUEDE ESCRIBIR.");
        }
    }
}
