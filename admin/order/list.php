<div class="container-fluid mt-4">
    <h2 class="text-center text-primary mb-4">Danh sách đơn hàng</h2>
    
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form class="d-flex" method="POST" action="?act=search-order" style="max-width: 400px; width: 100%;">
            <div class="input-group">
                <input type="text" class="form-control" name="content" placeholder="Nhập mã đơn hàng..." value="<?= htmlspecialchars($_POST['content'] ?? '') ?>">
                <button class="btn btn-primary" name="search" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i> Tìm
                </button>
            </div>
        </form>
        <a href="index.php?act=list-carts" class="btn btn-outline-secondary">
            <i class="fa-solid fa-arrows-rotate"></i> Xem tất cả
        </a>
    </div>

    <div class="table-responsive bg-white rounded shadow-sm p-3">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th scope="col" style="width: 80px;">Mã đơn</th>   
                    <th scope="col">Khách hàng</th>
                    <th scope="col">Ngày đặt</th>
                    <th scope="col">Tổng tiền</th>
                    <th scope="col">Trạng thái đơn</th>
                    <th scope="col">Thanh toán</th>
                    <th scope="col" style="width: 100px;" class="text-center">Chi tiết</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($bill)): ?>
                    <?php foreach($bill as $bi): 
                        extract($bi);
                    ?>
                    <tr>
                        <td><strong>#<?=$id_bill?></strong></td>
                        <td>
                            <div class="fw-bold"><?=htmlspecialchars($name_user)?></div>
                            <small class="text-muted"><?=htmlspecialchars($sdt ?? '')?></small>
                        </td>
                        <td><?=date('d/m/Y', strtotime($ngaydat))?></td>
                        <td><strong class="text-danger"><?=number_format((int)$tongbill, 0, ",", ".")?>₫</strong></td>
                        <td>
                            <?php
                            switch ($trangthai) {
                                case 0: echo '<span class="badge bg-warning text-dark">Chờ xác nhận</span>'; break;
                                case 1: echo '<span class="badge bg-info text-dark">Đã xác nhận</span>'; break;
                                case 2: echo '<span class="badge bg-primary">Đang chuẩn bị</span>'; break;
                                case 3: echo '<span class="badge bg-primary">Đang giao hàng</span>'; break;
                                case 4: echo '<span class="badge bg-success">Đã nhận hàng</span>'; break;
                                case 5: echo '<span class="badge bg-danger">Đã hủy</span>'; break;
                                default: echo '<span class="badge bg-secondary">Không xác định</span>'; break;
                            }
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($trangthaitt == 1 || $trangthai == 4) {
                                echo '<span class="badge bg-success">Đã thanh toán</span>';
                            } else {
                                echo '<span class="badge bg-danger">Chưa thanh toán</span>';
                            }
                            ?>
                        </td>
                        <td class="text-center">
                            <a href="?act=view-bill-admin&id_bill=<?=$id_bill?>" class="btn btn-sm btn-info text-white" title="Xem chi tiết">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Không tìm thấy đơn hàng nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3" id="pagination">
        <?= (!isset($_POST['search']) && isset($hien_thi_so_trang)) ? $hien_thi_so_trang : '' ?>
    </div>
</div>
