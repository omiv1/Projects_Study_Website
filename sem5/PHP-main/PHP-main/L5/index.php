<?php
 include_once('klasy/user.php');
 include_once('klasy/RegistrationForm.php');
 $rf = new RegistrationForm(); //wyświetla formularz rejestracji
 if (filter_input(INPUT_POST, 'submit',
FILTER_SANITIZE_FULL_SPECIAL_CHARS)) {
 $user = $rf->checkUser(); //sprawdza poprawność danych
 if ($user === NULL)
 echo "<p>Niepoprawne dane rejestracji.</p>";
 else{
 echo "<p>Poprawne dane rejestracji:</p>";
 $user->show();
 $user->save("users.json");
 echo "<b>Wyswietlam wszystkich uzytkownikow z pliku JSON</b>";
 $user->getAllUsers("users.json");
 $user->saveXML();
 echo "<b>Wyswietlam wszystkich uzytkownikow z pliku XML</b>";
 User::getAllUsersFromXML();
 }
 }