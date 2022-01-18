<?php
require "../dbBroker.php";
require "../pretplata.php";
if(isset($_POST['id'])) {
    Pretplata::deleteSubscriptionById($_POST['id'], $connection);
}