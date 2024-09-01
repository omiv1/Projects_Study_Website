<?php
include_once("user.php");
session_start();
echo '<b> ID Sesji: </bd><p></b>';
echo session_id();
echo '<hr>';
echo "<p>";
$us=unserialize($_SESSION['user']);
echo '<p>'. "Name ->" . $us->getUserName() . '<p>';
echo '<p>'. "FullName ->". $us->getFullName() . '<p>';
echo '<p>'. "E-Mail ->" . $us->getEmail() . '<p>';
echo '<p>'. "Password - >" . $us->getPassword() . '<p>';
echo '<hr>';
echo '<b> Ciasteczka: </bd><p></b>';
  foreach($_COOKIE AS $key => $value) {
    echo "<p> $key -> $value <p>";
  }
  if ( isset($_COOKIE[session_name()]) ) {
    setcookie(session_name(),'', time() - 42000, '/'); //Usuwa sesje, nie tylko dane sesji
   }
  session_destroy();
  echo '<hr>';
echo '<a href="test1.php">Test 1</a>';
?>