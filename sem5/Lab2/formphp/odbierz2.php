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
        //echo var_dump($_REQUEST);
        foreach($_REQUEST as $key=>$value) {
            if (is_array($value))
            {
                $value = join(", ",$value);
                echo "$key = $value <br />";
            }
            else echo "$key = $value <br />";
           }
    ?>
</body>
</html>