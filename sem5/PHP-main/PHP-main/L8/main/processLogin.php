<?php
 include_once 'Baza.php';
 include_once 'user.php';
 include_once 'UserManager.php';
 include_once('RegistrationForm.php');
 $db = new Baza("localhost", "root", "", "klienci");
 $um = new UserManager();

 //parametr z GET – akcja = wyloguj
 if (filter_input(INPUT_GET, "akcja")=="wyloguj") 
    {
        $um->logout($db);
    }

 //kliknięto przycisk submit z name = zaloguj
 if (filter_input(INPUT_POST, "zaloguj")) 
    {
        $userId=$um->login($db); //sprawdź parametry logowania

                    if ($userId > 0) 
                        {
                            echo "<p>Poprawne logowanie.<br />";
                            echo "Zalogowany użytkownik o id=$userId <br />";
                            //pokaż link wyloguj lub przekieruj
                            // użytkownika na inną stronę dla zalogowanych
                            header("location:testLogin.php");
                        } 
                    else if($userId == -1) 
                        {
                            $sql = "SELECT userId FROM logged_in_users WHERE userid= -1";
                            if ($result = $db->getMysqli()->query($sql)) 
                            {
                                    $row = $result->fetch_object();
                                    if($row != NULL)
                                    {
                                        $sql = "DELETE FROM logged_in_users WHERE userId = -1";
                                        $db->delete($sql);
                                        echo "Wprowadz jakies dane!";
                                        $um->loginForm();
                                    }
                                    else
                                    {
                                        echo "Uzytkownik jest już zalogowany!";
                                        $um->loginForm();
                                    }
                            }
                        } 
                    else
                    {
                        $um->loginForm(); //Pokaż formularz logowania
                    }
    }
        else 
        {
            $um->loginForm();
         }
 ?>
