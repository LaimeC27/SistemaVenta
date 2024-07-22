<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetUserTimezone
{
    public function handle($request, Closure $next)
    {
        // Detectar la ubicación del usuario y obtener la zona horaria correspondiente
        $userTimezone = $this->getUserTimezone($request);

        // Establecer la zona horaria en la aplicación
        date_default_timezone_set($userTimezone);

        // Continuar con la solicitud
        return $next($request);
    }

    protected function getUserTimezone($request)
    {
        // Aquí puedes implementar la lógica para detectar la ubicación del usuario
        // y devolver la zona horaria correspondiente.

        // Por ejemplo, podrías usar un servicio de geolocalización basado en IP
        // para determinar la ubicación del usuario y luego mapear esa ubicación
        // a una zona horaria.

        // En este ejemplo simplificado, simplemente devolvemos una zona horaria predeterminada.
        return 'America/Bogota'; // Zona horaria predeterminada
    }
}

