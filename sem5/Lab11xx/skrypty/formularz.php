<h1>Formularz zamowienia</h1>
<div id="data">
    <div>
    <?php
    //    include_once "../klasy/Baza.php";
    //    $bd = new Baza("localhost", "root", "", "klienci");
    //     function walidacja() {
    //         $args = [
    //             'Nazwisko' => ['filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '/^[A-Z]{1}[a-ząęłńśćźżó-]{1,25}$/']],
    //                 'age' => ['filter' => FILTER_VALIDATE_INT, 'options' => ['min_range' => 1, 'max_range' => 120]],
    //                 'Kraje' => ['filter' => FILTER_SANITIZE_STRING],
    //                 'jezyki' => ['filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_REQUIRE_ARRAY],
    //                 'email' => ['filter' => FILTER_VALIDATE_EMAIL],
    //         ];
    //         $dane = filter_input_array(INPUT_POST, $args);
    //         $errors = "";
    //         foreach ($dane as $key => $val) {
    //             if ($val === false or $val === NULL) $errors .= $key . " ";
    //         }
    //         if ($errors === "") {
    //             return true;
    //         }
    //         else {
    //             echo '<br>Niepoprawne dane: ' . $errors;
    //             return false;
    //         }
    //     }
    //     // Add to DB
    //     function dodajdoBD($bd) {
    //         if (walidacja()) {
    //             $args = [
    //                 'Nazwisko' => ['filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '/^[A-Z]{1}[a-ząęłńśćźżó-]{1,25}$/']],
    //                 'age' => ['filter' => FILTER_VALIDATE_INT, 'options' => ['min_range' => 1, 'max_range' => 120]],
    //                 'Kraje' => ['filter' => FILTER_SANITIZE_STRING],
    //                 'jezyki' => ['filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_REQUIRE_ARRAY],
    //                 'email' => ['filter' => FILTER_VALIDATE_EMAIL],
    //                 'radioboxy' => ['filter' => FILTER_SANITIZE_STRING]
    //             ];
    //             $dane = filter_input_array(INPUT_POST, $args);
    //             $nazw = $dane['Nazwisko'];
    //             $wiek = $dane['age'];
    //             $kraj = $dane['Kraje'];
    //             $email = $dane['email'];
    //             $zap = $dane['radioboxy'];
    //             $jezykii = (implode(",", $dane['jezyki']));
    //             $sql ="INSERT INTO klienci VALUES (NULL, '$nazw', '$wiek', '$kraj', '$email', '$jezykii', '$zap')";
    //             //var_dump($dane);
    //             $bd->insert($sql);
    //             echo '<h1>Dodałeś Dane do bazy danych z użyciem Ajaxa!<h1>';
    //         }
    //     }
    //     // No Submission
    //     if (count($_REQUEST) == 0) {
    //         echo '<span>Formularz AJAX</span>';
    //     }
    //     // Submitted
    //     else {
    //         echo '<span>AJAX wysłał dane</span>';
    //         dodajdoBD($bd);
    //     }
    
    ?>
    </div>
    Nazwisko: <input type="text" name="Nazwisko" id="Nazwisko" /> <br />
    Wiek: <input type="text" name="age" id="age" /> <br />
    Państwo:
    <select name="Kraje" id="Kraje">
        <option value="Polska">Polska</option>
        <option value="Niemcy">Nimecy</option>
        <option value="Czechy">Czechy</option>
        <option value="Slowacja">Słowacja</option>
        <option value="Ukraina">Ukraina</option>
        <option value="Bialorus">Białoruś</option>
    </select> <br />
    Adres e-mail: <input name="email" type="text" id="email" /> <br />
    Zamawiam tutorial z języka:<br />
    <input type="checkbox" name="jezyki[]" value="PHP" /> PHP
    <input type="checkbox" name="jezyki[]" value="CPP" /> Cpp
    <input type="checkbox" name="jezyki[]" value="Java" /> Java <br />
    Sposób zapłaty: <br />
    <input type="radio" name="radioboxy" value="Visa" checked/> Visa
    <input type="radio" name="radioboxy" value="Master Card" /> Master Card 
    <input type="radio" name="radioboxy" value="Przelew" /> Przelew bankowy <br />
    <input id="button-submit" type="button" onclick="dodaj()" value="Dodaj" />
    <input id="button-show" type="button" onclick="pokaz()" value="Pokaz" />
    <span id="js-errors"></span>
    <div id="database-display"> </div>
</div>