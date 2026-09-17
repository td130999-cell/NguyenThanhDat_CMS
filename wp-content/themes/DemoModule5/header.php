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
     HEADER / THANH NAVBAR BẮT ĐẦU TẠI ĐÂY
     ======================================================== -->
<header class="site-header">
    <div class="site-container">
        <nav class="custom-navbar">
            <!-- Khối bên trái: Tên nhóm, Tab Home, Ô tìm kiếm -->
            <div class="navbar-left">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-brand">Group C</a>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-tab active">Home</a>
                
                <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="navbar-search">
                    <input type="search" name="s" placeholder="Search" value="<?php echo get_search_query(); ?>" aria-label="Search">
                    <button type="submit">Submit</button>
                </form>
            </div>

            <!-- Khối bên phải: Danh mục & Các nút tác vụ -->
            <div class="navbar-right">
                <div class="navbar-nav-links">
                    <a href="<?php echo esc_url( home_url( '/?s=Thể+thao' ) ); ?>" class="navbar-link">Thể thao</a>
                    <a href="<?php echo esc_url( home_url( '/?s=Khoa+học' ) ); ?>" class="navbar-link">Khoa học</a>
                    <a href="<?php echo esc_url( home_url( '/?s=Tin+tức' ) ); ?>" class="navbar-link">Tin tức</a>
                </div>

                <div class="navbar-actions">
                    <!-- Nút Menu -->
                    <a href="#" class="navbar-action-item" title="Menu">
                        <svg class="action-icon" width="20" height="16" viewBox="0 0 24 10" fill="#333333">
                            <circle cx="4" cy="5" r="2.5"/>
                            <circle cx="12" cy="5" r="2.5"/>
                            <circle cx="20" cy="5" r="2.5"/>
                        </svg>
                        <span class="action-text">Menu</span>
                    </a>

                    <!-- Nút Search -->
                    <a href="#" class="navbar-action-item" title="Search">
                        <svg class="action-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#333333" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="7"></circle>
                            <line x1="21" y1="21" x2="16" y2="16"></line>
                        </svg>
                        <span class="action-text">Search</span>
                    </a>

                    <!-- Nút Account -->
                    <a href="#" class="navbar-action-item" title="Account">
                        <svg class="action-icon" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#555555" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M6.5 18.5a6 6 0 0 1 11 0" fill="#555555"></path>
                            <circle cx="12" cy="9.5" r="3" fill="#555555"></circle>
                        </svg>
                        <span class="action-text">Account &#9662;</span>
                    </a>
                </div>
            </div>
        </nav>
    </div>
</header>
<!-- ================= KẾT THÚC PHẦN HEADER / THANH NAVBAR ================= -->

