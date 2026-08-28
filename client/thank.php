<?php
$id_bill = isset($_GET['id_bill']) ? (int)$_GET['id_bill'] : 0;
?>

<div class="container my-5 py-4">
    <div class="row justify-content-center">
        <div class="col-md-7 text-center bg-white p-5 rounded shadow-sm border">
            <div class="mb-4">
                <i class="fa-solid fa-circle-check fa-5x text-success"></i>
            </div>
            <h2 class="fw-bold text-dark mb-2">Đặt hàng thành công!</h2>
            <p class="text-muted fs-5 mb-4">Cảm ơn bạn đã tin tưởng và mua sắm tại <strong>8 Football Store</strong>.</p>
            
            <?php if ($id_bill > 0): ?>
                <div class="alert alert-light border py-3 mb-4">
                    <span>Mã đơn hàng của bạn: <strong class="text-primary fs-5">#<?= $id_bill ?></strong></span>
                </div>
            <?php endif; ?>

            <p class="small text-muted mb-4">Chúng tôi sẽ sớm liên hệ để xác nhận và tiến hành giao hàng cho bạn trong thời gian sớm nhất.</p>

            <div class="d-flex justify-content-center gap-3">
                <?php if ($id_bill > 0): ?>
                    <a href="?act=view-bill&id_bill=<?= $id_bill ?>" class="btn btn-outline-primary px-4 py-2">
                        <i class="fa-solid fa-receipt me-1"></i> Xem chi tiết đơn hàng
                    </a>
                <?php endif; ?>
                <a href="index.php" class="btn btn-primary px-4 py-2">
                    <i class="fa-solid fa-house me-1"></i> Về trang chủ
                </a>
            </div>
        </div>
    </div>
</div>
