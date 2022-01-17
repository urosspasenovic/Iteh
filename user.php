<?php

class User {
    public $id;
    public $username;
    public $password;
    public $name;

    public function __construct($id = null, $username = null, $password = null, $name = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->name = $name;
    }

    public static function logInUser($username, $password,mysqli $connection)
    {
        $q ="select * from user where username='".$username."' and password='".$password."' limit 1";
        return $connection->query($q);
    }


}