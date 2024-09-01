<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Dane odebrane z formularza:</h2>
    <?php
    if (isset($_REQUEST['nazwisko'])&&($_REQUEST['nazwisko']!="")) {
        $nazwisko = htmlspecialchars(trim($_REQUEST['nazwisko']));
        echo "Nazwisko: $nazwisko <br />";
    }
    else echo "Nie podano nazwiska <br />";

    if (isset($_REQUEST['wiek'])&&($_REQUEST['wiek']!="")) {
        $wiek = htmlspecialchars(trim($_REQUEST['wiek']));
        echo "Wiek: $wiek <br />";
    }
    else echo "Nie podano wieku <br />";

    if (isset($_REQUEST['panstwo'])&&($_REQUEST['panstwo']!="")) {
        $panstwo = htmlspecialchars(trim($_REQUEST['panstwo']));
        echo "Panstwo: $panstwo <br />";
    }
    else echo "Nie podano panstwa <br />";

    if (isset($_REQUEST['email'])&&($_REQUEST['email']!="")) {
        $email = htmlspecialchars(trim($_REQUEST['email']));
        echo "E-mail: $email <br />";
    }
    else echo "Nie podano e-mail <br />";

    if (isset($_REQUEST['jezyk'])&&($_REQUEST['jezyk']!="")) {
        $jezyki = join(", ",$_REQUEST['jezyk']);
        echo "Jezyki: $jezyki <br />";
    }
    else echo "Nie podano jezyka <br />";

    if (isset($_REQUEST['metoda'])&&($_REQUEST['metoda']!="")) {
        $metoda = htmlspecialchars(trim($_REQUEST['metoda']));
        echo "Metoda platnosci: $metoda <br />";
    }
    else echo "Nie podano metody platnosci <br />";
    
    //pozostałe instrukcje pobierające dane wysłane
    //z formularza w postaci parametrów żądania
    //...
    ?>
</body>
</html>