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
            $data = \App\VActUser::where('complete_name', 'like', "%{$query}%")
                ->limit(20)
                ->get(['id', 'complete_name']);
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
        $ActExternalUser = new \App\ActExternalUser();
        $ActExternalUser->firstname = $request->input('username');
        $ActExternalUser->firstlastname = '';
        $ActExternalUser->email = $request->input('email') ?? '';

        return [
            'success' => $ActExternalUser->save(),
            'id' => $ActExternalUser->idact_external_user
        ];
    }
}
