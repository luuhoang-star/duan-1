<div class="container-fluid mt-4">
    <h2 class="text-center text-primary mb-4">Danh sách tài khoản người dùng</h2>
    
    <div class="table-responsive bg-white rounded shadow-sm p-3">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th scope="col" style="width: 60px;">#</th>   
                    <th scope="col">Họ và tên</th>
                    <th scope="col">Email</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Vai trò</th>
                    <th scope="col" style="width: 120px;" class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($result)): ?>
                    <?php foreach ($result as $us): ?>
                    <tr>
                        <td><strong>#<?=$us['id_user']?></strong></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="../img/<?=$us['avatar'] ?? 'user.png'?>" alt="Avatar" class="rounded-circle" style="width: 35px; height: 35px; object-fit: cover;">
                                <span class="fw-bold"><?=htmlspecialchars($us['name_user'])?></span>
                            </div>
                        </td>
                        <td><?=htmlspecialchars($us['email'])?></td>
                        <td><?=htmlspecialchars($us['sdt'] ?? 'Chưa cập nhật')?></td>
                        <td>
                            <?php if ($us['role'] === 'Admin'): ?>
                                <span class="badge bg-danger">Admin</span>
                            <?php else: ?>
                                <span class="badge bg-primary">Client</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <a href="?act=edit-user&id_user=<?=$us['id_user']?>" class="btn btn-sm btn-info text-white me-1" title="Phân quyền / Chi tiết">
                                <i class="fa-solid fa-user-pen"></i>
                            </a>
                            <?php if ($us['role'] === 'Client'): ?>
                                <a href="?act=delete-user&id_user=<?=$us['id_user']?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?')" title="Xóa người dùng">
                                    <i class="fa-solid fa-user-xmark"></i>
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Chưa có tài khoản nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>