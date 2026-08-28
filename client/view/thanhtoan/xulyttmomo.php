<?php
require_once __DIR__ . '/helpper_momo.php';

$amount = $_SESSION['tongbill'] ?? 0;
$orderInfo = "Thanh toán bằng mã QR MoMo - Đơn hàng #" . ($idBill ?? 0);
process_momo_payment($idBill, $amount, "captureWallet", $orderInfo);