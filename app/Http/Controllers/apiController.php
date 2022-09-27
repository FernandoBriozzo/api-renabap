<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

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
            $filename = "../storage/app/archivos/resultado-" . date("Y-m-d-H-i-s") . ".txt";
            $fileHandler = fopen($filename, 'w') or die("can't open file");
            fwrite($fileHandler, $response);
            fclose($fileHandler);
        }
    }

    public function apiGuardar(Request $request)
    {
        if (!isset($request['api-url'])) {
            return response()->json([
                'resultado' => 'Campo api-url no definido'
            ]);
            die();
        }
        $archivoNombre = "resultado-" . date("Y-m-d-H-i-s") . ".txt";
        if (isset($request["api-url"])) {
            try{
            $url = $request["api-url"];
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            if (strlen($response) == 0) {
                throw throw new Exception('Resultado vacío.');
            }
            unset($ch);
            $filename = "../storage/app/archivos/" . $archivoNombre;
            $fileHandler = fopen($filename, 'w') or die("can't open file");
            fwrite($fileHandler, $response);
            fclose($fileHandler);
            }
            catch (Exception $e) {
                return response()->json([
                    'resultado' => 'Error: ' . $e->getMessage()
                ]);
                die();
            }
        }
        return response()->json([
            'resultado' => 'Archivo creado exitosamente con el nombre: ' . $archivoNombre
        ]);
    }

    public function webLogin(){
        return view('login');
    }

    public function webAuth(Request $request) {
        if (!Auth::attempt($request->only('name', 'password'))){
            return back()->with('error','Datos de login inválidos');
        }
        $user = User::where('name', $request['name'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;
        return "Token creado con éxito: " . $token;
    }
}
