<?php
$listCat = loadAll();
?>

<div class="container-fluid mt-4">
    <h2 class="text-center text-primary mb-4">Cập nhật sản phẩm</h2>
    
    <form class="d-flex flex-column gap-3 shadow-sm p-4 bg-white rounded" id="update-product" action="index.php?act=update-product&id_sp=<?=$info['id_sp']?>" enctype="multipart/form-data" method="POST">
        <input type="hidden" name="id_sp" value="<?=$info['id_sp']?>">
        
        <div class="row">
            <div class="col-md-6 form-group">
                <label class="form-label fw-bold">Nhà sản xuất / Danh mục</label>
                <select name="category" id="category" class="form-select" required>
                    <?php foreach($listCat as $cat): ?> 
                        <option value="<?=$cat['id_dm']?>" <?= ($cat['id_dm'] == $info['id_dm']) ? 'selected' : '' ?>>
                            <?=$cat['name_dm']?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-6 form-group">
                <label class="form-label fw-bold">Loại mặt sân</label>
                <select name="matsan" id="matsan" class="form-select">
                    <option value="1" <?= ($info['matsan'] == 1) ? 'selected' : '' ?>>Cỏ nhân tạo (Turf)</option>
                    <option value="2" <?= ($info['matsan'] == 2) ? 'selected' : '' ?>>Cỏ tự nhiên (Ag, Fg)</option>
                    <option value="3" <?= ($info['matsan'] == 3) ? 'selected' : '' ?>>Phụ kiện</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label fw-bold">Tên sản phẩm</label>
            <input type="text" class="form-control" placeholder="Nhập tên sản phẩm" required id="product_name" name="product_name" value="<?=htmlspecialchars($info['name_sp'])?>">
        </div>

        <div class="row">
            <div class="col-md-6 form-group">
                <label class="form-label fw-bold">Giá bán (VNĐ)</label>
                <input type="number" class="form-control" placeholder="Nhập giá sản phẩm" required id="product_price" name="product_price" value="<?=(int)$info['price_sp']?>" min="0">
            </div>

            <div class="col-md-6 form-group">
                <label class="form-label fw-bold">Số lượng trong kho</label>
                <input type="number" class="form-control" placeholder="Nhập số lượng" required id="product_quantity" name="product_quantity" value="<?=$info['soluong']?>" min="0"> 
            </div>
        </div>

        <div class="form-group">
            <label class="form-label fw-bold">Mô tả sản phẩm</label>
            <textarea class="form-control" rows="5" placeholder="Nhập mô tả sản phẩm" required id="product_desc" name="product_desc"><?=htmlspecialchars($info['desc_sp'])?></textarea>
        </div>

        <div class="form-group">
            <label class="form-label fw-bold">Ảnh sản phẩm</label>
            <div class="d-flex align-items-center gap-3">
                <img src="../img/<?=$info['image_sp']?>" alt="Ảnh hiện tại" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                <div class="flex-grow-1">
                    <input type="file" class="form-control" id="product_avatar" name="product_avatar" accept="image/*">
                    <small class="text-muted">Để trống nếu không muốn thay đổi ảnh.</small>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-3">
            <button type="submit" class="btn btn-primary px-4" name="update-product">
                <i class="fa-solid fa-check"></i> Cập nhật
            </button>
            <a href="index.php?act=list-products" class="btn btn-secondary px-4">Hủy bỏ</a>
        </div>
    </form>
</div>