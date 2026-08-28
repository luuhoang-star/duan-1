<?php
require_once 'pdo.php';

/**
 * Đăng ký tài khoản người dùng mới
 */
function register($name, $email, $password)
{
    $sql = "INSERT INTO `user`(`name_user`, `email`, `password`, `role`) VALUES (?, ?, ?, 'Client')";
    pdo_execute($sql, $name, $email, $password);
}

/**
 * Kiểm tra thông tin đăng nhập
 */
function checklogin($email, $password)
{
    $sql = "SELECT * FROM `user` WHERE email = ? AND password = ?";
    return pdo_query_one($sql, $email, $password);
}

/**
 * Cập nhật thông tin cá nhân của người dùng
 */
function update_profile($id_user, $name_user, $gender, $avatar, $email, $sdt, $diachi)
{
    $sql = "UPDATE `user` 
            SET `name_user` = ?, `gender` = ?, `avatar` = ?, `email` = ?, `sdt` = ?, `diachi` = ? 
            WHERE id_user = ?";
    pdo_execute($sql, $name_user, $gender, $avatar, $email, $sdt, $diachi, $id_user);
}

/**
 * Helper upload ảnh đại diện / sản phẩm
 */
function updateImage($newImage, $oldImagePath, $target_dir = "../img/")
{
    if (!empty($newImage["name"])) {
        $filename = basename($newImage["name"]);
        $newImagePath = $target_dir . $filename;
        move_uploaded_file($newImage["tmp_name"], $newImagePath);
        return $filename;
    }
    return $oldImagePath;
}

/**
 * Lấy tất cả người dùng
 */
function loadAllUser()
{
    $sql = "SELECT * FROM `user` ORDER BY id_user DESC";
    return pdo_query($sql);
}

/**
 * Lấy thông tin 1 người dùng theo ID
 */
function loadUser($id_user)
{
    $sql = "SELECT * FROM `user` WHERE id_user = ?";
    return pdo_query($sql, $id_user);
}

function getUserById($id_user)
{
    $sql = "SELECT * FROM `user` WHERE id_user = ?";
    return pdo_query_one($sql, $id_user);
}

/**
 * Kiểm tra xem email đã tồn tại chưa
 */
function checkAccountExist($email)
{
    $sql = "SELECT email FROM `user` WHERE email = ?";
    return pdo_query_one($sql, $email);
}

/**
 * Cập nhật vai trò tài khoản (Admin)
 */
function update_user($role, $id_user)
{
    $sql = "UPDATE `user` SET `role` = ? WHERE id_user = ?";
    pdo_execute($sql, $role, $id_user);
}

/**
 * Xóa tài khoản người dùng
 */
function delete_user($id_user)
{
    $sql = "DELETE FROM `user` WHERE id_user = ? AND `role` != 'Admin'";
    pdo_execute($sql, $id_user);
}