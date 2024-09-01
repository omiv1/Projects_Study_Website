<?php
$tech = ["C", "CPP", "Java", "C#", "Html", "CSS", "XML", "PHP", "JavaScript"];
$filename = "ankieta2.txt";

if ($_POST) {
    // Zapis wynikow ankiety
    $selectedTech = $_POST['technologie'];
    //var_dump($selectedTech);
    if (!empty($selectedTech)) {
        // Odczytanie obecnych wynikow z pliku i inicjalizacja licznikow
        $counters = array_fill_keys($tech, 0);
        if (file_exists($filename)) {
            $data = file_get_contents($filename);
            $lines = explode(PHP_EOL, $data);

            foreach ($lines as $line) {
                $parts = explode(" - ", $line);
                if (count($parts) === 2) {
                    list($language, $count) = array_map('trim', $parts);
                    if (array_key_exists($language, $counters)) {
                        $counters[$language] = intval($count);
                    }
                }
            }
        }

        // Aktualizacja licznikow
        foreach ($selectedTech as $selected) {
            if (array_key_exists($selected, $counters)) {
                $counters[$selected]++;
            }
        }

        // Zapisanie danych
        $updatedData = '';
        foreach ($tech as $language) {
            $updatedData .= "$language - " . $counters[$language] . PHP_EOL;
        }

        file_put_contents($filename, $updatedData);
    }
}

// Wyswietlenie ankiety
echo "<h2>Wybierz technologie, które znasz:</h2>";
echo "<form method='post'>";
echo "Wybierz technologie, na które oddajesz głos:<br>";

foreach ($tech as $language) {
    echo "<input type='checkbox' name='technologie[]' value='$language'>$language<br>";
}

echo "<br><input type='submit' value='Oddaj głos'>";
echo "</form>";

// Wyswietlenie wynikow
if (file_exists($filename)) {
    $resultData = file_get_contents($filename);
    echo "<h2><br>Zebrane wyniki:</h2>";
    echo "<pre>$resultData</pre>";
}
?>
