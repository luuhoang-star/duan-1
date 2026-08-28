<?php
if (empty($_SESSION['user'])) {
    header('Location: ?act=login');
    exit();
}

$user = $_SESSION['user'];
$avatar = !empty($user['avatar']) ? $user['avatar'] : 'user.png';
?>

<div class="container my-5">
    <div class="row g-4">
        <!-- Sidebar tài khoản -->
        <div class="col-lg-4">
            <div class="card shadow-sm border-0 text-center p-4 bg-white rounded-3">
                <div class="mb-3">
                    <img src="../img/<?=$avatar?>" alt="Avatar" class="rounded-circle img-thumbnail" style="width: 120px; height: 120px; object-fit: cover;">
                </div>
                <h5 class="fw-bold mb-1"><?=htmlspecialchars($user['name_user'])?></h5>
                <p class="text-muted small mb-3"><?=htmlspecialchars($user['email'])?></p>
                <span class="badge bg-primary w-50 mx-auto mb-3"><?=$user['role'] ?? 'Client'?></span>
                
                <div class="list-group list-group-flush text-start border-top pt-2">
                    <a href="?act=profile" class="list-group-item list-group-item-action active fw-bold">
                        <i class="fa-solid fa-user me-2"></i>Thông tin cá nhân
                    </a>
                    <a href="?act=my-order" class="list-group-item list-group-item-action">
                        <i class="fa-solid fa-box-open me-2"></i>Đơn hàng của tôi
                    </a>
                    <a href="?act=cart" class="list-group-item list-group-item-action">
                        <i class="fa-solid fa-cart-shopping me-2"></i>Giỏ hàng
                    </a>
                    <a href="?act=logout" class="list-group-item list-group-item-action text-danger">
                        <i class="fa-solid fa-right-from-bracket me-2"></i>Đăng xuất
                    </a>
                </div>
            </div>
        </div>

        <!-- Form cập nhật thông tin -->
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 p-4 bg-white rounded-3">
                <h4 class="fw-bold text-primary mb-4"><i class="fa-solid fa-user-pen me-2"></i>Cập nhật thông tin cá nhân</h4>
                
                <form action="?act=update-profile" method="POST" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Họ và tên <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name_user" value="<?=htmlspecialchars($user['name_user'])?>" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" value="<?=htmlspecialchars($user['email'])?>" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Số điện thoại</label>
                            <input type="text" class="form-control" name="sdt" value="<?=htmlspecialchars($user['sdt'] ?? '')?>" placeholder="0339381785">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-bold">Giới tính</label>
                            <select name="gender" class="form-select">
                                <option value="">-- Chọn giới tính --</option>
                                <option value="Nam" <?= (($user['gender'] ?? '') === 'Nam') ? 'selected' : '' ?>>Nam</option>
                                <option value="Nữ" <?= (($user['gender'] ?? '') === 'Nữ') ? 'selected' : '' ?>>Nữ</option>
                                <option value="Khác" <?= (($user['gender'] ?? '') === 'Khác') ? 'selected' : '' ?>>Khác</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">Địa chỉ giao hàng mặc định</label>
                            <textarea class="form-control" name="diachi" rows="2" placeholder="Nhập địa chỉ của bạn"><?=htmlspecialchars($user['diachi'] ?? '')?></textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-bold">Ảnh đại diện mới</label>
                            <input type="file" class="form-control" name="avatar" accept="image/*">
                            <small class="text-muted">Chấp nhận định dạng: JPG, PNG, GIF. Để trống nếu không muốn đổi.</small>
                        </div>

                        <div class="col-12 mt-4 text-end">
                            <button type="submit" name="btn-save" class="btn btn-primary px-4 py-2 fw-bold">
                                <i class="fa-solid fa-floppy-disk me-1"></i> Lưu thay đổi
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>