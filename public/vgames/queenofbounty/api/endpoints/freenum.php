<?php
header("Content-Type: application/json");
$index = isset($_POST['index']) ? $_POST['index'] : -1;

$freeSpin = [
    1 => 20,
    2 => 10,
    3 => 5,
];

$_SESSION['free_num'] = $freeSpin[$index];

$_SESSION['free_num_last'] = $freeSpin[$index];

$_SESSION['multiples'] = $multiples[$index];

$_SESSION['freemode'] = true;

exit(json_encode([
    "success" => true,
    "data" => [
        "free_num" => $freeSpin[$index]
    ],
    "message" => "Change success"
]));
