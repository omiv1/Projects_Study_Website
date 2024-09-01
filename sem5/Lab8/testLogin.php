<?php
include_once 'klasy/Baza.php';
include_once 'klasy/UserManager.php';


$db = new Baza("localhost", "root", "", "klienci");
$um = new UserManager();

session_start();
if (isset($_SESSION['user_id']) && $um->getLoggedInUser($db,$_SESSION['user_id'], session_id()) == 1) 
{
        $userId = $_SESSION['user_id'];
        echo "<p>Poprawne logowanie.<br />";
        echo "Zalogowany użytkownik o id=$userId <br />";
        echo '<form action="testLogin.php" method="post">
                    <input type="submit" value="Wyloguj" name="wyloguj" />
                </form></p>';
} else {
    header("Location: processLogin.php");
}


if (filter_input(INPUT_POST, "wyloguj")) {
    $um->logout($db);
    header("Location: processLogin.php");
}
?>
