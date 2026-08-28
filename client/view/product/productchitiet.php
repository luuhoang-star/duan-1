<?php
$id_sp = (int)($_GET['id_sp'] ?? 0);
$id_dm = (int)($Product['id_dm'] ?? ($_GET['id_dm'] ?? 0));

$matsan_name = "Chưa phân loại";
if (($Product['matsan'] ?? 0) == 1) $matsan_name = "Giày cỏ nhân tạo (Turf)";
elseif (($Product['matsan'] ?? 0) == 2) $matsan_name = "Giày cỏ tự nhiên (Ag, Fg)";
elseif (($Product['matsan'] ?? 0) == 3) $matsan_name = "Phụ kiện thể thao";

$related_products = productrelated($id_dm);
$product_comments = loadCmtByProduct($id_sp);
?>

<div class="container my-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light p-3 rounded mb-4">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="index.php?act=all-product" class="text-decoration-none">Sản phẩm</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?=htmlspecialchars($Product['name_sp'])?></li>
        </ol>
    </nav>

    <!-- Chi tiết sản phẩm -->
    <div class="card shadow-sm border-0 p-4 bg-white rounded-3 mb-5">
        <div class="row g-4">
            <!-- Ảnh sản phẩm -->
            <div class="col-lg-5 text-center">
                <div class="p-3 border rounded-3 bg-light">
                    <img src="../img/<?=$Product['image_sp']?>" alt="<?=htmlspecialchars($Product['name_sp'])?>" class="img-fluid" style="max-height: 380px; object-fit: contain;">
                </div>
            </div>

            <!-- Thông tin & Mua hàng -->
            <div class="col-lg-7">
                <form action="?act=add-to-cart" method="POST">
                    <input type="hidden" name="id_sp" value="<?=$Product['id_sp']?>">
                    <input type="hidden" name="name_sp" value="<?=htmlspecialchars($Product['name_sp'])?>">
                    <input type="hidden" name="image_sp" value="<?=$Product['image_sp']?>">
                    <input type="hidden" name="price_sp" value="<?=$Product['price_sp']?>">
                    <input type="hidden" id="selectedSize" name="selectedSize" value="40">

                    <h3 class="fw-bold text-dark mb-2"><?=htmlspecialchars($Product['name_sp'])?></h3>
                    <p class="text-muted mb-2"><i class="fa-solid fa-tag me-1"></i>Loại: <span class="badge bg-secondary"><?=$matsan_name?></span></p>
                    
                    <div class="my-3">
                        <h2 class="text-danger fw-bold"><?=number_format((int)$Product['price_sp'], 0, ",", ".")?> ₫</h2>
                    </div>

                    <!-- Chọn Size -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Chọn kích cỡ (Size):</label>
                        <div class="d-flex gap-2">
                            <?php foreach(['40', '41', '42', '43', '44'] as $idx => $sz): ?>
                                <button type="button" class="btn btn-outline-dark size-btn <?= $idx === 0 ? 'active' : '' ?>" data-size="<?=$sz?>">
                                    <?=$sz?>
                                </button>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Số lượng -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Số lượng:</label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="number" name="soluongcart" class="form-control text-center" value="1" min="1" max="<?=$Product['soluong']?>" style="width: 90px;">
                            <span class="text-muted small"><?=$Product['soluong']?> sản phẩm có sẵn</span>
                        </div>
                    </div>

                    <!-- Nút Mua -->
                    <div class="d-flex gap-3 mt-4">
                        <button type="submit" name="addToCart" class="btn btn-outline-success btn-lg px-4 fw-bold">
                            <i class="fa-solid fa-cart-plus me-2"></i>Thêm vào giỏ hàng
                        </button>
                        <button type="submit" name="buy-now" class="btn btn-danger btn-lg px-4 fw-bold">
                            <i class="fa-solid fa-bolt me-2"></i>Mua ngay
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <hr class="my-4">

        <!-- Mô tả chi tiết -->
        <div>
            <h4 class="fw-bold mb-3"><i class="fa-solid fa-file-lines me-2"></i>Mô tả chi tiết sản phẩm</h4>
            <div id="detailDescription" style="max-height: 250px; overflow: hidden; line-height: 1.8;" class="text-secondary">
                <?= nl2br(htmlspecialchars($Product['desc_sp'])) ?>
            </div>
            <div class="text-center mt-3">
                <button type="button" class="btn btn-sm btn-outline-primary" id="toggleDescriptionBtn" onclick="toggleDescription()">
                    Xem thêm <i class="fa-solid fa-chevron-down ms-1"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sản phẩm liên quan -->
    <div class="my-5">
        <h4 class="fw-bold text-dark mb-4"><i class="fa-solid fa-layer-group me-2"></i>Sản phẩm cùng thương hiệu</h4>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
            <?php foreach($related_products as $rel): 
                if ($rel['id_sp'] == $id_sp) continue;
            ?>
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden product-card bg-white text-center">
                        <a href="?act=viewProduct&id_sp=<?=$rel['id_sp']?>&id_dm=<?=$rel['id_dm']?>">
                            <img src="../img/<?=$rel['image_sp']?>" class="card-img-top p-2" alt="<?=htmlspecialchars($rel['name_sp'])?>" style="height: 180px; object-fit: contain;">
                        </a>
                        <div class="card-body p-2 d-flex flex-column">
                            <h6 class="card-title text-truncate mb-1" title="<?=htmlspecialchars($rel['name_sp'])?>">
                                <a href="?act=viewProduct&id_sp=<?=$rel['id_sp']?>&id_dm=<?=$rel['id_dm']?>" class="text-dark text-decoration-none fw-bold small">
                                    <?=htmlspecialchars($rel['name_sp'])?>
                                </a>
                            </h6>
                            <p class="text-danger fw-bold mb-2 small"><?=number_format((int)$rel['price_sp'], 0, ",", ".")?> ₫</p>
                            <a href="?act=viewProduct&id_sp=<?=$rel['id_sp']?>&id_dm=<?=$rel['id_dm']?>" class="btn btn-sm btn-outline-primary mt-auto">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Bình luận & Đánh giá -->
    <div class="card shadow-sm border-0 p-4 bg-white rounded-3 mb-5">
        <h4 class="fw-bold mb-4"><i class="fa-solid fa-comments me-2"></i>Đánh giá & Bình luận</h4>

        <!-- Form gửi bình luận -->
        <?php if (isset($_SESSION['user'])): ?>
            <form method="POST" action="?act=comment&id_sp=<?=$id_sp?>&id_dm=<?=$id_dm?>" class="mb-4 p-3 bg-light rounded border">
                <input type="hidden" name="id_sp" value="<?=$id_sp?>">
                <input type="hidden" name="id_user" value="<?=$_SESSION['user']['id_user']?>">
                <div class="mb-3">
                    <label class="form-label fw-bold">Để lại cảm nghĩ của bạn về sản phẩm:</label>
                    <textarea class="form-control" rows="3" name="cmt" placeholder="Sản phẩm rất tốt, đi êm chân, vừa size..." required></textarea>
                </div>
                <button type="submit" name="comment" class="btn btn-primary">
                    <i class="fa-solid fa-paper-plane me-1"></i> Gửi đánh giá
                </button>
            </form>
        <?php else: ?>
            <div class="alert alert-info py-2 mb-4">
                Vui lòng <a href="?act=login" class="fw-bold text-decoration-none">Đăng nhập</a> để tham gia đánh giá sản phẩm.
            </div>
        <?php endif; ?>

        <!-- Danh sách bình luận -->
        <div class="comment-list">
            <?php if (!empty($product_comments)): ?>
                <?php foreach($product_comments as $comment): ?>
                    <div class="d-flex gap-3 mb-3 pb-3 border-bottom">
                        <img src="../img/<?=$comment['avatar'] ?? 'user.png'?>" alt="User" class="rounded-circle" style="width: 45px; height: 45px; object-fit: cover;">
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <h6 class="fw-bold mb-0"><?=htmlspecialchars($comment['name_user'])?></h6>
                                <small class="text-muted"><?=date('d/m/Y H:i', strtotime($comment['time']))?></small>
                            </div>
                            <p class="text-secondary mb-0"><?=htmlspecialchars($comment['content_cmt'])?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-muted text-center py-3 mb-0">Chưa có bình luận nào cho sản phẩm này. Hãy là người đầu tiên đánh giá!</p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
// Size selection
document.querySelectorAll('.size-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        document.getElementById('selectedSize').value = this.dataset.size;
    });
});

// Toggle description
function toggleDescription() {
    const desc = document.getElementById("detailDescription");
    const btn = document.getElementById("toggleDescriptionBtn");
    if (desc.style.maxHeight === "none") {
        desc.style.maxHeight = "250px";
        btn.innerHTML = 'Xem thêm <i class="fa-solid fa-chevron-down ms-1"></i>';
    } else {
        desc.style.maxHeight = "none";
        btn.innerHTML = 'Thu gọn <i class="fa-solid fa-chevron-up ms-1"></i>';
    }
}
</script>
