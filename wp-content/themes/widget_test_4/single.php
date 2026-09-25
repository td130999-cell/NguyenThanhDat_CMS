<?php
/**
 * Template: TRANG CHI TIẾT (Single Post Page)
 * Bố cục chuẩn theo Sơ đồ 3:
 * - Header
 * - 3 Cột: Categories (9) | Detail (6) | Recent post (10)
 * - Khối Prev - Next Post (7)
 * - Khối Comments (8)
 * - Khối widget_test_4 phía trên Footer (3 điểm)
 * - Footer
 */
get_header();
?>

<main class="main-layout-wrapper">
    <div class="site-container">

        <!-- ==============================================
             BỐ CỤC 3 CỘT Ở PHẦN THÂN
             ============================================== -->
        <div class="three-column-grid">

            <!-- CỘT TRÁI: CATEGORIES (9) -->
            <aside class="sidebar-col categories-col">
                <div class="block-title">
                    <span>Categories (9)</span>
                    <span class="block-badge">Cột trái</span>
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

            <!-- CỘT GIỮA: DETAIL (6) - CHI TIẾT BÀI VIẾT -->
            <section class="main-content-col detail-col">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" class="single-detail-article">
                        <div class="block-title" style="margin-bottom: 20px;">
                            <span>Detail (6) - Nội dung chi tiết bài viết</span>
                        </div>

                        <h1><?php the_title(); ?></h1>

                        <div class="single-post-meta">
                            <span>📅 Ngày đăng: <?php echo get_the_date( 'd/m/Y' ); ?></span> &bull;
                            <span>✍️ Tác giả: <?php the_author(); ?></span> &bull;
                            <span>🏷️ Chuyên mục: <?php the_category( ', ' ); ?></span>
                        </div>

                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="single-featured-image">
                                <?php the_post_thumbnail( 'large' ); ?>
                            </div>
                        <?php endif; ?>

                        <div class="single-content-body">
                            <?php the_content(); ?>
                        </div>
                    </article>

                    <!-- ==============================================
                         KHỐI PREV - NEXT POST (7) NẰM NGANG
                         ============================================== -->
                    <div class="prev-next-posts-bar">
                        <div class="nav-prev-link">
                            <span>&laquo; Bài trước</span>
                            <?php previous_post_link( '%link', '%title' ); ?>
                        </div>
                        <div style="font-weight: 700; color: #cbd5e1;">|</div>
                        <div class="nav-next-link" style="text-align: right;">
                            <span>Bài tiếp theo &raquo;</span>
                            <?php next_post_link( '%link', '%title' ); ?>
                        </div>
                    </div>

                    <!-- ==============================================
                         KHỐI COMMENTS (8) BÌNH LUẬN
                         ============================================== -->
                    <section class="single-comments-block">
                        <div class="block-title">
                            <span>Comments (8) - Ý kiến bạn đọc</span>
                        </div>

                        <?php
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        else :
                            echo '<p style="color:#64748b; font-size:14px;">Bình luận hiện đã đóng cho bài viết này.</p>';
                        endif;
                        ?>
                    </section>

                <?php endwhile; ?>
            </section>

            <!-- CỘT PHẢI: RECENT POST (10) -->
            <aside class="sidebar-col recent-post-col">
                <div class="block-title">
                    <span>Recent Post (10)</span>
                    <span class="block-badge">Cột phải</span>
                </div>
                <div class="sidebar-block">
                    <ul class="sidebar-list">
                        <?php
                        $recent_posts = wp_get_recent_posts( array(
                            'numberposts' => 6,
                            'post_status' => 'publish',
                        ) );
                        foreach ( $recent_posts as $post_item ) :
                        ?>
                            <li>
                                <a href="<?php echo esc_url( get_permalink( $post_item['ID'] ) ); ?>">
                                    <?php echo esc_html( $post_item['post_title'] ); ?>
                                </a>
                                <span style="font-size: 11px; color: #94a3b8; display: block; margin-top: 2px;">
                                    <?php echo get_the_date( 'd/m/Y', $post_item['ID'] ); ?>
                                </span>
                            </li>
                        <?php endforeach; wp_reset_query(); ?>
                    </ul>
                </div>
            </aside>

        </div>
    </div>
</main>

<?php
// Gọi Footer: Bên trong footer.php sẽ tự động render khối widget_test_4 phía trên Footer (3 điểm Trang chi tiết)
get_footer();
?>
