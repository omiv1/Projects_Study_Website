<?php
if (isset($_POST['zapisz']) && $_POST['zapisz'] == 'Zapisz' && !isset($_GET['pic'])) {
    if (is_uploaded_file($_FILES['zdjecie']['tmp_name'])) {
        $typ = $_FILES['zdjecie']['type'];
        if ($typ === 'image/jpeg') {
            $link = $_FILES['zdjecie']['name'];
            move_uploaded_file($_FILES['zdjecie']['tmp_name'], './' . $link);
            list($width, $height) = getimagesize($link);
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
            $obraz = imagecreatefromjpeg($link);
            imagecopyresampled($nowe, $obraz, 0, 0, 0, 0, $newW, $newH, $width, $height);
            imagejpeg($nowe, './mini-' . $link, 100);
            echo "nowe=mini-$link <br>";
            imagedestroy($nowe);
            imagedestroy($obraz);

            echo "link=$link <br/>";
            header('location:zdjecia.php?pic=' . $link);
        } else {
            header('location: index.html');
        }
    }
} elseif (isset($_GET['pic']) && !empty($_GET['pic'])) {
    echo '<a href="' . $_GET['pic'] . '">Zdjęcie</a><br/>';
    echo '<a href="mini-' . $_GET['pic'] . '">Miniatura</a><br/><br/>';
    echo '<a href="zdjecia.html">Powrót</a>';
}
?>