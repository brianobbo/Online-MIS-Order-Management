<?php
session_start();
include_once '../base-url.php';
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
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="style.css">

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
            <a class="menu__link" href="create-foodItem.php">FOOD</a>
            <a class="menu__link" href="../orders/order.php">Orders</a>


        </ul>
    </nav>

    <!- main-->
    <main class="admin__main">
        <div class="dashboard">

            <div class="dashboard__item dashboard__item--full">
                <div class="card">
                    <div class="card__header">
                        ADD FOOD ITEM
                    </div>
                    <div class="card__content">
                        <div class="card__item">
                            <div class="form-container">


                                <?php

                                $food_name = "";
                                $price = "";
                                $category="";
                                $photo = "";

                                if (isset($_POST['submit'])){

                                    $photo = $_FILES['photo']['name'];
                                    $food_name = mysqli_real_escape_string($db,$_POST['food_name']);
                                    $price = mysqli_real_escape_string($db,$_POST['price']);
                                    $category = mysqli_real_escape_string($db,$_POST['category']);

//upload folder
                                    $target = "../../images/".basename($photo);

                                    //upload itemto databasee
                                    $query = "INSERT INTO items(name, price, category, photo) VALUES('$food_name', '$price', '$category', '$photo') ";
                                    //execute query
                                    mysqli_query($db, $query);

                                    //move image to folder and image name to database
                                    if (move_uploaded_file($_FILES['photo']['tmp_name'],$target)){
                                        echo "successfully added food item";
                                        var_dump("succeful");
                                        header('location: create-foodItem.php');
                                    }else{
                                       // echo "not added: ".mysqli_error();
                                    }
                                }


                                ?>

                                <form action="create-foodItem.php" method="post" enctype="multipart/form-data">
                                    <div class="input-group" align="center">
                                        <input type="text" name="food_name" placeholder="Food Name">
                                        <input type="number" name="price" placeholder="Ugx 1000">

                                        <?php

                                        $query = "SELECT  *FROM categories ";
                                        $result =  mysqli_query($db,$query);
                                        ?>
                                        <select name="category">
                                            <option value="">category</option>
                                            <?php
                                            while ($row = mysqli_fetch_array($result)){?>
                                                <option value="<?php echo  $row['category_name']?>"><?php echo $row['category_name']?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="file" name="photo">
                                        <input type="submit" name="submit" value="ADD FOOD">

                                    </div>
                                </form>

                            </div>


                        </div>
                    </div>
                </div>
            </div>

            <div class="dashboard__item dashboard__item--full">
                <div class="card">
                    <div class="card__header">
                        FOOD LIST
                    </div>
                    <div class="card__content">
                        <div class="card__item">


                            <div id="gridview"><br>
                                <?php
                                //getDrugs

                               $query2 = "SELECT *FROM items";
                               $result2 = mysqli_query($db, $query2);

                               while ($row = mysqli_fetch_array($result2)){?>
                                    <div class="image">

                                            <img src='../../images/<?php echo $row['photo']?>' style="width: auto; height: 228px">
                                        <div class="item" style="margin-right: 65px; margin-left: 65px;">
                                            <h4><b><?php echo  $row['name'];?></b></h4>
                                            <h3><b>Ugx.<?php echo  $row['price'];?></b></h3>


    <?php
    echo "<a onClick=\"javascript: return confirm('Are You Sure you Want to Delete this foodItem');\"  
 href='delete-process-foodItem.php?id=".$row['id']."'>            
            <div class='input-group'>
            <input class='button' type='submit' value='DELETE' style=\"margin-right: 65px; margin-left: 65px; font-size: 10px\">
            </div>
            
 
</a>"; ?>





                                        </div>
                                    </div>
                                <?php }?>
                            </div>


                            <script type="text/javascript">
                                function confirmationDelete(anchor)
                                {
                                    var conf = confirm('Do u wanna delete foodItem ?');
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
