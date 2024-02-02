<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Core as Helper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
        |--------------------------------------------------------------------------
        | Login Controller
        |--------------------------------------------------------------------------
        |
        | This controller handles authenticating users for the application and
        | redirecting them to your home screen. The controller uses a trait
        | to conveniently provide its functionality to your applications.
        |
        */

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Signin
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function login(Request $request)
    {
        $rules = [
            'password' => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $checkExistEmail = User::where('email', $request->email)->first();
        if(empty($checkExistEmail)) {
            return response()->json(['status' => false, 'error' => 'E-mail não existe em nossa base de dados']);
        }

        $params = array(
            'password' => $request->get('password'),
            'email' => $request->get('email')
        );

        if ($user = Auth::attempt($params, true)) {
            return response()->json([
                'status' => true,
                'message' => 'Logado com sucesso',
                'user' => $user,
            ], 200);
        }

        return response()->json(['status' => false, 'error' => 'Erro ao autenticar']);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
