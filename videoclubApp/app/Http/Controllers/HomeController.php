<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class HomeController extends Controller {

    function __construct() {
        $this->middleware('auth')->only(['index', 'verify']);
        $this->middleware('verified')->only(['edit', 'update']);
    }

    function edit(): View {
        return view('auth.edit');
    }

    function index(): View {
        return view('auth.home');
    }

    function update(Request $request): RedirectResponse {

        $user = Auth::user();
        $rules = [
            'name'              => 'required|max:255',
            'email'             => 'required|max:255|email',
            'currentpassword'   => 'nullable|current_password',
            'password'          => 'nullable|min:8|confirmed',
        ];
        $messages = [
            'name.requiered'                        =>'El campo nombre es obligatorio.', 
            'name.max'                              =>'Ha pasado el máximo posible de caracteres.', 
            'email.required'                        =>'El campo email es obligatorio', 
            'email.max'                             =>'Ha pasado el máximo posible de caracteres.', 
            'email.email'                           =>'El email tiene que ser tipo email', 
            'currentpassword.current_password'      =>'clave anterior no correcta', 
            'password.min'                          =>'La contraseña no llega al mínimo obligatorio', 
            'password.confirmed'                    =>'Las contraseñas no coinciden', 
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {

            return back()->withInput()->withErrors($validator);

        }

        $user->name = $request->name;
        if($request->email != $user->email) {
            $user->email = $request->email;
            $user->email_verified_at = null;
        }

        if($request->password != null && $request->currentpassword != null) {
            $user->password = Hash::make($request->password);
        }   

        try {
            $result = $user->save();
            $message = 'El usuario se ha modificado correctamente.';
        } catch (\Exception $e) {
            $message = "Lo sentimos, ocurrió un error y el usuario no se pudo modificar.";
            $result = false;
        }

        $messageArray = [
            'general' => $message,
        ];

        if ($result) {
            return redirect()->route('home')->with($messageArray);
        } else {
            return back()->withInput()->withErrors($messageArray);
        }
    }
}
