<?php
    function drukuj_form() {
        $zawartosc = '<div id="tresc" style="text-align:center; margin-top: 50px;">
            <form action="?strona=formularz" method="POST" style="display:inline-block; text-align:left;">
            <table >
            <tbody>
                <tr>
                    <td>Nazwisko:</td>
                    <td><input type="text" name="nazwisko"/></td>
                </tr>
                <tr>
                    <td>Wiek:</td>
                    <td><input type="number" name="wiek"/></td>
                </tr>
                <tr>
                    <td>Państwo:</td>
                    <td>
                        <select size="1" name="panstwo">
                        <option value="Polska">Polska</option>
                        <option value="Niemcy">Niemcy</option>
                        <option value="Francja">Francja</option>
                        <option value="Szwecja">Szwecja</option>
                        <option value="Czechy">Czechy</option>
                        </select></td>
                </tr>
                <tr>
                    <td>Adres e-mail:</td>
                    <td><input type="email" name="email"/></td>
                </tr>
            </tbody>
            </table>
            
            <br><b>Zamawiam tutorial z języka:</b><br><br>
            <input type="checkbox" name="jezyk[]" value="PHP" /> PHP
            <input type="checkbox" name="jezyk[]" value="C/C++" /> C/C++
            <input type="checkbox" name="jezyk[]" value="JavaScript" /> JavaScript
            <input type="checkbox" name="jezyk[]" value="Java" /> Java <br><br />
            
            <b>Sposób zapłaty:</b> <br><br/>
            <input type="radio" name="metoda" value="eurocard" /> eurocard
            <input type="radio" name="metoda" value="visa" /> visa
            <input type="radio" name="metoda" value="przelew" /> przelew bankowy <br>
            <input type="submit" name="submit" value="Wyczysc" />
            <input type="submit" name="submit" value="Dodaj" />
            <input type="submit" name="submit" value="Pokaz" />
            </form>
        </div>';
        return $zawartosc;
    }
    

function walidacja($dane) {
    $args = [
        'nazwisko' => ['filter' => FILTER_VALIDATE_REGEXP, 'options' => ['regexp' => '/^[A-Z]{1}[a-ząęłńśćźżó-]{1,25}$/']],
        'wiek' => ['filter' => FILTER_VALIDATE_INT, 'options' => ['min_range' => 1, 'max_range' => 120]],
        'panstwo' => ['filter' => FILTER_SANITIZE_STRING],
        'email' => ['filter' => FILTER_VALIDATE_EMAIL],
        'jezyk' => ['filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_REQUIRE_ARRAY],
        'metoda' => ['filter' => FILTER_SANITIZE_STRING]
    ];

    $dane = filter_var_array($dane, $args);

    return $dane;
}

function dodajdoBD($bd) {
    $dane = $_POST;

    $dane = walidacja($dane);

    $errors = [];
    foreach ($dane as $key => $value) {
        if ($value === false || $value === NULL) {
            $errors[] = $key;
        }
    }

    if (empty($errors)) {
        $sql = "INSERT INTO klienci VALUES (NULL, '{$dane['nazwisko']}', '{$dane['wiek']}', '{$dane['panstwo']}', '{$dane['email']}', '" . implode(',', $dane['jezyk']) . "', '{$dane['metoda']}')";
        if ($bd->insert($sql)) {
            return "";
        } else {
            return "";
        }
    } else {
        return "<h3>Niepoprawne dane w polach: " . implode(", ", $errors) . "</h3>";
    }
}

include_once "../klasy/Baza.php";

$tytul = "Formularz zamówienia";
$zawartosc = drukuj_form();
$bd = new Baza("localhost", "root", "", "klienci");

if (filter_input(INPUT_POST, "submit")) {
    $akcja = filter_input(INPUT_POST, "submit");
    switch ($akcja) {
        case "Dodaj" : 
            $zawartosc .= dodajdoBD($bd);
            break;
        case "Pokaz" : 
            $zawartosc .= $bd->select("select nazwisko,wiek,panstwo,email,zamowienie,metoda from klienci", ["nazwisko","wiek","panstwo","email","zamowienie","metoda"]);
            break;
    }
}
?>
