<?php
/**
 * Single post template file for DemoModule5
 */
get_header();
?>

<div class="site-container">
    <?php while ( have_posts() ) : the_post(); ?>
        <article class="single-post-article" style="background:#ffffff; padding:35px; border-radius:6px; box-shadow:0 1px 3px rgba(0,0,0,0.05); border:1px solid #e2e8f0; margin-bottom:40px;">
            <h1 style="font-size:26px; color:#1e293b; margin-bottom:12px; line-height:1.3; text-transform:uppercase; font-weight:700;">
                <?php the_title(); ?>
            </h1>
            <div style="color:#64748b; font-size:13px; margin-bottom:25px; border-bottom:1px solid #e2e8f0; padding-bottom:12px;">
                Ngày đăng: <?php echo get_the_date( 'd/m/Y' ); ?> | Chuyên mục: <?php the_category( ', ' ); ?>
            </div>
            <?php if ( has_post_thumbnail() ) : ?>
                <div style="margin-bottom:25px; text-align:center;">
                    <?php the_post_thumbnail( 'large', array( 'style' => 'max-width:100%; height:auto; border-radius:6px;' ) ); ?>
                </div>
            <?php endif; ?>
            <div class="post-content" style="font-size:15px; line-height:1.8; color:#334155;">
                <?php the_content(); ?>
            </div>
        </article>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>
