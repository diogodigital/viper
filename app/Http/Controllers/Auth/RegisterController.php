<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wallet;
use App\Traits\Affiliates\AffiliateHistoryTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use AffiliateHistoryTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function register(Request $request)
    {
        $rules = [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $params = $request->only(['name', 'email', 'password', 'phone']);

        if(isset($request->affiliate_token) && !empty($request->affiliate_token)) {
            $token = \Helper::DecToken($request->affiliate_token);
            $params['inviter'] = $token['id'];
        }

        if($user = User::create($params)) {
            Wallet::create([
                'user_id' => $user->id,
                'balance' => 0,
                'balance_bonus' => 0
            ]);

            if(!empty($user->inviter)) {
                self::saveAffiliateHistory($user);
            }

            Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ], true);
            return response()->json(['status' => true, 'message' => 'Usuário criado com sucesso']);
        }

        return response()->json(['status' => false, 'error' => 'Erro ao criar conta']);
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
