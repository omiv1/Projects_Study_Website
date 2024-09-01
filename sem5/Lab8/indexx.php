<?php
include_once('klasy/User.php');
include_once('klasy/RegistrationForm.php');
include_once('klasy/FileManager.php');
include_once('klasy/baza.php');

$db = new Baza("localhost", "root", "", "klienci");
$rf = new RegistrationForm();
if (filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
    $user = $rf->checkUser($db);
    if ($user === NULL) {
        echo "<p>Niepoprawne dane rejestracji.</p>";
    } else {
        echo "<p>Poprawne dane rejestracji:</p>";
        
        $user->saveDB($db);
        //$bd->dodajdoBD($bd);
        $user->show();
    }
}

echo "<h3>Lista użytkowników z bazy danych</h3>";
echo User::getAllUsersFromDB($db);
?>
