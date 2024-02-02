<?php

namespace App\Traits\Providers;

use App\Models\GamesKey;
use App\Models\Order;
use App\Models\User;
use App\Models\Wallet;

trait SalsaGamesTrait
{
    protected static $baseUrl;
	private static $pn;
    protected static $key;
    private static $token       = '';
    protected static $data      = [];
    protected static $hash      = [];

    /**
     * Construct
     * @dev @victormsalatiel - Não comprem código roubado
     */
    public function __construct()
    {
        self::getCredentials();
    }


    /**
     * @dev @victormsalatiel - Não comprem código roubado
     * @return void
     */
    public static function getCredentials(): bool
    {
        $setting = GamesKey::first();

        self::$baseUrl  = $setting->getAttributes()['salsa_base_uri'];
        self::$pn       = $setting->getAttributes()['salsa_pn'];
        self::$key      = $setting->getAttributes()['salsa_key'];

        return true;
    }

    /**
     * @dev @victormsalatiel - Não comprem código roubado
     * @param $error
     * @return string
     */
    private static function ShowError($method, $error, $errorCode)
    {
        $response = "
            <PKT>
                <Result Name='$method' Success='0'>
                    <Returnset>
                        <Error Type='string' Value='$error' />
                        <ErrorCode Type='string' Value='$errorCode' />
                    </Returnset>
                </Result>
            </PKT>
          ";

        return $response;
    }

    /**
     * @dev @victormsalatiel - Não comprem código roubado
     * @return string
     */
    public static function generateToken($game, $pn)
    {
        return \Helper::MakeToken([
            'id' => auth('api')->id(),
            'provider' => 'salsa',
            'game' => $game,
            'pn' => $pn,
            'time' => time()
        ]);

        //return Uuid::uuid4()->toString();
    }


    /**
     * @dev @victormsalatiel - Não comprem código roubado
     * @param $pn
     * @param $type
     * @param $currency
     * @param $lang
     * @param $game
     * @return string
     */
    public static function playGameSalsa($pn, $type, $currency, $lang, $game)
    {
        if(self::getCredentials()) {
            return self::$baseUrl .
                '?token=' . self::generateToken($game, $pn) .
                '&pn=' . $pn .
                '&type=' . $type .
                '&currency=' . $currency .
                '&lang=' . $lang .
                '&game=' . $game
                ;
        }
    }

    /**
     * @dev @victormsalatiel - Não comprem código roubado
     * @param $request
     * @return string|null
     */
    public static function webhookSalsa($request)
    {
        try {
            if(self::getCredentials()) {
                $xmlstring = $request->getContent();
                //\DB::table('debug')->insert(['text' => json_encode($xmlstring)]);

                $xml    = simplexml_load_string($xmlstring, "SimpleXMLElement", LIBXML_NOCDATA);
                $json   = json_encode($xml);
                $array  = json_decode($json, true);

                $method = $array['Method']['@attributes']['Name'];
                $params = $array['Method']['Params'];

                self::$token = $params['Token']['@attributes']['Value'];
                self::$data = json_decode(base64_decode(self::$token), true);

                switch ($method):
                    case 'GetAccountDetails':
                        return self::GetAccountDetails($params);
                    case 'GetBalance':
                        return self::GetBalance($params);
                    case 'PlaceBet':
                        return self::PlaceBet($params);
                    case 'AwardWinnings':
                        return self::AwardWinnings($params);
                    case 'RefundBet':
                        return self::RefundBet($params);
                    case 'ChangeGameToken':
                        return self::ChangeGameToken($params);
                    default:
                        return 'nada encontrado.';
                endswitch;
            }
        } catch (\Exception $e) {
            //\DB::table('debug')->insert(['text' => json_encode($e->getMessage())]);
        }
    }

    /**
     * @dev @victormsalatiel - Não comprem código roubado
     * Validate Hash
     * @return bool
     */
    public static function ValidateHash($params, $token)
    {
        $hash = $params['Hash']['@attributes']['Value'];
        if($hash == ':hash') {
            return false;
        }

        $generateHash = self::GenerateHash($token, self::$key);
        if($hash == $generateHash) {
            return true;
        }

        return false;
    }

    /**
     * @dev @victormsalatiel - Não comprem código roubado
     * Metodo responsavel por gerar o hash
     * @param $paramsValue
     * @param $key
     * @return string
     */
    public static function GenerateHash($paramsValue, $key) {
        return hash('sha256', $paramsValue . $key);
    }

    /**
     * @dev @victormsalatiel - Não comprem código roubado
     * @param $params
     * @return string
     */
    public static function GetAccountDetails($params)
    {
        $token = self::$token;
        if(self::ValidateHash($params, $token)) {
            $tokenDec   = \Helper::DecToken($token);

            if($tokenDec['status']) {
                $user       = User::find($tokenDec['id']);
                $wallet     = Wallet::where('user_id', $tokenDec['id'])->first();
                $currency   = $wallet->currency;
                $country    = $currency == 'BRL' ? 'BR' : 'USA';

                $response = "
                <PKT>
                    <Result Name='GetAccountDetails' Success='1'>
                        <Returnset>
                            <Token Type='string' Value='$token' />
                            <LoginName Type='string' Value='$user->email' />
                            <Currency Type='string' Value='$currency' />
                            <Country Type='string' Value='$country' />
                            <Birthdate Type='date' Value='1988-08-02' />
                            <Registration Type='date' Value='$user->created_at' />
                            <Gender Type='string' Value='m' />
                        </Returnset>
                    </Result>
                </PKT>
            ";

                //\DB::table('debug')->insert(['text' => json_encode($response)]);
                return $response;
            }else{
                return self::ShowError('GetAccountDetails', 'Error retrieving Token', '1');
            }
        }else{
            return self::ShowError('GetAccountDetails', 'Invalid Hash.', '7000');
        }
    }

    /**
     * Get Account Details
     *
     * @dev @victormsalatiel - Não comprem código roubado
     * @param $params
     * @return string
     */
    public static function GetBalance($params)
    {
        $token = self::$token;
        if(self::ValidateHash($params, $token)) {
            $tokenDec   = \Helper::DecToken($token);
            if($tokenDec['status']) {
                $wallet     = Wallet::where('user_id', $tokenDec['id'])->first();
                $balance    = $wallet->total_balance * 100;
                $response   = "
                    <PKT>
                        <Result Name='GetBalance' Success='1'>
                            <Returnset>
                                <Token Type='string' Value='$token' />
                                <Balance Type='int' Value='$balance' />
                                <Currency Type='string' Value='$wallet->currency' />
                            </Returnset>
                        </Result>
                    </PKT>
                ";

                //\DB::table('debug')->insert(['text' => json_encode($response)]);
                return $response;
            }else{
                return self::ShowError('GetAccountDetails', 'Error retrieving Token', '1');
            }
        }else{
            return self::ShowError('GetBalance', 'Invalid Hash.', '7000');
        }
    }

    /**
     * Place Bet
     *
     * @dev @victormsalatiel - Não comprem código roubado
     * @param $params
     * @return string
     */
    public static function PlaceBet($params)
    {
        $token              = self::$token;
        $transactionID      = $params['TransactionID']['@attributes']['Value'];
        $betReferenceNum    = $params['BetReferenceNum']['@attributes']['Value'];
        $preparedToken      = $transactionID . $betReferenceNum . $token;

        if(self::ValidateHash($params, $preparedToken)) {
            $tokenDec   = \Helper::DecToken($token);
            if($tokenDec['status']) {

                $wallet = Wallet::where('user_id', $tokenDec['id'])->first();

                if(!empty($wallet)) {

                    $checkTransaction = Order::where('type', 'bet')->where('transaction_id', $transactionID)->first();
                    if(!empty($checkTransaction)) {
                        $balanceTotalData = $wallet->total_balance * 100;

                        return "
                            <PKT>
                                <Result Name='PlaceBet' Success='1'>
                                    <Returnset>
                                        <Token Type='string' Value='$token'/>
                                        <Currency Type='string' Value='$wallet->currency'/>
                                        <Balance Type='int' Value='$balanceTotalData'/>
                                        <ExtTransactionID Type='long' Value='$checkTransaction->id'/>
                                        <AlreadyProcessed Type='bool' Value='true'/>
                                    </Returnset>
                                </Result>
                             </PKT>
                            ";
                    }

                    $betAmount          = $params['BetAmount']['@attributes']['Value'];
                    $bet                = floatval($betAmount / 100);
                    $changeBonus        = 'balance';

                    // reduz o saldo da carteira
                    if($wallet->balance_bonus >= $bet) {
                        $wallet->decrement('balance_bonus', floatval($betAmount / 100));
                        $changeBonus = 'balance_bonus';
                    }elseif($wallet->balance >= $bet) {
                        $wallet->decrement('balance', floatval($betAmount / 100));
                    }else{
                        return self::ShowError('PlaceBet', 'Insufficient funds', '6');
                    }

                    $getWalletBalance = Wallet::where('user_id', $tokenDec['id'])->first();
                    $balanceTotal = $getWalletBalance->total_balance * 100;

                    /// cria uma transação
                    $transactionId = self::CreateTransactions($tokenDec['id'], $betReferenceNum, $transactionID, 'bet', $changeBonus, $bet, $tokenDec['game'], $tokenDec['pn']);
                    if($transactionId) {
                        $response = "
                            <PKT>
                                <Result Name='PlaceBet' Success='1'>
                                    <Returnset>
                                        <Token Value='$token' />
                                        <Balance Type='int' Value='$balanceTotal' />
                                        <Currency Type='string' Value='$wallet->currency' />
                                        <ExtTransactionID Type='long' Value='$transactionId' />
                                        <AlreadyProcessed Type='bool' Value='false' />
                                    </Returnset>
                                </Result>
                            </PKT>
                        ";

                        //\DB::table('debug')->insert(['text' => json_encode($response)]);
                        return $response;
                    }else{
                        return self::ShowError('PlaceBet', 'Transaction not found', '7');
                    }
                }else{
                    return self::ShowError('PlaceBet', 'Wrong data type', '5');
                }
            }else{
                return self::ShowError('PlaceBet', 'Error retrieving Token', '1');
            }
        }else{
            return self::ShowError('PlaceBet', 'Invalid Hash.', '7000');
        }
    }

    /**
     * Create Transactions
     * Metodo para criar uma transação
     *
     * @dev @victormsalatiel - Não comprem código roubado
     * @return false
     */
    private static function CreateTransactions($playerId, $betReferenceNum, $transactionID, $type, $changeBonus, $amount, $game, $pn)
    {
        $order = Order::create([
            'user_id'       => $playerId,
            'session_id'    => $betReferenceNum,
            'transaction_id'=> $transactionID,
            'type'          => $type,
            'type_money'    => $changeBonus ? 'balance_bonus' : 'balance',
            'amount'        => $amount,
            'providers'     => 'Salsa',
            'game'          => $game,
            'game_uuid'     => $pn,
            'round_id'      => 1,
        ]);

        if($order) {
            return $order->id;
        }

        return false;
    }

    /**
     * Award Winnings
     *
     * @dev @victormsalatiel - Não comprem código roubado
     * @param $params
     * @return string
     */
    public static function AwardWinnings($params)
    {
        $token              = self::$token;
        $transactionID      = $params['TransactionID']['@attributes']['Value'];
        $winReferenceNum    = $params['WinReferenceNum']['@attributes']['Value'];
        $preparedToken      = $transactionID . $winReferenceNum . $token;

        if(self::ValidateHash($params, $preparedToken)) {
            $tokenDec   = \Helper::DecToken($token);
            if($tokenDec['status']) {
                $wallet         = Wallet::where('user_id', $tokenDec['id'])->first();
                $WinAmount      = $params['WinAmount']['@attributes']['Value'] / 100;
                $transaction    = Order::where('transaction_id', $transactionID)->where('type', 'bet')->first();

                if(!empty($transaction)) {
                    $changeBonus = 'balance';

                    /// verificar se é bonus ou balance
                    if($transaction->type == 'balance_bonus') {
                        $changeBonus = $transaction->type; // define se é bonus

                        /// verificar a quantidade de rollover
                        if($wallet->balance_bonus_rollover == 0 || empty($wallet->balance_bonus_rollover)) {
                            $wallet->increment('balance_bonus', $WinAmount);
                        }else{
                            /// verifica se o valor do rollover é maior que o ganho, se sim, decrementa o valor
                            if($wallet->balance_bonus_rollover >= $WinAmount) {
                                $wallet->decrement('balance_bonus_rollover', $WinAmount);
                            }else{
                                /// caso contrario define como zero.
                                $wallet->update(['balance_bonus_rollover' => 0]);
                            }

                            $wallet->increment('balance_bonus', $WinAmount);
                        }
                    }else{
                        /// pagando o ganhos
                        $wallet->increment('balance', $WinAmount);
                    }

                    /// criando uma nova transação de ganho "Win"
                    self::CreateTransactions($tokenDec['id'], $transaction->session_id, $transactionID, 'win', $changeBonus, $WinAmount, $tokenDec['game'], $tokenDec['pn']);
                    $getWalletBalance = Wallet::where('user_id', $tokenDec['id'])->first();
                    $balanceTotal = $getWalletBalance->total_balance * 100;

                    $response = "
                        <PKT>
                            <Result Name='AwardWinnings' Success='1'>
                                <Returnset>
                                    <Token Type='string' Value='$token' />
                                    <Balance Type='int' Value='$balanceTotal' />
                                    <Currency Type='string' Value='$wallet->currency' />
                                    <ExtTransactionID Type='long' Value='$transaction->id' />
                                    <AlreadyProcessed Type='bool' Value='false' />
                                </Returnset>
                            </Result>
                        </PKT>
                    ";

                    return $response;
                }else{
                    return self::ShowError('AwardWinnings', 'Transaction not found', '7');
                }
            }else{
                return self::ShowError('AwardWinnings', 'Error retrieving Token', '1');
            }
        }else{
            return self::ShowError('AwardWinnings', 'Invalid Hash.', '7000');
        }
    }

    /**
     * Refund Bet
     *
     * @dev @victormsalatiel - Não comprem código roubado
     * @param $params
     * @return string
     */
    public static function RefundBet($params)
    {
        $token              = self::$token;
        $transactionID      = $params['TransactionID']['@attributes']['Value'];
        $betReferenceNum    = $params['BetReferenceNum']['@attributes']['Value'];
        $preparedToken      = $transactionID . $betReferenceNum . $token;

        if(self::ValidateHash($params, $preparedToken)) {
            $tokenDec   = \Helper::DecToken($token);
            if($tokenDec['status']) {
                $transaction = Order::where('transaction_id', $transactionID)->where('type', 'bet')->where('refunded', 0)->first();
                if(!empty($transaction)) {
                    $refundAmount = $params['RefundAmount']['@attributes']['Value'] / 100;
                    $wallet = Wallet::where('user_id', $tokenDec['id'])->first();

                    /// verificar se é bonus ou balance
                    if($transaction->type == 'balance_bonus') {
                        $wallet->increment('balance_bonus', $refundAmount); /// retorna o valor
                    }else{
                        $wallet->increment('balance', $refundAmount); /// retorna o valor
                    }

                    $transaction->update(['refunded' => 1]); /// define a transação como recusada

                    if(!empty($wallet)) {
                        $getWalletBalance = Wallet::where('user_id', $tokenDec['id'])->lockForUpdate()->first();
                        $balanceTotal = $getWalletBalance->total_balance * 100;

                        $response = "
                            <PKT>
                                <Result Name='RefundBet' Success='1'>
                                    <Returnset>
                                        <Token Type='string' Value='$token' />
                                        <Balance Type='int' Value='$balanceTotal' />
                                        <Currency Type='string' Value='$wallet->currency' />
                                        <ExtTransactionID Type='long' Value='$transaction->id' />
                                        <AlreadyProcessed Type='bool' Value='true' />
                                    </Returnset>
                                </Result>
                            </PKT>
                        ";

                        return $response;
                    }else{
                        return self::ShowError('RefundBet', 'Unspecified Error', '6000');
                    }
                }else{
                    return self::ShowError('RefundBet', 'Transaction not found', '7');
                }
            }else{
                return self::ShowError('RefundBet', 'Error retrieving Token', '1');
            }
        }else{
            return self::ShowError('RefundBet', 'Invalid Hash.', '7000');
        }
    }

    /**
     * @dev @victormsalatiel - Não comprem código roubado
     * @param $params
     * @return string
     */
    public static function ChangeGameToken($params)
    {
        $token              = self::$token;
        $newGameReference   = $params['NewGameReference']['@attributes']['Value'];
        $preparedToken      = $newGameReference . $token;

        if(self::ValidateHash($params, $preparedToken)) {
            $tokenDec   = \Helper::DecToken($token);
            if($tokenDec['status']) {
                $response = "
                    <PKT>
                        <Result Name='ChangeGameToken' Success='1'>
                            <Returnset>
                                <NewToken Type='string' Value='$token' />
                            </Returnset>
                        </Result>
                    </PKT>
                ";

                return $response;
            }else{
                return self::ShowError('GetAccountDetails', 'Error retrieving Token', '1');
            }
        }else{
            return self::ShowError('ChangeGameToken', 'Invalid Hash.', '7000');
        }
    }
}
