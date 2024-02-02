<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->email;
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json(['message' => 'E-mail não encontrado.'], 404);
        }

        $token = Str::random(60);

        $existingToken = DB::table('password_reset_tokens')
            ->where('email', $email)
            ->first();

        if ($existingToken) {
            // Se o email existe, atualize o token
            DB::table('password_reset_tokens')
                ->where('email', $email)
                ->update(['token' => $token]);
        } else {
            // Se o email não existe, crie um novo registro
            DB::table('password_reset_tokens')->insert([
                'email' => $email,
                'token' => $token,
                'created_at' => now(), // ou a data e hora desejada
            ]);
        }

        \Mail::to($user)->send(new ResetPasswordMail($token));
        return response()->json(['message' => 'Link de redefinição de senha enviado com sucesso.']);
    }

    /**
     * @param $token
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function showResetPasswordForm($token)
    {
        $resetRecord = DB::table('password_reset_tokens')->where('token', $token)->first();
        if (!$resetRecord) {
            abort(404, 'Token inválido ou expirado.');
        }

        return view('auth.confirm-password', ['token' => $token]);
    }

    /**
     * @param Request $request
     * @param $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request, $token)
    {
        $rules = [
            'password' => 'required|confirmed|min:3',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $resetRecord = DB::table('password_reset_tokens')->where('token', $token)->first();

        if (!$resetRecord) {
            abort(404, 'Token inválido ou expirado.');
        }

        $user = User::where('email', $resetRecord->email)->first();

        if (!$user) {
            abort(404, 'Usuário não encontrado.');
        }

        $user->password = $request->password;
        $user->save();

        DB::table('password_reset_tokens')->where('token', $token)->delete();
        return response()->json(['message' => 'Senha redefinida com sucesso.']);
    }
}
