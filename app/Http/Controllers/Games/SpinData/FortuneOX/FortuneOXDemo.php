<?php

namespace App\Http\Controllers\Games\SpinData\FortuneOX;

class FortuneOXDemo
{
    /**
     * @return array
     */
    public static function getDemo(): array
    {
        return [
            [
                [
                    "Symbol_2", "Symbol_5", "Symbol_0", "Symbol_5", "Symbol_0", "Symbol_4", "Symbol_2", "Symbol_4", "Symbol_3", "_blank", "Symbol_2", "_blank"
                ],
                [7, 5, 3],
                [
                    [
                        "index" => 5,
                        "name" => "Symbol_2",
                        "combine" => 3,
                        "way_243" => 1,
                        "payout" => 30,
                        "multiply" => 0,
                        "win_amount" => 4,
                        "active_icon" => [
                            1,
                            2,
                            3
                        ]
                    ]
                ],
                [],
                2,
                30
            ], //x6 mult
            [
                [
                    "Symbol_3", "Symbol_4", "Symbol_2", "Symbol_6", "Symbol_0", "Symbol_5", "Symbol_2", "Symbol_2", "Symbol_4", "_blank", "Symbol_1", "_blank"
                ],
                [7, 5, 3],
                [
                    [
                        "index" => 5,
                        "name" => "Symbol_2",
                        "combine" => 3,
                        "way_243" => 1,
                        "payout" => 15,
                        "multiply" => 0,
                        "win_amount" => 9,
                        "active_icon" => [
                            7,
                            8,
                            9
                        ]
                    ]
                ],
                [],
                6,
                30  //x6 mult
            ],
            //SUPERMEGAWIN 1:50
            [
                [
                    "Symbol_2", "Symbol_0", "Symbol_3", "Symbol_4", "Symbol_0", "Symbol_5", "Symbol_6", "Symbol_1", "Symbol_0", "_blank", "Symbol_2", "_blank"
                ],
                [1, 5, 9],
                [
                    [
                        "index" => 4,
                        "name" => "Symbol_2",
                        "combine" => 3,
                        "way_243" => 1,
                        "payout" => 45,
                        "multiply" => 0,
                        "win_amount" => 50,
                        "active_icon" => [
                            1,
                            5,
                            9
                        ]
                    ]
                ],
                [],
                0,
                250
            ],
            [
                [
                    "Symbol_2", "Symbol_0", "Symbol_3", "Symbol_4", "Symbol_0", "Symbol_5", "Symbol_6", "Symbol_1", "Symbol_0", "_blank", "Symbol_2", "_blank"
                ],
                [1, 5, 9],
                [
                    [
                        "index" => 4,
                        "name" => "Symbol_2",
                        "combine" => 3,
                        "way_243" => 1,
                        "payout" => 45,
                        "multiply" => 0,
                        "win_amount" => 50,
                        "active_icon" => [
                            1,
                            5,
                            9
                        ]
                    ]
                ],
                [],
                0,
                45     //SUPERMEGAWIN 1:50
            ],
            [
                [
                    "Symbol_3", "Symbol_0", "Symbol_2", "Symbol_3", "Symbol_0", "Symbol_3", "Symbol_5", "Symbol_4", "Symbol_5", "_blank", "Symbol_2", "_blank"
                ],
                [4, 5, 6],

                [
                    [
                        "index" => 1,
                        "name" => "Symbol_3",
                        "combine" => 3,
                        "way_243" => 1,
                        "payout" => 25,
                        "multiply" => 0,
                        "win_amount" => 50,
                        "active_icon" => [
                            4,
                            5,
                            6
                        ]
                    ]
                ],
                [],
                0,
                25
            ],         //SUPERWIN 1:20

            [
                [
                    "Symbol_4", "Symbol_1", "Symbol_3", "Symbol_6", "Symbol_0", "Symbol_5", "Symbol_3", "Symbol_1", "Symbol_5", "_blank", "Symbol_3", "_blank"
                ],
                [7, 5, 3],

                [
                    [
                        "index" => 5,
                        "name" => "Symbol_3",
                        "combine" => 3,
                        "way_243" => 1,
                        "payout" => 25,
                        "multiply" => 0,
                        "win_amount" => 20,
                        "active_icon" => [
                            7,
                            5,
                            3
                        ]
                    ]
                ],
                [],
                0,
                25
            ],
        ];
    }
}
