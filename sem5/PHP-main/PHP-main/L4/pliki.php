<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formularz PHP</title>
</head>
<body>
    <header><h1>Formularz do testow PHP</h1></header>
    <form action="pliki.php" method="POST">
        <table>
            <tr><td><label for ="nazwisko">Nazwisko :</label></td> <td><input id="nazwisko" type="text" name="Nazwisko"/></td></tr> 
            <tr><td><label for ="age">Wiek:</label></td> <td><input id="age" type="text" name="age"/></td></tr>
            <tr><td>Państwo: </td> <td>
                <select name="Kraje">
                    <option value="Polska">Pl</option>
                    <option value="Niemcy">Deu</option>
                    <option value="Anglia">Ang</option>
                  </select>
                </td></tr> 
            <tr><td><label for ="e-mail"> Adres e-mail: </label></td><td><input id="e-mail" type="text" name="e-mail"/></td></tr> 
        </table>
        <b>Zamawiam tutorial z języka: </b><br />
        <br/>
        <?php
        $jezyki = ["C", "CPP", "Java", "C#", "HTML", "CSS", "XML", "PHP", "JavaScript"];
        foreach($jezyki as $j)
        {
            echo "<input type=\"checkbox\" name = \"jezyki[]\" value=\"$j\" /> $j <br />";
        }
        ?>
        <b>Sposób zapłaty: </b> <br />
        <br/>
        <input type="radio" name="radioboxy" value="Eurocard" /> eurocard 
        <input type="radio" name="radioboxy" value="Visa" /> visa 
        <input type="radio" name="radioboxy" value="Przelew bankowy" />
        przelew bankowy<br />
        <input type="reset" name="submit" value="Wyczyść" />
        <input type="submit" name="submit" value="Zapisz" />
        <input type="submit" name="submit" value="Pokaż" />
        <input type="submit" name="submit" value="PHP" />
        <input type="submit" name="submit" value="CPP" />
        <input type="submit" name="submit" value="JAVA" />
        <input type="submit" name="submit" value="Statystyki" />
        <br/>
        </form>
        <?php
include_once "funkcje.php";
    if (filter_input(INPUT_POST, "submit")) {
        $akcja = filter_input(INPUT_POST, "submit");
        switch ($akcja) {
            case "Zapisz" : dodaj();break;
            case "Pokaż" : pokaz();break;
            case "PHP":pokaz_zamowienie("PHP"); break;
            case "CPP":pokaz_zamowienie("CPP"); break;
            case "JAVA":pokaz_zamowienie("Java"); break;
            case "Statystyki":statystyki(); break;
        }
    }
?>
</body>
</html>