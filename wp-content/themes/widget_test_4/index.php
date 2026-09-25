<?php
/**
 * Template: TRANG CHỦ (Home Page)
 * Bố cục chuẩn theo Sơ đồ 1:
 * - Header (1)
 * - 3 Cột: Archive (11) | Content (2) | Comments (12)
 * - Khối widget_test_4 phía trên Footer (4 điểm)
 * - Footer (3)
 */
get_header();
?>

<main class="main-layout-wrapper">
    <div class="site-container">
        <div class="three-column-grid">

            <!-- ==============================================
                 CỘT TRÁI: ARCHIVE (11) (Nhóm 6 SV)
                 ============================================== -->
            <aside class="sidebar-col archive-col">
                <div class="block-title">
                    <span>Archive (11)</span>
                    <span class="block-badge">Nhóm 6 SV</span>
                </div>

                <div class="sidebar-block" style="margin-bottom: 24px;">
                    <h4 style="font-size: 14px; font-weight: 700; color: #475569; margin-bottom: 10px; text-transform: uppercase;">
                        Lưu trữ theo tháng
                    </h4>
                    <ul class="sidebar-list">
                        <?php
                        wp_get_archives( array(
                            'type'            => 'monthly',
                            'limit'           => 6,
                            'show_post_count' => true,
                        ) );
                        ?>
                    </ul>
                </div>

                <div class="sidebar-block">
                    <h4 style="font-size: 14px; font-weight: 700; color: #475569; margin-bottom: 10px; text-transform: uppercase;">
                        Chuyên mục
                    </h4>
                    <ul class="sidebar-list">
                        <?php
                        wp_list_categories( array(
                            'title_li'   => '',
                            'show_count' => true,
                            'number'     => 6,
                        ) );
                        ?>
                    </ul>
                </div>
            </aside>

            <!-- ==============================================
                 CỘT GIỮA: CONTENT (2)
                 ============================================== -->
            <section class="main-content-col content-col">
                <div class="block-title">
                    <span>Content (2) - Bài viết Mới nhất</span>
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
                                        <span>✍️ <?php the_author(); ?></span>
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
                                'prev_text' => '&laquo; Trang trước',
                                'next_text' => 'Trang sau &raquo;',
                            ) );
                            ?>
                        </div>
                    <?php else : ?>
                        <p style="padding: 20px; color: #64748b;">Chưa có bài viết nào được xuất bản.</p>
                    <?php endif; ?>
                </div>
            </section>

            <!-- ==============================================
                 CỘT PHẢI: COMMENTS (12) (Nhóm 6 SV)
                 ============================================== -->
            <aside class="sidebar-col comments-col">
                <div class="block-title">
                    <span>Comments (12)</span>
                    <span class="block-badge">Nhóm 6 SV</span>
                </div>

                <div class="sidebar-block">
                    <?php
                    $recent_comments = get_comments( array(
                        'number' => 5,
                        'status' => 'approve',
                    ) );

                    if ( ! empty( $recent_comments ) ) :
                        foreach ( $recent_comments as $comment ) :
                            $comment_post = get_post( $comment->comment_post_ID );
                    ?>
                        <div class="comment-item">
                            <div class="comment-author">
                                💬 <strong><?php echo esc_html( $comment->comment_author ); ?></strong>
                            </div>
                            <div class="comment-text">
                                &ldquo;<?php echo wp_trim_words( esc_html( $comment->comment_content ), 12 ); ?>&rdquo;
                            </div>
                            <div style="font-size: 11px; color: #94a3b8; margin-top: 4px;">
                                trên: <a href="<?php echo esc_url( get_permalink( $comment_post->ID ) ); ?>" style="color: #64748b;"><?php echo esc_html( wp_trim_words( $comment_post->post_title, 5 ) ); ?></a>
                            </div>
                        </div>
                    <?php
                        endforeach;
                    else :
                    ?>
                        <p style="font-size: 13px; color: #94a3b8; font-style: italic;">
                            Chưa có bình luận nào gần đây.
                        </p>
                    <?php endif; ?>
                </div>
            </aside>

        </div>
    </div>
</main>

<?php
// Gọi Footer: Bên trong footer.php sẽ tự động render khối widget_test_4 phía trên Footer (4 điểm Trang chủ)
get_footer();
?>