<?php
/**
 * Root Router
 * Tự động chuyển hướng từ thư mục gốc sang client/index.php và giữ nguyên tham số query (GET)
 */
$query_string = $_SERVER['QUERY_STRING'] ?? '';
$target = 'client/index.php' . (!empty($query_string) ? '?' . $query_string : '');
header('Location: ' . $target);
exit();
