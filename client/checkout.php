<?php
$user = $_SESSION['user'] ?? [];
$id_user = $user['id_user'] ?? 0;
$name = $user['name_user'] ?? '';
$address = $user['diachi'] ?? '';
$tel = $user['sdt'] ?? '';
$email = $user['email'] ?? '';
?>

<div class="container my-5">
    <h2 class="text-center text-primary mb-4 fw-bold"><i class="fa-solid fa-credit-card me-2"></i>Xác nhận & Thanh toán đơn hàng</h2>

    <?php if (!empty($_SESSION['cart'])): ?>
    <form action="?act=thanhtoan" method="POST">
        <div class="row g-4">
            <!-- Thông tin khách hàng & Giao hàng -->
            <div class="col-lg-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-primary text-white fw-bold py-3">
                        <i class="fa-solid fa-user me-2"></i>Thông tin người nhận hàng
                    </div>
                    <div class="card-body p-4">
                        <input type="hidden" name="id_user" value="<?=$id_user?>">
                        
                        <div class="mb-3">
                            <label class="form-label fw-bold">Họ và tên người nhận <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="name_user" placeholder="Nhập họ và tên" value="<?=htmlspecialchars($name)?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Số điện thoại liên hệ <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="tel_user" placeholder="Nhập số điện thoại" value="<?=htmlspecialchars($tel)?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Địa chỉ nhận hàng <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="address_user" rows="2" placeholder="Số nhà, đường, phường/xã, quận/huyện, tỉnh/thành..." required><?=htmlspecialchars($address)?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Phương thức thanh toán <span class="text-danger">*</span></label>
                            <div class="d-flex flex-column gap-2 mt-1">
                                <div class="form-check p-3 border rounded">
                                    <input class="form-check-input" type="radio" name="pttt" id="pttt1" value="1" checked>
                                    <label class="form-check-label fw-bold" for="pttt1">
                                        <i class="fa-solid fa-money-bill-wave text-success me-2"></i>Thanh toán khi nhận hàng (COD)
                                    </label>
                                </div>
                                <div class="form-check p-3 border rounded">
                                    <input class="form-check-input" type="radio" name="pttt" id="pttt2" value="2">
                                    <label class="form-check-label fw-bold" for="pttt2">
                                        <i class="fa-solid fa-qrcode text-danger me-2"></i>Thanh toán qua QR MoMo
                                    </label>
                                </div>
                                <div class="form-check p-3 border rounded">
                                    <input class="form-check-input" type="radio" name="pttt" id="pttt3" value="3">
                                    <label class="form-check-label fw-bold" for="pttt3">
                                        <i class="fa-solid fa-building-columns text-primary me-2"></i>Thanh toán qua ATM MoMo
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tóm tắt đơn hàng -->
            <div class="col-lg-6">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-dark text-white fw-bold py-3">
                        <i class="fa-solid fa-receipt me-2"></i>Tóm tắt giỏ hàng
                    </div>
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="table-responsive flex-grow-1">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th class="text-center">Size</th>
                                        <th class="text-center">SL</th>
                                        <th class="text-end">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $grand_total = 0;
                                    foreach ($_SESSION['cart'] as $item):
                                        $line_total = (int)$item['price_sp'] * (int)$item['soluongcart'];
                                        $grand_total += $line_total;
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="fw-bold"><?=htmlspecialchars($item['name_sp'])?></div>
                                            <small class="text-muted"><?=number_format((int)$item['price_sp'], 0, ",", ".")?> ₫</small>
                                        </td>
                                        <td class="text-center"><span class="badge bg-secondary"><?=$item['size'] ?: 'N/A'?></span></td>
                                        <td class="text-center fw-bold"><?=$item['soluongcart']?></td>
                                        <td class="text-end fw-bold text-danger"><?=number_format($line_total, 0, ",", ".")?> ₫</td>
                                    </tr>
                                    <?php endforeach; 
                                    $_SESSION['tongbill'] = $grand_total;
                                    ?>
                                </tbody>
                            </table>
                        </div>

                        <hr class="my-3">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="fs-5 fw-bold">Tổng thanh toán:</span>
                            <span class="fs-4 fw-bold text-danger"><?=number_format($grand_total, 0, ",", ".")?> ₫</span>
                        </div>

                        <button type="submit" name="thanhtoan" class="btn btn-success btn-lg w-100 py-3 fw-bold shadow">
                            <i class="fa-solid fa-check-circle me-2"></i>Xác nhận đặt hàng ngay
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php else: ?>
        <div class="text-center py-5 bg-white rounded shadow-sm">
            <h4 class="text-muted">Không có sản phẩm nào để thanh toán!</h4>
            <a href="index.php?act=all-product" class="btn btn-primary mt-3">Quay lại mua hàng</a>
        </div>
    <?php endif; ?>
</div>