<body>
<h2>Dane odebrane z formularza</h2>
<?php
    if(isset($_REQUEST['Nazwisko'])&&($_REQUEST['Nazwisko']!=" "))
    {
        $nazwisko = htmlspecialchars(trim($_REQUEST['Nazwisko']));
        echo "Nazwisko: $nazwisko <br/>";
    }
    else echo "Nie wpisano nazwiska <br/>";
    if(isset($_REQUEST['age'])&&($_REQUEST['age']!=" "))
    {
        $wiek = htmlspecialchars(trim($_REQUEST['age']));
        echo "Wiek: $wiek <br/>";
    }
    else echo "Nie wpisano Wieku <br/>";
    if(isset($_REQUEST['Kraje'])&&($_REQUEST['Kraje']!=" ")) {
        $kraj = $_REQUEST['Kraje'];
                if ($kraj == 1) {
                    echo "Kraj: Polska</br>";
                } elseif ($kraj == 2) {
                    echo "Kraj: Niemcy</br>";
                } else {
                    echo "Kraj: Holandia</br>";
                }
        }          
     else echo 'Wybierz kraj<br/>';
      
    if(isset($_REQUEST['e-mail'])&&($_REQUEST['e-mail']!=" "))
    {
        $email = htmlspecialchars(trim($_REQUEST['e-mail']));
        echo "E-Mail: $email <br/>";
    }

    print("Jezyk programowania:<br/>");
    if (isset($_REQUEST['PHP']))  print("- PHP<br />");
    if (isset($_REQUEST['C']))  print("- C++<br />");
    if (isset($_REQUEST['Java'])) print("- Java<br />");
    print("Sposob zaplaty:<br/>");
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
?>
</body>