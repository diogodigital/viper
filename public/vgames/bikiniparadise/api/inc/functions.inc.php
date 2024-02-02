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
