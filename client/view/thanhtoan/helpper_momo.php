<?php
/**
 * Helper giao tiếp API thanh toán MoMo
 */
function execPostRequest($url, $data)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data)
    ));
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

/**
 * Xử lý tạo URL thanh toán MoMo chung cho cả QR và ATM
 */
function process_momo_payment($idBill, $amount, $requestType = "payWithATM", $orderInfo = "Thanh toán đơn hàng")
{
    $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
    $partnerCode = 'MOMOBKUN20180529';
    $accessKey = 'klm05TvNBzhg7h7j';
    $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

    $orderId = time() . "_" . $idBill;
    $redirectUrl = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/index.php?act=thank&id_bill=" . $idBill;
    $ipnUrl = $redirectUrl;
    $extraData = "";
    $requestId = time() . "";

    $rawHash = "accessKey=" . $accessKey . 
               "&amount=" . $amount . 
               "&extraData=" . $extraData . 
               "&ipnUrl=" . $ipnUrl . 
               "&orderId=" . $orderId . 
               "&orderInfo=" . $orderInfo . 
               "&partnerCode=" . $partnerCode . 
               "&redirectUrl=" . $redirectUrl . 
               "&requestId=" . $requestId . 
               "&requestType=" . $requestType;

    $signature = hash_hmac("sha256", $rawHash, $secretKey);

    $data = [
        'partnerCode' => $partnerCode,
        'partnerName' => "8 Football Store",
        'storeId' => "MomoTestStore",
        'requestId' => $requestId,
        'amount' => $amount,
        'orderId' => $orderId,
        'orderInfo' => $orderInfo,
        'redirectUrl' => $redirectUrl,
        'ipnUrl' => $ipnUrl,
        'lang' => 'vi',
        'extraData' => $extraData,
        'requestType' => $requestType,
        'signature' => $signature
    ];

    $result = execPostRequest($endpoint, json_encode($data));
    $jsonResult = json_decode($result, true);

    if (isset($jsonResult['payUrl'])) {
        unset($_SESSION['cart']);
        unset($_SESSION['tongbill']);
        header('Location: ' . $jsonResult['payUrl']);
        exit();
    } else {
        // Nếu không kết nối được MoMo API sandbox, chuyển về trang cảm ơn
        unset($_SESSION['cart']);
        header('Location: index.php?act=thank&id_bill=' . $idBill);
        exit();
    }
}