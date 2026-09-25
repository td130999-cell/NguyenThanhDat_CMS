<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- ========================================================
     KHỐI HEADER (1) THEO SƠ ĐỒ WIREFRAME
     ======================================================== -->
<header class="site-header">
    <div class="site-container">
        <div class="header-inner">
            <!-- Brand / Logo -->
            <div class="header-brand">
                <h1>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <?php bloginfo( 'name' ); ?>
                    </a>
                </h1>
                <span class="brand-tagline">Hệ thống Quản lý Bất Động Sản & Tin tức</span>
            </div>

            <!-- Menu điều hướng chính -->
            <nav class="header-nav">
                <ul>
                    <li class="<?php echo is_front_page() ? 'active' : ''; ?>">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Trang chủ</a>
                    </li>
                    <li class="<?php echo is_search() || is_archive() ? 'active' : ''; ?>">
                        <a href="<?php echo esc_url( home_url( '/?s=' ) ); ?>">Danh sách (Tìm kiếm)</a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( home_url( '/#widget-test-4' ) ); ?>">Dự án mở bán</a>
                    </li>
                </ul>
            </nav>

            <!-- Ô tìm kiếm nhanh ở Header -->
            <div class="header-search">
                <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="search" name="s" placeholder="Tìm kiếm tin tức, dự án..." value="<?php echo get_search_query(); ?>">
                    <button type="submit">Tìm</button>
                </form>
            </div>
        </div>
    </div>
</header>
