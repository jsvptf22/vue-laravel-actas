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
            $model = $request->input('external') ?
                'App\AllUser' : 'App\User';
            $query = $request->input('query');
            $data = $model::where('name', 'like', "%{$query}%")
                ->limit(20)
                ->get();
        } else {
            $data = null;
        }

        return $data;
    }
}
