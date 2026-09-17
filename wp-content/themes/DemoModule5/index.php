<?php
/**
 * Main template file for DemoModule5
 */
get_header();
?>

<div class="site-container">
    <!-- <div class="search-header">
        <h1 class="search-title">Tin Tức Mới Nhất</h1>
        <p class="search-count">Cập nhật thông tin và tin tức thể thao mới nhất</p>
    </div> -->

    <div class="search-results-list">
        <?php if ( have_posts() ) : ?>
            <?php
            while ( have_posts() ) : the_post();
                $post = get_post();
                $date = $post->post_date;
                $day = get_the_date( 'd', $post->ID );
                $month = get_the_date( 'm', $post->ID );
            ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class( 'search-result-card' ); ?>>
                    <div class="search-card-thumb">
                        <a href="<?php the_permalink(); ?>">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'medium' ); ?>
                            <?php endif; ?>
                        </a>
                    </div>
                    <div class="search-card-date">
                        <span class="date-day"><?php echo esc_html( $day ); ?></span>
                        <span class="date-month">THÁNG <?php echo esc_html( $month ); ?></span>
                    </div>
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
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
