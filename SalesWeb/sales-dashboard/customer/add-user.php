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
<!--                        <h1>Dashboard</h1>-->
            <img src="../logo/pharmacurelogo.png" width="100px">
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
                        ADD USER
                    </div>
                    <div class="card__content">
                        <div class="card__item">


                            <form style="align-self: center" method="post" >
                                <div class="input-group">
                                    <input type="text" name="fullName" placeholder="fullName">
                                </div>

                                <div class="input-group">
                                    <input type="text" name="telephone" placeholder="telephone">
                                </div>

                                <div class="input-group">
                                    <input type="text" name="email" placeholder="email">
                                </div>

                                <div class="input-group">
                                    <input type="text" name="token" placeholder="token">
                                </div>

                                <div class="input-group">
                                    <input type="text" name="dateOfBirth" placeholder="dateOfBirth">
                                </div>

                                <div class="input-group" align="center">
                                    <input class="button" type="submit" name="add" value="ADD "/>

                                </div>
                            </form>

                            <?php
                            if(isset($_POST['add']))
                            {
                                $fullName = $_POST['fullName'];
                                $telephone = $_POST['telephone'];
                                $email = $_POST['email'];
                                $token = $_POST['token'];
                                $dateOfBirth = $_POST['dateOfBirth'];

                                $sql = "INSERT INTO customer (fullName,telephone,email,token,dateOfBirth)
	 VALUES ('$fullName','$telephone','$email','$token','$dateOfBirth')";
                                if (mysqli_query($db, $sql)) {
                                    //header('location: users.php');
                                    echo "USER ADDED SUCCESSFULLY";
                                    exit();
                                } else {
                                    echo "Error: " . $sql . "
" . mysqli_error($db);
                                }
                                mysqli_close($db);
                            }
                            ?>
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
