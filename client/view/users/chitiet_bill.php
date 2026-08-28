<?php
if (empty($_SESSION['user'])) {
    header('Location: ?act=login');
    exit();
}

$id_bill = (int)($_GET['id_bill'] ?? 0);
$bill = load_bill_by_id($id_bill);

if (!$bill || $bill['id_user'] != $_SESSION['user']['id_user']) {
    echo '<div class="container my-5"><div class="alert alert-danger">Đơn hàng không tồn tại hoặc bạn không có quyền xem đơn hàng này!</div><a href="?act=my-order" class="btn btn-primary">Xem đơn hàng của tôi</a></div>';
    return;
}

$listbhd = select_billhoadon($id_bill);
$trangthaihd = (int)$bill['trangthai'];
$trangthai_tt = (int)$bill['trangthaitt'];
?>

<div class="container my-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light p-3 rounded mb-4">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="?act=my-order" class="text-decoration-none">Đơn hàng của tôi</a></li>
            <li class="breadcrumb-item active" aria-current="page">Chi tiết đơn #<?=$id_bill?></li>
        </ol>
    </nav>

    <div class="row g-4">
        <!-- Thông tin người nhận -->
        <div class="col-lg-5">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-primary text-white fw-bold py-3">
                    <i class="fa-solid fa-address-card me-2"></i>Thông tin nhận hàng
                </div>
                <div class="card-body p-4">
                    <p class="mb-2"><strong>Người nhận:</strong> <?=htmlspecialchars($bill['name_user'])?></p>
                    <p class="mb-2"><strong>Số điện thoại:</strong> <?=htmlspecialchars($bill['sdt'])?></p>
                    <p class="mb-2"><strong>Email:</strong> <?=htmlspecialchars($bill['email'])?></p>
                    <p class="mb-0"><strong>Địa chỉ giao hàng:</strong> <?=htmlspecialchars($bill['diachi'])?></p>
                </div>
            </div>
        </div>

        <!-- Thông tin đơn hàng & Trạng thái -->
        <div class="col-lg-7">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-dark text-white fw-bold py-3">
                    <i class="fa-solid fa-receipt me-2"></i>Trạng thái đơn hàng #<?=$id_bill?>
                </div>
                <div class="card-body p-4">
                    <div class="row mb-3">
                        <div class="col-6">
                            <span class="text-muted small d-block">Ngày đặt hàng:</span>
                            <strong><?=date('d/m/Y', strtotime($bill['ngaydat']))?></strong>
                        </div>
                        <div class="col-6">
                            <span class="text-muted small d-block">Hình thức thanh toán:</span>
                            <strong>
                                <?php
                                if ($bill['pttt'] == 1) echo "Thanh toán khi nhận hàng (COD)";
                                elseif ($bill['pttt'] == 2) echo "Thanh toán QR MoMo";
                                elseif ($bill['pttt'] == 3) echo "Thanh toán ATM MoMo";
                                ?>
                            </strong>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <span class="text-muted small d-block">Trạng thái vận chuyển:</span>
                            <?php
                            switch ($trangthaihd) {
                                case 0: echo '<span class="badge bg-warning text-dark fs-6">Chờ xác nhận</span>'; break;
                                case 1: echo '<span class="badge bg-info text-dark fs-6">Đã xác nhận</span>'; break;
                                case 2: echo '<span class="badge bg-primary fs-6">Đang chuẩn bị hàng</span>'; break;
                                case 3: echo '<span class="badge bg-primary fs-6">Đang giao hàng</span>'; break;
                                case 4: echo '<span class="badge bg-success fs-6">Đã giao hàng thành công</span>'; break;
                                case 5: echo '<span class="badge bg-danger fs-6">Đơn hàng bị hủy</span>'; break;
                            }
                            ?>
                        </div>
                        <div class="col-6">
                            <span class="text-muted small d-block">Trạng thái thanh toán:</span>
                            <?php
                            if ($trangthai_tt == 1 || $trangthaihd == 4) {
                                echo '<span class="badge bg-success fs-6">Đã thanh toán</span>';
                            } else {
                                echo '<span class="badge bg-danger fs-6">Chưa thanh toán</span>';
                            }
                            ?>
                        </div>
                    </div>

                    <!-- Hành động người dùng -->
                    <div class="mt-4 pt-3 border-top">
                        <?php if ($trangthaihd === 3): ?>
                            <a href="index.php?act=xacnhandh&trangthai=4&trangthaitt=1&id_bill=<?=$id_bill?>" class="btn btn-success" onclick="return confirm('Xác nhận bạn đã nhận được hàng?')">
                                <i class="fa-solid fa-check me-1"></i> Đã nhận được hàng
                            </a>
                        <?php elseif ($trangthaihd <= 2 && $trangthai_tt === 0): ?>
                            <a href="index.php?act=xacnhandh&trangthai=5&trangthaitt=0&id_bill=<?=$id_bill?>" class="btn btn-outline-danger" onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">
                                <i class="fa-solid fa-ban me-1"></i> Hủy đơn hàng
                            </a>
                        <?php elseif ($trangthaihd === 5): ?>
                            <a href="index.php?act=xacnhandh&trangthai=0&id_bill=<?=$id_bill?>" class="btn btn-outline-success">
                                <i class="fa-solid fa-rotate-right me-1"></i> Đặt lại đơn hàng này
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Danh sách sản phẩm -->
    <div class="card shadow-sm border-0 mt-4">
        <div class="card-header bg-white fw-bold py-3">
            <h5 class="mb-0">Danh sách sản phẩm trong đơn hàng</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Sản phẩm</th>
                            <th class="text-center">Size</th>
                            <th class="text-end">Đơn giá</th>
                            <th class="text-center">Số lượng</th>
                            <th class="text-end">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($listbhd as $lbhd): 
                            $line_total = $lbhd['tong_tien'] ? $lbhd['tong_tien'] : ($lbhd['price_sp'] * $lbhd['soluong_sp']);
                        ?>
                            <tr>
                                <td>
                                    <a href="?act=viewProduct&id_sp=<?=$lbhd['id_sp']?>" class="fw-bold text-dark text-decoration-none">
                                        <?=htmlspecialchars($lbhd['name_sp'])?>
                                    </a>
                                </td>
                                <td class="text-center"><span class="badge bg-secondary"><?=$lbhd['size_sp']?></span></td>
                                <td class="text-end"><?=number_format((int)$lbhd['price_sp'], 0, ",", ".")?> ₫</td>
                                <td class="text-center fw-bold"><?=$lbhd['soluong_sp']?></td>
                                <td class="text-end fw-bold text-danger"><?=number_format((int)$line_total, 0, ",", ".")?> ₫</td>
                            </tr>
                        <?php endforeach; ?>
                        <tr class="table-light">
                            <td colspan="4" class="text-end fw-bold fs-5">Tổng tiền thanh toán:</td>
                            <td class="text-end fw-bold text-danger fs-4"><?=number_format((int)$bill['tongbill'], 0, ",", ".")?> ₫</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>