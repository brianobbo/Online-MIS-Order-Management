<?php
session_start();
include_once '../sales-dashboard/config.php';
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
    <link rel="stylesheet" href="foodItem/style.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="customer/style.css">
    <link rel="stylesheet" type="text/css" href="foodItem/style.css">
    <style type="text/css">

        .container{
            display: flex;
        }
        .roundCountUpdate{
            margin-left: 100px;
            border-radius: 20px;
            width: 100px;
            height: 100px;
            padding: 10px;
            color: #f8f9f9;
            background: #173459 ;
        }
    </style>
</head>
<body>
<!-- partial:index.partial.html -->
<div class="admin">
    <header class="admin__header">
        <a href="#" class="logo">
            <!--            <h1>Dashboard</h1>-->
            <img src="icons/fastfood.png" width="100px">
        </a>

        <div class="toolbar">
            <div class="toolbar__left">
                <!--                <button class="btn btn--primary">Add content</button>-->
            </div>
            <div class="toolbar__right">
                <a href="admin/logout.php" class="btn btn--primary logout">Log Out</a>
            </div>
        </div>
    </header>

    <nav class="admin__nav">
        <ul class="menu">

            <a class="menu__link" href="index.php">Dashboard</a>
            <a class="menu__link" href="customer/users.php">Users</a>
            <a class="menu__link" href="foodItem/create-foodItem.php">FOOD</a>
            <a class="menu__link" href="orders/order.php">Orders</a>
            <a class="menu__link" href="out-put/system-output.php">Output</a>



        </ul>
    </nav>

    <!- main-->
    <main class="admin__main">
        <div class="dashboard">

            <!--Display round count for number of userrs orders and food items-->
            <div class="dashboard__item dashboard__item--full">
                <div class="card">
                    <div class="card__header">
                         KAKA CATERING SERVICE
                    </div>
                    <div class="card__content">
                        <div class="card__item">


                            <div class="container" " >
                            <div class="roundCountUpdate">
                                <h3 align="center">USERS</h3>
                                <p align="center" style="color: #d96129; font-weight: bolder">


                                    <?php
                                    $query1 = "SELECT COUNT(users.mobile) AS users FROM users";
                                    $result1 = mysqli_query($db, $query1);
                                    $values1 = mysqli_fetch_assoc($result1);
                                    $num_rows1 = $values1['users'];
                                    echo $num_rows1;
                                    ?>
                                </p>
                            </div>


                            <div class="roundCountUpdate">
                                <h3 align="center">ORDERS</h3>
                                <p align="center" style="color: #d96129; font-weight: bolder">
                                    <?php
                                    $query = "SELECT COUNT(bill_details.bill_no) AS orders FROM bill_details";
                                    $result = mysqli_query($db, $query);
                                    $values = mysqli_fetch_assoc($result);
                                    $num_rows = $values['orders'];
                                    echo $num_rows;
                                    ?>
                                </p>
                            </div>


                            <div class="roundCountUpdate">
                                <h3 align="center">FOOD ITEMS</h3>
                                <p align="center" style="color: #d96129; font-weight: bolder">
                                    <?php
                                    $query3 = "SELECT COUNT(items.name) AS items FROM items";
                                    $result3 = mysqli_query($db, $query3);
                                    $values3 = mysqli_fetch_assoc($result3);
                                    $num_rows3 = $values3['items'];
                                    echo $num_rows3;
                                    ?>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- display users of mobile here-->
        <div class="dashboard__item dashboard__item--full">
            <div class="card">
                <div class="card__header">
                    ALL USERS
                </div>
                <div class="card__content">
                    <div class="card__item">

                        <?php
                        include_once '../config.php';
                        $result3 = mysqli_query($db,"SELECT mobile, password, name, address FROM users ORDER BY name");
                        ?>

                        <table  id="t01">
                            <tr>
                                <th>name</th>
                                <th>mobile</th>
                                <th>address</th>
                            </tr>
                            <?php
                            $i=0;
                            while($row = mysqli_fetch_array($result3)) {
                            if($i%2==0)
                                $classname="even";
                            else
                                $classname="odd";
                            ?>
                            <tr class="<?php if(isset($classname)) echo $classname;?>">

                                <td><?php echo $row["name"]; ?></td>
                                <td><?php echo $row["mobile"]; ?></td>
                                <td><?php echo $row["address"]; ?></td>

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
