<?php
require_once("klasy/Strona.php");
$strona_akt = new Strona();
//dołącz plik z ustawioną zmienną $tytul i $zawartosc
$plik = "skrypty/glowna.php";
if (file_exists($plik)) {
 include($plik);
 $strona_akt->ustaw_tytul($tytul);
 $strona_akt->ustaw_zawartosc($zawartosc);
 $strona_akt->wyswietl();
}
