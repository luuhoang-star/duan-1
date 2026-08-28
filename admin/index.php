<?php
ob_start();
session_start();

require_once '../model/pdo.php';
require_once '../model/category.php';
require_once '../model/product.php';
require_once '../model/user.php';
require_once '../model/bill.php';
require_once '../model/cart.php';
require_once '../model/binhluan.php';

require_once 'header.php';

$act = $_GET['act'] ?? 'home';

switch ($act) {
    // ================== DANH MỤC ==================
    case 'list-categories':
        require_once 'categories/list.php';
        break;

    case 'add-category':
        if (isset($_POST['add_category'])) {
            $name = trim($_POST['category_name'] ?? '');
            if (empty($name)) {
                echo '<div class="alert alert-danger mx-3 mt-3">Không được để trống tên danh mục!</div>';
            } else {
                $check = check_dm($name);
                if ($check) {
                    echo '<div class="alert alert-warning mx-3 mt-3">Danh mục "' . htmlspecialchars($name) . '" đã tồn tại!</div>';
                } else {
                    addCategory($name);
                    header("Location: index.php?act=list-categories");
                    exit();
                }
            }
        }
        require_once 'categories/add.php';
        break;

    case 'update-category':
        $id_dm = (int)($_GET['id_dm'] ?? 0);
        if ($id_dm > 0) {
            $info = LoadById($id_dm);
            if (isset($_POST['update_category'])) {
                $name = trim($_POST['category_name'] ?? '');
                if (!empty($name)) {
                    updateCategory($id_dm, $name);
                    header("Location: index.php?act=list-categories");
                    exit();
                }
            }
            require_once 'categories/update.php';
        } else {
            header("Location: index.php?act=list-categories");
            exit();
        }
        break;

    case 'delete-category':
        if (isset($_GET['id_dm'])) {
            $id_dm = (int)$_GET['id_dm'];
            delete($id_dm);
        }
        header("Location: index.php?act=list-categories");
        exit();

    // ================== SẢN PHẨM ==================
    case 'list-products':
        $page = max(1, (int)($_GET['page'] ?? 1));
        $soSp = 5;
        $list = loadAllProduct_admin($page, $soSp);
        $total = load();
        $hien_thi_so_trang = render_pagination($total, $soSp, 'index.php?act=list-products');
        require_once 'products/list.php';
        break;

    case 'add-product':
    case 'add-product-with-cat':
        if (isset($_POST['submit'])) {
            $category = (int)$_POST['category'];
            $product_name = trim($_POST['product_name']);
            $product_price = (float)$_POST['product_price'];
            $product_desc = trim($_POST['product_desc']);
            $product_quantity = (int)$_POST['product_quantity'];
            $matsan = (int)$_POST['matsan'];
            
            $product_avatar = '';
            if (isset($_FILES['product_avatar']) && $_FILES['product_avatar']['size'] > 0) {
                $product_avatar = basename($_FILES['product_avatar']['name']);
                move_uploaded_file($_FILES["product_avatar"]["tmp_name"], "../img/" . $product_avatar);
            }

            addProduct($category, $product_name, $product_price, $product_desc, $product_quantity, $product_avatar, $matsan);
            header("Location: index.php?act=list-products");
            exit();
        }
        require_once 'products/add.php';
        break;

    case 'update-product':
        $id_sp = (int)($_GET['id_sp'] ?? 0);
        if ($id_sp > 0) {
            $info = LoadProById($id_sp);
            if (!$info) {
                header("Location: index.php?act=list-products");
                exit();
            }

            if (isset($_POST['update-product'])) {
                $category = (int)$_POST['category'];
                $product_name = trim($_POST['product_name']);
                $product_price = (float)$_POST['product_price'];
                $product_desc = trim($_POST['product_desc']);
                $product_quantity = (int)$_POST['product_quantity'];
                
                $product_avatar = $info['image_sp'];
                if (isset($_FILES['product_avatar']) && $_FILES['product_avatar']['size'] > 0) {
                    $product_avatar = basename($_FILES['product_avatar']['name']);
                    move_uploaded_file($_FILES["product_avatar"]["tmp_name"], "../img/" . $product_avatar);
                }

                updateProduct($id_sp, $category, $product_name, $product_price, $product_desc, $product_quantity, $product_avatar);
                header("Location: index.php?act=list-products");
                exit();
            }
            require_once 'products/update.php';
        } else {
            header("Location: index.php?act=list-products");
            exit();
        }
        break;

    case 'delete-product':
        if (isset($_GET['id_sp'])) {
            $id_sp = (int)$_GET['id_sp'];
            delete_pro($id_sp);
        }
        header("Location: index.php?act=list-products");
        exit();

    case 'search':
        $content = trim($_POST['content'] ?? '');
        $page = max(1, (int)($_GET['page'] ?? 1));
        $soSp = 5;
        $list = search_admin($content, $page, $soSp);
        $total = search($content);
        $hien_thi_so_trang = render_pagination($total, $soSp, 'index.php?act=search');
        require_once 'products/list.php';
        break;

    // ================== ĐƠN HÀNG ==================
    case 'list-carts':
        $page = max(1, (int)($_GET['page'] ?? 1));
        $soSp = 8;
        $bill = loadBill_admin($page, $soSp);
        $total = loadBill();
        $hien_thi_so_trang = render_pagination($total, $soSp, 'index.php?act=list-carts');
        require_once 'order/list.php';
        break;

    case 'search-order':
        $content = trim($_POST['content'] ?? '');
        if (!empty($content)) {
            $bill = content($content);
        } else {
            $bill = loadBill_admin(1, 8);
        }
        require_once 'order/list.php';
        break;

    case 'view-bill-admin':
        $id_bill = (int)($_GET['id_bill'] ?? ($_POST['id_bill'] ?? 0));
        if (isset($_POST['updatevaitro']) && $id_bill > 0) {
            $trangthain = (int)$_POST['trangthain'];
            capnhat_tthd($trangthain, $id_bill);
            
            // Nếu giao thành công thì cập nhật đã thanh toán
            if ($trangthain == 4) {
                xacnhanttdh($id_bill, 1);
            }
            header("Location: index.php?act=view-bill-admin&id_bill=" . $id_bill);
            exit();
        }
        require_once 'order/chitiet.php';
        break;

    // ================== BÌNH LUẬN ==================
    case 'comments':
        $comment = loadCmt();
        require_once 'comment/list.php';
        break;

    case 'delete-cmt':
        if (isset($_GET['id_cmt'])) {
            $id_cmt = (int)$_GET['id_cmt'];
            deleteCmt($id_cmt);
        }
        header("Location: index.php?act=comments");
        exit();

    // ================== TÀI KHOẢN ==================
    case 'list-users':
        $result = loadAllUser();
        require_once 'user/list.php';
        break;

    case 'edit-user':
        $id_user = (int)($_GET['id_user'] ?? 0);
        $User = loadUser($id_user);
        require_once 'user/edit.php';
        break;

    case 'update_user':
        if (isset($_POST['update-user']) && isset($_GET['id_user'])) {
            $id_user = (int)$_GET['id_user'];
            $role = $_POST['role'] ?? 'Client';
            update_user($role, $id_user);
            header('Location: index.php?act=list-users');
            exit();
        }
        break;

    case 'delete-user':
        if (isset($_GET['id_user'])) {
            $id_user = (int)$_GET['id_user'];
            delete_user($id_user);
        }
        header('Location: index.php?act=list-users');
        exit();

    // ================== THỐNG KÊ ==================
    case 'thong-ke':
        require_once 'thongke/list.php';
        break;

    // ================== DASHBOARD TỔNG QUAN (DEFAULT) ==================
    case 'home':
    default:
        $count_sp = count(load());
        $count_dm = count(loadAll());
        $all_bills = loadBill();
        $count_bill = count($all_bills);
        $count_user = count(loadAllUser());
        $count_cmt = count(loadCmt());
        
        $total_sales = 0;
        foreach ($all_bills as $b) {
            if ($b['trangthaitt'] == 1 || $b['trangthai'] == 4) {
                $total_sales += (int)$b['tongbill'];
            }
        }
        $latest_orders = array_slice($all_bills, 0, 5);
        ?>
        <div class="container-fluid mt-4">
            <h2 class="text-primary mb-4">Tổng quan Bảng điều khiển</h2>
            
            <div class="row g-3 mb-4">
                <div class="col-md-4 col-sm-6">
                    <div class="card shadow-sm border-0 bg-primary text-white p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase mb-1">Tổng sản phẩm</h6>
                                <h2 class="mb-0 fw-bold"><?=$count_sp?></h2>
                            </div>
                            <i class="uil uil-box fs-1"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="card shadow-sm border-0 bg-success text-white p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase mb-1">Doanh thu</h6>
                                <h2 class="mb-0 fw-bold"><?=number_format($total_sales, 0, ",", ".")?> ₫</h2>
                            </div>
                            <i class="uil uil-money-bill fs-1"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="card shadow-sm border-0 bg-warning text-dark p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase mb-1">Tổng đơn hàng</h6>
                                <h2 class="mb-0 fw-bold"><?=$count_bill?></h2>
                            </div>
                            <i class="uil uil-shopping-cart fs-1"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="card shadow-sm border-0 bg-info text-white p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase mb-1">Danh mục</h6>
                                <h2 class="mb-0 fw-bold"><?=$count_dm?></h2>
                            </div>
                            <i class="uil uil-align-left fs-1"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="card shadow-sm border-0 bg-danger text-white p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase mb-1">Khách hàng</h6>
                                <h2 class="mb-0 fw-bold"><?=$count_user?></h2>
                            </div>
                            <i class="uil uil-users-alt fs-1"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-6">
                    <div class="card shadow-sm border-0 bg-secondary text-white p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase mb-1">Bình luận</h6>
                                <h2 class="mb-0 fw-bold"><?=$count_cmt?></h2>
                            </div>
                            <i class="uil uil-comment-dots fs-1"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Đơn hàng gần đây -->
            <div class="card shadow-sm border-0 p-3 bg-white rounded mb-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0 fw-bold text-dark"><i class="uil uil-clock-three me-2"></i>Đơn hàng gần đây</h5>
                    <a href="index.php?act=list-carts" class="btn btn-sm btn-outline-primary">Xem tất cả</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Mã đơn</th>
                                <th>Khách hàng</th>
                                <th>Ngày đặt</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($latest_orders)): ?>
                                <?php foreach($latest_orders as $ord): ?>
                                <tr>
                                    <td><strong>#<?=$ord['id_bill']?></strong></td>
                                    <td><?=htmlspecialchars($ord['name_user'])?></td>
                                    <td><?=date('d/m/Y', strtotime($ord['ngaydat']))?></td>
                                    <td><strong class="text-danger"><?=number_format((int)$ord['tongbill'], 0, ",", ".")?>₫</strong></td>
                                    <td>
                                        <?php
                                        switch ($ord['trangthai']) {
                                            case 0: echo '<span class="badge bg-warning text-dark">Chờ xác nhận</span>'; break;
                                            case 1: echo '<span class="badge bg-info text-dark">Đã xác nhận</span>'; break;
                                            case 2: echo '<span class="badge bg-primary">Đang chuẩn bị</span>'; break;
                                            case 3: echo '<span class="badge bg-primary">Đang giao hàng</span>'; break;
                                            case 4: echo '<span class="badge bg-success">Đã nhận hàng</span>'; break;
                                            case 5: echo '<span class="badge bg-danger">Đã hủy</span>'; break;
                                            default: echo '<span class="badge bg-secondary">Khác</span>'; break;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="?act=view-bill-admin&id_bill=<?=$ord['id_bill']?>" class="btn btn-sm btn-info text-white">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="6" class="text-center text-muted">Chưa có đơn hàng nào.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
        break;
}

require_once 'footer.php';
ob_end_flush();