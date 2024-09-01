<?php
$tytul = "Galeria";
$zawartosc = '<h2><br />Moja galeria</h2>';
$zawartosc .= '<div class="galeria">';
$zawartosc .= '<h4>';

for ($i = 1; $i <= 10; $i++) {
    $zawartosc .= '<a href="zdjecia/obraz' . $i . '.jpg" target="_blank"><img class="thumbnail" src="miniaturki/obraz' . $i . '.jpg" /></a>';
}
$zawartosc .= '</h4>';
$zawartosc .= '</div>';
?>
