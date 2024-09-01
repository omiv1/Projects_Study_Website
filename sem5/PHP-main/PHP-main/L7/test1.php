<?php
include_once("user.php");
$u = new User('Leo', 'Leonardo da vinci', 'leo@gmail.com', 'haslo');
$u->setStatus(2);
session_start();
$_SESSION['user'] = serialize($u);
echo '<b> ID Sesji: </bd><p></b>';
echo session_id();
echo '<hr>';
echo "<p>";
foreach($_SESSION AS $key => $value) {
    echo "<p>  $key -> $value";
  }
  echo "<p>";
  echo '<hr>';
  echo '<b> Ciasteczka: </bd><p></b>';
foreach($_COOKIE AS $key => $value) {
    echo "<p> $key -> $value <p>";
  }
  echo '<hr>';
echo '<a href="test2.php">Test 2</a>';
?>