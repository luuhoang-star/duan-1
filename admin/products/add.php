<?php
$selected_dm = isset($_GET['id_dm']) ? (int)$_GET['id_dm'] : 0;
$listCat = loadAll();
?>

<div class="container-fluid mt-4">
    <h2 class="text-center text-primary mb-4">Thêm sản phẩm mới</h2>
    
    <form class="d-flex flex-column gap-3 shadow-sm p-4 bg-white rounded" id="add-product" action="index.php?act=add-product" enctype="multipart/form-data" method="POST" onsubmit="return validateForm()">
        <div class="row">
            <div class="col-md-6 form-group">
                <label class="form-label fw-bold">Nhãn hàng / Danh mục</label>
                <select name="category" id="category" class="form-select" required>
                    <option value="">-- Chọn danh mục --</option>
                    <?php foreach($listCat as $cat): ?>
                        <option value="<?=$cat['id_dm']?>" <?= ($selected_dm == $cat['id_dm']) ? 'selected' : '' ?>>
                            <?=$cat['name_dm']?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="col-md-6 form-group">
                <label class="form-label fw-bold">Loại mặt sân</label>
                <select name="matsan" id="matsan" class="form-select">
                    <option value="1">Cỏ nhân tạo (Turf)</option>
                    <option value="2">Cỏ tự nhiên (Ag, Fg)</option>
                    <option value="3">Phụ kiện</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label fw-bold">Tên sản phẩm</label>
            <input type="text" class="form-control" placeholder="Nhập tên sản phẩm" id="product_name" name="product_name" required>
            <span id="nameError" class="text-danger small"></span>
        </div>

        <div class="row">
            <div class="col-md-6 form-group">
                <label class="form-label fw-bold">Giá bán (VNĐ)</label>
                <input type="number" class="form-control" placeholder="Nhập giá sản phẩm" id="product_price" name="product_price" min="0" required>
                <span id="priceError" class="text-danger small"></span>
            </div>

            <div class="col-md-6 form-group">
                <label class="form-label fw-bold">Số lượng trong kho</label>
                <input type="number" class="form-control" placeholder="Nhập số lượng" id="product_quantity" name="product_quantity" min="1" value="1" required>
                <span id="quantityError" class="text-danger small"></span>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label fw-bold">Mô tả sản phẩm</label>
            <textarea class="form-control" rows="4" placeholder="Nhập mô tả chi tiết sản phẩm" id="product_desc" name="product_desc" required></textarea>
            <span id="descError" class="text-danger small"></span>
        </div>

        <div class="form-group">
            <label class="form-label fw-bold">Ảnh đại diện sản phẩm</label>
            <input type="file" class="form-control" id="product_avatar" name="product_avatar" accept="image/*" required>
            <span id="avatarError" class="text-danger small"></span>
        </div>

        <div class="d-flex justify-content-between mt-3">
            <button type="submit" class="btn btn-primary px-4" name="submit">
                <i class="fa-solid fa-plus"></i> Thêm sản phẩm
            </button>
            <a href="index.php?act=list-products" class="btn btn-secondary px-4">Quay lại danh sách</a>
        </div>
    </form>
</div>

<script>
function validateForm() {
    var name = document.getElementById("product_name").value.trim();
    var price = document.getElementById("product_price").value.trim();
    var desc = document.getElementById("product_desc").value.trim();
    var avatar = document.getElementById("product_avatar").value;
    var quantity = document.getElementById("product_quantity").value.trim();

    if (name === "") {
        alert("Tên sản phẩm không được để trống!");
        return false;
    }
    if (price === "" || isNaN(price) || price < 0) {
        alert("Giá sản phẩm không hợp lệ!");
        return false;
    }
    if (quantity === "" || quantity < 1) {
        alert("Số lượng sản phẩm phải từ 1 trở lên!");
        return false;
    }
    if (avatar === "") {
        alert("Vui lòng chọn ảnh cho sản phẩm!");
        return false;
    }
    return true;
}
</script>
