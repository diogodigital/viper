<?php
if ($_SERVER['REQUEST_METHOD'] != "POST") die("a");

$qUser = Q("SELECT * FROM w_users WHERE token='$token'");
$user = $qUser->fetch_assoc();
if (!$user) die("User not found");



$freeMode = rand(1, 10) == 1;
$freeSpin = rand(1, 20) == 1;
$freeNum = rand(1, 10) == 1;
define("SLOTINCONS", 0);
define("ACTIVEICONS", 1);
define("ACTIVELINES", 2);
define("DROPLINEDATA", 3);
define("MULTIPLYCOUNT", 4);
define("PAYOUT", 5);

// SlotIcons, ActiveIcons, ActiveLines, DropLineData, MultiplyCount, Payout
$loseResults = [
    [
        ["Symbol_5", "Symbol_3", "Symbol_6", "Symbol_2", "Symbol_2", "Symbol_1", "Symbol_3", "Symbol_4", "Symbol_3"], [], [], [], 1, 0
    ],

    [
        ["Symbol_5", "Symbol_4", "Symbol_3", "Symbol_3", "Symbol_3", "Symbol_2", "Symbol_2", "Symbol_0", "Symbol_1"], [], [], [], 1, 0
    ],

    [
        ["Symbol_5", "Symbol_1", "Symbol_3", "Symbol_1", "Symbol_4", "Symbol_6", "Symbol_3", "Symbol_6", "Symbol_1"], [], [], [], 1, 0
    ],

    [
        ["Symbol_5", "Symbol_2", "Symbol_3", "Symbol_6", "Symbol_3", "Symbol_1", "Symbol_5", "Symbol_1", "Symbol_4"], [], [], [], 1, 0
    ],
    [
        ["Symbol_3", "Symbol_6", "Symbol_5", "Symbol_1", "Symbol_6", "Symbol_6", "Symbol_6", "Symbol_5", "Symbol_0"], [], [], [], 1, 0
    ],
    [
        ["Symbol_2", "Symbol_1", "Symbol_4", "Symbol_5", "Symbol_3", "Symbol_6", "Symbol_5", "Symbol_3", "Symbol_1"], [], [], [], 1, 0
    ],
    [
        ["Symbol_4", "Symbol_1", "Symbol_2", "Symbol_3", "Symbol_4", "Symbol_3", "Symbol_6", "Symbol_4", "Symbol_5"], [], [], [], 1, 0
    ],
    [
        ["Symbol_2", "Symbol_1", "Symbol_4", "Symbol_2", "Symbol_6", "Symbol_2", "Symbol_1", "Symbol_5", "Symbol_3"], [], [], [], 1, 0
    ],
    [
        ["Symbol_6", "Symbol_1", "Symbol_5", "Symbol_3", "Symbol_1", "Symbol_3", "Symbol_3", "Symbol_6", "Symbol_3"], [], [], [], 1, 0
    ],
    [
        ["Symbol_3", "Symbol_4", "Symbol_4", "Symbol_4", "Symbol_4", "Symbol_3", "Symbol_5", "Symbol_1", "Symbol_5"], [], [], [], 1, 0
    ],
    [
        ["Symbol_3", "Symbol_5", "Symbol_1", "Symbol_6", "Symbol_5", "Symbol_4", "Symbol_6", "Symbol_1", "Symbol_2"], [], [], [], 1, 0
    ],
    [
        ["Symbol_2", "Symbol_1", "Symbol_4", "Symbol_5", "Symbol_3", "Symbol_6", "Symbol_5", "Symbol_3", "Symbol_1"], [], [], [], 1, 0
    ],
    [
        ["Symbol_2", "Symbol_1", "Symbol_4", "Symbol_5", "Symbol_3", "Symbol_6", "Symbol_5", "Symbol_3", "Symbol_1"], [], [], [], 1, 0
    ],
    [
        ["Symbol_4", "Symbol_6", "Symbol_3", "Symbol_6", "Symbol_4", "Symbol_4", "Symbol_5", "Symbol_2", "Symbol_2"], [], [], [], 1, 0
    ],
    [
        ["Symbol_2", "Symbol_4", "Symbol_1", "Symbol_3", "Symbol_4", "Symbol_6", "Symbol_6", "Symbol_0", "Symbol_3"], [], [], [], 1, 0
    ],
    [
        ["Symbol_3", "Symbol_4", "Symbol_1", "Symbol_6", "Symbol_4", "Symbol_5", "Symbol_2", "Symbol_1", "Symbol_6"], [], [], [], 1, 0
    ],
    [
        ["Symbol_6", "Symbol_0", "Symbol_1", "Symbol_3", "Symbol_4", "Symbol_2", "Symbol_3", "Symbol_2", "Symbol_1"], [], [], [], 1, 0
    ],
    [
        ["Symbol_3", "Symbol_6", "Symbol_5", "Symbol_5", "Symbol_3", "Symbol_4", "Symbol_5", "Symbol_2", "Symbol_2"], [], [], [], 1, 0
    ]
];

$demoWinResults = [
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
];

// SlotIcons, ActiveIcons, ActiveLines, DropLineData, MultiplyCount, Payout
$winResults = [
    [
        [
            "Symbol_6", "Symbol_0", "Symbol_5", "Symbol_1",  "Symbol_0", "Symbol_6", "Symbol_1", "Symbol_0", "Symbol_6"
        ],
        [1, 5, 9],
        [
            [
                "index" => 4,
                "name" => "Symbol_6",
                "combine" => 3,
                "way_243" => 1,
                "payout" => 4,
                "multiply" => 0,
                "win_amount" => 0.8,
                "active_icon" => [
                    1,
                    5,
                    9
                ]
            ]
        ], [], 2, 3
    ],
    [
        [
            "Symbol_3",
            "Symbol_0",
            "Symbol_4",
            "Symbol_3",
            "Symbol_0",
            "Symbol_4",
            "Symbol_4",
            "Symbol_0",
            "Symbol_5"
        ],
        [7, 5, 3],
        [
            [
                "index" => 5,
                "name" => "Symbol_4",
                "combine" => 3,
                "way_243" => 1,
                "payout" => 10,
                "multiply" => 0,
                "win_amount" => 4,
                "active_icon" => [
                    7,
                    5,
                    3
                ]
            ]
        ],
        [],
        2,
        30
    ],
    [
        [
            "Symbol_2", "Symbol_4", "Symbol_5", "Symbol_2", "Symbol_1", "Symbol_4", "Symbol_3", "Symbol_3", "Symbol_3"
        ],
        [7, 8, 9],
        [
            [
                "index" => 3,
                "name" => "Symbol_3",
                "combine" => 3,
                "way_243" => 1,
                "payout" => 15,
                "multiply" => 0,
                "win_amount" => 4,
                "active_icon" => [
                    7,
                    8,
                    9
                ]
            ]
        ],
        [],
        2,
        15
    ],
    [
        [
            "Symbol_3", "Symbol_3", "Symbol_3", "Symbol_6", "Symbol_5", "Symbol_2", "Symbol_4", "Symbol_4", "Symbol_1"
        ],
        [1, 2, 3],
        [
            [
                "index" => 2,
                "name" => "Symbol_3",
                "combine" => 3,
                "way_243" => 1,
                "payout" => 15,
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
        15
    ],

    [
        [
            "Symbol_2", "Symbol_4", "Symbol_6", "Symbol_2", "Symbol_6", "Symbol_6", "Symbol_6", "Symbol_0", "Symbol_2"
        ],
        [7, 5, 3],
        [
            [
                "index" => 5,
                "name" => "Symbol_6",
                "combine" => 3,
                "way_243" => 1,
                "payout" => 30,
                "multiply" => 0,
                "win_amount" => 4,
                "active_icon" => [
                    7,
                    5,
                    3
                ]
            ]
        ],
        [],
        2,
        4
    ],
    [
        [
            "Symbol_2", "Symbol_2", "Symbol_4", "Symbol_2", "Symbol_0", "Symbol_4", "Symbol_3", "Symbol_3", "Symbol_3"
        ],
        [7, 8, 9],
        [
            [
                "index" => 3,
                "name" => "Symbol_3",
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
        2,
        15
    ],

    [
        [
            "Symbol_2", "Symbol_6", "Symbol_2", "Symbol_5", "Symbol_5", "Symbol_5", "Symbol_5", "Symbol_4", "Symbol_2"
        ],
        [4, 5, 6],
        [
            [
                "index" => 1,
                "name" => "Symbol_5",
                "combine" => 3,
                "way_243" => 1,
                "payout" => 5,
                "multiply" => 0,
                "win_amount" => 1,
                "active_icon" => [
                    4,
                    5,
                    6
                ]
            ]
        ],
        [],
        0,
        5
    ],



];

//////////////////////////// COMMON /////////////////////////////////////////
// Just after results array declaration

shuffle($winResults);
shuffle($loseResults);

if ($user['is_demo_agent']) {
    $winResults = array_merge($winResults, $demoWinResults);
    $loseLength = 1;
    $winLength = 20;
} else {
    $winLength = 3;
    $loseLength = 20;
}

$winResults = array_slice($winResults, 0, $winLength);
$loseResults = array_slice($loseResults, 0, $loseLength);

$possibleResults = array_merge($winResults, $loseResults);
shuffle($possibleResults);
$result = $possibleResults[0];

///////////////////////////////////////////////////////////////////////////


$cpl = intval($_POST['cpl']);
$amount = floatval($_POST['betamount']);
$numline = intval($_POST['numline']);
$bet = $amount * $cpl * $numline;

/////////////////////////////// COMMOM /////////////////////////////////
// Just after $bet declaration

if ($user['wallet'] + $user['wallet_bonus'] < $bet) die("Insuficient credits");

else {
    if ($user['wallet'] >= $bet) {
        Q("UPDATE users SET wallet=wallet-$bet WHERE token='$token'");
    } else {
        $disc = $bet - $user['wallet'];
        Q("UPDATE users SET wallet=0 WHERE token='$token'");
        Q("UPDATE users SET wallet_bonus=wallet_bonus-$disc WHERE token='$token'");
    }
}

// Q($query);

// To $winAmount declaration
///////////////////////////////////////////////////////////////////////

$winAmount = $cpl * $amount * $result[PAYOUT];


$result[ACTIVELINES][0]["win_amount"] = $winAmount;
Q("UPDATE users SET wallet=wallet+$winAmount WHERE token='$token'");

$qUser = Q("SELECT * FROM users WHERE token='$token'");
$user = $qUser->fetch_assoc();




$pull = [
    "WinAmount" => $winAmount,
    "WinOnDrop" => $winAmount,
    "TotalWay" => 27,
    "FreeSpin" => 0,
    "LastMultiply" => 0,
    "WildFixedIcons" => [],
    "HasJackpot" => false,
    "HasScatter" => false,
    "CountScatter" => 0,
    "WildColumIcon" => "",
    "MultipyScatter" => 0,
    "MultiplyCount" => 2,
    "SlotIcons" => $result[0],
    "ActiveIcons" => $result[1],
    "ActiveLines" => $result[2],
    "WinLogs" => [
        "[BET] betLevel: 10, betSize:10, baseBet:20.00 => 2000",
        "[WIN] line 1: 4[Symbol_5] payout: 25 (*multipy:1) x 10 x 10 => 2500"
    ],
    "DropLine" => 3,
    "DropLineData" => $result[3],
    "MultipleList" => [
        1,
        2,
        3,
        5
    ]
];

$data = [
    "credit" => $user['wallet'] + $user['wallet_bonus'],
    "freemode" => false,
    "jackpot" => 0,
    "free_spin" => 0,
    "free_num" => 0,
    "scaler" => 0,
    "num_line" => $_POST['numline'],
    "cpl" => $cpl,
    "betamount" => $amount,
    "bet_amount" => $bet,
    "pull" => $pull
];



S("success", true);
S("data", $data);
S("message", "Spin success");
R();
