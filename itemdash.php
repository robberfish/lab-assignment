<?php
require('db.php'); //connect to db
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_query = "DELETE FROM `items` WHERE id = '$delete_id'";

    if (mysqli_query($con, $delete_query)) {
        header("Location: itemdash.php"); //redirect to refresh the page
        exit();
    } else {
        echo "Error". mysqli_error($con);
    }
}

//get all users' info from the database
$query = "SELECT id, name, image_url, price FROM `items`";
$result = mysqli_query($con, $query);
?>


<!DOCTYPE html>
<html>
<head>
<header>
        <i class="fa-solid fa-bug" style="color: #ffffff; font-size: 72px; display: block; align-content: center;margin-right: 15px;padding: 8px 16px; border-radius: 0px;"></i>
        <h1 id='p1' style="color: rgb(255, 255, 255); text-align: left; font-weight: bolder; font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; font-size:32px;">
            BEE <br> BUY <br>
        </h1>
        <nav>
            <ul class="nav-links">
                <li><a href="index.html">HOME</a></li>
                <li><a href="gallery.php">SHOP</a></li>
                <li><a href="bio.html">BIO</a></li>
                <li><a href="contactus.html">CONTACT</a></li>
                <li><a href="cart.php" class="active">CART</a></li>
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
    <meta charset="utf-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
     <!--for some reason application would not allow styles.css so I had to do styling here-->
    <style>
        table {
            width: 80%;
            margin: 16px auto;
            border-collapse: collapse;
        }
        body{
            background-color: white;
            background-image:none;
        }
        h1{
            color:black;
            font-size: 24px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
            font-weight:bold;
            background-color:rgba(241, 241, 241, 0.82);
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }
        th {
            background-color:rgba(242, 242, 242, 0.72);
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        tr:hover {
            background-color:rgba(241, 241, 241, 0.76);
        }
        a{
            color: black;
            font-weight: bolder;
        }
        a:hover{
            font-weight: bolder;
        }
        .group-buttons {
            text-align: center; 
            margin-top: 20px;   
        }


    </style>
</head>
<body>
    <div class="form">
        <h1>ITEM DASHBOARD</h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name </th>
                    <th>URL</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr><!--info from the db shown here-->
                        <td><?php echo htmlspecialchars($row['id']);?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['image_url']); ?></td>
                        <td><?php echo htmlspecialchars($row['price']);?></td>
                        <td>
                            <a href="itemdash.php?delete_id=<?php echo $row['id']; ?>">
                               Delete
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <div class="group-buttons">
            <button><p><a href="additem.php">Add New item</a></p></button>
            <button><p><a href="dashboard.php">User Dashboard</a></p></button>
            <button><p><a href="logout.php">Logout</a></p></button>
        </div>

    </div>
</body>
</html>
