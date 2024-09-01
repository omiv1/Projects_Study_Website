<?php
 include_once 'Baza.php';
class UserManager 
    {
        
        function loginForm() {
        ?>
         <link rel="stylesheet" href="styles.css" type="text/css">
          <div id="form" >
 <h3>Formularz logowania</h3><p>
 <form action="processLogin.php" method="post">
 Login: <br/><input type="text" name="login" /><br />
 Haslo: <br/><input type="password" name="passwd" /><br />
 <input type="submit" value="Zaloguj" name="zaloguj" />
 <input type="reset" value="Anuluj" />
 Nie masz jeszcze konta?
 <a href = "rejestracja.php">Zarejestruj sie!</a>
 </div>
 </form></p> <?php
        }
 function login($db) 
 {
        //funkcja sprawdza poprawność logowania
        //wynik - id użytkownika zalogowanego lub -1
        $args = ['login' => FILTER_SANITIZE_ADD_SLASHES,
        'passwd' => FILTER_SANITIZE_ADD_SLASHES];
        $dane = filter_input_array(INPUT_POST, $args);
        //sprawdź czy użytkownik o loginie istnieje w tabeli users
        //i czy podane hasło jest poprawne
        $login = $dane["login"];
        $passwd = $dane["passwd"];
        $userId = 0;
        $userId = $db->selectUser($login, $passwd, "users");

        $sql = "SELECT userid FROM logged_in_users WHERE userid= '".$userId."'";
        if ($result = $db->getMysqli()->query($sql)) 
        {
                $row = $result->fetch_object(); //pobierz rekord z użytkownikiem
                if($row == NULL)
                {
                     //rozpocznij sesję zalogowanego użytkownika
             session_start();
            
             //usuń wszystkie wpisy historyczne dla użytkownika o $userId
            
             $db->delete("DELETE from logged_in_users WHERE userId = $userId");
             //ustaw datę - format("Y-m-d H:i:s");
             $date=date("Y-m-d H:i:s");
             //pobierz id sesji i dodaj wpis do tabeli logged_in_users
            
             $sessionID = session_id();
            
             $sql = "INSERT INTO logged_in_users VALUES('$sessionID', '$userId', '$date')";
             $db->insert($sql);
                }
                else
                {
                    $userId =-1;
                } 
            }
        return $userId;//idk gdzie
 }
 function logout($db)
    {
        session_start();
        //pobierz id bieżącej sesji (pamiętaj o session_start()
        $session = session_id();

        //usuń sesję (łącznie z ciasteczkiem sesyjnym)
        if ( isset($_COOKIE[session_name()]) ) {
            setcookie(session_name(),'', time() - 42000, '/'); //Usuwa sesje, nie tylko dane sesji
           }
        session_destroy();
        //usuń wpis z id bieżącej sesji z tabeli logged_in_users
        $sql = "DELETE FROM logged_in_users WHERE sessionId = '$session'";
        $db->delete($sql);
    }
    function getLoggedInUser($db, $sessionId) 
    {
        $sql = "SELECT userId FROM logged_in_users WHERE sessionId = '$sessionId'";
        if ($result = $db->getMysqli()->query($sql)) 
            {
                    $row = $result->fetch_object(); //pobierz rekord z użytkownikiem
                    if($row == NULL)
                    {
                        return -1;
                    }
                    else
                    {
                    $id = $row->userId;
                    return $id;
                    }
             }
    }
}
   