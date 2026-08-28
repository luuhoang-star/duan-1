<?php
/**
 * File cầu nối tương thích ngược (Compatibility Bridge)
 * Tự động nạp toàn bộ các model đã được chuẩn hóa để code cũ chạy mượt mà mà không nhân bản mã nguồn.
 */
require_once __DIR__ . '/pdo.php';
require_once __DIR__ . '/product.php';
require_once __DIR__ . '/category.php';
require_once __DIR__ . '/bill.php';
require_once __DIR__ . '/cart.php';
require_once __DIR__ . '/binhluan.php';
require_once __DIR__ . '/user.php';