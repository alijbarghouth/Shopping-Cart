<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart | Home Page</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css.map">
</head>

<body class="card bg-light mb-3">

    <header>
        <div class="container">
            <div class="header_content">
                <a class="brand" href="index.html">Shopping Cart</a>
                <nav>
                    <ul><?php
                        include "php/DBconnection.php";

                        if (!empty($_GET["id"])) {
                            $userId = $_GET["id"];
                            $name;
                            $imagePath;

                            $sql = 'SELECT username,image FROM customer WHERE id = ?';
                            $res = $conn->prepare($sql);
                            $res->bind_param('i', $userId);
                            $res->execute();
                            $res->bind_result($username, $image);
                            $res->store_result();
                            if ($res->num_rows > 0) {
                                while ($res->fetch()) {
                                    $name = $username;
                                    $imagePath = $image;
                                }
                            }
                            echo "<p style='color:white;'>" . $name . "</p>";
                            echo "<img src='img/$imagePath' style='width:50;height:50px;     border-radius: 50%;
                '>";
                        } else {
                            echo "<li><a href='login.html'>Sign In</a></li>";
                            echo "<li><a href='register.html'>Sign Up</a></li>";
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <section class="Home">
        <div class="contaner">
            <div class="products">
                <div class="product_item">
                    <img class="product_item_image" src="img/c-d-x-PDX_a_82obo-unsplash.jpg" alt="image">
                    <div class="product_item_describtion">
                        <h3>Headphone Item</h3>
                        <p>Hd Yellow Wallpapers</p>
                        <span>size:large</span>
                    </div>
                    <div class="product_item_action">
                        <button class="add_to_cart">Add To Cart</button>
                        <i><i class="fas fa-heart"></i></i>
                    </div>
                </div>
                <div class="product_item">
                    <img class="product_item_image" src="img/eniko-kis-KsLPTsYaqIQ-unsplash.jpg" alt="image">
                    <div class="product_item_describtion">
                        <h3>Camera Item</h3>
                        <p>NIKON CORPORATION, NIKON D3200</p>
                        <span>size:large</span>
                    </div>
                    <div class="product_item_action">
                        <button class="add_to_cart">Add To Cart</button>
                        <i><i class="fas fa-heart"></i></i>
                    </div>
                </div>
                <div class="product_item">
                    <img class="product_item_image" src="img/rachit-tank-2cFZ_FB08UM-unsplash.jpg" alt="image">
                    <div class="product_item_describtion">
                        <h3>Watch Item</h3>
                        <p>Hd 3d Wallpapers</p>
                        <span>size:large</span>
                    </div>
                    <div class="product_item_action">
                        <button class="add_to_cart">Add To Cart</button>
                        <i><i class="fas fa-heart"></i></i>
                    </div>
                </div>
                <div class="product_item">
                    <img class="product_item_image" src="img/giorgio-trovato-K62u25Jk6vo-unsplash.jpg" alt="image">
                    <div class="product_item_describtion">
                        <h3>Glasses Item</h3>
                        <p>Canon, EOS 5D Mark III</p>
                        <span>size:large</span>
                    </div>
                    <div class="product_item_action">
                        <button class="add_to_cart">Add To Cart</button>
                        <i><i class="fas fa-heart"></i></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="js/all.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.bundle.min.js.map"></script>
</body>

</html>