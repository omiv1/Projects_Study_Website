<?php
include_once 'Baza.php';
include_once 'user.php';
include_once 'UserManager.php';
include_once 'RegistrationForm.php';
$rf = new RegistrationForm(); //wyświetla formularz rejestracji
$db = new Baza("localhost", "root", "", "klienci");
if (filter_input(INPUT_POST, 'submit', FILTER_SANITIZE_FULL_SPECIAL_CHARS)) 
    {
        $user = $rf->checkUser();
        if ($user === NULL)
        {
            echo "<p>Niepoprawne dane rejestracji.</p>";
        }
        else
        {
            $sql = "SELECT userName FROM users WHERE userName= '".$rf->user->getUserName()."'";
                if ($result = $db->getMysqli()->query($sql)) 
                    {
                            $row = $result->fetch_object(); //pobierz rekord z użytkownikiem
                            if($row == NULL)
                            {
                                $rf->user->saveDB($db);
                            }
                            else
                            {
                                echo "Uzytkownik jest już zarejestrowany!";
                            }
                    }
                }
    }
?>