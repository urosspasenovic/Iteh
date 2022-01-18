<?php
require "../dbBroker.php";
require "../pretplata.php";

if (isset($_POST['subscriptionName']) && isset($_POST['maximumNumberOfAccounts']) 
    && isset($_POST['subscriptionPrice']) ) {

        Pretplata::addSubscription($_POST['subscriptionName'], $_POST['maximumNumberOfAccounts'], $_POST['subscriptionPrice'],$_POST['userId'], $connection);
}
