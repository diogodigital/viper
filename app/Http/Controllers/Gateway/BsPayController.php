<?php

namespace App\Http\Controllers\Gateway;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\Withdrawal;
use App\Traits\Affiliates\AffiliateHistoryTrait;
use App\Traits\Gateways\BsPayTrait;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;

class BsPayController extends Controller
{
    use BsPayTrait, AffiliateHistoryTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * @param Request $request
     * @return null
     */
    public function getQRCodePix(Request $request)
    {
        return self::requestQrcode($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function callbackMethod(Request $request)
    {
        ///\DB::table('debug')->insert(['text' => json_encode($request->all())]);

        if(isset($request->transactionId) && $request->transactionType == 'RECEIVEPIX') {
            $transaction = Transaction::where('payment_id', $request->transactionId)->where('status', 0)->first();
            if(!empty($transaction)) {
                $wallet = Wallet::where('user_id', $transaction->user_id)->first();
                if(!empty($wallet)) {
                    if($transaction->update(['status' => 1])) {
                        $wallet->increment('balance', $transaction->price); /// add saldo

                        self::updateAffiliate($transaction->payment_id, $transaction->user_id, $transaction->price);
                    }
                }
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function consultStatusTransactionPix(Request $request)
    {
        return self::consultStatusTransaction($request);
    }


    /**
     * Cancel Withdrawal
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancelWithdrawalFromModal($id)
    {
        $withdrawal = Withdrawal::find($id);
        if(!empty($withdrawal)) {
            $wallet = Wallet::where('user_id', $withdrawal->user_id)
                ->first();

            if(!empty($wallet)) {
                $wallet->increment('balance', $withdrawal->amount);

                $withdrawal->update(['status' => 2]);
                Notification::make()
                    ->title('Saque cancelado')
                    ->body('Saque cancelado com sucesso')
                    ->success()
                    ->send();

                return back();
            }
            return back();
        }
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function withdrawalFromModal($id)
    {
        $withdrawal = Withdrawal::find($id);
        if(!empty($withdrawal)) {
            $parm = [
                'pix_key'           => $withdrawal->chave_pix,
                'pix_type'          => $withdrawal->tipo_chave,
                'amount'            => $withdrawal->amount,
                'document'          => $withdrawal->document,
                'payment_id'        => $withdrawal->id
            ];

            $resp = self::MakePayment($parm);

            if($resp) {
                $withdrawal->update(['status' => 1]);
                Notification::make()
                    ->title('Saque solicitado')
                    ->body('Saque solicitado com sucesso')
                    ->success()
                    ->send();

                return back();
            }else{
                Notification::make()
                    ->title('Erro no saque')
                    ->body('Erro ao solicitar o saque')
                    ->danger()
                    ->send();

                return back();
            }
        }
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
