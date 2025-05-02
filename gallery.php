<?php
require('db.php'); 
$query = "SELECT items.id, items.name, items.image_url, items.price, users.username 
    FROM items 
    JOIN users ON items.user_id = users.id";


$result = mysqli_query($con, $query);
$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BB Shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
     <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/fresh-bootstrap-table.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="styles.css">
  <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet">
  <link href="http://fonts.googleapis.com/css?family=Roboto:400,700,300" rel="stylesheet" type="text/css">
    <!--was having issues with styling so had to do some extra styling here-->
    <style> 
        body{
            background-image: url("mountains.jpg");
            background-color: rgb(36, 36, 36);
            background-blend-mode: multiply;
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            margin: 0;
        }
        button{
            width: 30%;
        }

        .container {
            padding: 16px;
            width: 100%;
            max-width: calc(100vw - 128px);
            margin-right: 128px; 
        }
        .container img {
            object-fit: cover;
            margin-bottom: 15px;
            transition: transform 0.3s ease;
        }

        .container img:hover {
            border-radius: 8px;
            box-shadow: 0px 0px 10px 8px rgba(255, 255, 255, 0.212);
        }
       
        .modal-body p {
            color: black;
        }   
    </style>
</head>
<body>
<header>
<i class="fa-solid fa-bug" style="color: #ffffff; font-size: 72px; display: block; align-content: center;margin-right: 15px;padding: 8px 16px; border-radius: 0px;"></i>
    <h1 id='p1' style="color: rgb(255, 255, 255); text-align: left; font-weight: bolder; font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; font-size:32px;">
            BEE <br> BUY <br>
        </h1>
        <nav>
            <ul class="nav-links">
                <li><a href="index.html" >HOME</a></li>
                <li><a href="gallery.php"lass="active">SHOP</a></li>
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
                    <i class="fa-brands fa-x-twitter" style="color: #ffffff; align-content: center;margin-right: 15px;padding: 8px 16px; border-radius: 0px; text-decoration: none;"></i>
                </a><br>
                <a href="https://instagram.com" target="_blank"> 
                    <i class="fa-brands fa-instagram" style="color: #ffffff; align-content: center;margin-right: 15px;padding: 8px 16px; border-radius: 0px;"></i>
                </a>
                </ul>
        </nav>
    </header>
    <!-- modal container here with all the specs for the item-->
    <div class="container mt-5 pt-5">
        <div class="row row-cols-1 row-cols-md-3 g-3">
            <?php foreach ($items as $item): ?>
                <div class="col">
                <img src="<?php echo htmlspecialchars($item['image_url']); ?>" 
                class="img-fluid" 
                alt="<?php echo htmlspecialchars($item['name']); ?>" 
                data-bs-toggle="modal" 
                data-bs-target="#open-modal" 
                data-id="<?php echo $item['id']; ?>" 
                data-name="<?php echo htmlspecialchars($item['name']); ?>" 
                data-price="<?php echo $item['price']; ?>"
                data-username="<?php echo htmlspecialchars($item['username']); ?>">

                </div>
            <?php endforeach; ?>
        </div>
    </div>
                <!--styling for the modal-->
    <div class="modal" id="open-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="" class="img-fluid" id="m_image">
                    <p id="m_text" class="mt-2" style="color: black;"></p>
                    <p id="m_price" class="mt-2" style="color: black;"></p>
                    <p id="m_user" class="mt-2" style="color: black; font-style: italic;"></p>
                    <button type="button" class="button" onclick="addToCart()">Add to Cart</button>
                </div>
            </div>
        </div>
    </div> <!--adding bootstrap and popper to help with modal styling-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    
    <script> //allowing modal to open and show accurate data when clicked
        document.querySelectorAll('.container img[data-bs-toggle="modal"]').forEach(image => {
            image.addEventListener('click', () => {
                document.getElementById('m_image').src = image.src;
                document.getElementById('m_text').textContent = image.getAttribute('data-name');
                document.getElementById('m_price').textContent = "$" + image.getAttribute('data-price');
                document.getElementById('m_user').textContent = "Posted by: " + image.getAttribute('data-username');
            });
        });



        function addToCart() { //add to cart function, that tracks what items you are collecting.
    let name = document.getElementById('m_text').textContent;
    let priceText = document.getElementById('m_price').textContent;

    let price = parseFloat(priceText.replace(/[^\d.-]/g, ''));
    if (isNaN(price)){
        alert("Invalid price");
        return;
    }
    let cart = JSON.parse(localStorage.getItem("cart"))||[];
    cart.push({ name, price });
    localStorage.setItem("cart", JSON.stringify(cart));
    
    alert(name +" added to your cart");//notify you when an item has been added
}
</script>
</body>
</html>
