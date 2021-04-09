<?php include('server.php') ?>
<!DOCTYPE html>

<head>
    <title>Registration system PHP and MySQL</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
    <h2>Login</h2>
</div>

<form method="post" action="login.php">

    <?php include('errors.php'); ?>

    <div class="input-group">
        <label>Fullname</label>
        <input type="text" name="fullName" >
    </div>
    <div class="input-group">
        <label>Email</label>
        <input type="email" name="email">
    </div>
    <div class="input-group" align="center" style="size: 100px">
        <button type="submit" class="btn" name="login_admin">Login</button>
    </div>





    <p>
        Not yet a member? <a href="register.php">Sign up</a>
    </p>
</form>


</body>
</html>