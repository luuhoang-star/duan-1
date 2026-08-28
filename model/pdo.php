<?php

/**
 * Mở kết nối đến CSDL sử dụng PDO
 */
function pdo_get_connection()
{
    $dburl = "mysql:host=localhost;dbname=playmobile;charset=utf8mb4";
    $username = 'root';
    $password = '123456';

    try {
        $conn = new PDO($dburl, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        return $conn;
    } catch (PDOException $e) {
        throw $e;
    }
}

/**
 * Thực thi câu lệnh sql thao tác dữ liệu (INSERT, UPDATE, DELETE)
 * @param string $sql câu lệnh sql
 * @param array ...$params các tham số binding cho câu sql
 */
function pdo_execute($sql, ...$params)
{
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}

/**
 * Thực thi câu lệnh sql INSERT và trả về lastInsertId
 * @param string $sql câu lệnh sql
 * @param array ...$params các tham số binding cho câu sql
 * @return string|int ID vừa được chèn
 */
function pdo_execute_last_result($sql, ...$params)
{
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $conn->lastInsertId();
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}

/**
 * Alias của pdo_execute_last_result để tương thích code cũ
 */
function pdo_executeid($sql, ...$params)
{
    return pdo_execute_last_result($sql, ...$params);
}

/**
 * Thực thi câu lệnh sql truy vấn dữ liệu (SELECT)
 * @param string $sql câu lệnh sql
 * @param array ...$params các tham số binding cho câu sql
 * @return array mảng các bản ghi
 */
function pdo_query($sql, ...$params)
{
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $rows = $stmt->fetchAll();
        return $rows;
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}

/**
 * Thực thi câu lệnh sql truy vấn một bản ghi
 * @param string $sql câu lệnh sql
 * @param array ...$params các tham số binding cho câu sql
 * @return array|false bản ghi đầu tiên hoặc false nếu không có
 */
function pdo_query_one($sql, ...$params)
{
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch();
        return $row;
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}

/**
 * Thực thi câu lệnh sql truy vấn một giá trị (cột đầu tiên của dòng đầu tiên)
 * @param string $sql câu lệnh sql
 * @param array ...$params các tham số binding cho câu sql
 * @return mixed giá trị của cột
 */
function pdo_query_value($sql, ...$params)
{
    try {
        $conn = pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        return $row ? $row[0] : null;
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}
