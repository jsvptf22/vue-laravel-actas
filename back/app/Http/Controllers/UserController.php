<?php

namespace App\Http\Controllers;

use App\User;
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
            $data = User::where('name', 'like', "%{$query}%")
                ->limit(20)
                ->get(['id', 'name', 'email']);
        } else {
            $data = null;
        }

        return $data;
    }
}
