<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obsługa przesłanych głosów
    if (isset($_POST["jezyki"])) {
        $wybraneJezyki = $_POST["jezyki"];

        // Inicjalizacja wyników (jeśli nie istnieją)
        $wyniki = [
            "C" => 0,
            "CPP" => 0,
            "Java" => 0,
            "C#" => 0,
            "Html" => 0,
            "CSS" => 0,
            "XML" => 0,
            "PHP" => 0,
            "JavaScript" => 0
            // Dodaj więcej języków programowania według potrzeb
        ];

        // Zaktualizuj wyniki na podstawie głosów
        foreach ($wybraneJezyki as $jezyk) {
            if (array_key_exists($jezyk, $wyniki)) {
                $wyniki[$jezyk]++;
            }
        }

        // Zapisz wyniki w pliku
        file_put_contents("wyniki.txt", serialize($wyniki));
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Ankieta</title>
</head>
<body>
    <h1>Ankieta dotycząca języków programowania</h1>
    <form method="post">
        <p>Wybierz języki programowania, które preferujesz:</p>
        <label>
            <input type="checkbox" name="jezyki[]" value="C"> C
        </label><br>
        <label>
            <input type="checkbox" name="jezyki[]" value="CPP"> CPP
        </label><br>
        <label>
            <input type="checkbox" name="jezyki[]" value="Java"> Java
        </label><br>
        <label>
            <input type="checkbox" name="jezyki[]" value="C#"> C#
        </label><br>
        <label>
            <input type="checkbox" name="jezyki[]" value="Html"> Html
        </label><br>
        <label>
            <input type="checkbox" name="jezyki[]" value="CSS"> CSS
        </label><br>
        <label>
            <input type="checkbox" name="jezyki[]" value="XML"> XML
        </label><br>
        <label>
            <input type="checkbox" name="jezyki[]" value="PHP"> PHP
        </label><br>
        <label>
            <input type="checkbox" name="jezyki[]" value="JavaScript"> JavaScript
        </label><br>
        <br>
        <input type="submit" value="Oddaj głos">
    </form>
    <a href="wyniki.php">Wyswietl wyniki ankiety</a> |
</body>
</html>
