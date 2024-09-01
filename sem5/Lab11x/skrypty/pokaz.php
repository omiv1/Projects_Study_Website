<?php
include_once "../klasy/Baza.php";
$bd = new Baza("localhost", "root", "", "klienci");
echo $bd->select("select nazwisko,wiek,panstwo,email,zamowienie,metoda from klienci", ["nazwisko","wiek","panstwo","email","zamowienie","metoda"]);