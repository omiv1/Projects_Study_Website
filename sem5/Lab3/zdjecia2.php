<?php
if (isset($_POST['zapisz']) && $_POST['zapisz'] == 'Zapisz' && !isset($_GET['pic'])) {
    if (is_uploaded_file($_FILES['zdjecie']['tmp_name'])) {
        $typ = $_FILES['zdjecie']['type'];
        if ($typ === 'image/jpeg') {
            $link = $_FILES['zdjecie']['name'];
            move_uploaded_file($_FILES['zdjecie']['tmp_name'], './zdjecia/' . $link); // Zapisz oryginalne zdjecie do katalogu "zdjecia"
            list($width, $height) = getimagesize('zdjecia/' . $link); // Pobierz rozmiary zapisanego zdjecia

            $wys = $_POST['wys'];
            $szer = $_POST['szer'];
            $skalaWys = 1;
            $skalaSzer = 1;
            $skala = 1;
            if ($width > $szer) $skalaSzer = $szer / $width;
            if ($height > $wys) $skalaWys = $wys / $height;
            if ($skalaWys <= $skalaSzer) $skala = $skalaWys;
            else $skala = $skalaSzer;
            $newH = $height * $skala;
            $newW = $width * $skala;
            header('Content-Type: image/jpeg');
            $nowe = imagecreatetruecolor($newW, $newH);
            $obraz = imagecreatefromjpeg('zdjecia/' . $link); // Wczytaj oryginalne zdjecie
            imagecopyresampled($nowe, $obraz, 0, 0, 0, 0, $newW, $newH, $width, $height);
            imagejpeg($nowe, './miniatury/mini-' . $link, 100); // Zapisz miniature do katalogu "miniatury"
            echo "nowe=miniatury/mini-$link <br>";
            imagedestroy($nowe);
            imagedestroy($obraz);

            echo "link=$link <br/>";
            header('location:zdjecia2.php?pic=' . $link);
        } else {
            header('location: index.html');
        }
    }
} elseif (isset($_GET['pic']) && !empty($_GET['pic'])) {
    echo '<a href="zdjecia/' . $_GET['pic'] . '">Zdjecie</a><br/>';
    echo '<a href="miniatury/mini-' . $_GET['pic'] . '">Miniatura</a><br/><br/>';
    echo '<a href="zdjecia2.html">Powrot</a>';
}
?>