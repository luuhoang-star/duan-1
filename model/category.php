<?php
require_once 'pdo.php';

/**
 * Thêm danh mục mới
 */
function addCategory($name)
{
    $sql = "INSERT INTO `danhmuc`(`name_dm`) VALUES (?)";
    pdo_execute($sql, $name);
}

/**
 * Xóa danh mục theo ID
 */
function delete($id_dm)
{
    $sql = "DELETE FROM `danhmuc` WHERE id_dm = ?";
    pdo_execute($sql, $id_dm);
}

/**
 * Lấy tất cả danh mục
 */
function loadAll()
{
    $sql = "SELECT * FROM `danhmuc` ORDER BY id_dm DESC";
    return pdo_query($sql);
}

/**
 * Lấy danh mục theo ID (trả về danh sách để tương thích cả $info[0] và foreach)
 */
function LoadById($id_dm)
{
    $sql = "SELECT * FROM `danhmuc` WHERE id_dm = ?";
    return pdo_query($sql, $id_dm);
}

/**
 * Lấy chi tiết 1 danh mục theo ID dạng mảng 1 chiều
 */
function loadCategoryById($id_dm)
{
    $sql = "SELECT * FROM `danhmuc` WHERE id_dm = ?";
    return pdo_query_one($sql, $id_dm);
}

/**
 * Cập nhật tên danh mục
 */
function updateCategory($id_dm, $name)
{
    $sql = "UPDATE `danhmuc` SET `name_dm` = ? WHERE id_dm = ?";
    pdo_execute($sql, $name, $id_dm);
}

function update_category($id_dm, $name)
{
    updateCategory($id_dm, $name);
}

/**
 * Lấy tên danh mục theo ID
 */
function nameById($id_dm)
{
    $sql = "SELECT name_dm FROM `danhmuc` WHERE id_dm = ?";
    return pdo_query_one($sql, $id_dm);
}

/**
 * Kiểm tra danh mục đã tồn tại chưa
 */
function check_dm($name_dm)
{
    $sql = "SELECT name_dm FROM `danhmuc` WHERE name_dm = ?";
    return pdo_query_one($sql, $name_dm);
}