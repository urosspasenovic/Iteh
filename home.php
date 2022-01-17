<?php
    require "dbBroker.php";
    require "pretplata.php";

    session_start();
   if (isset($_GET['logout']) && !empty($_GET['logout'])) {
        session_unset();
        session_destroy();
        header("Location: index.php");
    }
    
    $subscription = Pretplata::getAllSubscriptions($connection);

    if (!$subscription) {
        echo "Nastala je greška pri izvođenju upita.";
        die();
    }

    else {
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon1.ico"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <title>Pretplata</title>

</head>

<body>

    <div>
        <h1>Lista pretplata</h1> 
    </div>

    <div class="row" style="background-color: rgba(10, 65, 82, 0.0); border: none">
        <div class="col-6 col-md-4"></div>
        <div class="col-6 col-md-4">
            <input id="searchSubscription" placeholder="Find subscription" class="form-control"   onkeyup="searchSubscription()" >
        </div>
        <div class="col-6 col-md-4"> </div>
    </div>

    <div style="margin-top: 10px; background-color:  rgba(10, 65, 82, 0.5); border:none" >
        <table id="subscriptionTable" class="table " style="color: white; background-color: rgba(10, 65, 82, 1);">
            <thead class=" table-dark" style="color: white; background-color: rgb(2, 47, 61);">
            <tr>
                <th scope="col"></th>
                <th scope="col">Subscription name</th>
                <th scope="col">Maximum number of Accounts</th>
                <th scope="col">Price</th>
                <th scope="col">Select subscription</th>
            </tr>
            </thead>

            <tbody>
                <?php
                    while ($row = $subscription->fetch_array()) { 
                ?>
                <tr>
                    <td></td>
                    <td><?php echo $row["name"] ?></td>
                    <td><?php echo $row["maximumNumberOfAccounts"] ?></td>
                    <td><?php echo $row["price"] ?></td>
                    
                    <td>
                        <label class="custom-radio-btn">
                            <input type="radio" name="checked-donut" value=<?php echo $row["id"] ?>>
                        </label>
                    </td>

                </tr>
                <?php
            }
         } ?>
            </tbody>
        </table>
        <div class="row" style="padding: 10px; background-color: rgba(10, 65, 82, 0)">
            <div class="col-md-4">
        
                <button type="button" class="btn btn-primary"
                    style="color: white; background-color: rgb(13, 101, 128);" data-toggle="modal" data-target="#addGameModal">
                    <i class="bi bi-controller"></i> 
                    Add new subscription   
                </button>
             </div>
        
            <div class="col-sm-8" style="text-align: right">
                <button id="btnEditSubscription" class="btn " style="color: white; background-color: rgb(13, 101, 128);"
                    data-toggle="modal" data-target="#editSubscriptionModal">
                    <i class="bi bi-pen-fill"></i> 
                    Update subscription  
                </button>
                
                <button id="btnDeleteSubscription" class="btn " style="color: white; background-color: rgb(82, 10, 46);">
                    <i class="bi bi-eraser-fill"></i> 
                    Delete subscription
                </button>
            </div>
        </div>
    
        <a href="index.php?logout=true" style="float: right; padding: 15px">
            <button id="logout" type="button" class="btn" style="color: white; background-color: rgb(13, 101, 128);">
                <i class="bi bi-arrow-bar-left"></i>
                Log out
            </button>
        </a>
    </div>

</body>
</html>
