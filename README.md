# ⚽ 8 Football Store - Dự Án 1

Website bán giày bóng đá và phụ kiện thể thao chính hãng, xây dựng bằng **PHP (Mô hình MVC)**, **MySQL (PDO Prepared Statements)** và **Bootstrap 5**.

---

## 🛠️ Công Nghệ Sử Dụng

- **Backend**: PHP 8.x, MySQL (PDO Prepared Statements chống SQL Injection).
- **Frontend**: HTML5, CSS3, JavaScript ES6, Bootstrap 5.3, FontAwesome 6.5, jQuery AJAX.
- **Thanh toán**: COD, Cổng MoMo (QR Code & Thẻ ATM Sandbox).

---

## 📂 Cấu Trúc Thư Mục

```
duan-1/
├── index.php                 # Điều hướng vào client/index.php
├── playmobile (4).sql        # Cơ sở dữ liệu mẫu
├── admin/                    # Quản trị (Dashboard, Danh mục, Sản phẩm, Đơn hàng, Bình luận, User, Thống kê)
├── client/                   # Khách hàng (Trang chủ, Sản phẩm, Chi tiết, Giỏ hàng, Thanh toán, Đơn hàng)
├── model/                    # Xử lý CSDL (pdo.php, product.php, category.php, bill.php, cart.php, user.php, ...)
├── public/                   # CSS giao diện
└── img/                      # Hình ảnh sản phẩm, banner & avatar
```

---

## ✨ Tính Năng Chính

### 1. Phân hệ Khách hàng (Client)
- **Sản phẩm**: Xem danh sách, tìm kiếm, lọc theo thương hiệu / mặt sân (cỏ tự nhiên, cỏ nhân tạo, phụ kiện), sắp xếp giá tăng / giảm, phân trang.
- **Chi tiết sản phẩm**: Chọn kích cỡ (Size 40 - 44), tăng giảm số lượng, xem sản phẩm liên quan, gửi bình luận & đánh giá.
- **Giỏ hàng & Đặt hàng**: Thêm giỏ hàng / Mua ngay, cập nhật số lượng qua **AJAX**, thanh toán qua **COD**, **QR MoMo** hoặc **ATM MoMo**.
- **Tài khoản**: Đăng ký, đăng nhập, đổi thông tin cá nhân, xem lịch sử đơn hàng, xem chi tiết & trạng thái vận chuyển, hủy hoặc xác nhận nhận hàng.

### 2. Phân hệ Quản trị (Admin)
- **Dashboard**: Thống kê nhanh tổng sản phẩm, danh mục, đơn hàng, người dùng, doanh thu thực tế và 5 đơn hàng mới nhất.
- **Quản lý Danh mục & Sản phẩm**: Thêm, sửa, xóa, tải ảnh, phân loại mặt sân và quản lý tồn kho.
- **Quản lý Đơn hàng**: Xem chi tiết đơn, cập nhật trạng thái đơn (Chờ duyệt, Chuẩn bị, Đang giao, Đã nhận, Đã hủy) và trạng thái thanh toán.
- **Quản lý Người dùng & Bình luận**: Phân quyền tài khoản (Admin / Client), xóa tài khoản, duyệt / xóa bình luận.
- **Thống kê**: Biểu đồ doanh thu theo ngày bằng Google Charts.

---

## 🚀 Hướng Dẫn Cài Đặt Nhanh

1. **Clone repository**:
   ```bash
   git clone https://github.com/luuhoang-star/duan-1.git
   ```

2. **Tạo CSDL & Import dữ liệu**:
   - Tạo database `playmobile` trong phpMyAdmin / MySQL.
   - Import tệp `playmobile (4).sql` vào database `playmobile`.

3. **Cấu hình kết nối CSDL**:
   - Mở tệp `model/pdo.php` và chỉnh sửa cấu hình kết nối nếu cần:
     ```php
     $dburl = "mysql:host=localhost;dbname=playmobile;charset=utf8mb4";
     $username = 'root';
     $password = ''; // Hoặc mật khẩu MySQL của bạn
     ```

4. **Truy cập website**:
   - **Giao diện Khách hàng**: `http://localhost/duan-1/`
   - **Giao diện Quản trị**: `http://localhost/duan-1/admin/`
