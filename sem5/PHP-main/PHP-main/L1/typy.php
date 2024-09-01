<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $z1=1234;
    $z2=567.789;
    $z3=1;
    $z4=0;
    $z5=true;
    $z6="0";
    $z7="Typy w Php";
    $z8=[1, 2, 3, 4];
    $z9=[];
    $z10=["zielony", "czerwony", "niebieski"];
    $z11=["Agata", "Agatowska", 4.67, true];
    $z12=date("d/m/Y H:i:s");
    print("<p>Zmienna:$z1</p>");
    print("<p>Zmienna:$z2</p>");
    print("<p>Zmienna:$z3</p>");
    print("<p>Zmienna:$z4</p>");
    print("<p>Zmienna:$z5</p>");
    print("<p>Zmienna:$z6</p>");
    print("<p>Zmienna:$z7</p>");
    print("<p>Zmienna:[");
    for($i=0;$i<count($z8);$i++)
    {
        print("$z8[$i]");
    }
    print("]</p>");
    print("<p>Zmienna:[");
    for($j=0;$j<count($z9);$j++)
    {
        print("$z9[$j]");
    }
    print("]</p>");
    print("<p>Zmienna:[");
    for($y=0;$y<count($z10);$y++)
    {
        print("$z10[$y]");
    }
    print("]</p>");
    print("<p>Zmienna:[");
    for($c=0;$c<count($z11);$c++)
    {
        print("$z11[$c]");
    }
    print("]</p>");
    $xd=is_bool($z5);
    print("<p>$xd</p>");
    $xs=is_int($z3);
    print("<p>$xs</p>");
    $xc=is_numeric($z2);
    print("<p>$xc</p>");
    $m= $z3==$z5;
    $n= 0==="0";
    $s= $z3===$z5;
    $g = 0=="0";
    print("<p> Porownuje zmienne 1 i true: $m</p>");
    print("<p> Porownuje zmienne 0 i zero w apostrofach:$n</p>");
    print("<p> Porownuje zmienne 1 i true: $s</p>");
    print("<p> Porownuje zmienne 0 i zero w apostrofach:$g</p>");
    var_dump($z8);
    print_r($z8);
    ?>
</body>
</html>