<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zamówienie</title>
</head>
<body>
    <h2>Zamówione produkty:</h2>
    <?php
    if (isset($_REQUEST['jezyk'])) {
        $zamowioneJezyki = $_REQUEST['jezyk'];
        echo "<ul>";
        foreach ($zamowioneJezyki as $jezyk) {
            echo "<li>$jezyk</li>";
        }
        echo "</ul>";
    } else {
        echo "Nie wybrano żadnych produktów.";
    }
    ?>

    <h2>Sposób zapłaty:</h2>
    <?php
    if (isset($_REQUEST['metoda'])) {
        $sposobPlatnosci = $_REQUEST['metoda'];
        echo $sposobPlatnosci;
    } else {
        echo "Nie wybrano sposobu płatności.";
    }
    ?>

    <?php
    if (isset($_REQUEST['nazwisko'])) {
        $nazwisko = $_REQUEST['nazwisko'];
        echo '<h2>Dane zamawiającego:</h2>';
        echo '<a href="klient.php?nazwisko=' . $nazwisko . '">Pokaż dane zamawiającego</a>';
    } else {
        echo '<p>Brak danych zamawiającego.</p>';
    }
    ?>
</body>
</html>