<?php

require "../dbBroker.php";
require "../pretplata.php";

if(isset($_POST['id'])) {
    $pretplata = Pretplata::getSubscriptionById($_POST['id'], $connection);
    echo json_encode($pretplata);
}
