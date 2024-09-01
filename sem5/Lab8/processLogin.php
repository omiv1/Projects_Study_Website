<?php
include_once 'klasy/Baza.php';
include_once 'klasy/UserManager.php';

$db = new Baza("localhost", "root", "", "klienci");
$um = new UserManager();


session_start();

if (isset($_SESSION['user_id']) && $um->getLoggedInUser($db,$_SESSION['user_id'], session_id()) == 1)
{
    header("location:testLogin.php");
}
else{
    if (filter_input(INPUT_POST, "zaloguj")) {
        $userId = $um->login($db);

        if ($userId > 0) {
            // echo "<p>Poprawne logowanie.<br />";
            // echo "Zalogowany użytkownik o id=$userId <br />";
            header("location:testLogin.php");
        
        } 
        if ($userId == 0)
        {
            echo '<form action="processLogin.php" method="post">
                    <input type="hidden" name="login" value="' . htmlspecialchars($_POST['login']) . '">
                    <input type="hidden" name="password" value="' . htmlspecialchars($_POST['password']) . '">
                    <input type="submit" value="Wyloguj" name="wyloguj" />
                </form>';
        }
        else {
            $um->loginForm();
        }
    } 
    else if (filter_input(INPUT_POST, "wyloguj")) {
        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $um->logout_e($db, $login, $password);
        $um->loginForm();
    }
    else {
        $um->loginForm();
    }
}
?>
