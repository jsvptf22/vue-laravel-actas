<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SessionController extends Controller
{
    /**
     * verifica el token contra saia
     * y genera un token
     *
     * @param  [integer] key
     * @param  [string] token
     */
    public function checkSaiaToken(Request $request)
    {
        $request->validate([
            'key' => 'required|integer',
            'token' => 'required|string',
        ]);

        $key = $request->input('key');
        $token = $request->input('token');

        $Client = new \GuzzleHttp\Client();
        $clientRequest = $Client->request('POST', env('SAIA_APP_FOLDER') . 'funcionario/verificar_sesion.php', [
            'form_params' => [
                'key' => $key,
                'token' => $token,
                'externalVerification' => 1
            ]
        ]);
        $response = json_decode($clientRequest->getBody());

        if (!$response->data) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = User::find($key);
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addDay();
        $token->save();

        return response()->json([
            'apiToken' => $tokenResult->accessToken,
            'externalToken' => $response->data,
            'tokenType' => 'Bearer',
            'expiresAt' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
