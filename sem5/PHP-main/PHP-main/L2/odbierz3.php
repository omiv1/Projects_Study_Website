<h2>Dane odebrane z tablicy Jezyki na temat tutoriali</h2>
<?php
    if (isset($_REQUEST['jezyki']))  
    {
        foreach((array) $_REQUEST['jezyki'] as $values) {
            echo "Wybrane kursy = $values<br>";
          }
    }
    else echo("Wybierz cos!<br>");
    echo("Wybrane kursy JOIN: <br>");
    if (isset($_REQUEST['jezyki']))  
    {
        echo join(" ",$_REQUEST['jezyki']);
        echo("</br>");
    }
    else echo "Wybierz cos JOIN <br>";
    echo "Wyswietlam funkcja var_dump tablice REQUEST</br>"; 
    var_dump($_REQUEST);
    echo "</br>";
    echo "Wyswietlam funkcja tablice REQUEST petla</br>"; 
    foreach($_REQUEST as $keys=>$vals)
    {
        if(is_array($vals)==false)
        {
        echo "$keys = $vals</br>";
        }
        else {
            print("Elementy tablicowe w REQUEST </br>");
            print("-------------</br>");
            foreach($vals as $key => $value)
                    {
                    echo $key."=". $value;
                    echo "</br>";
                    }
                    print("-------------</br>");
            }
    }
?>