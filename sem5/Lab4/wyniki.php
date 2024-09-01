<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Wyniki ankiety</title>
</head>
<body>
    <h1>Wyniki ankiety dotyczącej języków programowania</h1>
    <h2>Liczba głosów na poszczególne języki:</h2>
    <?php
    $tech = ["C", "CPP", "Java", "C#", "Html", "CSS", "XML", "PHP", "JavaScript"];
    $liczniki = array_fill_keys($tech, 0);

    $file = fopen("ankieta.txt", "r");
    if ($file) {
        while (($line = fgets($file)) !== false) {
            $jezyk = trim($line);
            if (in_array($jezyk, $tech)) {
                $liczniki[$jezyk]++;
            }
        }
        fclose($file);

        foreach ($liczniki as $jezyk => $liczbaGlosow) {
            echo "$jezyk - $liczbaGlosow<br>";
        }
    } else {
        echo "Brak danych ankiety.";
    }
    ?>
</body>
</html>
