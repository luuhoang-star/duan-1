<div class="container-fluid mt-4">
    <h2 class="text-center text-primary mb-4">Danh sách sản phẩm</h2>
    
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form class="d-flex" method="POST" action="?act=search" style="max-width: 400px; width: 100%;">
            <div class="input-group">
                <input type="text" class="form-control" name="content" placeholder="Tìm kiếm sản phẩm..." value="<?= htmlspecialchars($_POST['content'] ?? '') ?>">
                <button class="btn btn-primary" name="search" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </form>
        <a href="index.php?act=add-product" class="btn btn-success">
            <i class="fa-solid fa-plus"></i> Thêm sản phẩm
        </a>
    </div>

    <div class="table-responsive bg-white rounded shadow-sm p-3">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th scope="col" style="width: 60px;">#</th>   
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col" style="width: 100px;">Ảnh</th>
                    <th scope="col">Danh mục</th>
                    <th scope="col">Giá</th>
                    <th scope="col" style="width: 90px;">Số lượng</th>
                    <th scope="col" style="width: 130px;" class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($list)): ?>
                    <?php foreach($list as $pro): 
                        $sua = "index.php?act=update-product&id_sp=" . $pro['id_sp'];
                        $xoa = "index.php?act=delete-product&id_sp=" . $pro['id_sp'];
                    ?>
                    <tr>
                        <td><strong>#<?=$pro['id_sp']?></strong></td>
                        <td><?=htmlspecialchars($pro['name_sp'])?></td>
                        <td>
                            <img src="../img/<?=$pro['image_sp']?>" alt="Ảnh sản phẩm" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                        </td>
                        <td><span class="badge bg-info text-dark"><?=$pro['name_dm'] ?? 'Chưa phân loại'?></span></td>
                        <td><strong class="text-danger"><?=number_format((int)$pro['price_sp'], 0, ",", ".")?>₫</strong></td>
                        <td><?=$pro['soluong']?></td>
                        <td class="text-center">
                            <a href="<?=$sua?>" class="btn btn-sm btn-warning me-1" title="Sửa">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <a href="<?=$xoa?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')" title="Xóa">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Không tìm thấy sản phẩm nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3" id="pagination">
        <?= $hien_thi_so_trang ?? '' ?>
    </div>
</div>
