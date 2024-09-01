<?php
include_once "../klasy/Baza.php";
$bd = new Baza("localhost", "root", "", "klienci");
//if (isset($_POST['button-submit'])) {
$args = 
    ['Nazwisko' => ['filter' => FILTER_VALIDATE_REGEXP,'options' => ['regexp' => '/^[A-Z]{1}[a-ząęłńśćźżó-]{1,25}$/']],
    'Kraje' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    'age' => FILTER_VALIDATE_INT,
    'email' => FILTER_VALIDATE_EMAIL,
    'jezyki' => ['filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'flags' =>FILTER_REQUIRE_ARRAY],
     'radioboxy' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    ];
  
   $dane = filter_input_array(INPUT_POST, $args);
   $errors = "";
   var_dump($dane);
   foreach ($dane as $key => $val) {
   if ($val === false or $val === NULL) {
   $errors .= $key . " ";
   }
   }
   if ($errors === "") {
     $nazw = $dane['Nazwisko'];
     $wiek = $dane['age'];
     $kraj = $dane['Kraje'];
     $email = $dane['email'];
     $zap = $dane['radioboxy'];
     $jezykii = (implode(",", $dane['jezyki']));
     $sql ="INSERT INTO klienci VALUES (NULL, '$nazw', '$wiek', '$kraj', '$email', '$jezykii', '$zap')";
     var_dump($dane);
     $bd->insert($sql);
     echo '<h1>Dodałeś Dane do bazy danych z użyciem Ajaxa!<h1>';
     echo "<a href='../index.php'> Powrot</a> </p>";
  } else {
         echo "<br>Nie poprawne dane: " . $errors;
  }
//}
//else {
   // $wynik = $bd->select("select * from klienci",["Email", "Zamowienie"]);
   // echo "<h4>$wynik</h4>";
//}