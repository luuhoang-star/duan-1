<?php
$user_data = is_array($User) && isset($User[0]) ? $User[0] : (is_array($User) ? $User : []);
$id_user = $user_data['id_user'] ?? ($_GET['id_user'] ?? 0);
$name_user = $user_data['name_user'] ?? '';
$gender = $user_data['gender'] ?? 'Chưa cập nhật';
$avatar = $user_data['avatar'] ?? 'user.png';
$email = $user_data['email'] ?? '';
$sdt = $user_data['sdt'] ?? 'Chưa cập nhật';
$diachi = $user_data['diachi'] ?? 'Chưa cập nhật';
$role = $user_data['role'] ?? 'Client';
?>

<div class="container-fluid mt-4">
    <h2 class="text-center text-primary mb-4">Cập nhật quyền tài khoản #<?=$id_user?></h2>
    
    <div class="row justify-content-center">
        <div class="col-md-7">
            <form class="d-flex flex-column gap-3 shadow-sm p-4 bg-white rounded" action="index.php?act=update_user&id_user=<?=$id_user?>" method="POST">
                <div class="text-center mb-3">
                    <img src="../img/<?=$avatar?>" alt="Avatar" class="rounded-circle img-thumbnail" style="width: 90px; height: 90px; object-fit: cover;">
                </div>

                <div class="form-group">
                    <label class="form-label fw-bold">Tên tài khoản</label>
                    <input type="text" class="form-control" disabled value="<?=htmlspecialchars($name_user)?>">
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" class="form-control" disabled value="<?=htmlspecialchars($email)?>">
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="form-label fw-bold">Số điện thoại</label>
                        <input type="text" class="form-control" disabled value="<?=htmlspecialchars($sdt)?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label class="form-label fw-bold">Giới tính</label>
                        <input type="text" class="form-control" disabled value="<?=htmlspecialchars($gender)?>">
                    </div>
                    <div class="col-md-6 form-group">
                        <label class="form-label fw-bold">Địa chỉ</label>
                        <input type="text" class="form-control" disabled value="<?=htmlspecialchars($diachi)?>">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label fw-bold text-danger">Vai trò / Quyền hạn hệ thống</label>
                    <select name="role" class="form-select" required>
                        <option value="Client" <?= $role === 'Client' ? 'selected' : '' ?>>Client (Khách hàng)</option>
                        <option value="Admin" <?= $role === 'Admin' ? 'selected' : '' ?>>Admin (Quản trị viên)</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <button type="submit" class="btn btn-primary px-4" name="update-user">
                        <i class="fa-solid fa-check"></i> Lưu thay đổi
                    </button>
                    <a href="index.php?act=list-users" class="btn btn-secondary px-4">Quay lại danh sách</a>
                </div>
            </form>
        </div>
    </div>
</div>