<?php
session_start();

// Product list
$products = [
    1 => ["name" => "Smartphone X", "price" => 12000, "image" => "images/iphone.jfif"],
    2 => ["name" => "Wireless Earbuds", "price" => 2500, "image" => "images/Wireless earbuds.jfif"],
    3 => ["name" => "Smartwatch Pro", "price" => 5000, "image" => "images/smart watch.jfif"],
    4 => ["name" => "Gaming Headset", "price" => 3500, "image" => "images/gaming headset.jfif"]
];

// Cancel single item
if (isset($_POST['remove_item'])) {
    $id = (int) $_POST['remove_item'];
    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }
    header("Location: cart.php");
    exit();
}

$total = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f1f8e9, #e3f2fd);
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
            font-size: 22px;
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
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            overflow: hidden;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 15px;
            text-align: center;
        }

        th {
            background: #009688;
            color: white;
            font-size: 15px;
            letter-spacing: 0.5px;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        tr:hover {
            background: #e0f2f1;
        }

        td img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 8px;
            vertical-align: middle;
        }

        .btn {
            padding: 8px 14px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn.remove {
            background: #d32f2f;
            color: white;
        }

        .btn.remove:hover {
            background: #b71c1c;
        }

        .btn.checkout {
            background: #009688;
            color: white;
            font-size: 16px;
            padding: 12px 20px;
            border-radius: 8px;
            display: block;
            margin: 20px auto;
        }

        .btn.checkout:hover {
            background: #00796B;
        }

        .total {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            text-align: right;
            margin-top: 10px;
        }

        .empty {
            text-align: center;
            padding: 20px;
            font-size: 16px;
            color: #666;
        }

        .warning {
            color: #d32f2f;
            text-align: center;
            font-weight: 500;
            margin-top: 10px;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="navbar">
        <h1>🛒 Your Cart</h1>
        <a href="store.php">⬅ Continue Shopping</a>
    </div>

    <div class="container">
        <h2>Shopping Cart Details</h2>
        <table>
            <tr>
                <th>Item</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
                <th>Action</th>
            </tr>
            <?php if (!empty($_SESSION['cart'])): ?>
                <?php foreach ($_SESSION['cart'] as $id => $qty): 
                    $subtotal = $products[$id]['price'] * $qty;
                    $total += $subtotal;
                ?>
                    <tr>
                        <td>
                            <img src="<?= $products[$id]['image'] ?>" alt="<?= $products[$id]['name'] ?>">
                            <?= $products[$id]['name'] ?>
                        </td>
                        <td><?= $qty ?></td>
                        <td>₱<?= number_format($products[$id]['price'], 2) ?></td>
                        <td>₱<?= number_format($subtotal, 2) ?></td>
                        <td>
                            <form action="cart.php" method="POST">
                                <button type="submit" name="remove_item" value="<?= $id ?>" class="btn remove">❌ Remove</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3" style="text-align:right; font-weight:600;">Total:</td>
                    <td colspan="2" style="font-weight:600; color:#009688;">₱<?= number_format($total, 2) ?></td>
                </tr>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="empty">Your cart is empty.</td>
                </tr>
            <?php endif; ?>
        </table>

        <?php if ($total >= 100 && !empty($_SESSION['cart'])): ?>
            <form action="payment_form.php" method="POST">
                <button type="submit" class="btn checkout">Proceed to Checkout</button>
            </form>
        <?php elseif ($total > 0): ?>
            <p class="warning">⚠ Minimum checkout amount is ₱100.</p>
        <?php endif; ?>
    </div>
</body>
</html>
