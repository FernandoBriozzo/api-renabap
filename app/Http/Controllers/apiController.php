<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class apiController extends Controller
{
    public function register(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8'
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['name']
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer'
        ]);

    }

    public function login(Request $request) {
        if (!Auth::attempt($request->only('name', 'password'))){
            return response()->json([
                'message' => 'Datos de login inválidos.'
            ], 401);
        }
        $user = User::where('name', $request['name'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'acces_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    public function userInfo(Request $request) {
        return $request->user();
    }

    public function generos()
    {
        $generos = Genre::all('nombre');
        return $generos->toJson();
    }

    public function create()
    {
        return view('form');
    }

    public function store(Request $request)
    {
        echo "aca viene del formulario<br>";
        $postFields = [];
        /* foreach ($request["postfields"] as $myfields) {
            $postFields += array($myfields["campo"] => $myfields["valor"]);
        } */

        if (isset($request["api-url"])) {
            $url = $request["api-url"];
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            unset($ch);
            var_dump($response);
            var_dump($request->all());
            $filename = "../storage/app/archivos/resultado.txt";
            $fileHandler = fopen($filename, 'w') or die("can't open file");
            fwrite($fileHandler, $response);
            fclose($fileHandler);
        }
    }
}
