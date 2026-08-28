<?php
$topProducts = top6Product();
$newProducts = NewProduct();
?>

<!-- Banner Slider -->
<div class="container my-4">
    <div id="carouselExampleIndicators" class="carousel slide rounded shadow overflow-hidden" data-bs-ride="carousel" data-bs-interval="3500">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <a href="index.php?act=all-product">
                    <img src="https://theme.hstatic.net/200000278317/1000929405/14/slideshow_1.jpg?v=1170" class="d-block w-100" alt="Banner 1" style="max-height: 450px; object-fit: cover;">
                </a>
            </div>
            <div class="carousel-item">
                <a href="index.php?act=all-product">
                    <img src="https://theme.hstatic.net/200000278317/1000929405/14/slideshow_4.jpg?v=1170" class="d-block w-100" alt="Banner 2" style="max-height: 450px; object-fit: cover;">
                </a>
            </div>
            <div class="carousel-item">
                <a href="index.php?act=all-product">
                    <img src="https://theme.hstatic.net/200000278317/1000929405/14/slideshow_7.jpg?v=1170" class="d-block w-100" alt="Banner 3" style="max-height: 450px; object-fit: cover;">
                </a>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<!-- Dịch vụ & Cam kết -->
<div class="container my-5">
    <div class="row g-4 text-center">
        <div class="col-md-4">
            <div class="p-4 bg-white rounded shadow-sm h-100 border">
                <div class="text-primary mb-3"><i class="fa-solid fa-truck-fast fa-2x"></i></div>
                <h5 class="fw-bold">Miễn phí vận chuyển</h5>
                <p class="text-muted small mb-0">Miễn phí vận chuyển cho các đơn hàng đạt hạn mức</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 bg-white rounded shadow-sm h-100 border">
                <div class="text-success mb-3"><i class="fa-solid fa-rotate-left fa-2x"></i></div>
                <h5 class="fw-bold">Đổi trả trong 30 ngày</h5>
                <p class="text-muted small mb-0">Đổi size hoặc hoàn tiền nhanh chóng nếu không vừa</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 bg-white rounded shadow-sm h-100 border">
                <div class="text-warning mb-3"><i class="fa-solid fa-headset fa-2x"></i></div>
                <h5 class="fw-bold">Hỗ trợ 24/7</h5>
                <p class="text-muted small mb-0">Tư vấn chọn giày và chọn size tận tình, chu đáo</p>
            </div>
        </div>
    </div>
</div>

<!-- Sản phẩm nổi bật -->
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0"><i class="fa-solid fa-fire text-danger me-2"></i>Sản phẩm nổi bật</h3>
        <a href="index.php?act=all-product" class="text-decoration-none fw-bold text-primary">Xem tất cả &rarr;</a>
    </div>
    
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        <?php foreach($topProducts as $sp): ?>
            <div class="col">
                <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden product-card bg-white position-relative">
                    <a href="?act=viewProduct&id_sp=<?=$sp['id_sp']?>&id_dm=<?=$sp['id_dm']?>">
                        <img src="../img/<?=$sp['image_sp']?>" class="card-img-top p-2" alt="<?=htmlspecialchars($sp['name_sp'])?>" style="height: 220px; object-fit: contain;">
                    </a>
                    <div class="card-body d-flex flex-column text-center p-3">
                        <h6 class="card-title mb-2 text-truncate" title="<?=htmlspecialchars($sp['name_sp'])?>">
                            <a href="?act=viewProduct&id_sp=<?=$sp['id_sp']?>&id_dm=<?=$sp['id_dm']?>" class="text-dark text-decoration-none fw-bold">
                                <?=htmlspecialchars($sp['name_sp'])?>
                            </a>
                        </h6>
                        <div class="mt-auto">
                            <p class="text-danger fw-bold fs-5 mb-2"><?=number_format((int)$sp['price_sp'], 0, ",", ".")?> ₫</p>
                            <a href="?act=viewProduct&id_sp=<?=$sp['id_sp']?>&id_dm=<?=$sp['id_dm']?>" class="btn btn-sm btn-primary w-100 rounded-pill">
                                <i class="fa-solid fa-eye me-1"></i> Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Sản phẩm mới -->
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0"><i class="fa-solid fa-sparkles text-warning me-2"></i>Sản phẩm mới ra mắt</h3>
        <a href="index.php?act=all-product" class="text-decoration-none fw-bold text-primary">Xem tất cả &rarr;</a>
    </div>
    
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        <?php foreach($newProducts as $sp): ?>
            <div class="col">
                <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden product-card bg-white position-relative">
                    <span class="badge bg-danger position-absolute top-0 end-0 m-2">Mới</span>
                    <a href="?act=viewProduct&id_sp=<?=$sp['id_sp']?>&id_dm=<?=$sp['id_dm']?>">
                        <img src="../img/<?=$sp['image_sp']?>" class="card-img-top p-2" alt="<?=htmlspecialchars($sp['name_sp'])?>" style="height: 220px; object-fit: contain;">
                    </a>
                    <div class="card-body d-flex flex-column text-center p-3">
                        <h6 class="card-title mb-2 text-truncate" title="<?=htmlspecialchars($sp['name_sp'])?>">
                            <a href="?act=viewProduct&id_sp=<?=$sp['id_sp']?>&id_dm=<?=$sp['id_dm']?>" class="text-dark text-decoration-none fw-bold">
                                <?=htmlspecialchars($sp['name_sp'])?>
                            </a>
                        </h6>
                        <div class="mt-auto">
                            <p class="text-danger fw-bold fs-5 mb-2"><?=number_format((int)$sp['price_sp'], 0, ",", ".")?> ₫</p>
                            <a href="?act=viewProduct&id_sp=<?=$sp['id_sp']?>&id_dm=<?=$sp['id_dm']?>" class="btn btn-sm btn-outline-primary w-100 rounded-pill">
                                <i class="fa-solid fa-eye me-1"></i> Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Banner thương hiệu -->
<div class="container my-5 text-center">
    <div class="card border-0 shadow-sm overflow-hidden rounded-3">
        <img src="../img/banner-giua.jpg" alt="Banner Khách hàng" class="img-fluid w-100">
    </div>
</div>
