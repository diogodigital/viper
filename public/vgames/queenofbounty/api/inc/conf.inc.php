<?php
$res = new stdClass();
$con = new mysqli("localhost", "root", "", "ggds_casinoprovider");
$multiples = [
    0 => [1, 2, 3, 5],
    1 => [1, 2, 3, 5],
    2 => [3, 6, 9, 20],
    3 => [6, 12, 18, 40]
];
$_SESSION['multiples'] = $multiples[0];