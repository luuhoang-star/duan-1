<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart_index = isset($_POST['cart_index']) ? (int)$_POST['cart_index'] : -1;
    $id_sp = isset($_POST['id_sp']) ? (int)$_POST['id_sp'] : 0;
    $new_qty = max(1, (int)($_POST['soluongcart'] ?? 1));

    // Tìm theo index hoặc theo id_sp
    if ($cart_index >= 0 && isset($_SESSION['cart'][$cart_index])) {
        $_SESSION['cart'][$cart_index]['soluongcart'] = $new_qty;
        $_SESSION['cart'][$cart_index]['tongtien'] = $new_qty * (int)$_SESSION['cart'][$cart_index]['price_sp'];
        $target_index = $cart_index;
    } else {
        $found = false;
        foreach ($_SESSION['cart'] as $k => $item) {
            if ($item['id_sp'] == $id_sp) {
                $_SESSION['cart'][$k]['soluongcart'] = $new_qty;
                $_SESSION['cart'][$k]['tongtien'] = $new_qty * (int)$item['price_sp'];
                $target_index = $k;
                $found = true;
                break;
            }
        }
        if (!$found) {
            echo json_encode(['success' => false, 'message' => 'Sản phẩm không có trong giỏ']);
            exit;
        }
    }

    $grand_total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $grand_total += (int)$item['price_sp'] * (int)$item['soluongcart'];
    }
    $_SESSION['tongbill'] = $grand_total;

    $line_total = (int)$_SESSION['cart'][$target_index]['price_sp'] * (int)$_SESSION['cart'][$target_index]['soluongcart'];

    echo json_encode([
        'success' => true,
        'line_total' => $line_total,
        'line_total_formatted' => number_format($line_total, 0, ",", ".") . ' ₫',
        'grand_total' => $grand_total,
        'grand_total_formatted' => number_format($grand_total, 0, ",", ".") . ' ₫',
        'cart_count' => count($_SESSION['cart'])
    ]);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Invalid request']);
