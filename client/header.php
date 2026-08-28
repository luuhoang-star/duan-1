<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIÊU THỊ TRỰC TUYẾN - Mua Sắm Đồ Thể Thao Chính Hãng</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../public/header.css">
    <link rel="stylesheet" href="../public/css.css">
    <link rel="stylesheet" href="../public/profile.css">
    <link rel="stylesheet" href="../public/user.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }
        .user-profile {
            position: relative;
            cursor: pointer;
        }
        .user-profile .submenu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            border-radius: 6px;
            min-width: 190px;
            z-index: 1000;
            padding: 8px 0;
        }
        .user-profile:hover .submenu {
            display: block;
        }
        .user-profile .submenu ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .user-profile .submenu ul li a {
            display: block;
            padding: 8px 16px;
            color: #333;
            text-decoration: none;
            font-size: 14px;
        }
        .user-profile .submenu ul li a:hover {
            background-color: #f1f1f1;
            color: #0d6efd;
        }
    </style>
</head>
<body>
    <header class="bg-white shadow-sm sticky-top">
        <div class="container py-2">
            <div class="d-flex align-items-center justify-content-between">
                <!-- Logo -->
                <a class="navbar-brand py-1" href="index.php">
                    <img src="https://theme.hstatic.net/200000278317/1000929405/14/logo_medium.png?v=1170" alt="Logo" width="140">
                </a>

                <!-- Thanh tìm kiếm -->
                <div class="flex-grow-1 mx-4" style="max-width: 600px;">
                    <form class="d-flex" role="search" method="POST" action="?act=search">
                        <div class="input-group">
                            <input class="form-control border-end-0 rounded-start" type="search" name="content" placeholder="Bạn đang tìm kiếm sản phẩm gì?..." aria-label="Search" value="<?= htmlspecialchars($_POST['content'] ?? '') ?>" required>
                            <button class="btn btn-outline-primary border-start-0 rounded-end" name="search" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Giỏ hàng & Tài khoản -->
                <div class="d-flex align-items-center gap-3">
                    <!-- Giỏ hàng -->
                    <a href="?act=cart" class="btn btn-light position-relative p-2 rounded-circle" title="Giỏ hàng">
                        <i class="fa-solid fa-bag-shopping fa-xl text-dark"></i>
                        <?php 
                        $cart_count = !empty($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
                        ?>
                        <span class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle">
                            <?= $cart_count ?>
                        </span>
                    </a>

                    <!-- Tài khoản -->
                    <div id="login">
                        <?php if (isset($_SESSION['user'])): ?>
                            <div class="user-profile d-flex align-items-center gap-2">
                                <img src="../img/<?= htmlspecialchars($_SESSION['user']['avatar'] ?? 'user.png') ?>" alt="Avatar" class="rounded-circle" style="width: 36px; height: 36px; object-fit: cover;">
                                <span class="fw-bold text-dark d-none d-md-inline"><?= htmlspecialchars($_SESSION['user']['name_user']) ?></span>
                                <i class="fa-solid fa-caret-down text-muted small"></i>
                                <div class="submenu">
                                    <ul>
                                        <?php if (($_SESSION['user']['role'] ?? '') === 'Admin'): ?>
                                            <li><a href="../admin/index.php" class="fw-bold text-primary"><i class="fa-solid fa-gauge me-2"></i>Trang quản trị (Admin)</a></li>
                                        <?php endif; ?>
                                        <li><a href="index.php?act=profile"><i class="fa-solid fa-user me-2"></i>Trang cá nhân</a></li>
                                        <li><a href="index.php?act=my-order"><i class="fa-solid fa-box-open me-2"></i>Đơn hàng của tôi</a></li>
                                        <li><hr class="dropdown-divider my-1"></li>
                                        <li><a href="index.php?act=logout" class="text-danger"><i class="fa-solid fa-right-from-bracket me-2"></i>Đăng xuất</a></li>
                                    </ul>
                                </div>
                            </div>
                        <?php else: ?>
                            <a href="index.php?act=login" class="btn btn-outline-primary btn-sm px-3 rounded-pill">
                                <i class="fa-solid fa-user me-1"></i> Đăng nhập
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thanh menu điều hướng -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-1">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link <?= (!isset($_GET['act']) || $_GET['act'] == 'home') ? 'active' : '' ?>" href="index.php">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (($_GET['act'] ?? '') == 'all-product') ? 'active' : '' ?>" href="index.php?act=all-product">Tất cả sản phẩm</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (($_GET['act'] ?? '') == 'loai' && ($_GET['matsan'] ?? '') == '2') ? 'active' : '' ?>" href="index.php?act=loai&matsan=2">Giày cỏ tự nhiên</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (($_GET['act'] ?? '') == 'loai' && ($_GET['matsan'] ?? '') == '1') ? 'active' : '' ?>" href="index.php?act=loai&matsan=1">Giày cỏ nhân tạo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (($_GET['act'] ?? '') == 'loai' && ($_GET['matsan'] ?? '') == '3') ? 'active' : '' ?>" href="index.php?act=loai&matsan=3">Phụ kiện</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Hãng sản xuất
                            </a>
                            <ul class="dropdown-menu">
                                <?php
                                $categories = loadAll();
                                foreach($categories as $cat): ?>
                                    <li><a class="dropdown-item" href="?act=search-by-id&id_dm=<?=$cat['id_dm']?>"><?=htmlspecialchars($cat['name_dm'])?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= (($_GET['act'] ?? '') == 'khach-hang') ? 'active' : '' ?>" href="index.php?act=khach-hang">Khách hàng</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>