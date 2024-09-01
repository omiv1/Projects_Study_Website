<?php
class UserManager 
{
    function loginForm() 
    {
        ?>
        <h3>Formularz logowania</h3>
        <form action="processLogin.php" method="post">
            <label for="login">Login:</label>
            <input type="text" id="login" name="login">
            <br>
            <label for="password">Hasło:</label>
            <input type="password" id="password" name="password">
            <br>
            <input type="submit" value="Zaloguj" name="zaloguj" />
        </form>
        <?php
    }
    
    function logout($db) 
    {
        session_start();
        //$userId = $db->selectUser($login, $password, "users");
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            
            // Wyloguj użytkownika
            $sql = "DELETE FROM logged_in_users WHERE userId = '{$userId}'";
        
            if ($db->delete($sql)) {
                echo "Wiersz usunięty z bazy danych!";
            } else {
                echo "Wystąpił problem podczas usuwania danych.";
            }

            // Usuń sesję
            session_destroy();

            // Przekieruj na stronę główną po wylogowaniu
        }
    }

    function logout_e($db, $login, $password) {
        // $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
        // $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    
        $userId = $db->selectUser($login, $password, "users");    
    
        // Wyloguj użytkownika z innej sesji
        $sql = "DELETE FROM logged_in_users WHERE userId = '{$userId}'";
        
        if ($db->delete($sql)) {
            echo "Wiersz usunięty z bazy danych! '{$login}'";
        } else {
            echo "Wystąpił problem podczas usuwania danych.";
        }
    }
    

    function login($db) {

        $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
        $errors = "";
        $userId = -1;

        if (empty($login) || empty($password)) {
            $errors .= "Wszystkie pola formularza są wymagane.<br>";
        }
        
        if ($errors === "") 
        {
            $userId = $db->selectUser($login, $password, "users");

            
            if ($userId < 0)
            {
                $errors .= "Błędny login lub hasło.<br>";
            }
            if ($errors === "") 
            {
                if ($userId >= 0) 
                {
                    $countResult = $db->select("SELECT COUNT(*) as count FROM logged_in_users WHERE userId = '$userId'", ['count']);
                    if ($countResult[22] > 0) 
                    {
                        echo "Użytkownik o nazwie '{$login}' już jest zalogowany.<br>";
                        echo "Aby sie wylogować najpierw musisz sie wylogować z poprzedniej sesji?";
                        $userId = 0;
                    }
                    else
                    {
                        $this->startSession($userId, $db);
                    }
                    
                }
            }
            else 
            {
            echo "<p>Błędne dane: $errors</p>";
            $userId = -1;
            }
        } 
        else 
        {
            echo "<p>Błędne dane: $errors</p>";
            $userId = -1;
        }

        return $userId;
    }


    function getLoggedInUser($db, $userId, $sessionId) {
        // Sprawdź, czy użytkownik o danym ID jest zalogowany z danym ID sesji
        $countResult = $db->select("SELECT COUNT(*) as count FROM logged_in_users WHERE userId = '$userId' AND sessionId = '$sessionId'", ['count']);
    
        if ($countResult[22] > 0) {
            // Użytkownik o danym ID i sesji jest zalogowany
            return 1;
        } else {
            // Użytkownik o danym ID i sesji nie jest zalogowany
            return -1;
        }
    }
    
    

    private function startSession($userId, $db) {
        session_start();

        // Clear all historical login entries for the user
        //$this->clearHistoricalLogins($userId, $db);

        // Set the session data
        $_SESSION['user_id'] = $userId;
        $_SESSION['login_time'] = date("Y-m-d H:i:s");
        $data = date("Y-m-d H:i:s");
        $id = session_id();

        $sql = "INSERT INTO logged_in_users VALUES ('{$id}','{$userId}','{$data}')";
        if ($db->insert($sql)) {
            echo "Dane dodane do bazy danych!";
        } else {
            echo "Wystąpił problem podczas dodawania danych.";
        }
    }

    private function endSession() {
        session_start();
        session_destroy();
    }

    private function clearHistoricalLogins($userId, $db) {
        $sql = "DELETE FROM logged_in_users WHERE userId = '{$userId}'";
        
        if ($db->delete($sql)) {
            echo "Wiersz usunięty z bazy danych!";
        } else {
            echo "Wystąpił problem podczas usuwania danych.";
        }
    }
}
