<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeria w PHP</title>
</head>
<body>
    <?php 
    function galeria($rows, $cols)
    {
        for($i=0;$i<$rows;$i++)
        {
            print("<div>");
            for($j=1;$j<=$cols;$j++)
            {
                $numer= $j + ($i*$cols);
                print("<img src='miniaturki/obraz$numer.JPG' alt='$j'/>");
            }
            print("</div>");
        }
    }
    galeria(2,4);
    ?>
</body>
</html>