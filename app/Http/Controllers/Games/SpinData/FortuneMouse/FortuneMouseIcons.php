<?php

namespace App\Http\Controllers\Games\SpinData\FortuneMouse;

class FortuneMouseIcons
{
    /**
     * @return array
     */
    public static function getIcons(): string
    {
        $data = [
            "success" => true,
            "data" => [
                [
                    "icon_name" => "Symbol_0",
                    "win_1" => 0,
                    "win_2" => 0,
                    "win_3" => 0,
                    "win_4" => 0,
                    "win_5" => 0,
                    "win_6" => 0,
                    "wild_card" => null,
                    "free_spin" => null,
                    "free_num" => 0,
                    "scaler_spin" => null
                ],
                [
                    "icon_name" => "Symbol_1",
                    "win_1" => 0,
                    "win_2" => 0,
                    "win_3" => 0,
                    "win_4" => 0,
                    "win_5" => 0,
                    "win_6" => 0,
                    "wild_card" => null,
                    "free_spin" => null,
                    "free_num" => 0,
                    "scaler_spin" => null
                ],
                [
                    "icon_name" => "Symbol_2",
                    "win_1" => 0,
                    "win_2" => 0,
                    "win_3" => 50,
                    "win_4" => 250,
                    "win_5" => 2500,
                    "win_6" => 0,
                    "wild_card" => null,
                    "free_spin" => null,
                    "free_num" => 0,
                    "scaler_spin" => null
                ],
                [
                    "icon_name" => "Symbol_3",
                    "win_1" => 0,
                    "win_2" => 0,
                    "win_3" => 20,
                    "win_4" => 100,
                    "win_5" => 1000,
                    "win_6" => 0,
                    "wild_card" => null,
                    "free_spin" => null,
                    "free_num" => 0,
                    "scaler_spin" => null
                ],
                [
                    "icon_name" => "Symbol_4",
                    "win_1" => 0,
                    "win_2" => 0,
                    "win_3" => 15,
                    "win_4" => 50,
                    "win_5" => 500,
                    "win_6" => 0,
                    "wild_card" => null,
                    "free_spin" => null,
                    "free_num" => 0,
                    "scaler_spin" => null
                ],
                [
                    "icon_name" => "Symbol_5",
                    "win_1" => 0,
                    "win_2" => 0,
                    "win_3" => 10,
                    "win_4" => 25,
                    "win_5" => 200,
                    "win_6" => 0,
                    "wild_card" => null,
                    "free_spin" => null,
                    "free_num" => 0,
                    "scaler_spin" => null
                ],
                [
                    "icon_name" => "Symbol_6",
                    "win_1" => 0,
                    "win_2" => 0,
                    "win_3" => 5,
                    "win_4" => 20,
                    "win_5" => 100,
                    "win_6" => 0,
                    "wild_card" => null,
                    "free_spin" => null,
                    "free_num" => 0,
                    "scaler_spin" => null
                ],
                [
                    "icon_name" => "Symbol_7",
                    "win_1" => 0,
                    "win_2" => 0,
                    "win_3" => 4,
                    "win_4" => 15,
                    "win_5" => 75,
                    "win_6" => 0,
                    "wild_card" => null,
                    "free_spin" => null,
                    "free_num" => 0,
                    "scaler_spin" => null
                ],
                [
                    "icon_name" => "Symbol_8",
                    "win_1" => 0,
                    "win_2" => 0,
                    "win_3" => 3,
                    "win_4" => 10,
                    "win_5" => 50,
                    "win_6" => 0,
                    "wild_card" => null,
                    "free_spin" => null,
                    "free_num" => 0,
                    "scaler_spin" => null
                ]
            ],
            "message" => "List icons success"
        ];
        $jsonString = json_encode($data, JSON_PRETTY_PRINT);

        return $jsonString;
    }
}
