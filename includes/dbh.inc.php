<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "gameloginsys";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if (!$conn) {
  die("Failed Connection: ".mysqli_connect_error());
}
