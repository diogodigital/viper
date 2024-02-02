<?php

namespace App\Http\Controllers\Games;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Games\SpinData\QueenOfBounty\QueenOfBountyDemo;
use App\Http\Controllers\Games\SpinData\QueenOfBounty\QueenOfBountyIcons;
use App\Http\Controllers\Games\SpinData\QueenOfBounty\QueenOfBountyLose;
use App\Http\Controllers\Games\SpinData\QueenOfBounty\QueenOfBountyWin;
use App\Traits\Providers\PrivateGamesTrait;
use Illuminate\Http\Request;

class QueenofbountyController extends Controller
{
    use PrivateGamesTrait;

    /**
     * @param string $token
     * @return \Illuminate\Http\JsonResponse
     */
    public function session(string $token)
    {
        $settingGame = [
            "num_line"          => 20,
            "line_num"          => 20,
            "bet_amount"        => 0.05,
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
            1, 2, 3, 5
        ];

        $iconData = [
            "Symbol_4",
            "Symbol_3",
            "Symbol_5",
            "Symbol_6",
            "Symbol_3",
            "Symbol_3",
            "Symbol_3",
            "Symbol_0",
            "Symbol_4",
            "Symbol_6",
            "Symbol_3",
            "Symbol_4",
            "Symbol_5",
            "Symbol_3",
            "Symbol_6"
        ];

        $activeLines = [
            [
                "name" => "Symbol_3",
                "index" => 1,
                "payout" => 20,
                "combine" => 3,
                "way_243" => 1,
                "multiply" => 1,
                "win_amount" => 1,
                "active_icon" => [
                    6,
                    7,
                    8
                ]
            ], [
                "name" => "Symbol_3",
                "index" => 11,
                "payout" => 20,
                "combine" => 3,
                "way_243" => 1,
                "multiply" => 1,
                "win_amount" => 1,
                "active_icon" => [
                    11,
                    7,
                    8
                ]
            ], [
                "name" => "Symbol_3",
                "index" => 14,
                "payout" => 20,
                "combine" => 3,
                "way_243" => 1,
                "multiply" => 1,
                "win_amount" => 1,
                "active_icon" => [
                    6,
                    2,
                    8
                ]
            ]
        ];

        $dropLine = [
            [
                "WinLogs" => [],
                "TotalWay" => 1,
                "SlotIcons" => [
                    "Symbol_3",
                    "Symbol_7",
                    "Symbol_8",
                    "Symbol_6",
                    "Symbol_3",
                    "Symbol_7",
                    "Symbol_3",
                    "Symbol_5",
                    "Symbol_4",
                    "Symbol_6",
                    "Symbol_4",
                    "Symbol_4",
                    "Symbol_5",
                    "Symbol_3",
                    "Symbol_6"
                ],
                "WinOnDrop" => 0,
                "ActiveIcons" => [],
                "ActiveLines" => []
            ]
        ];
        $betSizeList = [
            "0.2",
            "2",
            "20",
            "100"
        ];

        $feature = [
            "bigwin" => [
                [
                    "Big Win",
                    "50"
                ],
                [
                    "Herro Win",
                    "100"
                ],
                [
                    "Supper Win",
                    "300"
                ],
                [
                    "Mega Win",
                    "500"
                ]
            ],
            "betsize" => [
                "0.01",
                "0.05",
                "0.25"
            ],
            "betlevel" => [
                "1",
                "2",
                "3",
                "4",
                "5",
                "6",
                "7",
                "8",
                "9",
                "10"
            ],
            "linedata" => [
                "5|6|7|8|9",
                "0|1|2|3|4",
                "10|11|12|13|14",
                "0|6|12|8|4",
                "10|6|2|8|14",
                "0|1|7|3|4",
                "10|11|7|13|14",
                "5|11|12|13|9",
                "5|1|2|3|9",
                "0|6|7|8|4",
                "10|6|7|8|14",
                "5|6|2|8|9",
                "5|6|12|8|9",
                "5|1|7|3|9",
                "5|11|7|13|9",
                "0|6|2|8|4",
                "10|6|12|8|14",
                "0|1|7|13|14",
                "10|11|7|3|4",
                "0|11|2|13|4"
            ]
        ];

        $feature_result = [
            "left_feature" => 9,
            "select_count" => 0,
            "right_feature" => 9,
            "select_finish" => FALSE,
            "access_feature" => FALSE
        ];

        return self::SessionStructure($token, $settingGame, $iconData, $activeLines, $dropLine, $betSizeList, $multipleList, $feature, $feature_result);
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
            "HasScatter"        => true,
            "CountScatter"      => 0,
            "WildColumIcon"     => "",
            "MultipyScatter"    => 0,
            "MultiplyCount"     => 2,
            "WinLogs" => [
                "[BET] betLevel: 10, betSize:10, baseBet:20.00 => 2000",
                "[WIN] line 1: 4[Symbol_5] payout: 25 (*multipy:1) x 10 x 10 => 2500"
            ],
            "DropLine" => 3,
            "MultipleList" => [1, 2, 3, 5]
        ];

        return self::SpinStructure($token, $settingGame, $pull, QueenOfBountyLose::getLose(), QueenOfBountyDemo::getDemo(), QueenOfBountyWin::getWin());
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
        return QueenOfBountyIcons::getIcons();
    }
}
