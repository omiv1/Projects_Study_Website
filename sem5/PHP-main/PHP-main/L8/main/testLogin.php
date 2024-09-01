<?php
 include_once 'Baza.php';
 include_once 'user.php';
 include_once 'UserManager.php';
 include_once('RegistrationForm.php');
 $db = new Baza("localhost", "root", "", "klienci");
 $um = new UserManager();
 session_start();
 $IdUser=$um->getLoggedInUser($db, session_id());
 if($IdUser != -1 )
 {
    echo "<a href='processLogin.php?akcja=wyloguj'> Wyloguj</a> </p>";
    echo "<h3>Dane zalogowanego użytkownika: </h3>";
    echo $db->select("select id,userName,fullName, email from users where id = $IdUser", ["id","userName","fullName","email"]);
    echo "<h3>I inne informacje dla zalogowanego użytkownika...: </h3>";
 }
else
{
    $um->loginForm();
}
?>