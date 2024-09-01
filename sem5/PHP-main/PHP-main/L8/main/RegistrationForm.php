<?php
class RegistrationForm {
 public $user;
  function __construct()
  { ?>
  <h3>Formularz rejestracji</h3>
  <p>
  <form action="rejestracja.php" method="post">
      Nazwa użytkownika: <br/><input name="userName" /><br/>
      Imie i nazwisko: <br/><input name="fullName" /><br/>
      Haslo: <br/><input name="passwd" /><br/>
      E-mail: <br/><input name="email" />
      <input type="submit" name="submit" value="Rejestruj"/>
      <input type="reset" name="submit" value="Anuluj" />
      <a href = "processLogin.php">Powrot do logowania</a>
 </p>
 </form>
 <?php
 }
 function checkUser(){
      $args = [
      'userName' => ['filter' => FILTER_VALIDATE_REGEXP,'options' => ['regexp' => '/^[0-9A-Za-ząęłńśćźżó_-]{2,25}$/']],
      'fullName'  => ['filter' => FILTER_VALIDATE_REGEXP,'options' => ['regexp' => "/^([a-zA-Z' ]+)$/"]],
      "passwd" => ['filter' => FILTER_VALIDATE_REGEXP,'options' => ['regexp' => '/^[0-9A-Za-ząęłńśćźżó_-]{2,25}$/']],
      "email" => FILTER_VALIDATE_EMAIL,
      ];
        $dane = filter_input_array(INPUT_POST, $args);
        $errors = "";
          foreach ($dane as $key => $val) 
              {
                  if ($val === false or $val === NULL) 
                  {
                      $errors .= $key . ", ";
                  }
              }
        if ($errors === "") 
          {
            $this->user=new User($dane['userName'], $dane['fullName'], $dane['email'],$dane['passwd']);
          }
        else 
        {
          echo "<p>Błędne dane:$errors</p>";
          $this->user = NULL;
        }
return $this->user;
 }
}