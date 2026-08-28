<?php
$id_bill = isset($_GET['id_bill']) ? (int)$_GET['id_bill'] : 0;
$bill = load_bill_by_id($id_bill);
$listbhd = select_billhoadon($id_bill);

if (!$bill) {
    echo '<div class="container mt-4"><div class="alert alert-danger">Đơn hàng không tồn tại!</div><a href="index.php?act=list-carts" class="btn btn-secondary">Quay lại danh sách</a></div>';
    return;
}

$nd = $bill['ngaydat'];
$thd = $bill['tongbill'];
$pt = $bill['pttt'];
$trangthai = $bill['trangthai'];
?>

<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary mb-0">Chi tiết đơn hàng #<?= $id_bill ?></h2>
        <a class="btn btn-outline-secondary" href="index.php?act=list-carts">
            <i class="fa-solid fa-arrow-left"></i> Quay lại danh sách
        </a>
    </div>

    <div class="row">
        <!-- Thông tin đơn hàng & Cập nhật trạng thái -->
        <div class="col-lg-8 col-md-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white fw-bold">
                    Thông tin đơn hàng
                </div>
                <div class="card-body">
                    <form action="index.php?act=view-bill-admin&id_bill=<?= $id_bill ?>" method="POST">
                        <input type="hidden" name="id_bill" value="<?= $id_bill ?>">
                        
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold">Mã hóa đơn:</label>
                            <div class="col-sm-8">
                                <input type="text" value="#<?= $id_bill ?>" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold">Ngày đặt hàng:</label>
                            <div class="col-sm-8">
                                <input type="text" value="<?= date('d/m/Y', strtotime($nd)) ?>" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold">Tổng tiền đơn hàng:</label>
                            <div class="col-sm-8">
                                <input type="text" value="<?= number_format((int)$thd, 0, ",", ".") ?> ₫" class="form-control fw-bold text-danger" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold">Phương thức thanh toán:</label>
                            <div class="col-sm-8">
                                <?php
                                $pt_text = "Thanh toán trực tiếp (COD)";
                                if ($pt == 2) $pt_text = "Thanh toán QR MOMO";
                                if ($pt == 3) $pt_text = "Thanh toán ATM MOMO";
                                ?>
                                <input type="text" value="<?= $pt_text ?>" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold">Địa chỉ giao hàng:</label>
                            <div class="col-sm-8">
                                <input type="text" value="<?= htmlspecialchars($bill['diachi'] ?? '') ?>" class="form-control" disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label fw-bold">Trạng thái đơn hàng:</label>
                            <div class="col-sm-8">
                                <select class="form-select" name="trangthain">
                                    <option value="0" <?= $trangthai == 0 ? 'selected' : '' ?>>0 - Chờ xác nhận</option>
                                    <option value="1" <?= $trangthai == 1 ? 'selected' : '' ?>>1 - Đã xác nhận</option>
                                    <option value="2" <?= $trangthai == 2 ? 'selected' : '' ?>>2 - Đang chuẩn bị hàng</option>
                                    <option value="3" <?= $trangthai == 3 ? 'selected' : '' ?>>3 - Đang giao hàng</option>
                                    <option value="4" <?= $trangthai == 4 ? 'selected' : '' ?>>4 - Đã giao hàng thành công</option>
                                    <option value="5" <?= $trangthai == 5 ? 'selected' : '' ?>>5 - Đơn hàng bị hủy</option>
                                </select>
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <button class="btn btn-success px-4" type="submit" name="updatevaitro" value="update">
                                <i class="fa-solid fa-floppy-disk"></i> Lưu thay đổi trạng thái
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Thông tin người nhận -->
        <div class="col-lg-4 col-md-12 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-dark text-white fw-bold">
                    Thông tin khách hàng
                </div>
                <div class="card-body">
                    <p class="mb-2"><strong>Họ và tên:</strong> <?= htmlspecialchars($bill['name_user']) ?></p>
                    <p class="mb-2"><strong>Email:</strong> <?= htmlspecialchars($bill['email']) ?></p>
                    <p class="mb-2"><strong>Số điện thoại:</strong> <?= htmlspecialchars($bill['sdt']) ?></p>
                    <p class="mb-0"><strong>Địa chỉ:</strong> <?= htmlspecialchars($bill['diachi']) ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Danh sách sản phẩm trong đơn -->
    <div class="card shadow-sm border-0 mb-4">
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
                        <?php if (!empty($listbhd)): ?>
                            <?php foreach ($listbhd as $lbhd): 
                                $line_total = $lbhd['tong_tien'] ? $lbhd['tong_tien'] : ($lbhd['price_sp'] * $lbhd['soluong_sp']);
                            ?>
                                <tr>
                                    <td class="fw-bold"><?= htmlspecialchars($lbhd['name_sp']) ?></td>
                                    <td class="text-center"><span class="badge bg-secondary"><?= $lbhd['size_sp'] ?></span></td>
                                    <td class="text-end"><?= number_format((int)$lbhd['price_sp'], 0, ",", ".") ?> ₫</td>
                                    <td class="text-center"><?= $lbhd['soluong_sp'] ?></td>
                                    <td class="text-end fw-bold text-danger"><?= number_format((int)$line_total, 0, ",", ".") ?> ₫</td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="table-light">
                                <td colspan="4" class="text-end fw-bold">Tổng cộng:</td>
                                <td class="text-end fw-bold text-danger fs-5"><?= number_format((int)$thd, 0, ",", ".") ?> ₫</td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Không có thông tin chi tiết sản phẩm.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>