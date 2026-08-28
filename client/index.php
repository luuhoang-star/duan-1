<?php
session_start();
ob_start();

require_once '../model/pdo.php';
require_once '../model/product.php';
require_once '../model/category.php';
require_once '../model/user.php';
require_once '../model/bill.php';
require_once '../model/cart.php';
require_once '../model/binhluan.php';

require_once 'header.php';

/**
 * Helper thêm sản phẩm vào session cart (Deduplication)
 */
function add_item_to_cart($id_sp, $name_sp, $price_sp, $image_sp, $size, $quantity)
{
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    $quantity = max(1, (int)$quantity);
    $size = !empty($size) ? $size : '40';
    $found = false;

    foreach ($_SESSION['cart'] as $key => $item) {
        if ($item['id_sp'] == $id_sp && $item['size'] == $size) {
            $_SESSION['cart'][$key]['soluongcart'] += $quantity;
            $_SESSION['cart'][$key]['tongtien'] = $_SESSION['cart'][$key]['soluongcart'] * (int)$price_sp;
            $found = true;
            break;
        }
    }

    if (!$found) {
        $_SESSION['cart'][] = [
            'id_sp' => $id_sp,
            'name_sp' => $name_sp,
            'price_sp' => $price_sp,
            'soluongcart' => $quantity,
            'image_sp' => $image_sp,
            'tongtien' => $quantity * (int)$price_sp,
            'size' => $size
        ];
    }
}

$act = $_GET['act'] ?? 'home';

switch ($act) {
    // ================== SẢN PHẨM ==================
    case 'all-product':
        $page = max(1, (int)($_GET['page'] ?? 1));
        $soSp = 6;
        $Product = loadAllProduct_admin($page, $soSp);
        $total = load();
        $hien_thi_so_trang = render_pagination($total, $soSp, 'index.php?act=all-product');
        require_once './view/product/product.php';
        break;

    case 'loai':
        $matsan = (int)($_GET['matsan'] ?? 1);
        $page = max(1, (int)($_GET['page'] ?? 1));
        $soSp = 6;
        $Product = loadPro_by_matsan($matsan, $page, $soSp);
        $total = loaigiay($matsan);
        $hien_thi_so_trang = render_pagination($total, $soSp, 'index.php?act=loai&matsan=' . $matsan);
        require_once './view/product/product.php';
        break;

    case 'bo-loc':
        $filter = (int)($_GET['filter'] ?? 1);
        $page = max(1, (int)($_GET['page'] ?? 1));
        $soSp = 6;
        if ($filter == 1) {
            $Product = tang($page, $soSp);
            $total = loc_tang();
            $hien_thi_so_trang = render_pagination($total, $soSp, 'index.php?act=bo-loc&filter=1');
        } else {
            $Product = giam($page, $soSp);
            $total = loc_giam();
            $hien_thi_so_trang = render_pagination($total, $soSp, 'index.php?act=bo-loc&filter=2');
        }
        require_once 'view/product/product.php';
        break;

    case 'search':
        $content = trim($_POST['content'] ?? ($_GET['content'] ?? ''));
        $page = max(1, (int)($_GET['page'] ?? 1));
        $soSp = 6;
        $Product = search_text($content, $page, $soSp);
        $total = search($content);
        $hien_thi_so_trang = render_pagination($total, $soSp, 'index.php?act=search');
        require_once './view/product/product.php';
        break;

    case 'search-by-id':
        $id_dm = (int)($_GET['id_dm'] ?? 0);
        $page = max(1, (int)($_GET['page'] ?? 1));
        $soSp = 6;
        $Product = loadSearch($id_dm, $page, $soSp);
        $total = searchnbyid_dm($id_dm);
        $hien_thi_so_trang = render_pagination($total, $soSp, 'index.php?act=search-by-id&id_dm=' . $id_dm);
        require_once './view/product/product.php';
        break;

    case 'viewProduct':
        $id = (int)($_GET['id_sp'] ?? 0);
        $Product = LoadProById($id);
        if (!$Product) {
            header("Location: index.php?act=all-product");
            exit();
        }
        $cmt = loadCmtByProduct($id);
        require_once './view/product/productchitiet.php';
        break;

    // ================== GIỎ HÀNG & MUA HÀNG ==================
    case 'cart':
        $cart = $_SESSION['cart'] ?? [];
        require_once 'cart.php';
        break;

    case 'add-to-cart':
    case 'buy-now':
        if (!isset($_SESSION['user'])) {
            header("Location: ?act=login");
            exit();
        }

        $id_sp = (int)($_POST['id_sp'] ?? 0);
        $name_sp = $_POST['name_sp'] ?? '';
        $soluongcart = (int)($_POST['soluongcart'] ?? 1);
        $price_sp = (float)($_POST['price_sp'] ?? 0);
        $image_sp = $_POST['image_sp'] ?? '';
        $size = $_POST['selectedSize'] ?? '40';

        add_item_to_cart($id_sp, $name_sp, $price_sp, $image_sp, $size, $soluongcart);

        if (isset($_POST['buy-now']) || $act === 'buy-now') {
            header("Location: ?act=check-out");
        } else {
            header("Location: ?act=cart");
        }
        exit();

    case 'delete-cart':
        if (isset($_POST['cart_index'])) {
            $index = (int)$_POST['cart_index'];
            if (isset($_SESSION['cart'][$index])) {
                unset($_SESSION['cart'][$index]);
                $_SESSION['cart'] = array_values($_SESSION['cart']);
            }
        } elseif (isset($_POST['cart_id'])) {
            $id_sp = (int)$_POST['cart_id'];
            foreach ($_SESSION['cart'] as $k => $item) {
                if ($item['id_sp'] == $id_sp) {
                    unset($_SESSION['cart'][$k]);
                    break;
                }
            }
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
        header("Location: ?act=cart");
        exit();

    case 'check-out':
        if (empty($_SESSION['cart'])) {
            header("Location: ?act=cart");
            exit();
        }
        if (!isset($_SESSION['user'])) {
            header("Location: ?act=login");
            exit();
        }
        require_once 'checkout.php';
        break;

    case 'thanhtoan':
        if (!empty($_SESSION['cart']) && isset($_POST['thanhtoan'])) {
            $id_user = (int)($_SESSION['user']['id_user'] ?? ($_POST['id_user'] ?? 0));
            $name_user = trim($_POST['name_user'] ?? '');
            $diachi = trim($_POST['address_user'] ?? '');
            $sdt = trim($_POST['tel_user'] ?? '');
            $ngaytao = date('Y-m-d');
            $tongbill = (int)($_SESSION['tongbill'] ?? 0);
            $pttt = (int)($_POST['pttt'] ?? 1);

            // Cập nhật thông tin giao hàng mới nhất vào user nếu có
            if ($id_user > 0 && !empty($diachi)) {
                update_profile($id_user, $name_user, $_SESSION['user']['gender'] ?? '', $_SESSION['user']['avatar'] ?? 'user.png', $_SESSION['user']['email'] ?? '', $sdt, $diachi);
                $_SESSION['user']['name_user'] = $name_user;
                $_SESSION['user']['diachi'] = $diachi;
                $_SESSION['user']['sdt'] = $sdt;
            }

            $trangthai = 0; // Chờ xác nhận
            $trangthaitt = ($pttt == 1) ? 0 : 1; // COD: chưa thanh toán, MoMo: đã thanh toán

            $idBill = insert_hoadon($ngaytao, $pttt, $tongbill, $trangthai, $trangthaitt, $id_user);

            // Thêm tất cả sản phẩm trong giỏ hàng vào bảng cart
            foreach ($_SESSION['cart'] as $item) {
                $line_total = (int)$item['price_sp'] * (int)$item['soluongcart'];
                insert_billhoadon($idBill, $item['id_sp'], $item['name_sp'], $item['price_sp'], $item['size'], $item['soluongcart'], $line_total);
            }

            if ($pttt == 1) {
                // COD: Thanh toán khi nhận hàng
                unset($_SESSION['cart']);
                unset($_SESSION['tongbill']);
                header('Location: ?act=thank&id_bill=' . $idBill);
                exit();
            } elseif ($pttt == 2) {
                // Thanh toán QR MoMo
                include('view/thanhtoan/xulyttmomo.php');
                exit();
            } elseif ($pttt == 3) {
                // Thanh toán ATM MoMo
                include('view/thanhtoan/ttATMmomo.php');
                exit();
            }
        } else {
            header('Location: ?act=cart');
            exit();
        }
        break;

    // ================== BÌNH LUẬN ==================
    case 'comment':
        if (isset($_POST['comment']) && isset($_SESSION['user'])) {
            $cmt = trim($_POST['cmt'] ?? '');
            $id_sp = (int)($_POST['id_sp'] ?? 0);
            $id_dm = (int)($_GET['id_dm'] ?? 0);
            $id_user = (int)$_SESSION['user']['id_user'];
            $time = date("Y-m-d H:i:s");

            if (!empty($cmt) && $id_sp > 0) {
                addCmt($cmt, $id_sp, $id_user, $time);
            }
            header("Location: ?act=viewProduct&id_sp=$id_sp&id_dm=$id_dm");
            exit();
        }
        break;

    // ================== ĐƠN HÀNG CỦA TÔI ==================
    case 'my-order':
        require_once 'view/users/my-order.php';
        break;

    case 'view-bill':
        require_once 'view/users/chitiet_bill.php';
        break;

    case 'xacnhandh':
        $id_bill = (int)($_GET['id_bill'] ?? 0);
        $trangthai = (int)($_GET['trangthai'] ?? 0);
        $trangthaitt = isset($_GET['trangthaitt']) ? (int)$_GET['trangthaitt'] : 0;

        if ($id_bill > 0) {
            if ($trangthaitt == 1) {
                xacnhanttdh($id_bill, 1);
            }
            xacnhandh($id_bill, $trangthai);
            header('Location: ?act=view-bill&id_bill=' . $id_bill);
            exit();
        }
        break;

    case 'thank':
        require_once 'thank.php';
        break;

    case 'khach-hang':
        require_once 'view/users/khachhang.php';
        break;

    // ================== TÀI KHOẢN ==================
    case 'login':
        if (isset($_POST['submit'])) {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $check = checklogin($email, $password);
            if ($check) {
                $_SESSION['user'] = $check;
                header("Location: index.php");
                exit();
            } else {
                echo '<div class="alert alert-danger mx-3 mt-3">Email hoặc mật khẩu không chính xác!</div>';
            }
        }
        require_once './view/users/login.php';
        break;

    case 'logout':
        unset($_SESSION['user']);
        session_destroy();
        header("Location: index.php");
        exit();

    case 'register':
        if (isset($_POST['btn-register'])) {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($name) || empty($email) || empty($password)) {
                echo '<div class="alert alert-danger mx-3 mt-3">Vui lòng điền đầy đủ thông tin!</div>';
            } else {
                $exist = checkAccountExist($email);
                if ($exist) {
                    echo '<div class="alert alert-warning mx-3 mt-3">Email này đã được đăng ký!</div>';
                } else {
                    register($name, $email, $password);
                    echo '<script>alert("Đăng ký tài khoản thành công! Vui lòng đăng nhập."); window.location.href="?act=login";</script>';
                    exit();
                }
            }
        }
        require_once './view/users/register.php';
        break;

    case 'profile':
        require_once './view/users/profile.php';
        break;

    case 'update-profile':
        if (isset($_POST['btn-save']) && isset($_SESSION['user'])) {
            $id_user = (int)$_SESSION['user']['id_user'];
            $name_user = trim($_POST['name_user'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $gender = $_POST['gender'] ?? '';
            $sdt = trim($_POST['sdt'] ?? '');
            $diachi = trim($_POST['diachi'] ?? '');
            
            $avatar = $_SESSION['user']['avatar'] ?? 'user.png';
            if (isset($_FILES['avatar']) && $_FILES['avatar']['size'] > 0) {
                $avatar = basename($_FILES['avatar']['name']);
                move_uploaded_file($_FILES["avatar"]["tmp_name"], "../img/" . $avatar);
            }

            update_profile($id_user, $name_user, $gender, $avatar, $email, $sdt, $diachi);

            $_SESSION['user']['name_user'] = $name_user;
            $_SESSION['user']['email'] = $email;
            $_SESSION['user']['gender'] = $gender;
            $_SESSION['user']['sdt'] = $sdt;
            $_SESSION['user']['diachi'] = $diachi;
            $_SESSION['user']['avatar'] = $avatar;

            header("Location: ?act=profile");
            exit();
        }
        break;

    // ================== TRANG CHỦ ==================
    case 'home':
    case '/':
    default:
        require_once './home.php';
        break;
}

require_once 'footer.php';
ob_end_flush();