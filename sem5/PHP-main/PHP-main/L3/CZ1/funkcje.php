<?php
function dodaj() {
 $dane = "";
 if (isset($_REQUEST["Nazwisko"])) {
 $dane .= htmlspecialchars($_REQUEST['Nazwisko'])." ";
 }
 if (isset($_REQUEST["age"])) {
    $dane .= htmlspecialchars($_REQUEST['age'])." ";
    }
 if (isset($_REQUEST["Kraje"])) {
     $dane .= htmlspecialchars($_REQUEST['Kraje'])." ";
    }
    if (isset($_REQUEST["e-mail"])) {
        $dane .= htmlspecialchars($_REQUEST['e-mail'])." ";
    }
    foreach($_REQUEST['jezyki'] as $j)
    {
        $dane = $dane . $j . ",";
    }
    if (isset($_REQUEST["przegladarka"])) {
        $dane .= htmlspecialchars($_REQUEST['przegladarka'])." ";
    }
    $dane .= "\n";
    $d_root = $_SERVER['DOCUMENT_ROOT']; 
    $plik = fopen("$d_root/../pliki/dane.txt","a+");
    fwrite($plik,$dane);
    fclose($plik);
}
function pokaz() {
    $d_root = $_SERVER['DOCUMENT_ROOT']; 
    $plik = fopen("$d_root/../pliki/dane.txt", "r+");
    while(!feof($plik))
    {
        echo fgets($plik) . "<br/>";

    }
    fclose($plik);
}
function pokaz_zamowienie($tut) {
    $d_root = $_SERVER['DOCUMENT_ROOT']; 
    $plik = fopen("$d_root/../pliki/dane.txt","r+");
    while(!feof($plik))
    {
        $line = fgets($plik);
        if(str_contains($line, $tut.",")) echo $line."<br/>";

    }
    fclose($plik);
}
?>