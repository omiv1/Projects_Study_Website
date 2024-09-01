<?php
include_once "Baza.php";
$db = new Baza('localhost', 'root', '', 'klienci');
$pass= password_hash('RL9', PASSWORD_DEFAULT);
$date=date("Y-m-d H:i:s");
$sql = "INSERT INTO users VALUES(NULL, 'RL9','Robert Lewandowski', 'rl9@gmail.com', '$pass' , '1' , '$date')";
$db->insert($sql);
$pass= password_hash('LM10', PASSWORD_DEFAULT);
$date=date("Y-m-d");
$sql = "INSERT INTO users VALUES (NULL, 'LM10','Lionel Messi','lm10@gmail.com', '$pass' , '1', '$date')";
$db->insert($sql);
$pass= password_hash('CR7', PASSWORD_DEFAULT);
$date=date("Y-m-d");
$sql = "INSERT INTO users VALUES (NULL, 'CR7', 'Cristiano Ronaldo','cr7@gmail.com', '$pass' , '1', '$date')";
$db->insert($sql);
?>