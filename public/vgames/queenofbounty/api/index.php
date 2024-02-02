<?php
require_once("inc/functions.inc.php");
session_start();
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Origin: *");

header('Access-Control-Allow-Methods: GET, POST');


$info = $_SERVER['PATH_INFO'];
$token = explode("/", $info)[1];
$endPoint = explode("/", $info)[2];
$token = E($token);
$validEndpoints = ['session', 'icons', 'spin', 'freenum'];

$freeNum = 0;
$freeSpin = 0;
$cpl = 0;
$amount = 0;

if (isset($_SESSION['free_num'])) {
    $freeNum = $_SESSION['free_num'];
    if ($freeNum > 0) {
        $_SESSION['freemode'] = TRUE;
    } else {
        $_SESSION['multiples'] = $multiples[0];
    }
}

if (in_array($endPoint, $validEndpoints)) {
    require 'endpoints/' . $endPoint . '.php';
} else {
    die("ERR");
}
