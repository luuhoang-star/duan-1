# ⚽ 8 FOOTBALL STORE - WEBSITE BÁN GIÀY BÓNG ĐÁ CHÍNH HÃNG

Dự án website thương mại điện tử chuyên cung cấp giày bóng đá (sân cỏ nhân tạo, sân cỏ tự nhiên) và phụ kiện thể thao chính hãng. Mã nguồn được phát triển bằng **PHP thuần theo mô hình MVC**, tối ưu hóa bảo mật với **PDO Prepared Statements**, giao diện hiện đại sử dụng **Bootstrap 5**, FontAwesome và jQuery AJAX.

---

## 📌 MỤC LỤC
1. [Công nghệ sử dụng](#-công-nghệ-sử-dụng)
2. [Cấu trúc thư mục dự án](#-cấu-trúc-thư-mục-dự-án)
3. [Các tính năng chính](#-các-tính-năng-chính)
   - [Phân hệ Khách hàng (Client)](#1-phân-hệ-khách-hàng-client)
   - [Phân hệ Quản trị (Admin)](#2-phân-hệ-quản-trị-admin)
4. [Hướng dẫn cài đặt & Chạy dự án](#-hướng-dẫn-cài-đặt--chạy-dự-án)
5. [Cấu hình CSDL & Kết nối](#-cấu-hình-csdl--kết-nối)
6. [Các cải tiến & Tối ưu hóa (Refactor)](#-các-cải-tiến--tối-ưu-hóa-refactor)

---

## 🛠️ CÔNG NGHỆ SỬ DỤNG

- **Ngôn ngữ Backend**: PHP 8.x
- **Cơ sở dữ liệu**: MySQL / MariaDB (Kết nối an toàn qua PHP Data Objects - PDO)
- **Giao diện Frontend**: HTML5, CSS3, JavaScript ES6, Bootstrap 5.3, FontAwesome 6.5
- **Thư viện tương tác**: jQuery 3.7 (AJAX cập nhật giỏ hàng theo thời gian thực)
- **Cổng thanh toán**: Tích hợp thanh toán trực tuyến MoMo (QR Code & ATM Test Sandbox)
- **Biểu đồ thống kê**: Google Charts Bar

---

## 📂 CẤU TRÚC THƯ MỤC DỰ ÁN

```
duan-1/
├── index.php                 # Điều hướng root thông minh sang client/index.php
├── playmobile (4).sql        # Tệp cơ sở dữ liệu mẫu
├── README.md                 # Tài liệu hướng dẫn dự án
│
├── admin/                    # Phân hệ Quản trị viên (Admin)
│   ├── categories/           # Quản lý danh mục / nhãn hàng (add, list, update)
│   ├── comment/              # Quản lý bình luận & đánh giá (list)
│   ├── order/                # Quản lý đơn hàng & chi tiết (list, chitiet)
│   ├── products/             # Quản lý sản phẩm (add, list, update)
│   ├── thongke/              # Thống kê doanh thu & biểu đồ (list)
│   ├── user/                 # Quản lý tài khoản & phân quyền (list, edit)
│   ├── header.php            # Header & Sidebar admin (hỗ trợ Dark Mode)
│   ├── footer.php            # Footer admin & script tương tác
│   └── index.php             # Router trung tâm Admin & Dashboard tổng quan
│
├── client/                   # Phân hệ Khách hàng (Client)
│   ├── view/
│   │   ├── product/          # Giao diện danh sách & chi tiết sản phẩm
│   │   ├── thanhtoan/        # Module kết nối thanh toán MoMo (QR & ATM)
│   │   └── users/            # Lịch sử đơn hàng, Profile, Login, Register, Khách hàng
│   ├── cart.php              # Giao diện giỏ hàng
│   ├── checkout.php          # Giao diện xác nhận đặt hàng & chọn phương thức thanh toán
│   ├── thank.php             # Trang cảm ơn sau khi đặt hàng thành công
│   ├── xulysoluong.php       # API AJAX cập nhật số lượng giỏ hàng không cần load lại trang
│   ├── home.php              # Trang chủ Client (Banner, Sản phẩm nổi bật, Mới nhất)
│   ├── header.php            # Header Client (Tìm kiếm, Giỏ hàng động, Menu danh mục)
│   ├── footer.php            # Footer thông tin cửa hàng & chính sách
│   └── index.php             # Router trung tâm Client
│
├── model/                    # Tầng Dữ liệu & Business Logic (PDO Prepared Statements)
│   ├── pdo.php               # Kết nối CSDL & hàm thực thi SQL an toàn
│   ├── product.php           # Quản lý sản phẩm, lọc giá, mặt sân & phân trang dùng chung
│   ├── category.php          # Quản lý danh mục nhãn hàng
│   ├── bill.php              # Quản lý hóa đơn / đơn hàng & thống kê doanh thu
│   ├── cart.php              # Quản lý chi tiết sản phẩm trong đơn hàng
│   ├── binhluan.php          # Quản lý bình luận & đánh giá người dùng
│   ├── user.php              # Quản lý người dùng, đăng ký, đăng nhập & phân quyền
│   └── List.php              # Compatibility Bridge (nạp tự động các model)
│
├── public/                   # Tài nguyên CSS giao diện
│   ├── css.css
│   ├── header.css
│   ├── index.css
│   ├── profile.css
│   └── user.css
│
└── img/                      # Thư mục lưu trữ hình ảnh sản phẩm, banner & avatar
```

---

## ✨ CÁC TÍNH NĂNG CHÍNH

### 1. Phân hệ Khách hàng (Client)
- **Trang chủ**: Banner slider tự động, cam kết dịch vụ, danh sách sản phẩm nổi bật (bán chạy) và sản phẩm mới ra mắt.
- **Danh mục & Tìm kiếm**:
  - Tìm kiếm sản phẩm theo tên theo thời gian thực.
  - Lọc sản phẩm theo thương hiệu (Nike, Adidas, Puma, Mizuno, Joma, Kamito...).
  - Lọc sản phẩm theo loại mặt sân: Sân cỏ nhân tạo (Turf), Sân cỏ tự nhiên (Ag, Fg), Phụ kiện.
  - Sắp xếp giá tăng dần / giảm dần.
  - Phân trang chuẩn xác và linh hoạt.
- **Chi tiết sản phẩm**:
  - Xem ảnh phóng to, thông số, mô tả chi tiết (có nút mở rộng / thu gọn).
  - Lựa chọn kích cỡ giày (Size 40, 41, 42, 43, 44) và điều chỉnh số lượng.
  - Sản phẩm liên quan cùng danh mục.
  - Hệ thống bình luận, đánh giá dành cho thành viên đã đăng nhập.
- **Giỏ hàng & Đặt hàng**:
  - Thêm sản phẩm vào giỏ hàng (`Thêm vào giỏ` hoặc `Mua ngay`).
  - Cập nhật số lượng sản phẩm bằng **AJAX**, tự động tính lại tổng tiền tức thì.
  - Xóa sản phẩm khỏi giỏ hàng.
  - Trang xác nhận đơn hàng, tự động điền thông tin người nhận khi đăng nhập.
  - Hỗ trợ 3 phương thức thanh toán:
    1. **Thanh toán khi nhận hàng (COD)**.
    2. **Thanh toán qua mã QR MoMo**.
    3. **Thanh toán qua thẻ ATM MoMo**.
- **Quản lý tài khoản**:
  - Đăng ký, đăng nhập, đăng xuất tài khoản.
  - Cập nhật hồ sơ cá nhân (Họ tên, email, số điện thoại, giới tính, địa chỉ giao hàng, đổi ảnh đại diện avatar).
  - **Lịch sử đơn hàng (`my-order`)**: Xem danh sách các đơn hàng đã đặt, theo dõi trạng thái vận chuyển và thanh toán.
  - **Chi tiết đơn hàng (`view-bill`)**: Xem từng sản phẩm trong đơn, xác nhận đã nhận hàng hoặc hủy đơn hàng khi đơn chưa giao.

---

### 2. Phân hệ Quản trị (Admin)
- **Bảng điều khiển (Dashboard)**: Thống kê nhanh tổng sản phẩm, danh mục, đơn hàng, khách hàng, doanh thu thực tế và hiển thị danh sách các đơn hàng mới nhất.
- **Quản lý danh mục / nhãn hàng**: Xem danh sách, thêm danh mục mới, chỉnh sửa và xóa danh mục.
- **Quản lý sản phẩm**:
  - Xem danh sách sản phẩm (có phân trang và tìm kiếm nhanh).
  - Thêm sản phẩm mới (chọn danh mục, loại mặt sân, tải ảnh đại diện, giá, số lượng kho, mô tả).
  - Cập nhật thông tin sản phẩm và thay đổi ảnh.
  - Xóa sản phẩm.
- **Quản lý đơn hàng**:
  - Xem danh sách đơn hàng kèm trạng thái vận chuyển (Chờ xác nhận, Đã xác nhận, Đang chuẩn bị, Đang giao, Đã nhận hàng, Đã hủy) và trạng thái thanh toán.
  - Xem chi tiết đơn hàng (thông tin người nhận, danh sách sản phẩm, số lượng, size, thành tiền).
  - Cập nhật trạng thái đơn hàng.
- **Quản lý bình luận**: Xem danh sách bình luận của khách hàng trên các sản phẩm, xóa bình luận vi phạm.
- **Quản lý tài khoản**: Xem danh sách người dùng, cập nhật phân quyền (Admin / Client), xóa tài khoản.
- **Thống kê doanh thu**: Biểu đồ cột (Google Charts) thống kê doanh thu theo từng ngày và thẻ tổng hợp doanh số thực tế.
- **Giao diện**: Hỗ trợ chế độ Dark Mode và thu gọn Sidebar tiện lợi.

---

## 🚀 HƯỚNG DẪN CÀI ĐẶT & CHẠY DỰ ÁN

### Yêu cầu môi trường
- PHP >= 7.4 (Khuyến nghị **PHP 8.1 - 8.4**)
- MySQL / MariaDB >= 5.7
- Web server: Laravel Herd, XAMPP, WampServer, Laragon hoặc Apache/Nginx

### Các bước cài đặt
1. **Clone repository về máy**:
   ```bash
   git clone https://github.com/luuhoang-star/duan-1.git
   ```
2. **Import cơ sở dữ liệu**:
   - Mở phpMyAdmin hoặc công cụ quản lý MySQL (HeidiSQL, DBeaver, Navicat...).
   - Tạo một database mới có tên: `playmobile` (Bảng mã `utf8mb4_general_ci`).
   - Import tệp `playmobile (4).sql` có sẵn trong thư mục gốc của dự án vào database vừa tạo.
3. **Cấu hình kết nối cơ sở dữ liệu**:
   - Mở tệp `model/pdo.php`.
   - Kiểm tra và chỉnh sửa thông số kết nối nếu cấu hình local của bạn khác mặc định:
     ```php
     $dburl = "mysql:host=localhost;dbname=playmobile;charset=utf8mb4";
     $username = 'root';
     $password = '123456'; // Điền mật khẩu MySQL của bạn (nếu dùng XAMPP thì để trống '')
     ```
4. **Khởi chạy ứng dụng**:
   - Truy cập vào website qua trình duyệt:
     - Giao diện Khách hàng: `http://localhost/duan-1/` hoặc `http://duanmau-fixbug.test/`
     - Giao diện Quản trị: `http://localhost/duan-1/admin/` hoặc `http://duanmau-fixbug.test/admin/`

---

## 🔒 BẢO MẬT VÀ TỐI ƯU HÓA (REFACTOR)

- **Chống SQL Injection**: 100% các câu truy vấn cơ sở dữ liệu trong toàn bộ thư mục `model/` đã được tham số hóa thông qua cơ chế **PDO Prepared Statements** (`?` parameter binding).
- **Nguyên lý DRY (Don't Repeat Yourself)**:
  - Hợp nhất 9 hàm phân trang rải rác thành 1 hàm duy nhất `render_pagination()`.
  - Tối ưu hóa helper giỏ hàng `add_item_to_cart()` dùng chung.
  - Hợp nhất logic gọi API MoMo vào `helpper_momo.php`.
- **Tối ưu hiệu năng**: Loại bỏ tình trạng quét toàn bộ bảng trong PHP ở trang chi tiết đơn hàng và lịch sử đơn hàng, chuyển sang truy vấn trực tiếp theo ID.
- **Sạch sẽ & Gọn gàng**: Đã xóa bỏ toàn bộ các tệp HTML tĩnh cũ, tệp rác không sử dụng và các thẻ include thừa.

---

## 👥 TÁC GIẢ & THÔNG TIN DỰ ÁN

- **Dự án**: Dự án 1 - Xây dựng Website Thương mại điện tử
- **Chủ đề**: 8 Football Store - Giày đá bóng & phụ kiện thể thao chính hãng
- **Bản quyền**: © 8 Football Store. Tất cả các quyền được bảo lưu.
