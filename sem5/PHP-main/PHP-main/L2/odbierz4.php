<h2>Dane odebrane z formularza</h2>
<?php
    if (isset($_REQUEST['jezyki']))  
    {
        echo "Wybrane Tutoriale: </br>";
        foreach((array) $_REQUEST['jezyki'] as $values) {
            echo "$values ";
          }
          echo "</br>";
    }
    print("Sposob zaplaty: ");
    if (isset($_REQUEST['przegladarka']))  
    {
        if($_REQUEST['przegladarka']=='Ff')
        {
            print("Eurocard<br/>");
        }

    }
    if (isset($_REQUEST['przegladarka']))  
    {
        if($_REQUEST['przegladarka']=='Ch')
        {
            print("Visa<br/>");
        }
        
    }
    if (isset($_REQUEST['przegladarka']))  
    {
        if($_REQUEST['przegladarka']=='II')
        {
            print("Przelew Bankowy<br/>");
        }
    }
    $blad=false;
    if(isset($_REQUEST['Nazwisko'])&&($_REQUEST['Nazwisko']!==""))
    {
        $nazwisko = htmlspecialchars(trim($_REQUEST['Nazwisko']));
    }
    else $blad=true;
    if(isset($_REQUEST['age'])&&($_REQUEST['age']!==""))
    {
        $wiek = htmlspecialchars(trim($_REQUEST['age']));

    }
    else $blad=true;
    if(isset($_REQUEST['Kraje'])&&($_REQUEST['Kraje']!=="")) {
        $kraj = $_REQUEST['Kraje'];
        }          
        else $blad=true;
    if(isset($_REQUEST['e-mail'])&&($_REQUEST['e-mail']!==""))
    {
        $email = htmlspecialchars(trim($_REQUEST['e-mail']));
    }
    else $blad=true;
    if($blad==true)
    {
        echo("Nie wprowadzono pelnych danych klienta!</br>");
    }
    else
    {
        $klient = "klient.php?Nazwisko=$nazwisko&age=$wiek&kraje=$kraj&e-mail=$email";
        echo"<a href=\"$klient\">Dane klienta </a>";
    }
    echo" <br/>";
    echo"<a href=\"formularz2.php\">Powrot do formularza </a>";
?>