<?php
class Baza {
    private $mysqli; // Uchwyt do BD

    public function __construct($serwer, $user, $pass, $baza) {
        $this->mysqli = new mysqli($serwer, $user, $pass, $baza);

        /* Sprawdź połączenie */
        if ($this->mysqli->connect_errno) {
            printf("Nie udało się połączenie z serwerem: %s\n", $this->mysqli->connect_error);
            exit();
        }

        /* Zmień kodowanie na utf8 */
        if ($this->mysqli->set_charset("utf8")) {
            // Udało się zmienić kodowanie
        }
    } // Koniec funkcji konstruktora

    public function __destruct() {
        $this->mysqli->close();
    }

    public function select($sql, $pola) {
        // Parametr $sql – łańcuch zapytania select
        // Parametr $pola - tablica z nazwami pól w bazie
        // Wynik funkcji – kod HTML tabeli z rekordami (String)
        $tresc = "";

        if ($result = $this->mysqli->query($sql)) {
            $ilepol = count($pola); // Ile pól
            $ile = $result->num_rows; // Ile wierszy

            // Pętla po wyniku zapytania $result
            $tresc .= "<table><tbody>";
            while ($row = $result->fetch_object()) {
                $tresc .= "<tr>";
                for ($i = 0; $i < $ilepol; $i++) {
                    $p = $pola[$i];
                    $tresc .= "<td>" . $row->$p . "</td>";
                }
                $tresc .= "</tr>";
            }
            $tresc .= "</table></tbody>";
            $result->close(); /* Zwolnij pamięć */
        }

        return $tresc;
    }

    public function delete($sql) {
        // Uzupełnij zapytanie – i zwróć true lub false
        if( $this->mysqli->query($sql)) 
            return true; 
        else 
            return false;
    }

    public function insert($sql) {
        if( $this->mysqli->query($sql)) 
            return true; 
        else 
            return false;
    }

    public function getMysqli() {
        return $this->mysqli;
    }
    public function walidacja($dane) {
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
    public function dodajdoBD($bd) 
    {
        $dane = $_REQUEST; // Pobierz wszystkie dane z formularza

        $dane = walidacja($dane);
        //var_dump($dane);


        $errors = [];
        foreach ($dane as $key => $value) {
            if ($value === false || $value === NULL) {
                $errors[] = $key;
            }
        }

        if (empty($errors)) {
            $sql = "INSERT INTO klienci VALUES (NULL, '{$dane['nazwisko']}', '{$dane['wiek']}', '{$dane['panstwo']}', '{$dane['email']}', '" . implode(',', $dane['jezyk']) . "', '{$dane['metoda']}')";
            if ($bd->insert($sql)) {
                echo "Dane dodane do bazy danych!";
            } else {
                echo "Wystąpił problem podczas dodawania danych.";
            }
        } else {
            echo "<h3>Niepoprawne dane w polach: " . implode(", ", $errors) . "</h3>";
        }
    }
    function statystyki($bd) {
        $sql = "SELECT wiek FROM klienci";
        $result = $bd->getMysqli()->query($sql);
    
        $liczbaWszystkichZamowien = $result->num_rows;
        $liczbaZamowienPonizej18 = 0;
        $liczbaZamowienPowyzej49 = 0;
    
        while ($row = $result->fetch_assoc()) {
            $wiek = intval($row['wiek']);
            if ($wiek < 18) {
                $liczbaZamowienPonizej18++;
            } elseif ($wiek > 49) {
                $liczbaZamowienPowyzej49++;
            }
        }
    
        echo "Liczba wszystkich zamówień: $liczbaWszystkichZamowien<br>";
        echo "Liczba zamówień od osób poniżej 18 roku życia: $liczbaZamowienPonizej18<br>";
        echo "Liczba zamówień od osób powyżej 50 roku życia: $liczbaZamowienPowyzej49<br>";
    
        $result->close();
    }
    
} // Koniec klasy Baza
