<?php include('server.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration system PHP and MySQL</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
    <h2>Register</h2>
</div>

<form method="post" action="register.php ">

    <?php include('errors.php'); ?>

    <div class="input-group">
        <label>FullName</label>
        <input type="text" name="fullName" value="<?php echo $fullName; ?>">
    </div>
    <div class="input-group">
        <label>Telephone</label>
        <input type="text" name="telephone" value="<?php echo $telephone; ?>">
    </div>

    <div class="input-group">
        <label>Email</label>
        <input type="text" name="email" value="<?php echo $email?>">
    </div>

    <!--               <div class="input-group">-->
    <!--			<label>Token</label>-->
    <!--			<input type="text" name="token" value="--><?php //echo $token?><!--">-->

    <select name="token">
        <option>Token</option>
        <option value="ADMIN">ADMIN</option>
        <option value="OTHER">OTHER</option>

    </select>
    </div>





    <div class="input-group">
        <button type="submit" class="btn" name="reg_admin">Register</button>
    </div>
    <p>
        Already a member? <a href="login.php">Sign in</a>
    </p>
</form>
</body>
</html>