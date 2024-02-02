<?php

namespace App\Http\Controllers\Games\SpinData\BikiniParadise;

class BikiniParadiseDemo
{
    /**
     * @return array[]
     */
    public static function getDemo(): array
    {
        return [
            [
                [
                    "Symbol_2", "Symbol_5", "Symbol_0", "Symbol_5", "Symbol_0", "Symbol_4", "Symbol_2", "Symbol_4", "Symbol_3"
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
                    "Symbol_3", "Symbol_4", "Symbol_2", "Symbol_6", "Symbol_0", "Symbol_5", "Symbol_2", "Symbol_2", "Symbol_4"
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
                    "Symbol_2", "Symbol_0", "Symbol_3", "Symbol_4", "Symbol_0", "Symbol_5", "Symbol_6", "Symbol_1", "Symbol_0"
                ],
                [1, 5, 9],
                [
                    [
                        "index" => 4,
                        "name" => "Symbol_2",
                        "combine" => 3,
                        "way_243" => 1,
                        "payout" => 250,
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
                    "Symbol_2", "Symbol_0", "Symbol_3", "Symbol_4", "Symbol_0", "Symbol_5", "Symbol_6", "Symbol_1", "Symbol_0"
                ],
                [1, 5, 9],
                [
                    [
                        "index" => 4,
                        "name" => "Symbol_2",
                        "combine" => 3,
                        "way_243" => 1,
                        "payout" => 250,
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
                250     //SUPERMEGAWIN 1:50
            ],
            [
                [
                    "Symbol_3", "Symbol_0", "Symbol_2", "Symbol_3", "Symbol_0", "Symbol_3", "Symbol_5", "Symbol_4", "Symbol_5"
                ],
                [4, 5, 6],

                [
                    [
                        "index" => 1,
                        "name" => "Symbol_3",
                        "combine" => 3,
                        "way_243" => 1,
                        "payout" => 100,
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
                100
            ],         //SUPERWIN 1:20

            [
                [
                    "Symbol_4", "Symbol_1", "Symbol_3", "Symbol_6", "Symbol_0", "Symbol_5", "Symbol_3", "Symbol_1", "Symbol_5"
                ],
                [7, 5, 3],

                [
                    [
                        "index" => 5,
                        "name" => "Symbol_3",
                        "combine" => 3,
                        "way_243" => 1,
                        "payout" => 100,
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
                100
            ],      //SUPERMEGAWIN 1:20 diferente
            [
                [
                    "Symbol_2", "Symbol_2", "Symbol_5", "Symbol_5", "Symbol_5", "Symbol_2", "Symbol_5", "Symbol_1", "Symbol_5"
                ],
                [7, 5, 3],
                [
                    [
                        "index" => 5,
                        "name" => "Symbol_5",
                        "combine" => 3,
                        "way_243" => 1,
                        "payout" => 50,
                        "multiply" => 0,
                        "win_amount" => 10,
                        "active_icon" => [
                            7,
                            5,
                            3
                        ]
                    ]
                ],
                [],
                0,
                50
            ], // x10
        ];;
    }
}
