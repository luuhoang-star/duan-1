<?php
$act = $_GET['act'] ?? 'all-product';
$title_heading = 'Tất cả sản phẩm';
$breadcrumb_text = 'Tất cả sản phẩm';

if ($act === 'loai') {
    $matsan = (int)($_GET['matsan'] ?? 1);
    if ($matsan === 1) {
        $title_heading = 'Giày cỏ nhân tạo (Turf)';
        $breadcrumb_text = 'Giày cỏ nhân tạo';
    } elseif ($matsan === 2) {
        $title_heading = 'Giày cỏ tự nhiên (Ag, Fg)';
        $breadcrumb_text = 'Giày cỏ tự nhiên';
    } elseif ($matsan === 3) {
        $title_heading = 'Phụ kiện bóng đá';
        $breadcrumb_text = 'Phụ kiện';
    }
} elseif ($act === 'search') {
    $title_heading = 'Kết quả tìm kiếm: "' . htmlspecialchars($_POST['content'] ?? '') . '"';
    $breadcrumb_text = 'Tìm kiếm';
} elseif ($act === 'search-by-id') {
    $id_dm = (int)($_GET['id_dm'] ?? 0);
    $cat_info = nameById($id_dm);
    $cat_name = $cat_info['name_dm'] ?? 'Thương hiệu';
    $title_heading = 'Sản phẩm nhãn hàng: ' . htmlspecialchars($cat_name);
    $breadcrumb_text = htmlspecialchars($cat_name);
} elseif ($act === 'bo-loc') {
    $filter = (int)($_GET['filter'] ?? 1);
    $title_heading = ($filter === 1) ? 'Sắp xếp: Giá tăng dần' : 'Sắp xếp: Giá giảm dần';
    $breadcrumb_text = 'Bộ lọc giá';
}

$categories = loadAll();
?>

<div class="container my-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="bg-light p-3 rounded mb-4">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="index.php?act=all-product" class="text-decoration-none">Sản phẩm</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?=$breadcrumb_text?></li>
        </ol>
    </nav>

    <div class="row g-4">
        <!-- Sidebar Bộ lọc -->
        <div class="col-lg-3">
            <!-- Tìm kiếm nhanh -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-primary text-white fw-bold py-2">
                    <i class="fa-solid fa-magnifying-glass me-2"></i>Tìm kiếm sản phẩm
                </div>
                <div class="card-body">
                    <form method="POST" action="?act=search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="content" placeholder="Tên sản phẩm..." required value="<?= htmlspecialchars($_POST['content'] ?? '') ?>">
                            <button class="btn btn-primary" name="search" type="submit">
                                <i class="fa-solid fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Danh mục nhãn hàng -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-dark text-white fw-bold py-2">
                    <i class="fa-solid fa-list me-2"></i>Thương hiệu / Nhãn hàng
                </div>
                <div class="list-group list-group-flush">
                    <a href="index.php?act=all-product" class="list-group-item list-group-item-action <?= ($act === 'all-product') ? 'active fw-bold' : '' ?>">
                        Tất cả thương hiệu
                    </a>
                    <?php foreach($categories as $cat): ?>
                        <a href="?act=search-by-id&id_dm=<?=$cat['id_dm']?>" class="list-group-item list-group-item-action <?= (isset($_GET['id_dm']) && $_GET['id_dm'] == $cat['id_dm']) ? 'active fw-bold' : '' ?>">
                            <?=htmlspecialchars($cat['name_dm'])?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Loại mặt sân -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white fw-bold py-2">
                    <i class="fa-solid fa-futbol me-2"></i>Loại mặt sân
                </div>
                <div class="list-group list-group-flush">
                    <a href="index.php?act=loai&matsan=1" class="list-group-item list-group-item-action <?= (isset($_GET['matsan']) && $_GET['matsan'] == '1') ? 'active fw-bold' : '' ?>">
                        Giày cỏ nhân tạo (Turf)
                    </a>
                    <a href="index.php?act=loai&matsan=2" class="list-group-item list-group-item-action <?= (isset($_GET['matsan']) && $_GET['matsan'] == '2') ? 'active fw-bold' : '' ?>">
                        Giày cỏ tự nhiên (Ag, Fg)
                    </a>
                    <a href="index.php?act=loai&matsan=3" class="list-group-item list-group-item-action <?= (isset($_GET['matsan']) && $_GET['matsan'] == '3') ? 'active fw-bold' : '' ?>">
                        Phụ kiện thể thao
                    </a>
                </div>
            </div>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
                <h4 class="fw-bold text-dark mb-0"><?=$title_heading?></h4>
                
                <!-- Bộ lọc sắp xếp giá -->
                <div class="d-flex align-items-center gap-2">
                    <label class="text-nowrap small text-muted">Sắp xếp theo:</label>
                    <select class="form-select form-select-sm" id="select-filter" style="width: 170px;" onchange="location.href='?act=bo-loc&filter=' + this.value;">
                        <option value="">-- Mặc định --</option>
                        <option value="1" <?= (isset($_GET['filter']) && $_GET['filter'] == '1') ? 'selected' : '' ?>>Giá tăng dần</option>
                        <option value="2" <?= (isset($_GET['filter']) && $_GET['filter'] == '2') ? 'selected' : '' ?>>Giá giảm dần</option>
                    </select>
                </div>
            </div>

            <?php if (!empty($Product)): ?>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                    <?php foreach($Product as $sp): ?>
                        <div class="col">
                            <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden product-card bg-white position-relative">
                                <a href="?act=viewProduct&id_sp=<?=$sp['id_sp']?>&id_dm=<?=$sp['id_dm']?>">
                                    <img src="../img/<?=$sp['image_sp']?>" class="card-img-top p-3" alt="<?=htmlspecialchars($sp['name_sp'])?>" style="height: 220px; object-fit: contain;">
                                </a>
                                <div class="card-body d-flex flex-column text-center p-3">
                                    <h6 class="card-title mb-2 text-truncate" title="<?=htmlspecialchars($sp['name_sp'])?>">
                                        <a href="?act=viewProduct&id_sp=<?=$sp['id_sp']?>&id_dm=<?=$sp['id_dm']?>" class="text-dark text-decoration-none fw-bold">
                                            <?=htmlspecialchars($sp['name_sp'])?>
                                        </a>
                                    </h6>
                                    <div class="mt-auto">
                                        <p class="text-danger fw-bold fs-5 mb-2"><?=number_format((int)$sp['price_sp'], 0, ",", ".")?> ₫</p>
                                        <div class="d-flex gap-2">
                                            <a href="?act=viewProduct&id_sp=<?=$sp['id_sp']?>&id_dm=<?=$sp['id_dm']?>" class="btn btn-sm btn-primary flex-grow-1 rounded-pill">
                                                <i class="fa-solid fa-eye me-1"></i> Chi tiết
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Phân trang -->
                <div class="d-flex justify-content-center mt-5" id="pagination">
                    <?= $hien_thi_so_trang ?? '' ?>
                </div>

            <?php else: ?>
                <div class="text-center py-5 bg-white rounded shadow-sm">
                    <i class="fa-solid fa-box-open fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Không tìm thấy sản phẩm nào phù hợp!</h5>
                    <a href="index.php?act=all-product" class="btn btn-outline-primary mt-2">Xem tất cả sản phẩm</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
