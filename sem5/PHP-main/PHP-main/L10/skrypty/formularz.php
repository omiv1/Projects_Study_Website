<?php
function drukuj_form() {
 $zawartosc = '<div id="tresc"> 
 <form action="?strona=formularz" method="POST" >
 <table>
 <tr><td><label for ="nazwisko">Nazwisko :</label></td> <td><input id="nazwisko" type="text" name="Nazwisko"/></td></tr> 
 <tr><td><label for ="age">Wiek:</label></td> <td><input id="age" type="text" name="age"/></td></tr>
 <tr><td>Państwo: </td> <td>
     <select name="Kraje">
         <option value="Polska">Pl</option>
         <option value="Niemcy">Deu</option>
         <option value="Anglia">Ang</option>
       </select>
     </td></tr> 
 <tr><td><label for ="e-mail"> Adres e-mail: </label></td><td><input id="e-mail" type="text" name="e-mail"/></td></tr> 
</table>
<b>Zamawiam tutorial z języka: </b><br />
<br/>

<input type="checkbox" name="jezyki[]" value="PHP" /> PHP
<input type="checkbox" name="jezyki[]" value="C" /> C
<input type="checkbox" name="jezyki[]" value="Java" /> Java <br />
<b>Sposób zapłaty: </b> <br />
<br/>
<input type="radio" name="radioboxy" value="Master Card" /> Master Card 
<input type="radio" name="radioboxy" value="Visa" /> Visa
<input type="radio" name="radioboxy" value="Przelew" />
Przelew<br />
<input type="reset" name="submit" value="Wyczyść" />
<input type="submit" name="submit" value="Dodaj" />
<input type="submit" name="submit" value="Pokaż" />
<br/>
</form>
</div> ';
return $zawartosc;
}
function dodajdoBD($bd){
    $args = 
    ['Nazwisko' => ['filter' => FILTER_VALIDATE_REGEXP,'options' => ['regexp' => '/^[A-Z]{1}[a-ząęłńśćźżó-]{1,25}$/']],
    'Kraje' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    'age' => FILTER_VALIDATE_INT,
    'e-mail' => FILTER_VALIDATE_EMAIL,
     'radioboxy' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    ];
    //przefiltruj dane z GET/POST zgodnie z ustawionymi w $args filtrami:
   $dane = filter_input_array(INPUT_POST, $args);
   //pokaż tablicę po przefiltrowaniu - sprawdź wyniki filtrowania:
   //var_dump($dane);
   //Sprawdź czy dane w tablicy $dane nie zawierają błędów walidacji:
   $errors = "";
   foreach ($dane as $key => $val) {
   if ($val === false or $val === NULL) {
   $errors .= $key . " ";
   }
   }
   if ($errors === "") {
     $nazw = $dane['Nazwisko'];
     $wiek = $dane['age'];
     $kraj = $dane['Kraje'];
     $email = $dane['e-mail'];
     $jezykii = implode(",",$_POST['jezyki']);
     $zap = $dane['radioboxy'];
     $sql ="INSERT INTO klienci VALUES (NULL, '$nazw', '$wiek', '$kraj', '$email', '$jezykii', '$zap')";
     $bd->insert($sql);
  } else {
         echo "<br>Nie poprawne dane: " . $errors;
}
}   
include_once "klasy/Baza.php";
$tytul = "Formularz zamowienia";
$zawartosc = drukuj_form();
$bd = new Baza("localhost", "root", "", "klienci");
if (filter_input(INPUT_POST, "submit")) 
{
 $akcja = filter_input(INPUT_POST, "submit");
 switch ($akcja) {
    case "Dodaj" : $zawartosc.= dodajdoBD($bd); break;
    case "Pokaż" : $zawartosc.= $bd->select("select * from klienci",["Email", "Zamowienie"]);break;
 }
}

