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
                    style="color: white; background-color: rgb(13, 101, 128);" data-toggle="modal" data-target="#addSubscriptionModal">
                    <i class="bi bi-controller"></i> 
                    Add new subscription   
                </button>
             </div>
        
            <div class="col-sm-8" style="text-align: right">
                <button id="btnEditSubscription" name ="btnEditSubscription" class="btn " style="color: white; background-color: rgb(13, 101, 128);"
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

    <!-- Add subsription modal -->
    <div class="modal fade" id="addSubscriptionModal" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content" style="border: 3px solid rgb(2, 47, 61); background-color:rgb(2, 47, 61) ;">
                <div class="modal-header">
                    <h3 style="color: white; text-align:left">Add new subscription</h3>  
                </div>
                <div class="modal-body">
                    <div class="">
                        <form action="#" method="post" id="addSubscriptionForm">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input  type="text" style="border: 1px solid black" name="userId" class="form-control"
                                           placeholder="User ID" value="<?php echo $_SESSION['user_id'] ?>" readonly/> 
                                    </div>
                                    <div class="form-group">
                                        <input  type="text" style="border: 1px solid black" name="subscriptionName" class="form-control"
                                           placeholder="Subscription name" value=""/> 
                                    </div>
                                    <div class="form-group">
                                        <input type="number" style="border: 1px solid black" name="maximumNumberOfAccounts" class="form-control" 
                                        placeholder="Maximum number of Accounts" value=""/>
                                    </div>
                                    <div class="form-group">
                                        <input type="number" style="border: 1px solid black" name="subscriptionPrice" class="form-control"
                                           placeholder="Subscription price" value=""/>
                                    </div>
                                </div>
                                <div class="col-4" style="text-align: center">
                                    <div class="form-group">
                                        <button id="btnDodaj" type="submit" class="btn btn-success "
                                            style="background-color: rgba(10, 65, 82, 1); border: 1px solid black;">
                                             Add subscription
                                        </button>
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-default" 
                                            style="color: white; background-color: rgb(82, 10, 46); border: 1px solid white" 
                                            data-dismiss="modal">Dismiss
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>  
        </div>
    </div>

<!-- Edit subsription Modal-->
    <div class="modal fade" id="editSubscriptionModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content" style="border: 3px solid rgb(2, 47, 61); background-color:rgb(2, 47, 61) ;">
                <div class="modal-header">
                    <h3 style="color: white; text-align:left">Edit subscription</h3>   
                </div>
                <div class="modal-body">
                    <div class="">
                        <form action="#" method="post" id="editSubscriptionForm">
                    
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <input id="id" type="text" style="border: 1px  black" name="subscriptionId" class="form-control"
                                           placeholder="Subscription ID" value="" readonly/>
                                    </div>
                                    <div class="form-group">
                                        <input id="subscriptionNameId" style="border: 1px solid black" type="text" name="subscriptionName" class="form-control"
                                           placeholder="Game name" value=""/>
                                    </div>
                                    <div class="form-group">
                                        <input id="maximumNumberOfAccountsId" style="border: 1px solid black" type="number" name="maximumNumberOfAccounts" class="form-control"
                                           placeholder="Maximum number of accounts" value=""/>
                                    </div>
                                    <div class="form-group">
                                        <input id="subscriptionPriceId" style="border: 1px solid black" type="number" name="subscriptionPrice" class="form-control"
                                           placeholder="Subscription price" value=""/>
                                    </div>
                                </div>
                                <div class="col-4" style="text-align: center">
                                    <div class="form-group">
                                        <button id="btnIzmeni" type="submit" class="btn btn-success"
                                            style="background-color: rgba(10, 65, 82, 1); border: 1px solid black;">
                                             Update subscription
                                        </button>
                                    </div>
                                    <div class= "form-group">
                                        <button type="button" class="btn btn-default" 
                                        style="color: white; background-color: rgb(82, 10, 46); border: 1px solid white" 
                                        data-dismiss="modal">Dismiss
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
  
            </div>

        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="funkcije.js"></script>
    <script>
        function searchSubscription() {
            var searchInput, modified, searchTable, tr, i, td1, td2,  txtValue1, txtValue2
            searchInput = document.getElementById("searchSubscription");
            modified = searchInput.value.toLowerCase();
            searchTable = document.getElementById("subscriptionTable");
            row = searchTable.getElementsByTagName("tr");
           
            for (i = 0; i < row.length; i++) {
                col1 = row[i].getElementsByTagName("td")[1];
                col2 = row[i].getElementsByTagName("td")[2];
                col3 = row[i].getElementsByTagName("td")[3];
                if (col1 || col2 || col3) {
                    val1 = col1.textContent;
                    val2 = col2.textContent;
                    val3 = col3.textContent;
                    if (val1.toLowerCase().indexOf(modified) > -1 || val2.toLowerCase().indexOf(modified) > -1 || val3.toLowerCase().indexOf(modified) > -1) {
                        row[i].style.display = "";
                    } else {
                        row[i].style.display = "none";
                    }
                }
            }
        }
    </script>

</body>
</html>
