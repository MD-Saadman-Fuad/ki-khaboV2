<?php
include('config/constants.php');

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($action == 'add') {
    $food_id = isset($_GET['food_id']) ? (int)$_GET['food_id'] : 0;
    $qty = isset($_GET['qty']) ? (int)$_GET['qty'] : 1;
    if ($qty < 1) $qty = 1;

    if ($food_id > 0) {
        $sql = "SELECT * FROM food WHERE id = $food_id AND active = 'Yes'";
        $res = mysqli_query($conn, $sql);
        if ($res && mysqli_num_rows($res) == 1) {
            $row = mysqli_fetch_assoc($res);
            $title = $row['title'];
            $price = (float)$row['price'];
            $image_name = $row['image_name'];

            if (isset($_SESSION['cart'][$food_id])) {
                $_SESSION['cart'][$food_id]['qty'] += $qty;
            } else {
                $_SESSION['cart'][$food_id] = array(
                    'id' => $food_id,
                    'title' => $title,
                    'price' => $price,
                    'image_name' => $image_name,
                    'qty' => $qty
                );
            }
            $_SESSION['cart_msg'] = "<div class='bg-emerald-50 border border-emerald-200 text-emerald-700 text-center font-semibold py-2 px-4 rounded-xl shadow-xs'>Added <strong>" . htmlspecialchars($title) . "</strong> to your cart!</div>";
        }
    }
    
    $redirect = isset($_GET['redirect']) ? $_GET['redirect'] : (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : SITEURL);
    header("Location: " . $redirect);
    exit();

} elseif ($action == 'update') {
    $food_id = isset($_GET['food_id']) ? (int)$_GET['food_id'] : 0;
    $qty = isset($_GET['qty']) ? (int)$_GET['qty'] : 1;

    if ($food_id > 0 && isset($_SESSION['cart'][$food_id])) {
        if ($qty <= 0) {
            unset($_SESSION['cart'][$food_id]);
        } else {
            $_SESSION['cart'][$food_id]['qty'] = $qty;
        }
    }
    header("Location: " . SITEURL . "cart.php");
    exit();

} elseif ($action == 'remove') {
    $food_id = isset($_GET['food_id']) ? (int)$_GET['food_id'] : 0;
    if ($food_id > 0 && isset($_SESSION['cart'][$food_id])) {
        unset($_SESSION['cart'][$food_id]);
        $_SESSION['cart_msg'] = "<div class='bg-amber-50 border border-amber-200 text-amber-700 text-center font-semibold py-2 px-4 rounded-xl shadow-xs'>Item removed from cart.</div>";
    }
    header("Location: " . SITEURL . "cart.php");
    exit();

} elseif ($action == 'clear') {
    $_SESSION['cart'] = array();
    $_SESSION['cart_msg'] = "<div class='bg-stone-100 border border-stone-200 text-stone-600 text-center font-semibold py-2 px-4 rounded-xl shadow-xs'>Cart cleared.</div>";
    header("Location: " . SITEURL . "cart.php");
    exit();

} else {
    header("Location: " . SITEURL . "cart.php");
    exit();
}
?>
