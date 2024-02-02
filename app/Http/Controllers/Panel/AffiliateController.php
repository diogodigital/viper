<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Mail\ResetPasswordMail;
use App\Models\AffiliateHistory;
use App\Models\User;
use Illuminate\Http\Request;

class AffiliateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $token = \Helper::MakeToken([
            'email' => auth()->user()->email,
            'id' => auth()->id(),
            'time' => time()
        ]);

        $indications = User::where('inviter', auth()->id())->paginate();
        $histories = AffiliateHistory::where('inviter', auth()->id())->paginate();
        $histories->setPageName('affiliate_history');

        return view('panel.affiliates.index', compact('token', 'indications', 'histories'));
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
    public function getWithdrawal(Request $request)
    {
        $comission = auth()->user()->wallet->refer_rewards;
        auth()->user()->wallet->increment('balance', $comission);
        auth()->user()->wallet->update(['refer_rewards' => 0]);


        return response()->json(['status' => true], 200);
    }

    /**
     * Display the specified resource.
     */
    public function joinAffiliate(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);

        \Mail::send('emails.join-affiliate', ['email' => $request->get('email')], function ($message) use($request) {
            $message->from(env('MAIL_FROM_ADDRESS'));
            $message->to(env('MAIL_FROM_ADDRESS'), 'PEDIDO DE AFILIADO')
                    ->subject(env('APP_NAME'));
        });

        return back()->with('success', 'Seu e-mail foi enviado com sucesso. Aguarde o contato!');
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
