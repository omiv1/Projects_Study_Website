<?php
class User {
    const STATUS_USER = 1;
    const STATUS_ADMIN = 2;
    protected $userName;
    protected $passwd;
    protected $fullName;
    protected $email;
    protected $date;
    protected $status;

    function __construct($userName, $fullName, $email, $passwd) {
        $this->userName = $userName;
        $this->fullName = $fullName;
        $this->email = $email;
        $this->passwd = password_hash($passwd, PASSWORD_DEFAULT);
        $this->date = (new DateTime())->format('Y-m-d');
        $this->status = self::STATUS_USER;
    }

    public function show() {
        echo "User: $this->userName, $this->fullName, $this->email, $this->date, $this->passwd, $this->status";
    }

    static function getAllUsers($plik) {
        $tab = json_decode(file_get_contents($plik));
        echo "<ul>";
        foreach ($tab as $val) {
            echo "<li>$val->userName $val->fullName $val->date</li>";
        }
        echo "</ul>";
    }

    function toArray() {
        $arr = [
            "userName" => $this->userName,
            "fullName" => $this->fullName,
            "email" => $this->email,
            "date" => $this->date,
            "status" => $this->status,
            "passwd" => $this->passwd,
        ];
        return $arr;
    }

    function save($plik) {
        $tab = json_decode(file_get_contents($plik), true);
        array_push($tab, $this->toArray());
        file_put_contents($plik, json_encode($tab));
    }

    function saveXML($plik) {
        $xml = simplexml_load_file($plik);
        $xmlCopy = $xml->addChild("user");

        $xmlCopy->addChild("userName", $this->userName);
        $xmlCopy->addChild("fullName", $this->fullName);
        $xmlCopy->addChild("email", $this->email);
        $xmlCopy->addChild("date", $this->date);
        $xmlCopy->addChild("status", $this->status);
        $xmlCopy->addChild("status", $this->passwd);

        $xml->asXML($plik);
    }

    static function getAllUsersFromXML($plik) {
        $allUsers = simplexml_load_file($plik);
        echo "<ul>";
        foreach ($allUsers as $user) {
            $userName = $user->userName;
            $fullName = $user->fullName;
            $date = $user->date;
            echo "<li>$userName, $fullName, $date</li>";
        }
        echo "</ul>";
    }
}
?>
