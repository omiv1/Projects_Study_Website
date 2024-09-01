<?php
function walidacja($dane) {
    $args = [
        'nazwisko' =>  ['filter' => FILTER_VALIDATE_REGEXP,'options' => ['regexp' => '/^[A-Z]{1}[a-ząęłńśćźżó-]{1,25}$/']],
        'wiek' => ['filter' => FILTER_VALIDATE_INT,'options' => ['min_range' => 1,'max_range' => 120]],
        'panstwo' => ['filter' => FILTER_SANITIZE_STRING],
        'email' => ['filter' => FILTER_VALIDATE_EMAIL],
        'jezyk' => ['filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_REQUIRE_ARRAY],
        'metoda' => ['filter' => FILTER_SANITIZE_STRING]
    ];

    $dane = filter_var_array($dane, $args);

    return $dane;
}
function dodaj() {
    $dane = $_REQUEST; // Pobierz wszystkie dane z formularza

    $dane = walidacja($dane);
    var_dump($dane);


    $errors = [];
    foreach ($dane as $key => $value) {
        if ($value === false || $value === NULL) {
            $errors[] = $key;
        }
    }

    if (empty($errors)) {
        dopliku("dane.txt", $dane);
    } else {
        echo "<h3>Niepoprawne dane w polach: " . implode(", ", $errors) . "</h3>";
    }
}
function dopliku2($nazwaPliku, $tablicaDanych) {
	//var_dump($tablicaDanych);
    //$dane = implode(" ", $tablicaDanych);

	$dane = $tablicaDanych["nazwisko"] . " " . $tablicaDanych["wiek"] . " " . $tablicaDanych["panstwo"] . " " . $tablicaDanych["email"] . " ";
        if (isset($tablicaDanych["jezyk"])) {
            $dane .= implode(",", $tablicaDanych["jezyk"]);
        }
        $dane .= " " . $tablicaDanych["metoda"];

    $plik = fopen($nazwaPliku, "a");
    flock($plik, LOCK_EX);
    fwrite($plik, $dane . "\n");
    flock($plik, LOCK_UN);
    fclose($plik);
}
function dopliku($nazwaPliku, $tablicaDanych) {
    //var_dump($tablicaDanych);
    $nazwisko = $tablicaDanych['nazwisko'];
    $wiek = $tablicaDanych['wiek'];
    $kraj = $tablicaDanych['panstwo'];
    $email = $tablicaDanych['email'];
    $jezyki = implode(',', $tablicaDanych['jezyk']);
    $metodaPlatnosci = $tablicaDanych['metoda'];

    $dane = "$nazwisko $wiek $kraj $email $jezyki $metodaPlatnosci";
    
    $plik = fopen($nazwaPliku, "a");
    flock($plik, LOCK_EX);
    fwrite($plik, $dane . "\n");
    flock($plik, LOCK_UN);
    fclose($plik);
}
function pokaz() {
    $data = file_get_contents("dane.txt");
    $lines = explode("\n", $data);
    foreach ($lines as $line) {
        echo $line . "<br>";
    }
}

function pokaz_zamowienie($tut) {
    $data = file_get_contents("dane.txt");
    $lines = explode("\n", $data);
    foreach ($lines as $line) {
        $parts = explode(" ", $line);
        //if (isset($parts[4]) && strpos($parts[4], $tut) !== false) {
        //    echo $line . "<br>";
        //}
        if(isset($parts[4]))
        {
            $part = explode(",",$parts[4]);
            foreach ($part as $p)
            {
                if(($p === $tut))
                {
                    echo $line . "<br>";
                }
            }
        }
    }
}
function statystyki() {
    $data = file_get_contents("dane.txt");
    $lines = explode("\n", $data);

    $liczbaWszystkichZamowien = count($lines)-1;
    $liczbaZamowienPonizej18 = 0;
    $liczbaZamowienPowyzej49 = 0;

    foreach ($lines as $line) {
        $parts = explode(" ", $line);

        if (count($parts) >= 2) {
            $wiek = intval($parts[1]);
            if ($wiek < 18) {
                $liczbaZamowienPonizej18++;
            } elseif ($wiek > 49) {
                $liczbaZamowienPowyzej49++;
            }
        }
    }

    echo "Liczba wszystkich zamówień: $liczbaWszystkichZamowien<br>";
    echo "Liczba zamówień od osób poniżej 18 roku życia: $liczbaZamowienPonizej18<br>";
    echo "Liczba zamówień od osób powyżej 50 roku życia: $liczbaZamowienPowyzej49<br>";
}

?>
