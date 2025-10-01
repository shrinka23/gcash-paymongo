<?php
session_start();

// Calculate total from cart
$products = [
    1 => ["name" => "Smartphone X", "price" => 12000],
    2 => ["name" => "Wireless Earbuds", "price" => 2500],
    3 => ["name" => "Smartwatch Pro", "price" => 5000],
    4 => ["name" => "Gaming Headset", "price" => 3500]
];

$total = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $id => $qty) {
        $total += $products[$id]['price'] * $qty;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PayMongo Payment</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;    
        }

        body {
            background: linear-gradient(135deg, #e3f2fd, #f1f8e9);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .payment-container {
            background: #fff;
            padding: 40px 35px;
            border-radius: 15px;
            width: 400px;
            text-align: center;
            box-shadow: 0px 10px 25px rgba(0,0,0,0.1);
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            font-size: 24px;
            font-weight: 600;
            color: #009688;
            margin-bottom: 15px;
        }

        .amount-box {
            background: #e0f2f1;
            color: #004d40;
            font-size: 20px;
            font-weight: 600;
            padding: 12px;
            border-radius: 10px;
            margin: 15px 0 25px;
            box-shadow: inset 0 2px 6px rgba(0,0,0,0.05);
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: #444;
            text-align: left;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 18px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
            transition: border 0.3s ease;
        }

        input:focus {
            border-color: #009688;
        }

        .btn {
            display: inline-block;
            width: 100%;
            padding: 14px;
            font-size: 16px;
            font-weight: 500;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s ease;
        }

        .btn.pay {
            background: #009688;
            color: white;
        }

        .btn.pay:hover {
            background: #00796B;
        }

        .btn.back {
            background: #d32f2f;
            color: white;
            margin-top: 12px;
        }

        .btn.back:hover {
            background: #b71c1c;
        }

        .warning {
            color: #d32f2f;
            font-weight: 500;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <h2>💳 Complete Your Payment</h2>

        <?php if ($total >= 100): ?>
            <div class="amount-box">
                Total Amount: ₱<?= number_format($total, 2) ?>
            </div>

            <form action="create_payment.php" method="POST">
                <input type="hidden" name="amount" value="<?= $total ?>">
                <button type="submit" class="btn pay">✅ Pay Now</button>
            </form>
        <?php else: ?>
            <p class="warning">⚠ Your total is below ₱100. Add more items to checkout.</p>
            <a href="store.php"><button class="btn back">⬅ Back to Store</button></a>
        <?php endif; ?>
    </div>
</body>
</html>
