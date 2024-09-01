<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ankieta PHP</title>
</head>
<body>
    <header><h1>Ankieta PHP</h1></header>
    <form action="odbiorankiety.php" method="POST">
    <?php
        $tech = ["C", "CPP", "Java", "C#", "HTML", "CSS", "XML", "PHP", "JavaScript"];
        foreach($tech as $t)
        {
            echo "<input type=\"checkbox\" name = \"tech[]\" value=\"$t\" /> $t <br />";
        }
        ?>
        <br/>
        <input type="submit" name="submit" value="Wyślij"/>
    </form>
</body>
</html>