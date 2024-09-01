<?php
session_start();

// Wyświetl id sesji i wszystkie zmienne sesji
echo "Session ID: " . session_id() . "<br>";
echo "Session Variables:<br>";
foreach ($_SESSION as $key => $value) {
    echo "$key: $value<br>";
}

// Usunięcie sesji
session_destroy();

// Link powrotny do test1.php
echo '<a href="test1.php">Powrót do test1.php</a>';
?>
