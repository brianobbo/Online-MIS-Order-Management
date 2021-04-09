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
    <link rel="stylesheet" href="style.css">
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
                <a href="users.php">
                    <button class="btn btn--primary">Back</button>

                </a>
            </div>
            <div class="toolbar__right">
                <a href="../admin/logout.php" class="btn btn--primary logout">Log Out</a>
            </div>
        </div>
    </header>
    <nav class="admin__nav">
        <ul class="menu">
            <a class="menu__link" href="../index.php">Dashboard</a>
            <a class="menu__link" href="users.php">Users</a>
            <a class="menu__link" href="../foodItem/create-foodItem.php">FOOD</a>
            <a class="menu__link" href="../orders/order.php">Orders</a>

        </ul>
    </nav>

    <!- main-->
    <main class="admin__main">
        <div class="dashboard">

            <div class="dashboard__item dashboard__item--full">
                <div class="card">
                    <div class="card__header">
                        UPDATE USER
                    </div>
                    <div class="card__content">
                        <div class="card__item">

                            <?php
                            //session_start();
                            //
                            //if (!isset($_SESSION['fullName'])) {
                            //    header('location: ../admin/logout.php');
                            //
                            //}else


                            if(count($_POST)>0) {
                                mysqli_query($db,"UPDATE users set name='" . $_POST['name'] . "', mobile='" . $_POST['mobile'] . "', address='" . $_POST['address'] . "' WHERE mobile='" . $_POST['mobile'] . "'");
                                $message = "USER UPDATED SUCCESSFULLY";
                                header("location: users.php");
                            }
                            $result = mysqli_query($db,"SELECT *FROM users WHERE mobile='" . $_GET['mobile'] . "'");
                            $row= mysqli_fetch_array($result);
                            ?>
                            <html>
                            <head>

                                <link rel="stylesheet" type="text/css" href="style.css">

                                <title>Update customer Data</title>
                            </head>
                            <body>

                            <form name="frmUser" method="post" action="">
                                <div>

                                    <?php if(isset($message)) { echo $message; exit();} ?>
                                </div>

                                <div class="input-group">
                                    <input type="text" name="name"  value="<?php echo $row['name']; ?>">
                                </div>


                                <div class="input-group">
                                    <input type="text" name="mobile" class="txtField" value="<?php echo $row['mobile']; ?>">
                                </div>

                                <div class="input-group">
                                    <input type="text" name="address" class="txtField" value="<?php echo $row['address']; ?>">
                                </div>

                                <div class="input-group" align="center">
                                    <input class="btn" type="submit" name="submit" value="SUBMIT"/>

                                </div>


                            </form>
                            </body>
                            </html>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </main>
    <footer class="admin__footer">
        <span>&copy; 2020 KAKA CATERING SERVICE.</span>
        <span><a href="#1" class="help">Powerd by Obryanz. Inc</a></span>
    </footer>
</div>
<!-- partial -->
<script  src="./script.js"></script>

</body>
</html>
