<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * realiza una busqueda sobre el modelo
     * User basado en un fragmento de nombre
     */
    public function autocomplete(Request $request)
    {
        if ($request->input('query')) {
            $query = $request->input('query');
            $data = \App\VActUser::where('nombre_completo', 'like', "%{$query}%")
                ->limit(20)
                ->get(['id', 'nombre_completo', 'externo']);
        } else {
            $data = null;
        }
        return $data;
    }

    /**
     * crea un usuario externo al sistema
     */
    public function createExternal(Request $request)
    {
        $key = $request->input('key');
        $externalToken = $request->input('externalToken');
        $name = $request->input('username');
        $email = $request->input('email');
        $identification = $request->input('identification');

        $Client = new \GuzzleHttp\Client();
        $clientRequest = $Client->request('POST', env('SAIA_APP_FOLDER') . 'tercero/guardar.php', [
            'form_params' => [
                'key' => $key,
                'token' => $externalToken,
                'nombre' => $name,
                'correo' => $email,
                'tipo' => 1, //persona natural
                'identificacion' => $identification,
                'tipo_identificacion' => 'CC',
            ]
        ]);

        return $clientRequest->getBody();
    }
}
