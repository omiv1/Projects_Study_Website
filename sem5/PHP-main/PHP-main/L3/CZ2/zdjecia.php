<?php
if (isset($_POST['zapisz']) && $_POST['zapisz'] == 'Zapisz' &&//Sprawdz czy dane zostaly przeslane
!isset($_GET['pic'])) { //Sprawdz czy zostal przeslany parametr o nazwie pic ( bedzie potrzebny do generowania linkow do zdjec)
    if (is_uploaded_file($_FILES['zdjecie']['tmp_name'])) { //!Sprawdzamy czy typ pliku jest zgodny z zalozeniami i czy zostal przeslany
        $typ = $_FILES['zdjecie']['type'];
        if ($typ === 'image/jpeg') { //!
            $filename = $_FILES['zdjecie']['name'];
            $filedestination = 'zdjecia/' . $filename;
            move_uploaded_file($_FILES['zdjecie']['tmp_name'], $filedestination); //Zapisujemy wgrane zdjecie w odpowiednim katalogu

$link = $filedestination;//Link do naszego zdjecia
$random = uniqid('img_'); //wygenerowanie losowej wartości
$zdj= $random . '.jpg';
copy($link, './' . $zdj); //utworzenie kopii zdjęcia
list($width, $height) = getimagesize($zdj); //pobranie rozmiarów obrazu
$wys = $_POST['wys']; //wysokość preferowana przez użytkownika
$szer = $_POST['szer']; //szerokość preferowana przez użytkownika
$skalaWys = 1;
$skalaSzer = 1;
$skala = 1;
if ($width > $szer) $skalaSzer = $szer / $width;
if ($height > $wys) $skalaWys = $wys / $height;
if ($skalaWys <= $skalaSzer) $skala = $skalaWys;
else $skala = $skalaSzer;

//ustalenie rozmiarów miniaturki tworzonego zdjęcia:
$newH = $height * $skala;
$newW = $width * $skala;
header('Content-Type: image/jpeg');//Sygnalizujemy przegladarce odpowiedni typ danych na wyjsciu
$nowe = imagecreatetruecolor($newW, $newH); //Utworz plik graficzny wypelniony kolorem czarnym o wymiarach miniatury 
$obraz = imagecreatefromjpeg($zdj);//Pobierz zawartosc oryginalnego obrazu
imagecopyresampled($nowe, $obraz, 0, 0, 0, 0, $newW, $newH, $width, $height);//Kopiujemy zawartosc pobrana w calosci do pliku o wymiarach miniatury 
imagejpeg($nowe, 'miniatury/mini-' .    $filename, 100);//Zapisujemy plik na serwerze
//echo "nowe=/mini-$link <br>";
imagedestroy($nowe);//Usuwamy czarny obraz
imagedestroy($obraz);//Usuwamy zawartosc oryginalnego zdjecia
unlink($zdj);//Usuwamy kopie utworzonego obrazu

$dlugosc = strlen($link);
$dlugosc -= 4;
$link = substr($link, 0, $dlugosc);
echo "link=$link <br/>";
header('location:zdjecia.php?pic='.$link);
}
else {
header('location:zdjecia.html');
} 
}
}
if (isset($_GET['pic']) && !empty($_GET['pic']))
 {
 echo '<a href="' . $_GET['pic'] . '.jpg">Zdjęcie</a><br/>';
 echo '<a href="miniatury/mini-' . str_replace('zdjecia/', '', $_GET['pic']) . '.jpg">Miniatura</a><br/><br/>';//Str usuwa zdjecia/
 echo '<h2>Galeria zdjec:</h2>';
 $dir_name = "miniatury/";
 $dir2_name = "zdjecia/";
 $miniatury = glob($dir_name."*");//Glob zwraca pliki w folderze o  rozszerzeniu w cudzyslowi ale u nas sa tylko zdj wiec dowolny znak
 $zdjecia = glob($dir2_name."*");
    for ($i=0; $i<count($miniatury); $i++)
      {
        $miniatura = $miniatury[$i];
        $zdjecie = $zdjecia[$i];
        echo '<a href="'.$zdjecie.'"><img src="'.$miniatura.'" style="height: 150px; width: 150px; \n"  /> </a>';
      }
      $ile = count($zdjecia);
      echo '</br>';
      echo "<b>W galerii jest aktualnie $ile zdjęć</b> "; 
      echo '</br>';
      echo '<a href="zdjecia.html"><u>Powrót do formularza dodawania zdjec</u></a>';
 }
?>