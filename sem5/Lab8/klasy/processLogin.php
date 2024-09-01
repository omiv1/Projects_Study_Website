<?php
include_once 'klasy/Baza.php';
include_once 'klasy/UserManager.php';

$db = new Baza("localhost", "root", "", "klienci");
$um = new UserManager();

if (filter_input(INPUT_GET, "akcja") == "wyloguj") 
{
    $um->logout($db);
}

if (filter_input(INPUT_POST, "zaloguj")) {
    $userId = $um->login($db);

    if ($userId > 0) {
        echo "<p>Poprawne logowanie.<br />";
        echo "Zalogowany użytkownik o id=$userId <br />";
        echo "<a href='processLogin.php?akcja=wyloguj'>Wyloguj</a></p>";
    } else {
        echo "<p>Błędna nazwa użytkownika lub hasło</p>";
        $um->loginForm();
    }
} else {
    $um->loginForm();
}
?>
