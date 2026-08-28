<?php
$listCat = loadAll();
?>

<div class="container-fluid mt-4">
    <h2 class="text-center text-primary mb-4">Danh sách nhãn hàng / Danh mục</h2>
    
    <div class="d-flex justify-content-end mb-3">
        <a href="index.php?act=add-category" class="btn btn-success">
            <i class="fa-solid fa-plus"></i> Thêm nhãn hàng mới
        </a>
    </div>

    <div class="table-responsive bg-white rounded shadow-sm p-3">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th scope="col" style="width: 80px;">#</th>   
                    <th scope="col">Tên nhãn hàng / Danh mục</th>
                    <th scope="col" style="width: 250px;" class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($listCat)): ?>
                    <?php foreach($listCat as $cat): 
                        $suacate = "index.php?act=update-category&id_dm=" . $cat['id_dm'];
                        $xoacate = "index.php?act=delete-category&id_dm=" . $cat['id_dm'];
                    ?>
                    <tr>
                        <td><strong>#<?=$cat['id_dm']?></strong></td>
                        <td><span class="fw-bold text-dark"><?=htmlspecialchars($cat['name_dm'])?></span></td>
                        <td class="text-center">
                            <a href="<?=$suacate?>" class="btn btn-sm btn-warning me-1" title="Sửa danh mục">
                                <i class="fa-solid fa-pen"></i> Sửa
                            </a>
                            <a href="<?=$xoacate?>" class="btn btn-sm btn-danger me-1" onclick="return confirm('Những sản phẩm thuộc danh mục này cũng có thể bị ảnh hưởng. Bạn có chắc chắn muốn xóa?')" title="Xóa danh mục">
                                <i class="fa-solid fa-trash"></i> Xóa
                            </a>
                            <a href="index.php?act=add-product&id_dm=<?=$cat['id_dm']?>" class="btn btn-sm btn-primary" title="Thêm sản phẩm vào danh mục này">
                                <i class="fa-solid fa-plus"></i> SP
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center text-muted py-4">Chưa có danh mục nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>