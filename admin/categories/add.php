<div class="container-fluid mt-4">
    <h2 class="text-center text-primary mb-4">Thêm nhãn hàng / Danh mục mới</h2>
    
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form class="d-flex flex-column gap-3 shadow-sm p-4 bg-white rounded" id="add-category" action="index.php?act=add-category" method="POST">
                <div class="form-group">
                    <label class="form-label fw-bold">Tên nhãn hàng / Danh mục</label>
                    <input type="text" class="form-control" placeholder="Nhập tên nhãn hàng (VD: Nike, Adidas...)" required id="category_name" name="category_name">
                </div>

                <div class="d-flex justify-content-between mt-3">
                    <button type="submit" class="btn btn-primary px-4" name="add_category">
                        <i class="fa-solid fa-plus"></i> Thêm mới
                    </button>
                    <a href="index.php?act=list-categories" class="btn btn-secondary px-4">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
</div>