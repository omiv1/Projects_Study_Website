<?php
class BazaPDO
{
    private $dbh; // Uchwyt do BD

    public function __construct($host, $dbname, $user, $pass)
    {
        try {
            $this->dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass, [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    function __destruct()
    {
        $this->dbh = null;
    }

    public function select($sql, $pola)
    {
        $stmt = $this->dbh->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $tresc = "<table><tbody>";

        while ($row = $stmt->fetch()) {
            $tresc .= "<tr>";
            foreach ($pola as $p) {
                $tresc .= "<td>" . $row[$p] . "</td>";
            }
            $tresc .= "</tr>";
        }

        $tresc .= "</table></tbody>";

        return $tresc;
    }

    public function delete($sql)
    {
        try {
            $this->dbh->exec($sql);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function insert($sql)
    {
        try {
            $this->dbh->exec($sql);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getPDO()
    {
        return $this->dbh;
    }

    public function walidacja($dane)
    {
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

    public function dodajdoBD($bd)
    {
        $dane = $_REQUEST; // Pobierz wszystkie dane z formularza

        $dane = $this->walidacja($dane);
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

    function statystyki($bd)
    {
        $sql = "SELECT wiek FROM klienci";
        $stmt = $bd->getPDO()->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $liczbaWszystkichZamowien = $stmt->rowCount();
        $liczbaZamowienPonizej18 = 0;
        $liczbaZamowienPowyzej49 = 0;

        while ($row = $stmt->fetch()) {
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
    }
} // Koniec klasy BazaPDO
?>
