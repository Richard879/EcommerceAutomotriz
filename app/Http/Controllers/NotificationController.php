<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Auth;

class NotificationController extends Controller
{
    public function get()
    {
        // Obtiene las notificaciones
        // return Notification::all();

        // Obtener las notificaciones del usuario autenticado
        return Auth::user()->notifications;
    }
}
