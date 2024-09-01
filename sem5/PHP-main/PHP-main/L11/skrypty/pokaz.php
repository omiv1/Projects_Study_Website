<?php
include_once "../klasy/Baza.php";
$bd = new Baza("localhost", "root", "", "klienci");
echo $bd->select("select * from klienci",["Email", "Zamowienie"]);