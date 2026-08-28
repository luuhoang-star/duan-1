<?php
$cat_name = is_array($info) && isset($info[0]) ? $info[0]['name_dm'] : ($info['name_dm'] ?? '');
$cat_id = is_array($info) && isset($info[0]) ? $info[0]['id_dm'] : ($info['id_dm'] ?? ($id_dm ?? ''));
?>

<div class="container-fluid mt-4">
    <h2 class="text-center text-primary mb-4">Cập nhật nhãn hàng / Danh mục</h2>
    
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form class="d-flex flex-column gap-3 shadow-sm p-4 bg-white rounded" id="update-category" action="index.php?act=update-category" method="POST">
                <input type="hidden" name="id_dm" id="id_dm" value="<?=$cat_id?>">
                
                <div class="form-group">
                    <label class="form-label fw-bold">Tên nhãn hàng / Danh mục</label>
                    <input type="text" class="form-control" placeholder="Nhập tên nhãn hàng" required id="category_name" name="category_name" value="<?=htmlspecialchars($cat_name)?>">
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <button type="submit" class="btn btn-primary px-4" name="update_category">
                        <i class="fa-solid fa-check"></i> Cập nhật
                    </button>
                    <a href="index.php?act=list-categories" class="btn btn-secondary px-4">Hủy bỏ</a>
                </div>
            </form>
        </div>
    </div>
</div>