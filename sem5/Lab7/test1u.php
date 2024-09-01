<?php
include_once('klasy/User.php');
session_start();

$user = new User('kubus', 'Kubus Puchatek', 'kubus@stumilowylas.pl', 'ADMIN');
$_SESSION['user'] = serialize($user);

echo "ID Sesji: " . session_id() . "<br>";

echo "Obiekt user zapamiętany w sesji.<br>";

echo "Ciasteczka:<br>";
foreach ($_COOKIE as $key => $value) {
    echo "$key = $value <br>";
}

echo '<a href="test2u.php">Przejdź do test2u.php</a>';
?>
