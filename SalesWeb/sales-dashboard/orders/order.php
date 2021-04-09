<?php
session_start();
include_once '../config.php';
if (!isset($_SESSION['fullName'])) {
    header('location: ../admin/logout.php');
}else?>

<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>Pharmacure - Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../customer/style.css" type="text/css">
    <link rel="stylesheet" href="../foodItem/style.css" type="text/css">

</head>
<body style="font-size: 12px">
<!-- partial:index.partial.html -->
<div class="admin">
    <header class="admin__header">
        <a href="#" class="logo">
            <!--            <h1>Dashboard</h1>-->
            <img src="../icons/fastfood.png" width="100px">

        </a>


        <div class="toolbar">
            <div class="toolbar__left">
<!--                <button class="btn btn--primary">Add content</button>-->
            </div>
            <div class="toolbar__right">
                <a href="../admin/logout.php" class="btn btn--primary logout">Log Out</a>
            </div>
        </div>
    </header>
    <nav class="admin__nav">
        <ul class="menu">

            <a class="menu__link" href="../index.php">Dashboard</a>
            <a class="menu__link" href="../customer/users.php">Users</a>
            <a class="menu__link" href="../foodItem/create-foodItem.php">Food</a>
            <a class="menu__link" href="order.php">Orders</a>


        </ul>
    </nav>
    <main class="admin__main">
        <div class="dashboard">

            <div class="dashboard__item dashboard__item--full">
                <div class="card">
                    <div class="card__header">
                        ORDERS
                    </div>
                    <div class="card__content">
                        <div class="card__item">

<!-- Order payment implementation-->

                            <?php



                          $query = "SELECT
items.id, items.name, items.price, items.category, 
bill.bill_no, bill.bill_date, bill.mobile,
bill_details.itemid, bill_details.qty,
users.name, users.address

FROM items

INNER JOIN bill_details 
ON items.id = bill_details.itemid

INNER JOIN bill
ON bill_details.bill_no = bill.bill_no

INNER JOIN users
ON bill.mobile = users.mobile";



                        $result =   mysqli_query($db,$query);
                        while ($row = mysqli_fetch_array($result)){?>


                                <div class="card">
<!--                                    <img src="img_avatar2.png" alt="Avatar" style="width:100%">-->
                                    <div class="container">

                                        <table>
                                            <tr>
                                                <td>
                                                    <h4><b><?php echo  $row['name'];?></b></h4>
                                                    <p><b>LOCATION: </b><?php echo  $row['address'];?></p>
                                                    <p><b>AMOUNT: Ugx.</b><?php echo  $row['price'];?></p>
<!--                                                    <p><b>FOOD ITEM: </b>--><?php //echo  $row['name'];?><!--</p>-->
                                                    <p><b>CATEGORY: </b><?php echo  $row['category'];?></p>
                                                    <p><b>BILL DATE: </b><?php echo  $row['bill_date'];?></p>
                                                    <p><b>QUANTITY: </b><?php echo  $row['qty'];?></p>
                                                    <p><b>AMOUNT: Ugx.</b><?php echo  $row['price'];?></p>
                                                    <p><b>TELEPHONE: </b><?php echo  $row['mobile'];?></p>
                                                    <?php

                                                    echo "<a onClick=\"javascript: return confirm('Are You Sure you Want to Delete order');\"  
 href='delete-process-order.php?bill_no=".$row['bill_no']."'>            
<div class='input-group' style='width: 100px'>
            <input class='button' type='submit' value='DELETE ORDER' style=\"margin-right: 65px; margin-left: 65px; font-size: 10px\">
            </div> 
</a>";
                                                    ?>
                                                </td>

                                            </tr>
                                        </table>
                                        <div>
                                        </div>
                                    </div>
                                </div>
                            <?php }?>


                            <script type="text/javascript">
                                function confirmationDelete(anchor)
                                {
                                    var conf = confirm('Are you sure want to delete this order?');
                                    if(conf)
                                        window.location=anchor.attr("href");
                                }
                            </script>

                 <!--Order payment implementation-->




                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>
    <footer class="admin__footer">
        <span>&copy; 2021 KAKA CATERING SERVICE.</span>
        <span><a href="#1" class="help">Powerd by Obryanz. Inc</a></span>
    </footer>
</div>
<!-- partial -->
<script  src="./script.js"></script>

</body>
</html>
