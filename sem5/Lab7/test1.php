<?php
session_start();
$_SESSION['username'] = 'kubus';
$_SESSION['fullname'] = 'Kubus Puchatek';
$_SESSION['email'] = 'kubus@stumilowylas.pl';
$_SESSION['status'] = 'ADMIN';

// Wyświetl id sesji
echo "Session ID: " . session_id() . "<br>";

// Wyświetl wszystkie zmienne sesji
echo "Session Variables:<br>";
foreach ($_SESSION as $key => $value) {
    echo "$key: $value<br>";
}

// Wyświetl ciasteczka skojarzone z domeną localhost
echo "Ciasteczka:<br>";
foreach ($_COOKIE as $key => $value) {
    echo "$key: $value<br>";
}

// Link do test2.php
echo '<a href="test2.php">Przejdź do test2.php</a>';
?>
