<?php
require_once 'pdo.php';
require_once 'bill.php';

/**
 * Thêm sản phẩm chi tiết vào bảng cart của đơn hàng
 */
function insert_billhoadon($idBill, $id_sp, $name_sp, $price_sp, $size_sp, $soluong_sp, $tongtien)
{
    $sql = "INSERT INTO `cart`(`id_sp`, `name_sp`, `size_sp`, `price_sp`, `soluong_sp`, `tong_tien`, `id_bill`) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    pdo_execute($sql, $id_sp, $name_sp, $size_sp, $price_sp, $soluong_sp, $tongtien, $idBill);
}

/**
 * Lấy danh sách sản phẩm trong hóa đơn theo id_bill (hoặc lấy tất cả nếu id_bill null)
 */
function select_billhoadon($id_bill = null)
{
    if (!empty($id_bill)) {
        $sql = "SELECT * FROM `cart` WHERE id_bill = ? ORDER BY id_cart ASC";
        return pdo_query($sql, $id_bill);
    } else {
        $sql = "SELECT * FROM `cart` ORDER BY id_cart DESC";
        return pdo_query($sql);
    }
}