<?php
require_once 'pdo.php';
require_once 'product.php'; // Cho hàm render_pagination

/**
 * Thêm mới đơn hàng (hóa đơn) và trả về ID hóa đơn vừa tạo
 */
function insert_hoadon($ngaytao, $pttt, $tongbill, $trangthai, $trangthaitt, $iduser)
{
    $sql = "INSERT INTO `bill`(`ngaydat`, `pttt`, `tongbill`, `trangthai`, `trangthaitt`, `id_user`) 
            VALUES (?, ?, ?, ?, ?, ?)";
    return pdo_execute_last_result($sql, $ngaytao, $pttt, $tongbill, $trangthai, $trangthaitt, $iduser);
}

/**
 * Lấy danh sách hóa đơn kèm thông tin khách hàng (hỗ trợ lọc theo mã hoặc số tiền)
 */
function select_hoadon($kyc = null, $sgia = null)
{
    if (!empty($kyc)) {
        $sql = "SELECT bill.*, user.name_user, user.email, user.sdt, user.diachi 
                FROM bill 
                INNER JOIN user ON bill.id_user = user.id_user 
                WHERE bill.id_bill = ?
                ORDER BY bill.id_bill DESC";
        return pdo_query($sql, $kyc);
    } else if (!empty($sgia) && (int)$sgia > 0) {
        $sql = "SELECT bill.*, user.name_user, user.email, user.sdt, user.diachi 
                FROM bill 
                INNER JOIN user ON bill.id_user = user.id_user 
                WHERE bill.tongbill >= ?
                ORDER BY bill.id_bill DESC";
        return pdo_query($sql, (int)$sgia);
    } else {
        $sql = "SELECT bill.*, user.name_user, user.email, user.sdt, user.diachi 
                FROM bill 
                INNER JOIN user ON bill.id_user = user.id_user 
                ORDER BY bill.id_bill DESC";
        return pdo_query($sql);
    }
}

/**
 * Lấy chi tiết 1 đơn hàng theo ID kèm thông tin người mua
 */
function load_bill_by_id($id_bill)
{
    $sql = "SELECT bill.*, user.name_user, user.email, user.sdt, user.diachi 
            FROM bill 
            INNER JOIN user ON bill.id_user = user.id_user 
            WHERE bill.id_bill = ?";
    return pdo_query_one($sql, $id_bill);
}

/**
 * Lấy danh sách đơn hàng của một người dùng cụ thể
 */
function load_bills_by_user($id_user)
{
    $sql = "SELECT * FROM `bill` WHERE id_user = ? ORDER BY id_bill DESC";
    return pdo_query($sql, $id_user);
}

/**
 * Lấy toàn bộ đơn hàng
 */
function loadBill()
{
    $sql = "SELECT bi.*, us.name_user, us.email, us.sdt, us.diachi 
            FROM `bill` as bi
            INNER JOIN `user` as us ON bi.id_user = us.id_user
            ORDER BY bi.id_bill DESC";
    return pdo_query($sql);
}

/**
 * Lấy danh sách đơn hàng phân trang cho Admin
 */
function loadBill_admin($page = 1, $soSp = 8)
{
    $page = max(1, (int)$page);
    $batdau = ($page - 1) * $soSp;
    $sql = "SELECT bi.*, us.name_user, us.email, us.sdt, us.diachi 
            FROM `bill` as bi
            INNER JOIN `user` as us ON bi.id_user = us.id_user
            ORDER BY bi.id_bill DESC
            LIMIT " . (int)$batdau . ", " . (int)$soSp;
    return pdo_query($sql);
}

/**
 * Cập nhật trạng thái đơn hàng (Admin)
 */
function capnhat_tthd($trangthain, $id_bill)
{
    $sql = "UPDATE `bill` SET `trangthai` = ? WHERE `id_bill` = ?";
    pdo_execute($sql, $trangthain, $id_bill);
}

function xacnhandh($id_bill, $trangthai)
{
    capnhat_tthd($trangthai, $id_bill);
}

/**
 * Cập nhật trạng thái thanh toán
 */
function xacnhanttdh($id_bill, $trangthaitt)
{
    $sql = "UPDATE `bill` SET `trangthaitt` = ? WHERE `id_bill` = ?";
    pdo_execute($sql, $trangthaitt, $id_bill);
}

/**
 * Tìm kiếm đơn hàng theo mã đơn
 */
function content($content)
{
    $sql = "SELECT bi.*, us.name_user, us.email, us.sdt, us.diachi 
            FROM `bill` as bi
            INNER JOIN `user` as us ON bi.id_user = us.id_user 
            WHERE bi.id_bill = ?
            ORDER BY bi.id_bill DESC";
    return pdo_query($sql, $content);
}

/**
 * Thống kê doanh thu theo khoảng ngày
 */
function thongke_donhthu($subDays, $now)
{
    $sql = "SELECT * FROM `bill` WHERE `ngaydat` BETWEEN ? AND ? ORDER BY `ngaydat` ASC";
    return pdo_query($sql, $subDays, $now);
}

/**
 * Phân trang đơn hàng
 */
function hien_thi_so_trang_order($total, $soSp)
{
    return render_pagination($total, $soSp, 'index.php?act=list-carts');
}

function hien_thi($total, $soSp)
{
    return hien_thi_so_trang_order($total, $soSp);
}