<?php
require_once 'pdo.php';

/**
 * Lấy tất cả bình luận kèm tên người dùng và avatar (Client)
 */
function loadAllcmt()
{
    $sql = "SELECT cmt.*, us.name_user, us.avatar  
            FROM `binhluan` as cmt 
            INNER JOIN `user` as us ON cmt.id_user = us.id_user
            ORDER BY cmt.id_cmt DESC";
    return pdo_query($sql);
}

/**
 * Lấy danh sách bình luận kèm tên sản phẩm và tên user cho Admin
 */
function loadCmt()
{
    $sql = "SELECT cmt.*, us.name_user, us.avatar, sp.name_sp 
            FROM `binhluan` as cmt
            INNER JOIN `user` as us ON cmt.id_user = us.id_user
            INNER JOIN `sanpham` as sp ON cmt.id_sp = sp.id_sp
            ORDER BY cmt.id_cmt DESC";
    return pdo_query($sql);
}

/**
 * Lấy bình luận của 1 sản phẩm cụ thể
 */
function loadCmtByProduct($id_sp)
{
    $sql = "SELECT cmt.*, us.name_user, us.avatar 
            FROM `binhluan` as cmt 
            INNER JOIN `user` as us ON cmt.id_user = us.id_user
            WHERE cmt.id_sp = ?
            ORDER BY cmt.id_cmt DESC";
    return pdo_query($sql, $id_sp);
}

/**
 * Thêm bình luận mới
 */
function addCmt($cmt, $id_sp, $id_user, $time)
{
    $sql = "INSERT INTO `binhluan`(`content_cmt`, `id_sp`, `id_user`, `time`) VALUES (?, ?, ?, ?)";
    pdo_execute($sql, $cmt, $id_sp, $id_user, $time);
}

/**
 * Xóa bình luận theo ID
 */
function deleteCmt($id_cmt)
{
    $sql = "DELETE FROM `binhluan` WHERE id_cmt = ?";
    pdo_execute($sql, $id_cmt);
}
