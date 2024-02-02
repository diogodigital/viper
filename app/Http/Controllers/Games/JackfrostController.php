<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Games\SpinData\JackFrost\JackFrostBonus;
use App\Http\Controllers\Games\SpinData\JackFrost\JackFrostDemo;
use App\Http\Controllers\Games\SpinData\JackFrost\JackFrostIcons;
use App\Http\Controllers\Games\SpinData\JackFrost\JackFrostLose;
use App\Http\Controllers\Games\SpinData\JackFrost\JackFrostWin;
use App\Traits\Providers\PrivateGamesTrait;
use Illuminate\Http\Request;

class JackfrostController extends Controller
{
    use PrivateGamesTrait;

    /**
     * @param string $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function session(string $token)
    {
        $settingGame = [
            "num_line"          => 5,
            "line_num"          => 5,
            "bet_amount"        => 0.2,
            "free_num"          => 0,
            "free_total"        => -1,
            "free_amount"       => 4,
            "free_multi"        => 0,
            "freespin_mode"     => 0,
            "credit_line"       => 1,
            "buy_feature"       => 50,
            "buy_max"           => 1300,
            "total_way"         => 27,
            "multiply"          => 0,
            "previous_session"  => false,
            "game_state"        => "",
        ];


        $multipleList = [

        ];

        $iconData = [
            "Symbol_2",
            "Symbol_1",
            "Symbol_3",
            "Symbol_4",
            "Symbol_6",
            "Symbol_5",
            "Symbol_4",
            "Symbol_4",
            "Symbol_4"
        ];

        $activeLines = [
            [
                "name" => "Symbol_4",
                "index" => 3,
                "payout" => 10,
                "combine" => 3,
                "way_243" => 1,
                "multiply" => 0,
                "win_amount" => 2,
                "active_icon" => [
                    7,
                    8,
                    9
                ]
            ]
        ];

        $dropLine = [];
        $betSizeList = [
            "0.2",
            "2",
            "20",
            "100"
        ];

        $feature = [

        ];

        return self::SessionStructure($token, $settingGame, $iconData, $activeLines, $dropLine, $betSizeList, $multipleList, $feature);
    }

    /**
     * @param $token
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function spin(Request $request, $token)
    {

        $settingGame = [
            "cpl"       => $request->cpl,
            "betamount" => $request->betamount,
            "num_line"  => $request->numline,
            "jackpot"   => 0,
            "free_spin" => 0,
            "free_num"  => 0,
            "scaler"    => 0,
            "freemode"  => false,
        ];

        $pull = [
            "TotalWay"          => 27,
            "FreeSpin"          => 0,
            "LastMultiply"      => 0,
            "WildFixedIcons"    => [],
            "HasJackpot"        => false,
            "HasScatter"        => false,
            "CountScatter"      => 0,
            "WildColumIcon"     => "",
            "MultipyScatter"    => 0,
            "MultiplyCount"     => 2,
            "WinLogs" => [
                "[BET] betLevel: 10, betSize:10, baseBet:20.00 => 2000",
                "[WIN] line 1: 4[Symbol_5] payout: 25 (*multipy:1) x 10 x 10 => 2500"
            ],
            "DropLine" => 3,
            "MultipleList" => [

            ]
        ];

        return self::SpinStructure($token, $settingGame, $pull, JackFrostLose::getLose(), JackFrostDemo::getDemo(), JackFrostWin::getWin(), JackFrostBonus::getBonus());
    }

    /**
     * Freenum
     */
    public function freenum(Request $request)
    {
        //
    }

    /**
     * Get Icons
     */
    public function icons()
    {
        return JackFrostIcons::getIcons();
    }
}
