<?php
if (empty($_SESSION['user'])) {
    header('Location: ?act=login');
    exit();
}

$id_user = (int)$_SESSION['user']['id_user'];
$my_orders = load_bills_by_user($id_user);
?>

<div class="container my-5">
    <h2 class="text-center text-primary mb-4 fw-bold"><i class="fa-solid fa-boxes-packing me-2"></i>Lịch sử đơn hàng của tôi</h2>

    <div class="table-responsive bg-white rounded shadow-sm p-4">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th style="width: 90px;">Mã đơn</th>
                    <th>Ngày đặt hàng</th>
                    <th>Trạng thái đơn</th>
                    <th>Thanh toán</th>
                    <th>Tổng tiền</th>
                    <th class="text-center" style="width: 110px;">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($my_orders)): ?>
                    <?php foreach($my_orders as $ord): 
                        $linkhd = "index.php?act=view-bill&id_bill=" . $ord['id_bill'];
                    ?>
                    <tr>
                        <td><strong>#<?=$ord['id_bill']?></strong></td>
                        <td><?=date('d/m/Y', strtotime($ord['ngaydat']))?></td>
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
                            <?php
                            if ($ord['trangthaitt'] == 1 || $ord['trangthai'] == 4) {
                                echo '<span class="badge bg-success">Đã thanh toán</span>';
                            } else {
                                echo '<span class="badge bg-danger">Chưa thanh toán</span>';
                            }
                            ?>
                        </td>
                        <td><strong class="text-danger"><?=number_format((int)$ord['tongbill'], 0, ",", ".")?> ₫</strong></td>
                        <td class="text-center">
                            <a href="<?=$linkhd?>" class="btn btn-sm btn-outline-primary" title="Xem chi tiết đơn hàng">
                                <i class="fa-solid fa-eye me-1"></i> Chi tiết
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <i class="fa-solid fa-box-open fa-3x mb-3 d-block text-secondary"></i>
                            Bạn chưa có đơn hàng nào.
                            <div class="mt-3">
                                <a href="index.php?act=all-product" class="btn btn-primary btn-sm">Mua sắm ngay</a>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>