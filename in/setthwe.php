<?php
$serbar = "localhost";

// $uzer = "root";
// $pasord = "";
// $dvase = "pearl";

$uzer = "heinsoec_om";
$pasord = "}tlQ#h76&Om~";
$dvase = "heinsoec_Pearl";
$connn = new mysqli($serbar, $uzer, $pasord, $dvase);

// Check connection
if ($connn->connect_error) {
    die("Connection failed: " . $connn->connect_error);
}
?>