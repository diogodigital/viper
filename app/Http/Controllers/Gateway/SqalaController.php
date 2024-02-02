<?php

namespace App\Http\Controllers\Gateway;

use App\Http\Controllers\Controller;
use App\Models\SuitPayPayment;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\Withdrawal;
use App\Traits\Gateways\SqalaTrait;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;

class SqalaController extends Controller
{
    use SqalaTrait;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function callbackMethod(Request $request)
    {
        $data = $request->all();

        if(isset($data['event']) && $data['event'] == 'payment.paid') {
            if(isset($data['id']) && $data['data'] && $data['data']['status'] == 'PAID') {
                $transaction = Transaction::where('payment_id', $data['id'])->where('status', 0)->first();
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

        return response()->json([], 200);
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

}
