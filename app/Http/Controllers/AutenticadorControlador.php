<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Events\EventNovoRegistro;
use Illuminate\Support\Str;

class AutenticadorControlador extends Controller
{
    public function registro(Request $request){
        
        //Valida os dados que serão recebidos: nome, email e senha
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|string|confirmed'
        ]);

        //Se ele passar pela validação, cria o usuário:
        $user =  new User([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> bcrypt($request->password),
            'token' => Str::random(40)
        ]); 
        
        $user->save();

        event(new EventNovoRegistro($user));

        return response()->json([
            'res'=>'Usuário criado com sucesso!'
        ], 201); // Código de Status de objeto criado

    }

    public function login(Request $request){
        
        //Valida os dados que serão recebidos: email e senha
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        $credenciais = [
            'email' => $request->email, 
            'password' => $request->password,
            'active' => 1
        ];

        //retorna true ou false
        //Auth::attempt($credenciais);

        //Se não conseguir autenticar:
        if (!Auth::attempt($credenciais)) {
            return reponse()->json([
                'res' => 'Acesso negado!'
            ], 401);
        } 

        //Se autenticar, cria-se um Token:
        
        //Acessa o usuário logado
        $user = $request->user();
        //armazena o token na variável
        $token = $user->createToken('Token de acesso')->accessToken;
        //Retorna o token como response
        return response()->json([
            'token' => $token
        ], 200);


    }

    public function logout(Request $request){
        //Acessa o usuário logado e revoga o token
        $request->user()->token()->revoke();
        return response()->json([
            'res' => 'Deslogado com sucesso!'
        ]);
    }


    public function ativarRegistro($id, $token){
        $user = User::find($id);
        if ($user) {
            if ($user->token == $token) {
                $user->active = true;
                $user->token = '';
                $user->save();

                return view('resgistroAtivo');
            }
        }
        return view('resgistroErro');
    }


}
