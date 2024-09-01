<?php
// include_once "../klasy/Baza.php";
// $bd = new Baza("localhost", "root", "", "klienci");
// if (isset($_POST['button-submit'])) {
// $args = 
//     ['Nazwisko' => ['filter' => FILTER_VALIDATE_REGEXP,'options' => ['regexp' => '/^[A-Z]{1}[a-ząęłńśćźżó-]{1,25}$/']],
//     'Kraje' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
//     'age' => FILTER_VALIDATE_INT,
//     'email' => FILTER_VALIDATE_EMAIL,
//     'jezyki' => ['filter' => FILTER_SANITIZE_FULL_SPECIAL_CHARS, 'flags' =>FILTER_REQUIRE_ARRAY],
//      'radioboxy' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
//     ];
  
//    $dane = filter_input_array(INPUT_POST, $args);
//    $errors = "";
//    var_dump($dane);
//    foreach ($dane as $key => $val) {
//    if ($val === false or $val === NULL) {
//    $errors .= $key . " ";
//    }
//    }
//    if ($errors === "") {
//      $nazw = $dane['Nazwisko'];
//      $wiek = $dane['age'];
//      $kraj = $dane['Kraje'];
//      $email = $dane['email'];
//      $zap = $dane['radioboxy'];
//      $jezykii = (implode(",", $dane['jezyki']));
//      $sql ="INSERT INTO klienci VALUES (NULL, '$nazw', '$wiek', '$kraj', '$email', '$jezykii', '$zap')";
//      var_dump($dane);
//      $bd->insert($sql);
//      echo '<h1>Dodałeś Dane do bazy danych z użyciem Ajaxa!<h1>';
//      echo "<a href='../index.php'> Powrot</a> </p>";
//   } else {
//          echo "<br>Nie poprawne dane: " . $errors;
//  }
// }
//else {
   // $wynik = $bd->select("select * from klienci",["Email", "Zamowienie"]);
   // echo "<h4>$wynik</h4>";
//}
       include_once "/klasy/Baza.php";
       $bd = new Baza("localhost", "root", "", "klienci");
        function walidacja() {
            $args = [
                'Nazwisko' => ['filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '/^[A-Z]{1}[a-ząęłńśćźżó-]{1,25}$/']],
                    'age' => ['filter' => FILTER_VALIDATE_INT, 'options' => ['min_range' => 1, 'max_range' => 120]],
                    'Kraje' => ['filter' => FILTER_SANITIZE_STRING],
                    'jezyki' => ['filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_REQUIRE_ARRAY],
                    'email' => ['filter' => FILTER_VALIDATE_EMAIL],
            ];
            $dane = filter_input_array(INPUT_POST, $args);
            $errors = "";
            foreach ($dane as $key => $val) {
                if ($val === false or $val === NULL) $errors .= $key . " ";
            }
            if ($errors === "") {
                return true;
            }
            else {
                echo '<br>Niepoprawne dane: ' . $errors;
                return false;
            }
        }
        // Add to DB
        function dodajdoBD($bd) {
            if (walidacja()) {
                $args = [
                    'Nazwisko' => ['filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '/^[A-Z]{1}[a-ząęłńśćźżó-]{1,25}$/']],
                    'age' => ['filter' => FILTER_VALIDATE_INT, 'options' => ['min_range' => 1, 'max_range' => 120]],
                    'Kraje' => ['filter' => FILTER_SANITIZE_STRING],
                    'jezyki' => ['filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_REQUIRE_ARRAY],
                    'email' => ['filter' => FILTER_VALIDATE_EMAIL],
                    'radioboxy' => ['filter' => FILTER_SANITIZE_STRING]
                ];
                $dane = filter_input_array(INPUT_POST, $args);
                $nazw = $dane['Nazwisko'];
                $wiek = $dane['age'];
                $kraj = $dane['Kraje'];
                $email = $dane['email'];
                $zap = $dane['radioboxy'];
                $jezykii = (implode(",", $dane['jezyki']));
                $sql ="INSERT INTO klienci VALUES (NULL, '$nazw', '$wiek', '$kraj', '$email', '$jezykii', '$zap')";
                //var_dump($dane);
                $bd->insert($sql);
                echo '<h1>Dodałeś Dane do bazy danych z użyciem Ajaxa!<h1>';
            }
        }
        // No Submission
        if (count($_REQUEST) == 0) {
            echo '<span>Formularz AJAX</span>';
        }
        // Submitted
        else {
            echo '<span>AJAX wysłał dane</span>';
            dodajdoBD($bd);
        }
    
    ?>