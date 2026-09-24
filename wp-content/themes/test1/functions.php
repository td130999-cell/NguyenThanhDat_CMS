<?php
function test1_scripts() {
    // Đăng ký và nạp style.css vào wp_head()
    wp_enqueue_style( 'test1-style', get_stylesheet_uri(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'test1_scripts' );
