<?php
function dodajdoBD($bd){
    $args = 
    ['Nazwisko' => ['filter' => FILTER_VALIDATE_REGEXP,'options' => ['regexp' => '/^[A-Z]{1}[a-ząęłńśćźżó-]{1,25}$/']],
    'Kraje' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    'age' => FILTER_VALIDATE_INT,
    'e-mail' => FILTER_VALIDATE_EMAIL,
     'jezyki' => ['filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'flags' =>FILTER_REQUIRE_ARRAY],
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
     $jezykii = (implode(",", $dane['jezyki']));
     $zap = $dane['radioboxy'];
     $sql ="INSERT INTO klienci VALUES (NULL, '$nazw', '$wiek', '$kraj', '$email', '$jezykii', '$zap')";
     $bd->insert($sql);
     var_dump($dane);
  } else {
         echo "<br>Nie poprawne dane: " . $errors;
}
}   
?>