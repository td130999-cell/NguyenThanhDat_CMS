<?php
/**
 * Template for displaying search results in DemoModule5
 */
get_header();
?>

<div class="site-container">
    <div class="search-header">
        <h1 class="search-title">
            Kết quả tìm kiếm cho: "<span><?php echo esc_html( get_search_query() ); ?></span>"
        </h1>
        <p class="search-count">
            <?php
            global $wp_query;
            $count = $wp_query->found_posts;
            echo 'Tìm thấy ' . $count . ' kết quả phù hợp.';
            ?>
        </p>
    </div>

    <div class="search-results-list">
        <?php if ( have_posts() ) : ?>
            <?php
            while ( have_posts() ) : the_post();
                // Sử dụng mã trích xuất ngày tháng theo hướng dẫn đề bài
                $post = get_post();
                $date = $post->post_date;
                $day = get_the_date( 'd', $post->ID );
                $month = get_the_date( 'm', $post->ID );
            ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'search-result-card' ); ?>>
                    <!-- 1. Hình ảnh thumbnail bên trái -->
                    <div class="search-card-thumb">
                        <a href="<?php the_permalink(); ?>">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'medium' ); ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/default-thumb.jpg' ); ?>" alt="<?php the_title_attribute(); ?>">
                            <?php endif; ?>
                        </a>
                    </div>

                    <!-- 2. Khối ngày tháng ở giữa -->
                    <div class="search-card-date">
                        <span class="date-day"><?php echo esc_html( $day ); ?></span>
                        <span class="date-month">THÁNG <?php echo esc_html( $month ); ?></span>
                    </div>

                    <!-- 3. Tiêu đề và trích dẫn nội dung bên phải -->
                    <div class="search-card-content">
                        <h2 class="search-card-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h2>
                        <div class="search-card-excerpt">
                            <?php the_excerpt(); ?>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>

            <div class="pagination">
                <?php
                echo paginate_links( array(
                    'prev_text' => '&laquo; Trước',
                    'next_text' => 'Sau &raquo;',
                ) );
                ?>
            </div>

        <?php else : ?>
            <div class="no-results">
                <p>Không tìm thấy kết quả nào phù hợp với từ khóa "<strong><?php echo esc_html( get_search_query() ); ?></strong>". Vui lòng thử lại với từ khóa khác.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
