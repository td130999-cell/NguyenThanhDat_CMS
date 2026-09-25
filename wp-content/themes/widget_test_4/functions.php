<?php
/**
 * Functions and definitions for theme widget_test_4
 */

// 1. Khởi tạo tính năng theme
function widget_test_4_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 400, 260, true );

    add_theme_support( 'html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ) );

    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'widget_test_4' ),
    ) );
}
add_action( 'after_setup_theme', 'widget_test_4_setup' );

// 2. Nạp CSS
function widget_test_4_scripts() {
    wp_enqueue_style( 'widget_test_4-style', get_stylesheet_uri(), array(), time() );
}
add_action( 'wp_enqueue_scripts', 'widget_test_4_scripts' );

// 3. Tùy chỉnh độ dài tóm tắt bài viết
function widget_test_4_excerpt_length( $length ) {
    return 24;
}
add_filter( 'excerpt_length', 'widget_test_4_excerpt_length' );

function widget_test_4_excerpt_more( $more ) {
    return '...';
}
add_filter( 'excerpt_more', 'widget_test_4_excerpt_more' );


// ========================================================
// 4. ĐĂNG KÝ KHU VỰC SIDEBAR (ABOVE FOOTER)
// ========================================================
function widget_test_4_register_sidebars() {
    register_sidebar( array(
        'name'          => 'Above Footer Sidebar (Khu vực trên Footer)',
        'id'            => 'above-footer-sidebar',
        'description'   => 'Khu vực hiển thị widget_test_4 ngay phía trên Footer ở cả 3 trang: Trang chủ, Trang danh sách, Trang chi tiết',
        'before_widget' => '<div id="%1$s" class="above-footer-widget-item %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-test4-main-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'widget_test_4_register_sidebars' );


// ========================================================
// 5. ĐỊNH NGHĨA CUSTOM WIDGET: widget_test_4
// ========================================================
class widget_test_4 extends WP_Widget {

    /**
     * Khởi tạo widget với định danh 'widget_test_4'
     */
    public function __construct() {
        parent::__construct(
            'widget_test_4', // ID Widget theo yêu cầu của thầy
            'widget_test_4', // Tên Widget hiển thị trong WP-Admin
            array(
                'description' => 'Widget hiển thị dự án Bất Động Sản Random theo hình mẫu (Khu vực trên Footer)',
                'classname'   => 'widget_test_4_box',
            )
        );
    }

    /**
     * Xuất giao diện Widget ra Frontend theo chuẩn hình mẫu thầy cho
     */
    public function widget( $args, $instance ) {
        echo $args['before_widget'];

        // Dữ liệu mẫu dự phòng theo đúng 100% hình mẫu đề bài
        $sample_projects = array(
            array(
                'title'     => 'Vinhomes Global Gate Hạ Long',
                'investor'  => 'Tập đoàn Vingroup',
                'duration'  => 'Lâu dài',
                'address'   => 'Phường Tuần Châu và phường Hà An, Thành phố Hạ Long, Quảng Ninh',
                'image'     => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?auto=format&fit=crop&w=700&q=80',
            ),
            array(
                'title'     => "Cloud Icon L'Avenir",
                'investor'  => 'Cloud Gate Group',
                'duration'  => '50 năm',
                'address'   => 'Lô B2, đường Độc Lập, phường Bình Kiến, Đắk Lắk',
                'image'     => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=700&q=80',
            ),
            array(
                'title'     => 'An Binh HomeLand',
                'investor'  => 'Công ty cổ phần Glexhomes',
                'duration'  => 'Lâu dài',
                'address'   => 'Khu đô thị Geleximco, Lê Trọng Tấn, Quận Hà Đông, Hà Nội',
                'image'     => 'https://images.unsplash.com/photo-1577495508048-b635879837f1?auto=format&fit=crop&w=700&q=80',
            ),
        );

        // Truy vấn 3 bài viết NGẪU NHIÊN ('orderby' => 'rand')
        $query_bds = new WP_Query( array(
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'orderby'        => 'rand',
            'post_status'    => 'publish',
        ) );
        ?>

        <div class="widget-test4-container">
            <div class="widget-test4-header">
                <h3 class="widget-test4-main-title">Dự án Bất động sản Nổi bật</h3>
                <span class="widget-test4-note">Dữ liệu ngẫu nhiên (Random)</span>
            </div>

            <div class="widget-test4-grid">
                <?php
                $item_index = 0;
                if ( $query_bds->have_posts() ) :
                    while ( $query_bds->have_posts() ) : $query_bds->the_post();
                        $post_id = get_the_ID();
                        $fallback = $sample_projects[ $item_index % count( $sample_projects ) ];

                        // Lấy Custom Field nếu có, nếu chưa có thì lấy dữ liệu chuẩn mẫu
                        $investor = get_post_meta( $post_id, 'chu_dau_tu', true );
                        if ( empty( $investor ) ) {
                            $investor = $fallback['investor'];
                        }

                        $duration = get_post_meta( $post_id, 'thoi_han', true );
                        if ( empty( $duration ) ) {
                            $duration = $fallback['duration'];
                        }

                        $address = get_post_meta( $post_id, 'dia_chi', true );
                        if ( empty( $address ) ) {
                            $address = $fallback['address'];
                        }

                        $status = get_post_meta( $post_id, 'trang_thai', true );
                        if ( empty( $status ) ) {
                            $status = 'Đang mở bán';
                        }

                        // Lấy ảnh đại diện bài viết hoặc ảnh mẫu
                        if ( has_post_thumbnail( $post_id ) ) {
                            $thumb_url = get_the_post_thumbnail_url( $post_id, 'medium_large' );
                        } else {
                            $thumb_url = $fallback['image'];
                        }
                ?>
                    <article class="bds-card">
                        <!-- Khung hình ảnh + Badge "Đang mở bán" góc trên bên trái -->
                        <div class="bds-card-thumb-wrap">
                            <span class="bds-badge-status"><?php echo esc_html( $status ); ?></span>
                            <a href="<?php the_permalink(); ?>">
                                <img src="<?php echo esc_url( $thumb_url ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy">
                            </a>
                        </div>

                        <!-- Khung thông tin chi tiết -->
                        <div class="bds-card-content">
                            <!-- Tiêu đề dự án -->
                            <h4 class="bds-card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h4>

                            <!-- Chủ đầu tư -->
                            <div class="bds-investor">
                                Chủ đầu tư: <strong><?php echo esc_html( $investor ); ?></strong>
                            </div>

                            <!-- Thời hạn sở hữu (Icon đồng hồ / tick) -->
                            <div class="bds-meta-row">
                                <svg class="bds-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                <span><?php echo esc_html( $duration ); ?></span>
                            </div>

                            <!-- Địa chỉ (Icon vị trí pin) -->
                            <div class="bds-meta-row">
                                <svg class="bds-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <span><?php echo esc_html( $address ); ?></span>
                            </div>
                        </div>
                    </article>
                <?php
                        $item_index++;
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Fallback hiển thị đúng 3 card mẫu nếu database chưa có bài viết
                    foreach ( $sample_projects as $proj ) :
                ?>
                    <article class="bds-card">
                        <div class="bds-card-thumb-wrap">
                            <span class="bds-badge-status">Đang mở bán</span>
                            <img src="<?php echo esc_url( $proj['image'] ); ?>" alt="<?php echo esc_attr( $proj['title'] ); ?>">
                        </div>
                        <div class="bds-card-content">
                            <h4 class="bds-card-title"><?php echo esc_html( $proj['title'] ); ?></h4>
                            <div class="bds-investor">
                                Chủ đầu tư: <strong><?php echo esc_html( $proj['investor'] ); ?></strong>
                            </div>
                            <div class="bds-meta-row">
                                <svg class="bds-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                <span><?php echo esc_html( $proj['duration'] ); ?></span>
                            </div>
                            <div class="bds-meta-row">
                                <svg class="bds-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <span><?php echo esc_html( $proj['address'] ); ?></span>
                            </div>
                        </div>
                    </article>
                <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>

        <?php
        echo $args['after_widget'];
    }

    /**
     * Form cấu hình Widget trong WP-Admin
     */
    public function form( $instance ) {
        $title = ! empty( $instance['title'] ) ? $instance['title'] : 'widget_test_4';
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">Tiêu đề:</label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p><em>Widget tự động lấy 3 bài viết ngẫu nhiên theo hình mẫu Bất Động Sản (có nhãn Đang mở bán, Chủ đầu tư, Thời hạn, Địa chỉ).</em></p>
        <?php
    }

    /**
     * Lưu cấu hình Widget
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
        return $instance;
    }
}

// 6. Đăng ký Widget vào hệ thống WordPress
function widget_test_4_register_custom_widget() {
    register_widget( 'widget_test_4' );
}
add_action( 'widgets_init', 'widget_test_4_register_custom_widget' );
