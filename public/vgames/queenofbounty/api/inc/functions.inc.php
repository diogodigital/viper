<?php
require_once("conf.inc.php");

function R() {
    global $res;
    header("Content-Type: application/json");
    die(json_encode($res));
}
function S($key, $value) {
    global $res;
    $res->$key = $value;
}
function Q(string $query) {
    global $con;
    return $con->query($query);
}
function E(string $value) {
    global $con;
    return mysqli_escape_string($con, $value);
}
function CountScatter($arr) {
    $count_scarter = array_count_values($arr);

    if (isset($count_scarter['Symbol_1'])) {
        return $count_scarter['Symbol_1'];
    }

    return 0;
}

function MultiplyCount($drops) {
    global $multiples;
    if ($drops > 3) {
        $drops = 3;
    }
    return $multiples[$drops];
}
function ToFloat($val, $digits = 2) {
    return (float)number_format($val, $digits, '.', '');
}
function CalcWinActiveLine($lines) {
    $aux = 0;

    if (sizeof($lines) > 0) {
        foreach($lines as $line) {
            $aux = $aux + ($line['payout'] * $line['multiply']);
        }
    }

    return $aux;
}
function CalcWinDropLine($drops, $mult) {
    $total = 0;
    foreach($drops as $drop) {
        $amout = CalcWinActiveLine($drop['ActiveLines']);
        $total = $total + $amout;
        // $drop['ActiveLines']['win_amount'] = $amout;
    }
    $total = $total * $mult;
    return compact(['drops', 'total']);
}
