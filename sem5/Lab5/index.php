<?php
include_once('klasy/User.php');
include_once('klasy/RegistrationForm.php');
include_once('klasy/FileManager.php');

FileManager::createEmptyFiles();

$rf = new RegistrationForm();
if (filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
    $user = $rf->checkUser();
    if ($user === NULL) {
        echo "<p>Niepoprawne dane rejestracji.</p>";
    } else {
        echo "<p>Poprawne dane rejestracji:</p>";
        $user->save("users.json");
        $user->saveXML("users.xml");
        $user->show();
    }
}

echo "<h3>Lista użytkowników z pliku JSON</h3>";
var_dump(User::getAllUsers("users.json"));

echo "<h3>Lista użytkowników z pliku XML</h3>";
var_dump(User::getAllUsersFromXML("users.xml"));
?>
