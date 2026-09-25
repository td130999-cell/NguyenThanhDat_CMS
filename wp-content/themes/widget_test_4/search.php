<?php
/**
 * Template: TRANG DANH SÁCH / TÌM KIẾM
 * Bố cục chuẩn theo Sơ đồ 2:
 * - Header (1)
 * - Khối Search (4) nằm ngang
 * - 3 Cột: Khối (13) | Search result (5) | Khối (14)
 * - Khối (15) phía trên Footer: widget_test_4 (3 điểm)
 * - Footer
 */
get_header();
?>

<main class="main-layout-wrapper">
    <div class="site-container">

        <!-- ==============================================
             KHỐI SEARCH (4) NẰM NGANG TOÀN BỘ CHIỀU RỘNG
             ============================================== -->
        <section class="search-horizontal-bar">
            <h2>🔍 Search (4) - Tìm kiếm & Lọc danh sách bài viết</h2>
            <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <input type="search" name="s" placeholder="Nhập từ khóa tìm kiếm..." value="<?php echo get_search_query(); ?>" required>
                <button type="submit">Tìm kiếm</button>
            </form>
        </section>

        <!-- ==============================================
             BỐ CỤC 3 CỘT Ở PHẦN THÂN
             ============================================== -->
        <div class="three-column-grid">

            <!-- CỘT TRÁI: KHỐI (13) (Danh mục & Bộ lọc) -->
            <aside class="sidebar-col sidebar-13">
                <div class="block-title">
                    <span>Khối (13) - Danh mục</span>
                    <span class="block-badge">Sidebar trái</span>
                </div>
                <ul class="sidebar-list">
                    <?php
                    wp_list_categories( array(
                        'title_li'   => '',
                        'show_count' => true,
                    ) );
                    ?>
                </ul>
            </aside>

            <!-- CỘT GIỮA: SEARCH RESULT (5) -->
            <section class="main-content-col search-result-col">
                <div class="block-title">
                    <span>Search Result (5) - Kết quả tìm kiếm</span>
                    <span class="block-badge">
                        <?php
                        global $wp_query;
                        echo $wp_query->found_posts . ' kết quả';
                        ?>
                    </span>
                </div>

                <div class="posts-feed">
                    <?php if ( have_posts() ) : ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" class="post-item-card">
                                <div class="post-item-thumb">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <?php the_post_thumbnail( 'medium' ); ?>
                                        <?php else : ?>
                                            <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background:#e2e8f0; color:#94a3b8; font-size:12px;">
                                                Không có ảnh
                                            </div>
                                        <?php endif; ?>
                                    </a>
                                </div>

                                <div class="post-item-info">
                                    <h3 class="post-item-title">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </h3>

                                    <div class="post-item-meta">
                                        <span>📅 <?php echo get_the_date( 'd/m/Y' ); ?></span>
                                        <span>🏷️ <?php the_category( ', ' ); ?></span>
                                    </div>

                                    <div class="post-item-excerpt">
                                        <?php the_excerpt(); ?>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>

                        <div class="pagination-wrap" style="margin-top: 24px; text-align: center;">
                            <?php
                            echo paginate_links( array(
                                'prev_text' => '&laquo; Trước',
                                'next_text' => 'Sau &raquo;',
                            ) );
                            ?>
                        </div>
                    <?php else : ?>
                        <div style="padding: 30px; text-align: center; color: #64748b;">
                            <p style="font-size: 16px; margin-bottom: 8px;">Không tìm thấy bài viết nào phù hợp.</p>
                            <p style="font-size: 13px;">Hãy thử tìm kiếm với các từ khóa khác hoặc bấm Trang chủ.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </section>

            <!-- CỘT PHẢI: KHỐI (14) (Bài viết mới / Tags) -->
            <aside class="sidebar-col sidebar-14">
                <div class="block-title">
                    <span>Khối (14) - Phổ biến</span>
                    <span class="block-badge">Sidebar phải</span>
                </div>
                <div class="sidebar-block">
                    <h4 style="font-size: 14px; font-weight: 700; color: #475569; margin-bottom: 12px; text-transform: uppercase;">
                        Bài viết mới
                    </h4>
                    <ul class="sidebar-list">
                        <?php
                        $recent = wp_get_recent_posts( array(
                            'numberposts' => 5,
                            'post_status' => 'publish',
                        ) );
                        foreach ( $recent as $item ) :
                        ?>
                            <li>
                                <a href="<?php echo esc_url( get_permalink( $item['ID'] ) ); ?>">
                                    <?php echo esc_html( $item['post_title'] ); ?>
                                </a>
                            </li>
                        <?php endforeach; wp_reset_query(); ?>
                    </ul>
                </div>
            </aside>

        </div>
    </div>
</main>

<?php
// Gọi Footer: Bên trong footer.php chính là Khối (15) hiển thị widget_test_4 nằm ngang trên Footer (3 điểm Trang danh sách)
get_footer();
?>
