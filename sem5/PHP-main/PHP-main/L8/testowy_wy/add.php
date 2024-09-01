<?php
include_once "Baza.php";
$db = new Baza('localhost', 'root', '', 'test');
$pass=hash('sha256', 'klient');
$sql = "insert into users values ('klient', '$pass' );";
$db->insert($sql);
$pass=hash('sha256', 'klient2');
$sql = "insert into users values ('klient2', '$pass' );";
$db->insert($sql);
?>