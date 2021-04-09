<?php
session_start();
include_once '../config.php';
if (!isset($_SESSION['fullName'])) {
    header('location: admin/logout.php');
}else?>
<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <title>Restaurant</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../foodItem/style.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../customer/style.css">
    <link rel="stylesheet" type="text/css" href="../foodItem/style.css">

</head>
<body>
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
            <a class="menu__link" href="../foodItem/create-foodItem.php">FOOD</a>
            <a class="menu__link" href="../orders/order.php">Orders</a>


        </ul>
    </nav>

    <!- main-->
    <main class="admin__main">
        <div class="dashboard">

            <!--Display round count for number of userrs orders and food items-->
            <div class="dashboard__item dashboard__item--full">
                <div class="card">
                    <div class="card__header">
                        SALES OUT PUT
                    </div>
                    <div class="card__content">
                        <div class="card__item">

                            <?php
                            $result = mysqli_query($db,"SELECT
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
ON bill.mobile = users.mobile");
                            ?>

                            <table  id="t01">
                                <tr>
                                    <th>Customer</th>
                                    <th>Address</th>
                                    <th>Amount</th>
                                    <th>CATEGORY</th>
                                    <th>Bill Date</th>
                                    <th>Quantity</th>
                                    <th>Telephone</th>
                                    </td>
                                </tr>
                                <?php
                                $i=0;
                                while($row = mysqli_fetch_array($result)) {
                                    if($i%2==0)
                                        $classname="even";
                                    else
                                        $classname="odd";
                                    ?>
                                    <tr class="<?php if(isset($classname)) echo $classname;?>">

                                        <td><?php echo $row["name"]; ?></td>
                                        <td><?php echo $row["address"]; ?></td>
                                        <td><?php echo $row["price"]; ?></td>
                                        <td><?php echo $row["category"]; ?></td>
                                        <td><?php echo $row["bill_date"]; ?></td>
                                        <td><?php echo $row["qty"]; ?></td>
                                        <td><?php echo $row["mobile"]; ?></td>

                                        </a></td>

                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </table>



                        </div>
                </div>
            </div>
        </div>



        <!-- display system outputs-->





</div>
</main>
<footer class="admin__footer">
    <span>&copy; 2021 KAKA CATERING SERVICE </span>
    <span><a href="#1" class="help">Powerd by Obryanz. Inc</a></span>
</footer>
</div>
<!-- partial -->
<script  src="./script.js"></script>

</body>
</html>
