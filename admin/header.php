<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSS -->
    <link rel="stylesheet" href="../public/index.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <title>Hệ Thống Quản Trị - SIÊU THỊ TRỰC TUYẾN</title>
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
               <a href="index.php" style="text-decoration: none;"> 
                   <img src="https://theme.hstatic.net/200000278317/1000929405/14/logo_medium.png?v=1170" alt="Logo" width="150px"> 
                   <span class="logo_name">8 Football</span>
               </a>
            </div>
        </div>

        <div class="menu-items">
            <ul class="nav-links m-0 p-0">
                <li><a href="index.php">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Bảng điều khiển</span>
                </a></li>
                <li><a href="?act=list-categories">
                    <i class="uil uil-align-left"></i>
                    <span class="link-name">Danh mục</span>
                </a></li>
                <li><a href="?act=list-products">
                    <i class="uil uil-book-alt"></i>
                    <span class="link-name">Sản phẩm</span>
                </a></li>
                <li><a href="?act=list-carts">
                    <i class="uil uil-shopping-bag"></i>
                    <span class="link-name">Đơn hàng</span>
                </a></li>
                <li><a href="?act=comments">
                    <i class="uil uil-comment-alt-dots"></i>
                    <span class="link-name">Bình luận</span>
                </a></li>
                <li><a href="?act=list-users">
                    <i class="uil uil-users-alt"></i>
                    <span class="link-name">Tài khoản</span>
                </a></li>
                <li><a href="?act=thong-ke">
                    <i class="uil uil-chart-bar"></i>
                    <span class="link-name">Thống kê</span>
                </a></li>
            </ul>
            
            <ul class="logout-mode m-0 p-0">
                <li><a href="../client/index.php">
                    <i class="uil uil-store"></i>
                    <span class="link-name">Xem Cửa Hàng</span>
                </a></li>
                <li class="mode">
                    <a href="#">
                        <i class="uil uil-moon"></i>
                        <span class="link-name">Dark Mode</span>
                    </a>
                    <div class="mode-toggle">
                        <span class="switch"></span>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
            <div class="d-flex align-items-center gap-3">
                <a href="../client/index.php" class="btn btn-sm btn-outline-primary" target="_blank">
                    <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Trang chủ Khách hàng
                </a>
            </div>
        </div>
        <div class="dash-content">