<?php

namespace App\Traits\Providers;

use App\Http\Controllers\SystemWalletController;
use App\Models\GameExclusive;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\JsonResponse;

trait PrivateGamesTrait
{

    /**
     * @dev @victormsalatiel - Não comprem código roubado
     * @param string $token
     * @param array $settingGame
     * @param array $iconData
     * @param array $activeLines
     * @param array $dropLine
     * @param array $betSizeList
     * @param array $multipleList
     * @param array $feature
     * @return JsonResponse
     */
    public static function SessionStructure(string $token, array $settingGame, array $iconData, array $activeLines, array $dropLine, array $betSizeList, array $multipleList, array $feature, array $featureResult = [])
    {
        $tokenOpen  = \Helper::DecToken($token);
        $setting    = \Helper::getSetting();

        if(isset($tokenOpen['status']) && $tokenOpen['status']) {
            $user = User::find($tokenOpen['id']);

            $data                       = new \stdClass();
            $data->user_name            = $user->name;
            $data->credit               = $user->wallet->balance + $user->wallet->balance_bonus;
            $data->num_line             = $settingGame['num_line'];
            $data->line_num             = $settingGame['line_num'];
            $data->bet_amount           = $settingGame['bet_amount'];
            $data->free_num             = $settingGame['free_num'];
            $data->free_total           = $settingGame['free_total'];
            $data->free_amount          = $settingGame['free_amount'];
            $data->free_multi           = $settingGame['free_multi'];
            $data->freespin_mode        = $settingGame['freespin_mode'];
            $data->multiple_list        = $multipleList;
            $data->credit_line          = $settingGame['credit_line'];
            $data->buy_feature          = $settingGame['buy_feature'];
            $data->buy_max              = $settingGame['buy_max'];
            $data->feature              = $feature;
            $data->total_way            = $settingGame['total_way'];
            $data->multiply             = $settingGame['multiply'];
            $data->icon_data            = $iconData;
            $data->active_lines         = $activeLines;
            $data->drop_line            = $dropLine;
            $data->currency_prefix      = $setting->prefix;
            $data->currency_suffix      = "";
            $data->currency_thousand    = ".";
            $data->currency_decimal     = ",";
            $data->bet_size_list        = $betSizeList;

            $data->previous_session     = $settingGame['previous_session'];
            $data->game_state           = $settingGame['game_state'];
            $data->feature_result       = $featureResult;

            return response()->json([
                "data" => $data,
                "success" => true,
                "message" => "Session success"
            ]);
        }

        return response()->json([], 400);
    }


    /**
     * @dev @victormsalatiel - Não comprem código roubado
     * @param string $token
     * @param array $settingGame
     * @param array $pull
     * @param array $dataLose
     * @param array $dataDemo
     * @param array $dataWin
     * @return JsonResponse
     */
    public static function SpinStructure(string $token, array $settingGame, array $pull, array $dataLose, array $dataDemo, array $dataWin, array $dataBonus)
    {
        $tokenOpen = \Helper::DecToken($token);

        if(isset($tokenOpen['status']) && $tokenOpen['status']) {
            $game               = GameExclusive::whereActive(1)->where('uuid', $tokenOpen['game'])->first();
            $user               = User::find($tokenOpen['id']);
            $wallet             = Wallet::where('user_id', $tokenOpen['id'])->first();

            $cpl                = intval($settingGame['cpl']);
            $amount             = floatval($settingGame['betamount']);
            $numline            = intval($settingGame['num_line']);
            $bet                = $amount * $cpl * $numline;
            $betInitial         = $bet;

            define("SLOTINCONS", 0);
            define("ACTIVEICONS", 1);
            define("ACTIVELINES", 2);
            define("DROPLINEDATA", 3);
            define("MULTIPLYCOUNT", 4);
            define("PAYOUT", 5);

            $loseResults        = $dataLose;
            $demoWinResults     = $dataDemo;

//            $checkFirstDeposit  = Transaction::where('user_id', auth()->id())->where('status', 1)->count();
//            if($checkFirstDeposit == 1 || $checkFirstDeposit == 2) {
//                $winResults     = $dataWin;
//            }else{
//                $winResults     = $bet >= 10 && $bet <= 50 ? $dataWin : [];
//            }

            $winResults         = $dataWin;
            $bonusResults       = $dataBonus;

            shuffle($loseResults);
            shuffle($demoWinResults);
            shuffle($winResults);
            shuffle($bonusResults);

            if ($user->is_demo_agent) {
                $winResults = array_merge($winResults, $demoWinResults);
                $loseLength = $game->influencer_loseLength;
                $winLength  = $game->influencer_winLength;
            } else {
                $winLength = $game->winLength;
                $loseLength = $game->loseLength;
            }

            $winResults = array_slice($winResults, 0, $winLength);
            $loseResults = array_slice($loseResults, 0, $loseLength);

            $possibleResults = array_merge($winResults, $loseResults);
            shuffle($possibleResults);
            $result = $possibleResults[0];

            $changeBonus = 'balance';

            if ($wallet->balance + $wallet->balance_bonus < $bet) {
                return response()->json("Insuficient balances", 400);
            }
            else {
                if ($wallet->balance >= $bet) {
                    $wallet->decrement('balance', $bet);
                } else {
                    $changeBonus = 'balance_bonus';

                    $wallet->update(['balance' => 0]);
                    $wallet->decrement('balance_bonus', $bet);
                }
            }

            $winAmount = $cpl * $amount * $result[PAYOUT]; // valor do premio

            $result[ACTIVELINES][0]["win_amount"] = $winAmount;

            /// atualiza os ganhos da vitoria
            $wallet->increment('balance', $winAmount);


            $pull['WinAmount']      = $winAmount;
            $pull['WinOnDrop']      = $winAmount;

            $pull['SlotIcons']      = $result[0];
            $pull['ActiveIcons']    = $result[1];
            $pull['ActiveLines']    = $result[2];
            $pull['DropLineData']   = $result[3];

            $data = [
                "credit"            => ($wallet->balance + $wallet->balance_bonus),
                "freemode"          => $settingGame['freemode'] ?? false,
                "jackpot"           => $settingGame['jackpot'],
                "free_spin"         => $settingGame['free_spin'],
                "free_num"          => $settingGame['free_num'],
                "scaler"            => $settingGame['scaler'],
                "num_line"          => $settingGame['num_line'],
                "cpl"               => $cpl,
                "betamount"         => $amount,
                "bet_amount"        => $bet,
                "pull"              => $pull
            ];

            \Helper::generateGameHistory($user, $winAmount == 0 ? 'loss' : 'win', $winAmount, $betInitial, $game->name, $game->uuid, $changeBonus, 'originals');

            return response()->json([
                "data" => $data,
                "success" => true,
                "message" => "Spin success"
            ]);
        }

        return response()->json([], 400);
    }

    /**
     * @dev @victormsalatiel - Não comprem código roubado
     * @param $request
     * @param $token
     * @return JsonResponse|void
     */
    public static function FreeNumStructure($request, $token, $freeSpin, $multiples)
    {
        $index      = $request->index ?? 0;
        $tokenOpen  = \Helper::DecToken($token);
        $game		= GameExclusive::whereActive(1)->where('uuid', $tokenOpen['game'])->first();

        if(isset($tokenOpen['status']) && $tokenOpen['status']) {
            session(['free_num_' . $game->uuid => $freeSpin[$index]]); // quantide de rodadas gratis
            session(['free_num_last_' . $game->uuid => $freeSpin[$index]]); // quantide de rodadas da ultima rodada grátis
            session(['multiples_' . $game->uuid => $multiples[$index] ?? 0]);
            session(['freemode_' . $game->uuid => true]); // ativa o modo freemode

            return response()->json([
                "success" => true,
                "data" => [
                    "free_num" => $freeSpin[$index]
                ],
                "message" => "Change success"
            ]);
        }
    }
}
