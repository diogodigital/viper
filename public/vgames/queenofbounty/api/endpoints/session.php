<?php
$_SESSION['freemode'] = FALSE;
$qUser = Q("SELECT * FROM w_users WHERE token='$token'");
$user = $qUser->fetch_assoc();
if (!$user) die("Err user not found");
$data = new stdClass();
$data->user_name = $user['username'];
$data->credit = $user['balance'] + $user['welcomebonus'];
$data->num_line = 20;
$data->line_num = 20;
$data->bet_amount = 0.05;
$data->free_num = $freeNum;
$data->free_total = 64;
$data->free_amount = 234.6;
$data->free_multi = 1;
$data->freespin_mode = 1;
$data->multiple_list = [
    1, 2, 3, 5
];
$data->credit_line = 1;
$data->buy_feature = 50;
$data->buy_max = 1300;
$data->feature = [
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
$data->total_way = 243;
$data->multiply = 0;
$data->icon_data = [
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
$data->active_lines = [
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
$data->drop_line = [
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
$data->currency_prefix = "R$";
$data->currency_suffix = "";
$data->currency_thousand = ".";
$data->currency_decimal = ",";
$data->bet_size_list = [
    "0.05",
    "0.5",
    "2.5",
    "10"
];
$data->previous_session = FALSE;
$data->game_state = NULL;
$data->feature_symbol = "";
$data->feature_result = [
    "left_feature" => 9,
    "select_count" => 0,
    "right_feature" => 9,
    "select_finish" => FALSE,
    "access_feature" => FALSE
];
S("success", true);
S("data", $data);
S("message", "Load sessions success");
R();