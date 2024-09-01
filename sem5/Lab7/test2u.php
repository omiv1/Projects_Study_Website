<?php
include_once('klasy/User.php');
session_start();

echo "ID Sesji: " . session_id() . "<br>";

if (isset($_SESSION['user'])) {
    $user = unserialize($_SESSION['user']);

    echo "Właściwości obiektu user:<br>";
    echo "Username: " . $user->getUsername() . "<br>";
    echo "Fullname: " . $user->getFullname() . "<br>";
    echo "Email: " . $user->getEmail() . "<br>";
    echo "Status: " . $user->getStatus() . "<br>";
} else {
    echo "Brak obiektu user w sesji.<br>";
}

session_destroy();
echo "Sesja usunięta.<br>";

echo '<a href="test1u.php">Powrót do test1u.php</a>';
?>
