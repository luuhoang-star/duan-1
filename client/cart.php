<div class="container my-5">
    <h2 class="text-center text-primary mb-4 fw-bold"><i class="fa-solid fa-cart-shopping me-2"></i>Giỏ hàng của bạn</h2>

    <?php if (!empty($_SESSION['cart'])): ?>
        <div class="table-responsive bg-white rounded shadow-sm p-4 mb-4">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;">Xóa</th>
                        <th style="width: 100px;">Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th class="text-center" style="width: 80px;">Size</th>
                        <th class="text-end" style="width: 140px;">Đơn giá</th>
                        <th class="text-center" style="width: 120px;">Số lượng</th>
                        <th class="text-end" style="width: 150px;">Tổng tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $grand_total = 0;
                    foreach ($_SESSION['cart'] as $index => $item):
                        $item_price = (int)$item['price_sp'];
                        $item_qty = (int)$item['soluongcart'];
                        $line_total = $item_price * $item_qty;
                        $grand_total += $line_total;
                    ?>
                    <tr id="cart-row-<?=$index?>">
                        <td>
                            <form method="POST" action="?act=delete-cart">
                                <input type="hidden" name="cart_index" value="<?=$index?>">
                                <button type="submit" name="delete" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            <img src="../img/<?=$item['image_sp']?>" alt="<?=htmlspecialchars($item['name_sp'])?>" class="img-thumbnail" style="width: 70px; height: 70px; object-fit: contain;">
                        </td>
                        <td>
                            <a href="?act=viewProduct&id_sp=<?=$item['id_sp']?>" class="fw-bold text-dark text-decoration-none">
                                <?=htmlspecialchars($item['name_sp'])?>
                            </a>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-secondary"><?=$item['size'] ?: 'Mặc định'?></span>
                        </td>
                        <td class="text-end">
                            <span class="fw-bold"><?=number_format($item_price, 0, ",", ".")?> ₫</span>
                            <input type="hidden" class="item-price-val" value="<?=$item_price?>">
                        </td>
                        <td class="text-center">
                            <input type="number" 
                                   class="form-control form-control-sm text-center quantity-input" 
                                   value="<?=$item_qty?>" 
                                   min="1" 
                                   max="99" 
                                   onchange="updateCartQuantity(<?=$index?>, this.value)">
                        </td>
                        <td class="text-end">
                            <strong class="text-danger line-total-text" id="line-total-<?=$index?>"><?=number_format($line_total, 0, ",", ".")?> ₫</strong>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="table-light">
                        <td colspan="5" class="text-end fw-bold fs-5">Tổng cộng đơn hàng:</td>
                        <td colspan="2" class="text-end fw-bold text-danger fs-4" id="grand-total-text">
                            <?=number_format($grand_total, 0, ",", ".")?> ₫
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="row g-3 justify-content-between align-items-center bg-white p-3 rounded shadow-sm">
            <div class="col-md-6">
                <form class="d-flex gap-2" onsubmit="event.preventDefault(); alert('Mã giảm giá đã được ghi nhận!');">
                    <input type="text" class="form-control" placeholder="Nhập mã giảm giá..." style="max-width: 250px;">
                    <button type="submit" class="btn btn-outline-warning text-dark fw-bold">Áp dụng</button>
                </form>
            </div>
            <div class="col-md-6 text-end">
                <a href="index.php?act=all-product" class="btn btn-outline-secondary me-2">
                    <i class="fa-solid fa-arrow-left me-1"></i> Tiếp tục mua hàng
                </a>
                <a href="?act=check-out" class="btn btn-success px-4 py-2 fw-bold">
                    Tiến hành thanh toán <i class="fa-solid fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

    <?php else: ?>
        <div class="text-center py-5 bg-white rounded shadow-sm">
            <i class="fa-solid fa-bag-shopping fa-4x text-muted mb-3"></i>
            <h4 class="text-dark">Giỏ hàng của bạn đang trống!</h4>
            <p class="text-muted">Hãy khám phá các mẫu giày bóng đá chất lượng tại 8 Football.</p>
            <a href="index.php?act=all-product" class="btn btn-primary mt-2 px-4 py-2">
                <i class="fa-solid fa-cart-plus me-2"></i>Mua sắm ngay
            </a>
        </div>
    <?php endif; ?>
</div>

<script>
function updateCartQuantity(cartIndex, newQty) {
    newQty = parseInt(newQty);
    if (isNaN(newQty) || newQty < 1) newQty = 1;

    $.ajax({
        type: 'POST',
        url: 'xulysoluong.php',
        data: {
            cart_index: cartIndex,
            soluongcart: newQty
        },
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                $('#line-total-' + cartIndex).text(response.line_total_formatted);
                $('#grand-total-text').text(response.grand_total_formatted);
            }
        },
        error: function() {
            // Fallback reload
            location.reload();
        }
    });
}
</script>