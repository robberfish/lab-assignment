<?php

require('db.php');
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
} //error debugging

if (isset($_POST['username'])) {
    $username = mysqli_real_escape_string($con, stripslashes($_POST['username']));
    $email    = mysqli_real_escape_string($con, stripslashes($_POST['email']));
    $password = mysqli_real_escape_string($con, stripslashes($_POST['password']));
    $phone    = mysqli_real_escape_string($con, stripslashes($_POST['phone']));
    $bday     = mysqli_real_escape_string($con, stripslashes($_POST['bday']));
    $create_datetime = date("Y-m-d H:i:s");
   
    $is_admin = 0; //default for new users. To make an admin, we need to go in and manually edit the database to make you an admin

    $query = "INSERT INTO users (username, password, email, phone, birthday, create_datetime, is_admin, buddy_id)
          VALUES ('$username', '" . password_hash($password, PASSWORD_DEFAULT) . "', '$email', '$phone', '$bday', '$create_datetime', '$is_admin')";
    $result = mysqli_query($con, $query);

    if ($result) {
        $success = "User added successfully. Start shopping!";
    } else {
        if (mysqli_errno($con) == 1062) {
            $error = "Username already exists. Please choose another."; //username should be unique
    } else {
        $error = "This did not work. Try again";
    }}
}

?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Pretend Photo Website</title>
    <link rel="stylesheet" href="styles.css">
    <style>select {
    width: 100%;
    padding: 12px 14px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    background-color: #fff;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    font-size: 14px;
    font-weight: 300;
    color: #333;
    appearance: none;
}
</style>
</head>

<body>
    <header>
        <i class="fa-solid fa-bug" style="color: #ffffff; font-size: 80px; display: block; align-content: center;margin-right: 15px;padding: 8px 16px; border-radius: 0px;"></i>
        <h1 id='p1' style="color: rgb(255, 255, 255); text-align: left; font-weight: bolder; font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; font-size:32px;">
            BEE <br> BUY <br>
        </h1>
        <nav>
            <ul class="nav-links">
                <li><a href="index.html">HOME</a></li>
                <li><a href="gallery.php">SHOP</a></li>
                <li><a href="bio.html">BIO</a></li>
                <li><a href="contactus.html">CONTACT</a></li>
                <li><a href="cart.php">CART</a></li>
                <li><a href="login.php">LOGIN</a></li>
                <li><a href="dashboard.php">ADMIN</a></li>
                <li><a href="additem.php">POST</a></li>
                <a href="https://facebook.com" target="_blank"> 
                    <i class="fa-brands fa-facebook-f" style="color: #ffffff; align-content: center;margin-right: 15px;padding: 8px 16px; border-radius: 0px;"></i>
                </a><br>
                <a href="https://x.com" target="_blank"> 
                    <i class="fa-brands fa-x-twitter" style="color: #ffffff; align-content: center;margin-right: 15px;padding: 8px 16px; border-radius: 0px;"></i>
                </a><br>
                <a href="https://instagram.com" target="_blank"> 
                    <i class="fa-brands fa-instagram" style="color: #ffffff; align-content: center;margin-right: 15px;padding: 8px 16px; border-radius: 0px;"></i>
                </a>
            </ul>
        </nav>
    </header>

    <h1>Sign Up</h1>
    <form method="POST" action=""> 
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="Phone number" required>
        <p>Birthday:</p><input type="date" name="bday" placeholder="Birthday" required><br>
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Register">
    </form>
    <?php if (isset($error)) { echo "<p style='color:white;'>$error</p>"; } ?>
    <?php if (isset($success)) { echo "<p style='color:white;'>$success</p>"; } ?>
    <br>
    <p>Already have an account? Login <a href="login.php"><u>here</u></a>!</p>

</body>
</html>
