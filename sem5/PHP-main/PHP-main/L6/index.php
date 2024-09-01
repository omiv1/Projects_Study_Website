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
    <form action="index.php" method="POST">
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
        <input type="radio" name="radioboxy" value="Master Card" /> Master Card 
        <input type="radio" name="radioboxy" value="Visa" /> Visa
        <input type="radio" name="radioboxy" value="Przelew" />
        Przelew<br />
        <input type="reset" name="submit" value="Wyczyść" />
        <input type="submit" name="submit" value="Dodaj" />
        <input type="submit" name="submit" value="Pokaż" />
        <input type="submit" name="submit" value="PHP" />
        <input type="submit" name="submit" value="CPP" />
        <input type="submit" name="submit" value="JAVA" />
        <input type="submit" name="submit" value="Statystyki" />
        <br/>
        </form>
    <?php
        include_once "funkcje.php";
        include_once "klasy/Baza.php";
        //tworzymy uchwyt do bazy danych:
        $bd = new Baza("localhost", "root", "", "klienci");
        if (filter_input(INPUT_POST, "submit")) 
        {
            $akcja = filter_input(INPUT_POST, "submit");
            switch ($akcja) {
                case "Dodaj" : dodajdoBD($bd); break;
                case "Pokaż" : echo $bd->select("select Nazwisko,Zamowienie, Wiek from klienci", ["Nazwisko","Zamowienie","Wiek"]); break;
                case "PHP" : echo $bd->select("select Nazwisko, Zamowienie from klienci where Zamowienie REGEXP 'PHP'", ["Nazwisko", "Zamowienie"]); break;
                case "CPP" : echo $bd->select("select Nazwisko, Zamowienie from klienci where Zamowienie REGEXP 'CPP'", ["Nazwisko", "Zamowienie"]); break;
                case "JAVA" : echo $bd->select("select Nazwisko, Zamowienie from klienci where Zamowienie REGEXP 'Java[[:>:]]'", ["Nazwisko", "Zamowienie"]); break;//REGEXP tam gdzie wyrazenie konczy sie na java to wyswietla (javascript sie nie lapie dzieki temu)
                case "Statystyki":echo "<b>Zamowienia od osob w wieku <18 lat</b>" ; echo $bd->select("select Nazwisko, Wiek from klienci where Wiek<18", ["Nazwisko", "Wiek"]); 
                echo "<b>Zamowienia od osob w wieku >=50 lat</b>"; echo $bd->select("select Nazwisko, Wiek from klienci where Wiek>=50", ["Nazwisko", "Wiek"]); break;
                }
        }
    ?>
</body>
</html>