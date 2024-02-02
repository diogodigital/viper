<?php

if ($_SERVER['REQUEST_METHOD'] != "POST") die("a");

$qUser = Q("SELECT * FROM w_users WHERE token='$token'");
$user = $qUser->fetch_assoc();
if (!$user) die("User not found");

if ($freeNum > 0) {
    $freeNum--;
    $_SESSION['free_num'] = $freeNum;
}


$freeMode = ($freeNum > 0);

define("SLOTINCONS", 0);
define("ACTIVEICONS", 1);
define("ACTIVELINES", 2);
define("DROPLINEDATA", 3);
define("MULTIPLYCOUNT", 4);
define("PAYOUT", 5);

// SlotIcons, ActiveIcons, ActiveLines, DropLineData, MultiplyCount, Payout
$loseResults = require_once('spin_data\\loss.php');

$scatterResults = require_once('spin_data\\scatters.php');

$demoWinResults = [];

// SlotIcons, ActiveIcons, ActiveLines, DropLineData, MultiplyCount, Payout
$winResults = require_once('spin_data\\wins.php');

//////////////////////////// COMMON /////////////////////////////////////////
// Just after results array declaration

shuffle($winResults);
shuffle($loseResults);
shuffle($scatterResults);

if ($user['is_demo_agent']) {
    $winResults = array_merge($winResults, $demoWinResults);
    $loseLength = 5;
    $winLength = 80;
    $scatterResultsLength = 15;
} else {
    $winLength = 10;
    $loseLength = 85;
    $scatterResultsLength = 5;
}

$winResults = array_slice($winResults, 0, $winLength);
$loseResults = array_slice($loseResults, 0, $loseLength);
$scatterResults = array_slice($scatterResults, 0, $scatterResultsLength);

$possibleResults = array_merge($winResults, $loseResults, $scatterResults);
shuffle($possibleResults);
$result = $possibleResults[0];

$countScatter = CountScatter($result[0]);
$hasScatter = ($countScatter > 0);


if ($hasScatter && $freeMode) {
    $freeNum = $freeNum + $_SESSION['free_num_last'];
    $_SESSION['free_num'] = $freeNum;
    $freeSpin = $_SESSION['free_num_last'];
}

///////////////////////////////////////////////////////////////////////////

$cpl = intval($_POST['cpl']);
$amount = floatval($_POST['betamount']);
$numline = intval($_POST['numline']);
$bet = $amount * $cpl * $numline;

/////////////////////////////// COMMOM /////////////////////////////////
// Just after $bet declaration

if ($user['balance'] + $user['welcomebonus'] < $bet) {
    die("Insuficient credits");
} else {
    if ($user['balance'] >= $bet) {
        Q("UPDATE w_users SET balance=balance-$bet WHERE token='$token'");
    } else {
        $disc = $bet - $user['balance'];
        Q("UPDATE w_users SET balance=0 WHERE token='$token'");
        Q("UPDATE w_users SET welcomebonus=welcomebonus-$disc WHERE token='$token'");
    }
}

// Q($query);

// To $winAmount declaration
///////////////////////////////////////////////////////////////////////
// exit(json_encode($result));

$winAmount = 0;
$winInLines = 0;

for ($i = 0; $i<sizeof($result[ACTIVELINES]); $i++) {
    $tAmount = ToFloat($result[ACTIVELINES][$i]["payout"] * ($cpl * $amount));
    $result[ACTIVELINES][$i]["win_amount"] = $tAmount;
    $winAmount = $winAmount + $tAmount;
    $winInLines = $winAmount;
}
for ($i = 0; $i<sizeof($result[DROPLINEDATA]); $i++) {
    for ($j = 0; $j<sizeof($result[DROPLINEDATA][$i]['ActiveLines']); $j++) {
        $tAmount = ToFloat(($result[DROPLINEDATA][$i]['ActiveLines'][$j]['payout'] * ($cpl * $amount)) * $result[DROPLINEDATA][$i]['ActiveLines'][$j]['multiply']);
        $result[DROPLINEDATA][$i]['ActiveLines'][$j]['win_amount'] = $tAmount;
        $winAmount = $winAmount + $tAmount;
    }
}

Q("UPDATE w_users SET balance=balance+$winAmount WHERE token='$token'");

$qUser = Q("SELECT * FROM w_users WHERE token='$token'");
$user = $qUser->fetch_assoc();

$dropLines = sizeof($result[DROPLINEDATA]);

$pull = [
    "WinAmount" => $winAmount,
    "WinOnDrop" => $winInLines,
    "TotalWay" => $winAmount > 0 ? 243 : 0,
    "FreeSpin" => $freeSpin,
    "HasNewSpawn" => ($dropLines > 0),
    "HasPlaceHolder" => false,
    "LastMultiply" => 1,
    "WildFixedIcons" => [],
    "HasJackpot" => false,
    "HasScatter" => $hasScatter,
    "CountScatter" => $countScatter,
    "WildColumIcon" => "",
    "MultipyScatter" => 0,
    "MultiplyCount" => MultiplyCount($dropLines),
    "SlotIcons" => $result[0],
    "ActiveIcons" => $winAmount > 0 ? $result[1] : [],
    "ActiveLines" => $winAmount > 0 ? $result[2] : [],
    "WinLogs" => [
        "[BET] betLevel: 10, betSize:10, baseBet:20.00 => 2000",
        "[WIN] line 1: 4[Symbol_5] payout: 25 (*multipy:1) x 10 x 10 => 2500"
    ],
    "DropLine" => $dropLines,
    "DropLineData" => $result[3],
    "MultipleList" => [
        1,
        2,
        3,
        5
    ],
    "FeatureResult" => [
        "left_feature" => 9,
        "select_count" => 0,
        "right_feature" => 9,
        "select_finish" => false,
        "access_feature" => false
    ]
];

$data = [
    "credit" => $user['balance'] + $user['welcomebonus'],
    "freemode" => $freeMode,
    "jackpot" => 0,
    "free_spin" => intval($freeNum > 0),
    "free_num" => $freeNum,
    "scaler" => 0,
    "num_line" => $numline,
    "cpl" => $cpl,
    "bet_amount" => $amount,
    "feature_symbol" => "",
    "pull" => $pull
];



S("success", true);
S("data", $data);
S(
    "message",
    "Spin success"
);
R();
