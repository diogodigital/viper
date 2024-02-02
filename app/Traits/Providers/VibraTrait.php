<?php

namespace App\Traits\Providers;

use App\Models\Order;
use App\Models\VibraCasinoGame;
use App\Models\Wallet;
use Illuminate\Support\Facades\Log;

trait VibraTrait
{

    /**
     * @dev @victormsalatiel - Não comprem código roubado
     * @return string
     */
    public static function generateToken($siteId, $gameId)
    {
        return \Helper::MakeToken([
            'id' => auth()->id(),
            'provider' => 'vibra',
            'siteId' => $siteId,
            'gameId' => $gameId,
            'time' => time()
        ]);
    }

    /**
     * Generate Game Launch
     * @dev @victormsalatiel - Não comprem código roubado
     * @return string
     */
    public static function GenerateGameLaunch(VibraCasinoGame $vibra)
    {
        $siteID  = $vibra->game_id; /// SCRATCHCARDMULTINIVEL9A7
        $baseUrl = 'https://assets.mick.vsslots.com/launcher/GameManager.php';

        // Parâmetros da URL
        $params = [
            'siteId'    => '',
            'gameMode'  => 'REAL', // FUN - REAL
            'currency'  => 'USD',
            'channel'   => 'desktop',
            'locale'    => 'pt',
            'gameId'    => $siteID,
            'userId'    => auth()->id(),
            'token'     => self::GenerateToken('', $siteID),
        ];

        // Construindo a string de consulta
        $queryString = http_build_query($params);

        // Concatenando a string de consulta à URL base
        $finalUrl = $baseUrl . '?' . $queryString;

        return $finalUrl;
    }

    /**
     * @param $code
     * @param $message
     * @dev @victormsalatiel - Não comprem código roubado
     * @return \Illuminate\Http\JsonResponse
     */
    private static function SendError($code, $message)
    {
        return response()->json([
            "result" => "ERROR",
            "timestamp" => time(),
            "data" => [
                "code" => $code,
                "message" => $message
            ]
        ], $code);
    }

    /**
     * Game Launch
     * @dev @victormsalatiel - Não comprem código roubado
     * @return string
     */
    public static function GameLaunch()
    {

    }

    /**
     * @param $request
     * @dev @victormsalatiel - Não comprem código roubado
     * @return \Illuminate\Http\JsonResponse
     */
    private static function initializeGame($request)
    {
        $token      = $request->token;
        $tokenDec   = \Helper::DecToken($token);

        if($tokenDec['status']) {
            $wallet = Wallet::where('user_id', $request->userId)->first();

            if($wallet) {
                return response()->json([
                    'result' => "OK",
                    "timestamp" => time(),
                    "data" => [
                        //'stakeLevels' => [10, 25, 50, 100],
                        //'stakeDefaultLevel' => 10,
                        //'accountFreeBalance' => '',
                        'accountBalance' => $wallet->total_balance * 100,
                        'accountCurrency' => 'USD',
                        'token' => $token,
                    ]
                ]);
            }else{
                return self::SendError(501, "Invalid user identifier");
            }
        }else{
            return self::SendError(511, "Invalid token");
        }
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    private static function requestBalance($request)
    {
        $token      = $request->token;
        $tokenDec   = \Helper::DecToken($token);

        if($tokenDec['status']) {
            $wallet = Wallet::where('user_id', $request->userId)->first();

            if($wallet) {
                return response()->json([
                    'result' => "OK",
                    "timestamp" => time(),
                    "data" => [
                        //'stakeLevels' => [10, 25, 50, 100],
                        //'stakeDefaultLevel' => 10,
                        //'accountFreeBalance' => '',
                        'accountBalance' => $wallet->total_balance * 100,
                        'accountCurrency' => 'USD',
                        'token' => $token,
                    ]
                ]);
            }else{
                return self::SendError(501, "Invalid user identifier");
            }
        }else{
            return self::SendError(511, "Invalid token");
        }
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    private static function updateBalance($request)
    {
        return self::SetTransaction($request);
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    private static function updateBalanceForced($request)
    {
        return self::SetTransaction($request);
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    private static function voidTransaction($request)
    {
        $data       = $request->all();
        $tokenDec   = \Helper::DecToken($data['token']);

        if($tokenDec['status']) {
            $order = Order::where('session_id', $data['sessionId'])->where('transaction_id', $data['transactionId'])->first();
            if(!empty($order)) {
                $wallet      = Wallet::where('user_id', $data['userId'])->first();
                $amount      = $data['amount'] / 100;

                if(!empty($wallet)) {
                    /// reembolso de credit
                    if($order->type == 'bet') {
                        if($order->type_money == 'balance_bonus') {
                            $wallet->increment('balance_bonus', $amount);
                        }

                        if($order->type_money == 'balance') {
                            $wallet->increment('balance', $amount);
                        }
                    }

                    /// reembolso de debit
                    if($order->type == 'win') {
                        if($order->type_money == 'balance_bonus') {
                            $wallet->decrement('balance_bonus', $amount);
                        }

                        if($order->type_money == 'balance') {
                            $wallet->decrement('balance', $amount);
                        }
                    }

                    return response()->json([
                        'result' => "OK",
                        "timestamp" => time(),
                        "data" => [
                            "accountBalance" => $wallet->total_balance * 100,
                            "accountCurrency" => "USD",
                            "transactionId" => $data['transactionId'],
                            "token" => $data['token']
                        ]
                    ]);
                }else{
                    return self::SendError(501, "Invalid user identifier");
                }
            }else{
                return self::SendError(513, "Invalid transaction");
            }
        }else{
            return self::SendError(511, "Invalid token");
        }
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    private static function playStatus($request)
    {
        return response()->json([
            'result' => "OK",
            "timestamp" => time(),
            "data" => [
                "token" => $request->token
            ]
        ]);
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    private static function finalizeGame($request)
    {
        return response()->json([
            'result' => "OK",
            "timestamp" => time(),
            "data" => [
                "token" => $request->token
            ]
        ]);
    }

    /**
     * Webhook Data
     *
     * @param $request
     * @param $parameters
     * @return array|\Illuminate\Http\JsonResponse|void
     */
    public static function WebhookData($request, $parameters)
    {
        //\DB::table('debug')->insert(['text' => json_encode($request->all())]);

        \Log::info('PARAMETER:' . $parameters);
        \Log::info('DEBUG:' . json_encode($request->all()));

        if(!empty($parameters)) {
            switch ($parameters) {
                case 'initializeGame':
                    return self::initializeGame($request);
                case 'requestBalance':
                    return self::requestBalance($request);
                case 'updateBalance':
                    return self::updateBalance($request);
                case 'updateBalanceForced':
                    return self::updateBalanceForced($request);
                case 'voidTransaction':
                    return self::voidTransaction($request);
                case 'playStatus':
                    return self::playStatus($request);
                case 'finalizeGame':
                    return self::finalizeGame($request);

            }
        }

    }


    /**
     * Set Transactions
     *
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    private static function SetTransaction($request)
    {
        $data       = $request->all();
        $tokenDec   = \Helper::DecToken($data['token']);

        if($tokenDec['status']) {
            $wallet      = Wallet::where('user_id', $data['userId'])->first();
            $amount      = $data['amount'] / 100;
            $changeBonus = 'balance_bonus';
            $typeBet     = 'bet';

            if(!empty($wallet)) {
                Log::info('MEU SALDO: '. $wallet->total_balance);

                /// verifica se o saldo é maior ou igual ao valor apostado
                if($wallet->total_balance >= floatval($amount)) {

                    /// verifica se vai ser debitado no bonus ou na carteira
                    if($wallet->balance_bonus >= $amount) {
                        Log::info('PAGOU BONUS');

                        if($data['operation'] == 'DEBIT') {
                            $wallet->decrement('balance_bonus', $amount);
                        }

                        if($data['operation'] == 'CREDIT') {
                            $typeBet = 'win';
                            $wallet->increment('balance_bonus', $amount);
                        }

                        $changeBonus = 'balance_bonus';
                    }elseif($wallet->balance >= $amount) {
                        Log::info('PAGOU WALLET');

                        if($data['operation'] == 'DEBIT') {
                            $wallet->decrement('balance', $amount);
                        }

                        if($data['operation'] == 'CREDIT') {
                            $wallet->increment('balance', $amount);
                        }
                    }else{
                        Log::info('SEM SALDO');
                        return self::SendError(509, "Insufficient funds");
                    }

                    $orderId = self::PrepareTransactions(
                        $typeBet,
                        $changeBonus,
                        $data['userId'],
                        $data['transactionId'],
                        $data['sessionId'],
                        $data['gameId'],
                        $amount,
                        $data['amountCurrency'],
                    );

                    if($orderId) {
                        Log::info('NOVO SALDO E SUCESSO: '. $wallet->total_balance);
                        return response()->json([
                            'result' => "OK",
                            "timestamp" => time(),
                            "data" => [
                                "accountBalance" => $wallet->total_balance * 100,
                                "accountCurrency" => "USD",
                                "transactionId" => $data['transactionId'],
                                "token" => $data['token']
                            ]
                        ]);
                    }else{
                        Log::info('TRANSAÇÂO ERRO');
                        return self::SendError(513, "Invalid transaction");
                    }
                }else{
                    Log::info('SEM SALDO');
                    return self::SendError(509, "Insufficient funds");
                }
            }else{
                Log::info('USUARIO ERRADO');
                return self::SendError(501, "Invalid user identifier");
            }
        }else{
            Log::info('TOKEN ERRADO');
            return self::SendError(511, "Invalid token");
        }
    }

    /**
     * @param $type
     * @param $changeBonus
     * @param $userId
     * @param $transactionId
     * @param $sessionId
     * @param $gameId
     * @param $betAmount
     * @param $currency
     * @return false
     */
    private static function PrepareTransactions($type, $changeBonus, $userId, $transactionId, $sessionId, $gameId, $betAmount, $currency)
    {
        $order = Order::create([
            'user_id'       => $userId,
            'session_id'    => $sessionId,
            'transaction_id'=> $transactionId,
            'type'          => $type,
            'type_money'    => $changeBonus ? 'balance_bonus' : 'balance',
            'amount'        => $betAmount,
            'providers'     => 'Vibra',
            'game'          => $gameId,
            'game_uuid'     => $gameId,
            'round_id'      => 1,
        ]);

        if($order) {
            return $order->id;
        }

        return false;
    }

}
