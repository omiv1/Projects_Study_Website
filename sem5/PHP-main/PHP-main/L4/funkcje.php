<?php
function dopliku($nazwaPliku, $tablicaDanych) {
    $dane = "";
    foreach($tablicaDanych as $key => $val)
    {
        if(is_array($val))
        {
            $dane .= (implode(", ", $val)) . ', ';
        }
        else
        {
        $dane .= $val . ', ' ;
        }
    }
    $dane .= PHP_EOL; //dodaj koniec linii za pomocą stałej PHP
    //wykonaj operacje zapisu do pliku o zadanej nazwie:
    $plik = fopen($nazwaPliku, "a+" );
    fwrite($plik,$dane);
    fclose($plik);
    echo "<p>Zapisano: <br /> $dane</p>";
   }
function walidacja() {
    $args = 
     ['Nazwisko' => ['filter' => FILTER_VALIDATE_REGEXP,'options' => ['regexp' => '/^[A-Z]{1}[a-ząęłńśćźżó-]{1,25}$/']],
     'Kraje' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
     'age' => FILTER_VALIDATE_INT,
     'e-mail' => FILTER_VALIDATE_EMAIL,
      'jezyki' => ['filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'flags' =>FILTER_REQUIRE_ARRAY],
     ];
     //przefiltruj dane z GET/POST zgodnie z ustawionymi w $args filtrami:
    $dane = filter_input_array(INPUT_POST, $args);
    //pokaż tablicę po przefiltrowaniu - sprawdź wyniki filtrowania:
    var_dump($dane);
    //Sprawdź czy dane w tablicy $dane nie zawierają błędów walidacji:
    $errors = "";
    foreach ($dane as $key => $val) {
    if ($val === false or $val === NULL) {
    $errors .= $key . " ";
    }
    }
    if ($errors === "") {
        //Dane poprawne - zapisz do pliku
        //wykorzystaj pomocniczą funkcję:
        dopliku("dane.txt", $dane);
   } else {
          echo "<br>Nie poprawne dane: " . $errors;
}
}
function dodaj() {
    echo "<h3>Dodawanie do pliku:</h3>";
    walidacja();
}
function pokaz() {
    $plik = fopen("dane.txt", "r+");
    while(!feof($plik))
    {
        echo fgets($plik) . "<br/>";

    }
    fclose($plik);
}
function pokaz_zamowienie($tut) {
   $plik = fopen("dane.txt", "r+");
    while(!feof($plik))
    {
        $line = fgets($plik);
        if(str_contains($line, $tut.",")) echo $line."<br/>";

    }
    fclose($plik);
}
function statystyki()
{
    $plik = fopen("dane.txt", "r+");
    $l18 = 0;
    $me50 = 0 ;
    $liczbazam = 0;
    while(!feof($plik))
    {
        $line = fgets($plik);
        if($line !="")
        {
            $liczbazam++;
            $liniaexplode = explode(",",$line);
            if($liniaexplode[2]<18)
            {
                $l18++;
            }
            if($liniaexplode[2]>=50)
            {
                $me50++;
            }
        }
    }
    fclose($plik);
    echo "<br>Liczba wszystkich zamowien: " . $liczbazam;
    echo "<br>Liczba zamowien od osob w wieku <18 lat: " . $l18;
    echo "<br>Liczba zamowien od osob w wieku >=50 lat: " . $me50;
}
?>