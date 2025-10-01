<?php
session_start();

// Sample gadget products with images
$products = [
    1 => ["name" => "Smartphone X", "price" => 12000, "image" => "images/iphone.jfif"],
    2 => ["name" => "Wireless Earbuds", "price" => 2500, "image" => "images/Wireless earbuds.jfif"],
    3 => ["name" => "Smartwatch Pro", "price" => 5000, "image" => "images/smart watch.jfif"],
    4 => ["name" => "Gaming Headset", "price" => 3500, "image" => "images/gaming headset.jfif"]
];

// Add item to cart
if (isset($_GET['add'])) {
    $id = (int) $_GET['add'];
    if (isset($products[$id])) {
        if (!isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id] = 0;
        }
        $_SESSION['cart'][$id]++;
    }
    header("Location: store.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gadget Store</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #e3f2fd, #f1f8e9);
            margin: 0;
            padding: 0;
        }

        .navbar {
            background: #009688;
            padding: 15px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }

        .navbar h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }

        .navbar a {
            text-decoration: none;
            color: white;
            font-weight: 500;
            background: #00796B;
            padding: 8px 15px;
            border-radius: 8px;
            transition: 0.3s;
        }

        .navbar a:hover {
            background: #004D40;
        }

        .container {
            width: 90%;
            margin: 40px auto;
        }

        .products {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 25px;
        }

        .product {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 20px;
            text-align: center;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .product:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        .product img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 15px;
        }

        .product h3 {
            margin: 10px 0;
            font-size: 18px;
            color: #333;
        }

        .product p {
            font-size: 16px;
            font-weight: 600;
            color: #009688;
            margin: 8px 0 15px;
        }

        .product a {
            display: inline-block;
            background: #009688;
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            transition: 0.3s;
        }

        .product a:hover {
            background: #00796B;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="navbar">
        <h1>✨ Gadget Store</h1>
        <a href="cart.php">🛒 View Cart</a>
    </div>

    <div class="container">
        <div class="products">
            <?php foreach ($products as $id => $product): ?>
                <div class="product">
                    <img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
                    <h3><?= $product['name'] ?></h3>
                    <p>₱<?= number_format($product['price'], 2) ?></p>
                    <a href="store.php?add=<?= $id ?>">Add to Cart</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
