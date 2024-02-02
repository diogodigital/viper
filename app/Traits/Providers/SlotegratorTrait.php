<?php

namespace App\Traits\Providers;

use App\Models\Game;
use App\Models\Order;
use App\Models\Setting;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletChange;
use Illuminate\Http\Response as ResponseAlias;

trait SlotegratorTrait
{
    /**
     * @dev @victormsalatiel - Não comprem código roubado
     * @var String $merchantUrl
     * @var String $merchantId
     * @var String $merchantKey
     */
    protected string $merchantId, $merchantKey, $merchantUrl;

    /**
     * @dev @victormsalatiel - Não comprem código roubado
     * @return void
     */
    public function getCredentials(): void
    {
        $setting = \Helper::getSetting();

        $this->merchantUrl = $setting->merchant_url;
        $this->merchantId = $setting->merchant_id;
        $this->merchantKey = $setting->merchant_key;
    }

    /**
     * @dev @victormsalatiel - Não comprem código roubado
     * @param string $gameuuid
     * @return array
     * @throws \Exception
     */
    public function startGameSlotegrator(string $gameuuid): array
    {
        if(auth()->check()) {
            $this->getCredentials(); // buscando as crendenciais

            $url = $this->merchantUrl . 'games/init';
            //$url = 'https://gis.slotegrator.com/api/index.php/v1/games/init';

            $requestParams = [
                'game_uuid'         => $gameuuid,
                'player_id'         => auth()->user()->id,
                'player_name'       => auth()->user()->name,
                'email'             => auth()->user()->email,
                'return_url'        => url('/'),
                'currency'          => /*'BRL'*/'EUR',
                'session_id'        => $this->generateRandomString(),
                'language'          => 'pt',
                'lobby_data'        => $this->getLobby($gameuuid, false),
            ];

            $merchantId     = $this->merchantId;
            $merchantKey    = $this->merchantKey;
            $nonce          = md5(uniqid(mt_rand(), true));
            $time           = time();

            $headers = [
                'X-Merchant-Id' => $merchantId,
                'X-Timestamp' => $time,
                'X-Nonce' => $nonce,
            ];

            $mergedParams = array_merge($requestParams, $headers);
            ksort($mergedParams);
            $hashString = http_build_query($mergedParams);

            $XSign = hash_hmac('sha1', $hashString, $merchantKey);

            ksort($requestParams);
            $postdata = http_build_query($requestParams);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'X-Merchant-Id: '.$merchantId,
                'X-Timestamp: '.$time,
                'X-Nonce: '.$nonce,
                'X-Sign: '.$XSign,
                'Accept: application/json',
                'Enctype: application/x-www-form-urlencoded',
            ));

            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $result = json_decode(curl_exec($ch));

            if (curl_errno($ch)) {
                $error_message = curl_error($ch);
                return [
                    'status' => false,
                    'error' =>  $error_message
                ];
            }

            if(isset($result->url)) {
                $game_url = $result->url;

                return [
                    'status' => true,
                    'game_url' => $game_url
                ];
            }
            return [
                'status' => false,
                'error' =>  $result->message
            ];
        }

        return [
            'status' => false,
            'error' =>  ''
        ];
    }

    /**
     * @dev @victormsalatiel - Não comprem código roubado
     * @return \Illuminate\Http\JsonResponse
     */
    public function selfvalidation()
    {
        try{
            $this->getCredentials(); // buscando as crendenciais

            $url = $this->merchantUrl . 'self-validate';
            $merchantId = $this->merchantId;
            $merchantKey = $this->merchantKey;

            $nonce = md5(uniqid(mt_rand(), true));
            $time = time();

            $headers = [
                'X-Merchant-Id' => $merchantId,
                'X-Timestamp' => $time,
                'X-Nonce' => $nonce,
            ];

            $requestParams = [];

            $mergedParams = array_merge($requestParams, $headers);
            ksort($mergedParams);
            $hashString = http_build_query($mergedParams);

            $XSign = hash_hmac('sha1', $hashString, $merchantKey);

            ksort($requestParams);
            $postdata = http_build_query($requestParams);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'X-Merchant-Id: '.$merchantId,
                'X-Timestamp: '.$time,
                'X-Nonce: '.$nonce,
                'X-Sign: '.$XSign,
                'Accept: application/json',
                'Enctype: application/x-www-form-urlencoded',
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $curl = curl_exec($ch);
            $response = json_decode($curl);

            return response()->json([
                $response
            ], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * @dev @victormsalatiel - Não comprem código roubado
     * @param $gameuuid
     * @param bool $api
     * @return true
     */
    public function getLobby($gameuuid, bool $api = true)
    {
        $url = $this->merchantUrl . 'games/lobby?game_uuid=' . $gameuuid . '&currency=EUR&technology=HTML5';
        $merchantId     = $this->merchantId;
        $merchantKey    = $this->merchantKey;
        $nonce          = md5(uniqid(mt_rand(), true));
        $time           = time();

        $headers = [
            'X-Merchant-Id' => $merchantId,
            'X-Timestamp' => $time,
            'X-Nonce' => $nonce,
        ];

        $requestParams = [
            'game_uuid' => $gameuuid,
            'currency' => 'EUR',
            'technology' => 'HTML5',
        ];

        $mergedParams = array_merge($requestParams, $headers);
        ksort($mergedParams);
        $hashString = http_build_query($mergedParams);

        $XSign = hash_hmac('sha1', $hashString, $merchantKey);

        ksort($requestParams);
        $postdata = http_build_query($requestParams);


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'X-Merchant-Id: '.$merchantId,
            'X-Timestamp: '.$time,
            'X-Nonce: '.$nonce,
            'X-Sign: '.$XSign,
            'Accept: application/json',
            'Enctype: application/x-www-form-urlencoded',
        ));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = json_decode(curl_exec($ch));

        if (!$api && isset($result->lobby)) {
            return $result->lobby[0]->lobbyData;
        } else if (!$api) {
            return null;
        }

        return true;
    }

    /**
     * @dev @victormsalatiel - Não comprem código roubado
     * @param array $data
     * @return array
     */
    private function sortArray(array $data): array
    {
        ksort($data);
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data[$key] = $this->sortArray($value);
            }
        }
        return $data;
    }

    /**
     * @dev @victormsalatiel - Não comprem código roubado
     * @param int $length
     * @return string
     * @throws \Exception
     */
    private function generateRandomString(int $length = 10): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * @dev @victormsalatiel - Não comprem código roubado
     * @param $request
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function webhooks($request)
    {
        try {
            $this->getCredentials();

            $headers = $request->header();
//            \DB::table('debug')->insert(['text' => json_encode($request->header())]);
//            \DB::table('debug')->insert(['text' => json_encode($request->all())]);

            $merchantKey = $this->merchantKey;
            $headers = [
                'X-Merchant-Id' => $request->header('X-Merchant-Id'),
                'X-Timestamp' => $request->header('X-Timestamp'),
                'X-Nonce' => $request->header('X-Nonce'),
            ];

            $XSign = $request->header('X-Sign');
            $mergedParams = array_merge($request->toArray(), $headers);
            ksort($mergedParams);

            $hashString = http_build_query($mergedParams);
            $expectedSign = hash_hmac('sha1', $hashString, $merchantKey);
            if ($XSign !== $expectedSign) {
                return response()->json([
                    'error_code' => 'INTERNAL_ERROR',
                    'error_description' => 'Unauthorized Request'
                ], ResponseAlias::HTTP_OK);
            }

            $request->merge([
                //'amount' => floor($request->amount * 100) / 100
                'amount' => $request->amount
            ]);

            $walletUser = null;
            $user = User::find($request->player_id);

            if(!empty($user)) {
                $walletUser = Wallet::where('user_id', $user->id)->first();
            }

            if ($request->action == 'refund') {
                $checkTransaction = Order::where([
                    'transaction_id' => $request->bet_transaction_id,
                    //'round_id' => $request->round_id,
                    'refunded' => 1,
                ])->count();
            } else {
                $checkTransaction = Order::where([
                    'transaction_id' => $request->transaction_id
                ])->count();
            }

            $nameGame = '';
            if (isset($request->game_uuid)) {
                $game = Game::where('uuid', $request->game_uuid)->first();
                $nameGame = $game->name ?? '';
            }


            $action = $request->action;
            if ($checkTransaction == 0 && ($request->action == 'balance' || !empty($nameGame))) {
                if ($action == 'balance') {
                    if (!isset($user) && empty($walletUser)) {
                        return response()->json([
                            'error_code' => "INTERNAL_ERROR",
                            'error_description' => "This player doesnt exists"
                        ], ResponseAlias::HTTP_OK);
                    }

                    $wallet = $walletUser->balance + $walletUser->balance_bonus;
                    return response()->json([
                        'balance' => number_format($wallet, 4, '.', ''), //editado
                    ], ResponseAlias::HTTP_OK);

                } else if($action == 'bet') { // BET
                    $betAmount = $request->amount;
                    $changeBonus = false;
                    if ($request->amount > ($walletUser->balance + $walletUser->balance_bonus)) {
                        return response()->json([
                            'error_code' => "INSUFFICIENT_FUNDS",
                            'error_description' => "Not enough money to continue playing"
                        ], ResponseAlias::HTTP_OK);
                    }

                    // VERIFICA SE O USUARIO POSSUI WALLET E POSSUI WALLET BONUS
                    if ($request->amount > 0 && ($request->amount <= ($walletUser->balance + $walletUser->balance_bonus))) {

                        $sql = [
                            'balance' => $walletUser->balance - $betAmount,
                            'anti_bot' => $walletUser->anti_bot + $betAmount,
                            'total_bet' => $walletUser->total_bet + $betAmount,
                        ];

                        if ($walletUser->balance <= 0) {
                            $sql = [
                                'balance_bonus' => $walletUser->balance_bonus - $betAmount
                            ];
                            $changeBonus = true;
                        }

                        // AQUI, SE O USUARIO TIVER WALLET INFERIOR BETAMOUNT, POREM TEM WALLET BONUS. SISTEMA PERMITE JOGAR, ESGOTANDO WALLET E BONUS
                        if ($walletUser->balance > 0 && $walletUser->balance <= $betAmount && ($walletUser->balance_bonus - $walletUser->balance) >= $betAmount && $walletUser->balance_bonus > 0 ){
                            $sql = [
                                'balance' => 0,
                                'balance_bonus' => $walletUser->balance_bonus - $betAmount
                            ];
                            $betAmount = $walletUser->balance - $betAmount;
                            $changeBonus = true;
                        }

                        $walletUser->update($sql);

                        $this->generateHistory($request, 'bet', $nameGame, $request->game_uuid, $changeBonus);
                        $this->generateWalletChange($request, $user, $nameGame);
                    }

                    if(!empty($walletUser)) {
                        $wallet = $walletUser->balance + $walletUser->balance_bonus;
                        return response()->json([
                            'balance' => number_format($wallet, 4, '.', ''), //editado
                            'transaction_id' => $request->transaction_id
                        ], ResponseAlias::HTTP_OK);
                    }else{
                        return response()->json([
                            'error_code' => "INTERNAL_ERROR",
                            'error_description' => "This player doesnt exists"
                        ], ResponseAlias::HTTP_OK);
                    }

                } else if($action == 'win') { // WIN
                    $winAmount = $request->amount;

                    $historyBet = Order::where([
                            'user_id' => $request->player_id,
                            'session_id' => $request->session_id,
                            'game' => $nameGame,
                            'type' => 'bet'
                        ])
                        ->orderBy('created_at', 'desc')
                        ->first();

                    $condition = null;
                    if (isset($historyBet)) {
                        $condition = $historyBet->type_money == 'balance_bonus' ? ($walletUser->balance <= 0 && $walletUser->balance_bonus >= 0) : ($walletUser->balance <= 0 && $walletUser->balance_bonus > 0);

                    } else {
                        $condition = ($walletUser->balance <= 0 && $walletUser->balance_bonus >= 0);
                    }

                    // verifica se o usuario tem wallet, caso n tenha, aumenta no bonus
                    if ($condition) {
                        $sql = [
                            'balance_bonus' => $walletUser->balance_bonus + $winAmount
                        ];
                    } else {
                        $sql = [
                            'balance' => $walletUser->balance + $winAmount
                        ];
                    }

                    $walletUser->update($sql);

                    if ($historyBet) {
                        $config = Setting::first();

                        if ($request->amount <= 0 || $historyBet->amount >= $request->amount) {
                            if ($request->amount != $historyBet->amount) {

                                $last_lose = ($request->amount > 0 && $historyBet->amount >= $request->amount) ? $request->amount : $historyBet->amount;

                                // AQUI VERIFICA SE TEM AFILIADO, ATRIBUI PORCETAGEM PARA referRewards, NGR
                                if ($user->inviter) {
                                    $afiliado = User::find($user->inviter);
                                    $afiliadoWallet = Wallet::where('user_id', $user->inviter)->first();
                                    if (!empty($afiliadoWallet)) {
                                        $reward = \Helper::porcentagem_xn($afiliado->affiliate_revenue_share, $last_lose);
                                        $rewardNgr = \Helper::porcentagem_xn($config->ngr_percent, $reward);
                                        $calcReward = ($reward - $rewardNgr);
                                        $referRewards = $afiliadoWallet->refer_rewards + $calcReward;
                                        $afiliadoWallet->update([
                                            'refer_rewards' => $referRewards
                                        ]);
                                    }
                                }

                                $walletUser->update([
                                    'total_lose' => $walletUser->total_lose + $last_lose,
                                    'last_lose' => $last_lose,
                                    'last_won' => 0,
                                ]);

                            }
                        } else {
//                            $last_won = (\Helper::amountPrepare($request->amount) - \Helper::amountPrepare($historyBet->amount));
//
//                            // AQUI VERIFICA SE TEM AFILIADO, ATRIBUI PORCETAGEM PARA referRewards, NGR
//                            if ($user->inviter) {
//                                $afiliadoWallet = Wallet::where('user_id', $user->inviter)->first();
//                                if (!empty($afiliadoWallet)) {
//                                    $reward = (\Helper::amountPrepare($config->ngr_percent) / 100) * $last_won;
//
//                                    \Log::info('Last Won:' . $last_won);
//                                    $afiliadoWallet->update([
//                                        'refer_rewards' => $afiliadoWallet->refer_rewards - \Helper::amountPrepare(floor($reward * 100) / 100)
//                                    ]);
//                                }
//                            }
//
//                            $walletUser->update([
//                                'total_won' => $walletUser->total_won + $last_won,
//                                'last_won' => $last_won,
//                                'last_lose' => 0,
//                            ]);
                        }
                    }

                    $this->generateHistory($request, 'win', $nameGame, $request->game_uuid);
                    $this->generateWalletChange($request, $user, $nameGame, $historyBet);

                    if(!empty($walletUser)) {
                        $wallet = $walletUser->balance + $walletUser->balance_bonus;
                        return response()->json([
                            'balance' => number_format($wallet, 4, '.', ''),//editado
                            'transaction_id' => $request->transaction_id
                        ], ResponseAlias::HTTP_OK);
                    }else{
                        return response()->json([
                            'error_code' => "INTERNAL_ERROR",
                            'error_description' => "This player doesnt exists"
                        ], ResponseAlias::HTTP_OK);
                    }


                } else if($action == 'refund') { // REFUND
                    $walletbonus = false;

                    // verifica se o usuario tem wallet, caso n tenha, aumenta no bonus
                    if (!empty($walletUser) && $walletUser->balance <= 0 && $walletUser->balance_bonus > 0 ) {
                        $walletbonus = true;
                    }

                    // verifica se o usuario tem wallet, caso n tenha, aumenta no bonus
                    $checkTransactionBet = Order::where([
                        'transaction_id' => $request->bet_transaction_id,
                        //'round_id' => $request->round_id
                    ])->first();

//                    \Log::info('Transaction: ' .  $checkTransactionBet);
//                    \Log::info('Transaction Request amount: ' .  $request->amount);

                    if ($checkTransactionBet) {
                        if ($checkTransactionBet->type == 'win') {
                            $wallet = $walletbonus ? $walletUser->balance_bonus : $walletUser->balance;
//                            if ($checkTransactionBet->round_id == $request->round_id) {
//                                if ($walletbonus) {
//                                    $wallet = $walletUser->balance_bonus - $request->amount;
//                                } else {
//                                    $wallet = $walletUser->balance - $request->amount;
//                                }
//                            }
                        } else {
                            if ($walletbonus) {
                                $wallet = $walletUser->balance_bonus + $request->amount;
                            } else {
                                $wallet = $walletUser->balance + $request->amount;
                            }
                        }
                        //                        \Log::info('Transaction Balance: ' .  $wallet);

                        if ($walletbonus) {
                            $walletUser->update([
                                'balance_bonus' => $wallet
                            ]);
                        } else {
                            $walletUser->update([
                                'balance' => $wallet
                            ]);
                        }

                        $this->generateHistory($request, 'refund', $nameGame, $request->game_uuid);
                    }

                    if ($checkTransactionBet != null) {
                        $checkTransactionBet->update([
                            'refunded' => 1
                        ]);
                    }

                    if(!empty($walletUser)) {
                        $wallet = ($walletUser->balance + $walletUser->balance_bonus);
                        return response()->json([
                            'balance' => number_format($wallet, 4, '.', ''), //editado
                            'transaction_id' => $request->transaction_id
                        ], ResponseAlias::HTTP_OK);
                    }else{
                        return response()->json([
                            'error_code' => "INTERNAL_ERROR",
                            'error_description' => "This player doesnt exists"
                        ], ResponseAlias::HTTP_OK);
                    }
                } else if($action == 'rollback') { // ROLLBACK
                    $walletbonus = false;

                    // verifica se o usuario tem wallet, caso n tenha, aumenta no bonus
                    if ($walletUser->balance <= 0 && $walletUser->balance_bonus > 0 ) {
                        $walletbonus = true;
                    }

                    //\Log::info('rollback_transactions:' . json_encode($request->rollback_transactions));

                    foreach($request->rollback_transactions as $rollback) {
                        if ($rollback['action'] == 'win') {
                            if ($walletbonus) {
                                $walletUser->update([
                                    'balance_bonus' => $walletUser->balance_bonus - $rollback['amount'],
                                ]);
                            } else {
                                $walletUser->update([
                                    'balance' => $walletUser->balance - $rollback['amount'],
                                ]);
                            }
                        } elseif ($rollback['action'] == 'bet') {
                            if ($walletbonus) {
                                $walletUser->update([
                                    'balance_bonus' => $walletUser->balance_bonus + $rollback['amount'],
                                ]);
                            } else {
                                $walletUser->update([
                                    'balance' => $walletUser->balance + $rollback['amount'],
                                ]);
                            }
                        }
                    }

                    $this->generateHistory($request, 'rollback', $nameGame, $request->game_uuid);

                    if(!empty($walletUser)) {
                        $wallet = $walletUser->balance + $walletUser->balance_bonus;
                        return response()->json([
                            'balance' => number_format($wallet, 4, '.', ''), //editado
                            'transaction_id' => $request->transaction_id,
                            'rollback_transactions' => collect($request->rollback_transactions)->pluck('transaction_id')->toArray()
                        ], ResponseAlias::HTTP_OK);
                    }else{
                        return response()->json([
                            'error_code' => "INTERNAL_ERROR",
                            'error_description' => "This player doesnt exists"
                        ], ResponseAlias::HTTP_OK);
                    }
                }
            } else {
                if ($action == 'rollback') {
                    return response()->json([
                        'balance' => number_format($walletUser->balance +$walletUser->balance_bonus, 4, '.', ''), //editado
                        'transaction_id' => $request->transaction_id,
                        'rollback_transactions' => collect($request->rollback_transactions)->pluck('transaction_id')->toArray()
                    ], ResponseAlias::HTTP_OK);
                } else {
                    if(!empty($walletUser)) {
                        return response()->json([
                            'balance' => number_format($walletUser->balance + $walletUser->balance_bonus, 4, '.', ''), //editado
                            'transaction_id' => $request->transaction_id,
                        ], ResponseAlias::HTTP_OK);
                    }

                    return response()->json([
                        'error_code' => "INTERNAL_ERROR",
                        'error_description' => "This player doesnt exists"
                    ], ResponseAlias::HTTP_OK);
                }
            }

        } catch (\Exception $e) {
            \Log::info('Message error:' .  $e->getMessage());
            \Log::info('Line error:' .  $e->getLine());
            return response()->json(['error' => $e->getMessage(), 'line' => $e->getLine()], 400);
        }
    }

    /**
     * @dev @victormsalatiel - Não comprem código roubado
     * @param $request
     * @param $type
     * @param $nameGame
     * @param $gameId
     * @param bool $changeBonus
     * @return void
     */
    private function generateHistory($request, $type, $nameGame, $gameId, bool $changeBonus = false): void
    {
        Order::create([
            'user_id' => $request->player_id,
            'session_id' => $request->session_id,
            'transaction_id' => $request->transaction_id,
            'type' => $type,
            'type_money' => $changeBonus ? 'balance_bonus' : 'balance',
            'amount' => $request->amount ?? 0,
            'providers' => 'SloteGrator',
            'game' => $nameGame,
            'game_uuid' => $gameId,
            'round_id' => $request->round_id,
        ]);
    }

    /**
     * @dev @victormsalatiel - Não comprem código roubado
     * @param $request
     * @param $user
     * @param $nameGame
     * @param $historyBet
     * @return void
     */
    private function generateWalletChange($request, $user, $nameGame, $historyBet = null): void
    {
        $title = $request->action == 'bet' ? $nameGame . ' play' : $nameGame . ' win';

        $hisBet = 0;
        if ($historyBet != null) {
            $hisBet = $historyBet->amount;
        }

        WalletChange::create([
            'reason' => $title,
            'change' => $request->action == 'bet' ? -number_format($request->amount, 2, '.', '') : number_format($request->amount, 2, '.', ''),
            'value_bonus' => 0,
            'value_total' => $request->amount,
            'value_roi' => $request->action == 'bet' ? 0 : $request->amount - $hisBet,
            'value_entry' => $request->action == 'bet' ? $request->amount : $hisBet,
            'game' => $nameGame,
            'user' => $user->email
        ]);
    }

    /**
     * @dev @victormsalatiel - Não comprem código roubado
     * @return \Illuminate\Http\JsonResponse
     */
    public function limits()
    {
        try{
            $this->getCredentials(); // buscando as crendenciais

            $url            = $this->merchantUrl . 'limits';
            $merchantId     = $this->merchantId;
            $merchantKey    = $this->merchantKey;
            $nonce          = md5(uniqid(mt_rand(), true));
            $time           = time();

            $headers = [
                'X-Merchant-Id' => $merchantId,
                'X-Timestamp' => $time,
                'X-Nonce' => $nonce,
            ];

            $requestParams = [];

            $mergedParams = array_merge($requestParams, $headers);
            ksort($mergedParams);
            $hashString = http_build_query($mergedParams);

            $XSign = hash_hmac('sha1', $hashString, $merchantKey);

            ksort($requestParams);
            $postdata = http_build_query($requestParams);


            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_POST, 0);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'X-Merchant-Id: '.$merchantId,
                'X-Timestamp: '.$time,
                'X-Nonce: '.$nonce,
                'X-Sign: '.$XSign,
                'Accept: application/json',
                'Enctype: application/x-www-form-urlencoded',
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $result = json_decode(curl_exec($ch));

            return response()->json([
                'data' => $result
            ], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
