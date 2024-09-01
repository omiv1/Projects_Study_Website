<?php
class RegistrationForm {
 protected $user;
 function __construct(){ ?>
 <h3>Formularz rejestracji</h3><p>
 <form action="index.php" method="post">
 Nazwa użytkownika: <br/><input name="userName" /><br/>
 Imie i nazwisko: <br/><input name="fullName" /><br/>
 Haslo: <br/><input name="passwd" /><br/>
 E-mail: <br/><input name="email" />
        <input type="submit" name="submit" value="Rejestruj"/>
        <input type="reset" name="submit" value="Anuluj" />
 </form></p>
 <?php
 }
 function checkUser(){ // podobnie jak metoda validate z lab4
 $args = [
 'userName' => ['filter' => FILTER_VALIDATE_REGEXP,'options' => ['regexp' => '/^[0-9A-Za-ząęłńśćźżó_-]{2,25}$/']],
 'fullName'  => ['filter' => FILTER_VALIDATE_REGEXP,'options' => ['regexp' => "/^([a-zA-Z' ]+)$/"]],
 "passwd" => ['filter' => FILTER_VALIDATE_REGEXP,'options' => ['regexp' => '/^[0-9A-Za-ząęłńśćźżó_-]{2,25}$/']],
 "email" => FILTER_VALIDATE_EMAIL,
];
//przefiltruj dane:
$dane = filter_input_array(INPUT_POST, $args);
//sprawdz czy są błędy walidacji $errors – jak w lab4 // uzupełnij kod
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
    //Dane poprawne – utwórz obiekt user
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