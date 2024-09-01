<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dane Zamawiającego</title>
</head>
<body>
    <h2>Dane zamawiającego:</h2>
    <?php
    if (isset($_GET['nazwisko'])) {
        $nazwisko = $_GET['nazwisko'];
        echo "Nazwisko: $nazwisko";
        
        // Tutaj możesz dodać więcej pól do wyświetlenia, np. wiek, państwo, adres email itp.
        // Jeśli potrzebujesz innych danych klienta, użyj ich kluczy z przekazywanych parametrów GET.
    } else {
        echo "Brak danych klienta.";
    }
    ?>
</body>
</html>
