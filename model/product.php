<?php
require_once 'pdo.php';

/**
 * Thêm sản phẩm mới
 */
function addProduct($category, $product_name, $product_price, $product_desc, $product_quantity, $product_avatar, $matsan)
{
    $sql = "INSERT INTO `sanpham`(`id_dm`, `name_sp`, `price_sp`, `desc_sp`, `soluong`, `image_sp`, `matsan`) VALUES (?, ?, ?, ?, ?, ?, ?)";
    return pdo_execute($sql, $category, $product_name, $product_price, $product_desc, $product_quantity, $product_avatar, trim($matsan));
}

/**
 * Xóa sản phẩm theo ID
 */
function delete_pro($id_sp)
{
    $sql = "DELETE FROM `sanpham` WHERE id_sp = ?";
    pdo_execute($sql, $id_sp);
}

/**
 * Lấy chi tiết sản phẩm kèm tên danh mục theo ID
 */
function LoadProById($id_sp)
{
    $sql = "SELECT sp.*, dm.name_dm, dm.id_dm 
            FROM `sanpham` as sp
            INNER JOIN `danhmuc` as dm ON sp.id_dm = dm.id_dm
            WHERE sp.id_sp = ?";
    return pdo_query_one($sql, $id_sp);
}

/**
 * Lấy chi tiết sản phẩm theo ID (hỗ trợ cả 2 tên hàm)
 */
function loadProductById($id_sp)
{
    $sql = "SELECT * FROM `sanpham` WHERE id_sp = ?";
    return pdo_query_one($sql, $id_sp);
}

/**
 * Cập nhật thông tin sản phẩm
 */
function updateProduct($id_sp, $category, $product_name, $product_price, $product_desc, $product_quantity, $product_avatar)
{
    $sql = "UPDATE `sanpham` 
            SET `id_dm` = ?, `name_sp` = ?, `price_sp` = ?, `desc_sp` = ?, `soluong` = ?, `image_sp` = ? 
            WHERE id_sp = ?";
    pdo_execute($sql, $category, $product_name, $product_price, $product_desc, $product_quantity, $product_avatar, $id_sp);
}

/**
 * Tìm kiếm sản phẩm theo tên (lấy tất cả kết quả)
 */
function search($content)
{
    $sql = "SELECT * FROM `sanpham` WHERE name_sp LIKE ?";
    return pdo_query($sql, '%' . $content . '%');
}

/**
 * Tìm kiếm sản phẩm có phân trang (client)
 */
function search_text($content, $page = 1, $soSp = 6)
{
    $page = max(1, (int)$page);
    $batdau = ($page - 1) * $soSp;
    $sql = "SELECT * FROM `sanpham` WHERE name_sp LIKE ? LIMIT " . (int)$batdau . ", " . (int)$soSp;
    return pdo_query($sql, '%' . $content . '%');
}

/**
 * Tìm kiếm sản phẩm cho admin (kèm tên danh mục, có phân trang)
 */
function search_admin($content, $page = 1, $soSp = 5)
{
    $page = max(1, (int)$page);
    $batdau = ($page - 1) * $soSp;
    $sql = "SELECT sp.*, dm.name_dm 
            FROM `sanpham` as sp
            INNER JOIN `danhmuc` as dm ON sp.id_dm = dm.id_dm
            WHERE sp.name_sp LIKE ? 
            ORDER BY sp.id_sp DESC
            LIMIT " . (int)$batdau . ", " . (int)$soSp;
    return pdo_query($sql, '%' . $content . '%');
}

/**
 * Lấy tất cả sản phẩm theo ID danh mục
 */
function searchnbyid_dm($id_dm)
{
    $sql = "SELECT * FROM `sanpham` WHERE id_dm = ?";
    return pdo_query($sql, $id_dm);
}

/**
 * Lấy sản phẩm theo danh mục có phân trang
 */
function loadSearch($id_dm, $page = 1, $soSp = 6)
{
    $page = max(1, (int)$page);
    $batdau = ($page - 1) * $soSp;
    $sql = "SELECT * FROM `sanpham` WHERE id_dm = ? LIMIT " . (int)$batdau . ", " . (int)$soSp;
    return pdo_query($sql, $id_dm);
}

/**
 * Lấy toàn bộ sản phẩm
 */
function load()
{
    $sql = "SELECT * FROM `sanpham`";
    return pdo_query($sql);
}

/**
 * Lấy toàn bộ sản phẩm kèm tên danh mục
 */
function loadAllProduct()
{
    $sql = "SELECT sp.*, dm.name_dm 
            FROM `sanpham` as sp
            INNER JOIN `danhmuc` as dm ON sp.id_dm = dm.id_dm
            ORDER BY sp.id_sp DESC";
    return pdo_query($sql);
}

/**
 * Lấy sản phẩm theo ID dạng mảng
 */
function loadabc($id_sp)
{
    $sql = "SELECT * FROM `sanpham` WHERE `id_sp` = ?";
    return pdo_query($sql, $id_sp);
}

/**
 * Lấy danh sách sản phẩm phân trang cho Admin
 */
function loadAllProduct_admin($page = 1, $soSp = 5)
{
    $page = max(1, (int)$page);
    $batdau = ($page - 1) * $soSp;
    $sql = "SELECT sp.*, dm.name_dm 
            FROM `sanpham` as sp
            INNER JOIN `danhmuc` as dm ON sp.id_dm = dm.id_dm
            ORDER BY sp.id_sp DESC
            LIMIT " . (int)$batdau . ", " . (int)$soSp;
    return pdo_query($sql);
}

/**
 * Cập nhật số lượng sản phẩm
 */
function updateProductQuantity($id_sp, $new_quantity)
{
    $sql = "UPDATE `sanpham` SET soluong = ? WHERE id_sp = ?";
    pdo_execute($sql, $new_quantity, $id_sp);
}

function change_soluong_sp($soluongNew, $id_sp)
{
    updateProductQuantity($id_sp, $soluongNew);
}

/**
 * Lọc theo giá tăng / giảm
 */
function loc_tang()
{
    $sql = "SELECT * FROM `sanpham` ORDER BY price_sp ASC";
    return pdo_query($sql);
}

function loc_giam()
{
    $sql = "SELECT * FROM `sanpham` ORDER BY price_sp DESC";
    return pdo_query($sql);
}

function tang($page = 1, $soSp = 6)
{
    $page = max(1, (int)$page);
    $batdau = ($page - 1) * $soSp;
    $sql = "SELECT * FROM `sanpham` ORDER BY price_sp ASC LIMIT " . (int)$batdau . ", " . (int)$soSp;
    return pdo_query($sql);
}

function giam($page = 1, $soSp = 6)
{
    $page = max(1, (int)$page);
    $batdau = ($page - 1) * $soSp;
    $sql = "SELECT * FROM `sanpham` ORDER BY price_sp DESC LIMIT " . (int)$batdau . ", " . (int)$soSp;
    return pdo_query($sql);
}

/**
 * Lấy top 4 sản phẩm bán chạy nhất
 */
function top6Product()
{
    $sql = "SELECT * FROM `sanpham` ORDER BY luotban DESC LIMIT 0, 4";
    return pdo_query($sql);
}

/**
 * Lấy 4 sản phẩm mới nhất
 */
function NewProduct()
{
    $sql = "SELECT * FROM `sanpham` ORDER BY id_sp DESC LIMIT 0, 4";
    return pdo_query($sql);
}

/**
 * Lấy 4 sản phẩm liên quan theo danh mục
 */
function productrelated($id_dm)
{
    $sql = "SELECT * FROM `sanpham` WHERE id_dm = ? LIMIT 0, 4";
    return pdo_query($sql, $id_dm);
}

/**
 * Lấy sản phẩm theo loại mặt sân (1: Cỏ nhân tạo, 2: Cỏ tự nhiên, 3: Phụ kiện)
 */
function loaigiay($matsan)
{
    $sql = "SELECT * FROM `sanpham` WHERE matsan = ?";
    return pdo_query($sql, $matsan);
}

function loadPro_by_matsan($matsan, $page = 1, $soSp = 6)
{
    $page = max(1, (int)$page);
    $batdau = ($page - 1) * $soSp;
    $sql = "SELECT sp.*, dm.name_dm 
            FROM `sanpham` as sp
            INNER JOIN `danhmuc` as dm ON sp.id_dm = dm.id_dm
            WHERE sp.matsan = ?
            ORDER BY sp.id_sp DESC
            LIMIT " . (int)$batdau . ", " . (int)$soSp;
    return pdo_query($sql, $matsan);
}

/**
 * =========================================================================
 * HÀM RENDER PHÂN TRANG CHUNG (DRY - Dùng cho toàn bộ hệ thống)
 * =========================================================================
 */
function render_pagination($total_items, $per_page, $base_url)
{
    $count = is_array($total_items) ? count($total_items) : (int)$total_items;
    $number_of_pages = (int)ceil($count / $per_page);
    if ($number_of_pages <= 1) {
        return '';
    }

    $separator = (strpos($base_url, '?') !== false) ? '&' : '?';
    $html = '<ul class="pagination mb-0">';
    for ($i = 1; $i <= $number_of_pages; $i++) {
        $html .= '<li class="page-item"><a class="page-link text-black" href="' . $base_url . $separator . 'page=' . $i . '">' . $i . '</a></li>';
    }
    $html .= '</ul>';
    return $html;
}

// Wrapper functions để tương thích ngược 100% với code cũ
function hien_thi_so_trang_search($total, $soSp)
{
    return render_pagination($total, $soSp, 'index.php?act=search');
}

function hien_thi_so_trang($total, $soSp)
{
    return render_pagination($total, $soSp, 'index.php?act=list-products');
}

function hien_thi_so_trang_view($matsan, $total, $soSp)
{
    return render_pagination($total, $soSp, 'index.php?act=loai&matsan=' . $matsan);
}

function hien_thi_so_trang_all($total, $soSp)
{
    return render_pagination($total, $soSp, 'index.php?act=all-product');
}

function hien_thi_so_trang_id_dm($id_dm, $total, $soSp)
{
    return render_pagination($total, $soSp, 'index.php?act=search-by-id&id_dm=' . $id_dm);
}

function hien_thi_so_trang_tang($total, $soSp)
{
    return render_pagination($total, $soSp, 'index.php?act=bo-loc&filter=1');
}

function hien_thi_so_trang_giam($total, $soSp)
{
    return render_pagination($total, $soSp, 'index.php?act=bo-loc&filter=2');
}