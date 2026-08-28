<div class="container-fluid mt-4">
    <h2 class="text-center text-primary mb-4">Danh sách bình luận & đánh giá</h2>
    
    <div class="table-responsive bg-white rounded shadow-sm p-3">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th scope="col" style="width: 60px;">#</th>   
                    <th scope="col" style="width: 180px;">Người bình luận</th>
                    <th scope="col" style="width: 160px;">Thời gian</th>
                    <th scope="col">Nội dung</th>
                    <th scope="col" style="width: 250px;">Sản phẩm</th>
                    <th scope="col" style="width: 90px;" class="text-center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($comment)): ?>
                    <?php foreach($comment as $cmt): ?>
                    <tr>
                        <td><strong>#<?=$cmt['id_cmt']?></strong></td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="../img/<?=$cmt['avatar'] ?? 'user.png'?>" alt="Avatar" class="rounded-circle" style="width: 35px; height: 35px; object-fit: cover;">
                                <span><?=htmlspecialchars($cmt['name_user'])?></span>
                            </div>
                        </td>
                        <td><small class="text-muted"><?=date('d/m/Y H:i', strtotime($cmt['time']))?></small></td>
                        <td><?=htmlspecialchars($cmt['content_cmt'])?></td>
                        <td><span class="badge bg-light text-dark border"><?=htmlspecialchars($cmt['name_sp'] ?? 'Sản phẩm #' . $cmt['id_sp'])?></span></td>
                        <td class="text-center">
                            <a href="?act=delete-cmt&id_cmt=<?=$cmt['id_cmt']?>" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa bình luận này?')" title="Xóa bình luận">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Chưa có bình luận nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
