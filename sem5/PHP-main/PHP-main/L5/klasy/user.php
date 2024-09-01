<?php
class User {
    const STATUS_USER = 1;
    const STATUS_ADMIN = 2;
//pola klasy
    protected $userName;
    protected $passwd;
    protected $fullName;
    protected $email;
    protected $date;
    protected $status;
//metody klasy:
    function __construct($userName, $fullName, $email, $passwd ){
//implementacja konstruktora
$this->status=User::STATUS_USER;
$this->userName=$userName;
$this->passwd=password_hash($passwd, PASSWORD_BCRYPT);
$this->date = date("Y-m-d");
$this->fullName=$fullName;
$this->email=$email;
}
    Public function show() {
        $t = '<p>Username: ' . $this->userName . ',';
        $t .= '<p>Full name: ' . $this->fullName . ',';
        $t .= '<p>Password: ' . $this->passwd . ',';
        $t .= '<p>E-Mail: ' . $this->email . ',';
        $t .= '<p>Date: ' . $this->date . ',';
        if($this->status==2)
        {
            $t .= 'Admin';
        }
        else
        {
            $t .= 'User';
        }
        $t .= '</p>';
        echo $t;
}
//settery
public function setUserName($newName)
{
    $this->userName = $newName;
}
public function setFullName($newfullName)
{
    $this->fullName = $newfullName;
}
public function setEmail($newEmail)
{
    $this->email = $newEmail;
}
public function setPassword($newpasswd)
{
    $this->passwd = password_hash($newpasswd, PASSWORD_BCRYPT);
}
public function setStatus($newStatus)
{
    if($newStatus != User::STATUS_ADMIN && $newStatus != User::STATUS_USER)
    {
        $newStatus = USER::STATUS_USER;
    }
    $this->status = $newStatus;
}
//gettery
public function getUserName()
{
    return $this->userName;
}
public function getFullName()
{
    return $this->fullName;
}
public function getEmail()
{
    return $this->email;
}
public function getDate()
{
    return $this->date;
}
public function getPassword()
{
    return $this->passwd;
}
public function getStatus()
{
    return $this->status;
}
static function getAllUsers($plik){
    $tab = json_decode(file_get_contents($plik));
    //var_dump($tab);
    foreach ($tab as $val){
    echo "<p>".$val->userName." ".$val->fullName." ".$val->date."</p>";
    }
   }
   function toArray(){
    $arr=[
    "userName" => $this->userName,
    "fullName" => $this->fullName,
    "passwd" => $this->passwd,
    "email" => $this->email,
    "date" => $this->date,
    "status" => $this->status,
    ];
    return $arr;
   }
   function save($plik){
    $tab = json_decode(file_get_contents($plik),true);
    array_push($tab,$this->toArray());
    file_put_contents($plik, json_encode($tab));
   }
   function saveXML()
   {
    $xml = simplexml_load_file('users.xml');
    //dodajemy nowy element user (jako child)
    $xmlCopy=$xml->addChild("user");
    //do elementu dodajemy jego właściwości o określonej nazwie i treści
    $xmlCopy->addChild("userName", $this->userName);
    $xmlCopy->addChild("fullName", $this->fullName);
    $xmlCopy->addChild("passwd", $this->passwd);
    $xmlCopy->addChild("email", $this->email);
    $xmlCopy->addChild("date", $this->date);
    $xmlCopy->addChild("status", $this->status);
    //zapisujemy zmodyfikowany XML do pliku:
    $xml->asXML('users.xml'); 
   }
   static function getAllUsersFromXML()
   {
    $allUsers = simplexml_load_file('users.xml');
    echo "<ul>";
    foreach ($allUsers as $user):
    $userName=$user->userName;
    $date=$user->date;
    echo "<li>$userName, $date, ... </li>";
    endforeach;
    echo "</ul>";
   }
}
?>