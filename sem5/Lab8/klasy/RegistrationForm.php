<?php
class RegistrationForm {
    protected $user;

    function __construct() {
        echo "<h3>Formularz rejestracji</h3><p>";
        echo "<form action=\"indexx.php\" method=\"post\">";
        echo "Nazwa użytkownika: <br/><input name=\"userName\" /><br/>";
        echo "Imię i nazwisko: <br/><input name=\"fullName\" /><br/>";
        echo "Adres e-mail: <br/><input name=\"email\" /><br/>";
        echo "Hasło: <br/><input type=\"password\" name=\"passwd\" /><br/>";
        echo "<input type=\"submit\" name=\"submit\" value=\"Zarejestruj\" />";
        echo "</form></p>";
    }

    function checkUser($db) {
        $userName = filter_input(INPUT_POST, 'userName', FILTER_SANITIZE_STRING);
        $fullName = filter_input(INPUT_POST, 'fullName', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $passwd = filter_input(INPUT_POST, 'passwd', FILTER_SANITIZE_STRING);

        $errors = "";

        if (empty($userName) || empty($fullName) || empty($email) || empty($passwd)) {
            $errors .= "Wszystkie pola formularza są wymagane.<br>";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors .= "Niepoprawny format adresu e-mail.<br>";
        }

        if (strlen($passwd) < 6) {
            $errors .= "Hasło musi mieć co najmniej 6 znaków.<br>";
        }
       // $countResult = 0;
        $countResult = $db->select("SELECT COUNT(*) as count FROM users WHERE userName = '$userName'", ['count']);
        for ($i = 0; $i < 48; $i++) {
            //var_dump($countResult[$i]);
        }
        //var_dump($countResult[22]);
        
        if ($countResult[22] > 0) {
            $errors .= "Użytkownik o nazwie '{$userName}' już istnieje.<br>";
        }
        
        if ($errors === "") {
            $this->user = new User($userName, $fullName, $email, $passwd);
        } else {
            echo "<p>Błędne dane: $errors</p>";
            $this->user = NULL;
        }

        return $this->user;
    }
}
?>
