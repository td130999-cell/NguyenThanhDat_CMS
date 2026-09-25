<?php
/**
 * Template: TRANG DANH SÁCH CHUYÊN MỤC / LƯU TRỮ (Archive Page)
 * Sử dụng chung cấu trúc Trang danh sách của Sơ đồ 2:
 * - Header (1)
 * - Khối Tìm kiếm / Tiêu đề danh mục
 * - 3 Cột: Khối (13) | Danh sách bài viết (5) | Khối (14)
 * - Khối (15) phía trên Footer: widget_test_4 (3 điểm)
 * - Footer
 */
get_header();
?>

<main class="main-layout-wrapper">
    <div class="site-container">

        <!-- KHỐI TIÊU ĐỀ DANH SÁCH / SEARCH NẰM NGANG -->
        <section class="search-horizontal-bar">
            <h2>📁 Danh sách bài viết: <?php the_archive_title(); ?></h2>
            <?php the_archive_description( '<p style="color:#64748b; margin-top:6px;">', '</p>' ); ?>
        </section>

        <!-- BỐ CỤC 3 CỘT -->
        <div class="three-column-grid">

            <!-- CỘT TRÁI: KHỐI (13) -->
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

            <!-- CỘT GIỮA: DANH SÁCH BÀI VIẾT (5) -->
            <section class="main-content-col search-result-col">
                <div class="block-title">
                    <span>Danh sách bài viết</span>
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
                        <p style="padding: 20px; color: #64748b;">Chưa có bài viết nào trong chuyên mục này.</p>
                    <?php endif; ?>
                </div>
            </section>

            <!-- CỘT PHẢI: KHỐI (14) -->
            <aside class="sidebar-col sidebar-14">
                <div class="block-title">
                    <span>Khối (14) - Lưu trữ</span>
                    <span class="block-badge">Sidebar phải</span>
                </div>
                <ul class="sidebar-list">
                    <?php
                    wp_get_archives( array(
                        'type'            => 'monthly',
                        'show_post_count' => true,
                    ) );
                    ?>
                </ul>
            </aside>

        </div>
    </div>
</main>

<?php
// Gọi Footer: Bên trong footer.php chính là Khối (15) hiển thị widget_test_4 nằm ngang trên Footer (3 điểm Trang danh sách)
get_footer();
?>
