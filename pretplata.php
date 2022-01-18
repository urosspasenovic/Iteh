<?php
class Pretplata
{
    public $id;
    public $name;
    public $maximumNumberOfAccounts;
    public $price;
    public $userId;
    
    public function __construct($id = null, $name = null, $maximumNumberOfAccounts = null, $price = null, $userId= -1)
    {
        $this->id = $id;
        $this->name = $name;
        $this->maximumNumberOfAccounts = $maximumNumberOfAccounts;
        $this->price = $price;
        $this->userId= $userId;
    }

    public static function getAllSubscriptions(mysqli $connection)
    {
        $userId= $_SESSION['user_id'];
        $q = "SELECT * FROM proizvod where userId= $userId";
        return $connection->query($q);
    }

    public static function getSubscriptionById($id, mysqli $connection)
    {
        $q = "SELECT * FROM proizvod WHERE id=$id";
        $myArray = array();
        if ($result = $connection->query($q)) {

            while ($row = $result->fetch_array(1)) {
                $myArray[] = $row;
            }
        }
        return $myArray;
    }

    public static function deleteSubscriptionById($id, mysqli $connection)
    {
        $q = "DELETE FROM proizvod WHERE id=$id";
        return $connection->query($q);
    }

    public static function addSubscription($name, $maximumNumberOfAccounts, $price, $userId, mysqli $connection)
    {
        $q = "INSERT INTO proizvod(name,maximumNumberOfAccounts,price,userId) values('$name','$maximumNumberOfAccounts', '$price','$userId')";
        return $connection->query($q);
    }

    public static function editSubscription($id, $name, $maximumNumberOfAccounts, $price, mysqli $connection)
    {
        $q = "UPDATE proizvod set name='$name', maximumNumberOfAccounts ='$maximumNumberOfAccounts', price='$price' where id=$id";
        return $connection->query($q);
    }
}