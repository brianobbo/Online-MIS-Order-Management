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
    <title>Restaurant</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../customer/style.css">
    <link rel="stylesheet" type="text/css" href="../foodItem/style.css"> <!--this is for font size included in style.css of dru and also for round cornerd butttton-->
    <link rel="stylesheet" href="../foodItem/style.css">



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




            <div class="dashboard__item dashboard__item--full">
                <div class="card">
                    <div class="card__header" style=" display: flex text-decoration: none ;background-color: #313541; color: white">
                        <a href="../customer/add-user.php" ><img src="../icons/add.png" width="25px">ADD USER</a>
                    </div>
                    <div class="card__content">
                        <div class="card__item">


                            <?php
                            $result = mysqli_query($db,"SELECT name, mobile, address FROM users ORDER BY name");
                            ?>

                            <table  id="t01">
                                <tr>
                                    <th>name</th>
                                    <th>mobile</th>
                                    <th>address</th>
                                    <th colspan="2">Action</th>
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
                                        <td><?php echo $row["mobile"]; ?></td>
                                        <td><?php echo $row["address"]; ?></td>

                                        <!-- UPDATE-->
                                        <td><b style="color: white"><a href="../customer/update-user.php?mobile=<?php echo $row["mobile"]; ?>">  <img src='../icons/edit.png' width='15'></a></td></b>


                                        <!-- DELETE -->


                                        <?php

                                        echo "<td><a onClick=\"javascript: return confirm('Are You Sure ou Want to Delete');\" 
 href='delete-process-users.php?mobile=".$row['mobile']."'>            
 <img src='../icons/delete.png' width='15'>
 
</a></td>";
                                        ?>

                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </table>



                            <script type="text/javascript">
                                function confirmationDelete(anchor)
                                {
                                    var conf = confirm('Are you sure want to delete this record?');
                                    if(conf)
                                        window.location=anchor.attr("href");
                                }
                            </script>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </main>
    <footer class="admin__footer">
        <span>&copy; 2021 KAKA CATERING SERVICE</span>
        <span><a href="#1" class="help">Powerd by Obryanz. Inc</a></span>
    </footer>
</div>
<!-- partial -->
<script  src="./script.js"></script>

</body>
</html>
