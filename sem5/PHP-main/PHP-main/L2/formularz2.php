
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="odbierz3.php" method="GET">
<table>
            <tr><td><label for ="nazwisko">Nazwisko :</label></td> <td><input id="nazwisko" type="text" name="Nazwisko"/></td></tr> 
            <tr><td><label for ="age">Wiek:</label></td> <td><input id="age" type="text" name="age"/></td></tr>
            <tr><td>Państwo: </td> <td>
                <select name="Kraje">
                    <option value="Polska">Polska</option>
                    <option value="Niemcy">Niemcy</option>
                    <option value="Anglia">Anglia</option>
                  </select>
                </td></tr> 
            <tr><td><label for ="e-mail"> Adres e-mail: </label></td><td><input id="e-mail" type="text" name="e-mail"/></td></tr> 
        </table>
        <b>Zamawiam tutorial z języka: </b><br />
        <br/>
        <?php
        $jezyki = ["C", "CPP", "Java", "C#", "HTML", "CSS", "XML", "PHP", "JavaScript"];
        foreach($jezyki as $values) { ?>
        <?php echo $values ?> 
        <input type="checkbox" name="jezyki[]" value="<?php echo $values?>" />
        <?php } ?>
        <br/>
        <b>Sposób zapłaty: </b> 
        <input type="radio" name="przegladarka" value="Ff" /> eurocard 
        <input type="radio" name="przegladarka" value="Ch" /> visa 
        <input type="radio" name="przegladarka" value="II" />
        przelew bankowy<br />
        <input type="submit" value="Wyślij" />
        <input type="reset" value="Anuluj" />
        <br/>
        <br/>
        </form>
</body>
</html>