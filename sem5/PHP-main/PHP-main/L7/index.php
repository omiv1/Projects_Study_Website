<?php
 include_once('user.php');
 include_once('RegistrationForm.php');
 include_once('Baza.php');
 $rf = new RegistrationForm(); //wyświetla formularz rejestracji
 if (filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) 
    {
        $user = $rf->checkUser(); //sprawdza poprawność danych
        if ($user === NULL)
        {
            echo "<p>Niepoprawne dane rejestracji.</p>";
        }
        else
        {
            echo "<p>Poprawne dane rejestracji:</p>";
            $db = new Baza("localhost", "root", "", "klienci");
            echo '<br/>';
            $user->saveDB($db);
            echo "<b>Wyswietlam wszystkich uzytkownikow z bazy danych</b>";
            echo '<br/>';
            User::getAllUsersFromDb($db);
        }
    }