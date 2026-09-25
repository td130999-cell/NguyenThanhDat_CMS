<?php
/**
 * Plugin Name: CMS Custom Roles
 * Plugin URI: https://nguyenthanhdat.com
 * Description: Tạo 3 custom roles cho hệ thống CMS: cms_read (chỉ đọc), cms_write (đọc + viết), cms_admin (quản trị plugin/theme)
 * Version: 1.0.0
 * Author: Nguyen Thanh Dat
 * Author URI: https://nguyenthanhdat.com
 * Text Domain: cms-custom-roles
 * Domain Path: /languages
 * License: GPL v2 or later
 */

// Không cho phép truy cập trực tiếp
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Tạo custom roles khi activate plugin
 */
function cms_custom_roles_activate() {
    // =============================================
    // Role 1: cms_read - Chỉ có quyền đọc
    // =============================================
    add_role( 'cms_read', 'CMS Read', array(
        'read' => true,
        'level_0' => true,
    ));

    // =============================================
    // Role 2: cms_write - Đọc + Viết bài
    // =============================================
    add_role( 'cms_write', 'CMS Write', array(
        'read'                   => true,
        'edit_posts'             => true,
        'edit_published_posts'   => true,
        'publish_posts'          => true,
        'upload_files'           => true,
        'delete_posts'           => true,
        'delete_published_posts' => true,
        'level_0'                => true,
        'level_1'                => true,
        'level_2'                => true,
    ));

    // =============================================
    // Role 3: cms_admin - Cài plugin, cài theme
    // Có đầy đủ quyền quản trị
    // =============================================
    add_role( 'cms_admin', 'CMS Admin', array(
        'switch_themes'          => true,
        'edit_themes'            => true,
        'activate_plugins'       => true,
        'edit_plugins'           => true,
        'edit_users'             => true,
        'edit_files'             => true,
        'manage_options'         => true,
        'moderate_comments'      => true,
        'manage_categories'      => true,
        'manage_links'           => true,
        'upload_files'           => true,
        'import'                 => true,
        'unfiltered_html'        => true,
        'edit_posts'             => true,
        'edit_others_posts'      => true,
        'edit_published_posts'   => true,
        'publish_posts'          => true,
        'edit_pages'             => true,
        'read'                   => true,
        'level_10'               => true,
        'level_9'                => true,
        'level_8'                => true,
        'level_7'                => true,
        'level_6'                => true,
        'level_5'                => true,
        'level_4'                => true,
        'level_3'                => true,
        'level_2'                => true,
        'level_1'                => true,
        'level_0'                => true,
        'edit_others_pages'      => true,
        'edit_published_pages'   => true,
        'publish_pages'          => true,
        'delete_pages'           => true,
        'delete_others_pages'    => true,
        'delete_published_pages' => true,
        'delete_posts'           => true,
        'delete_others_posts'    => true,
        'delete_published_posts' => true,
        'delete_private_posts'   => true,
        'edit_private_posts'     => true,
        'read_private_posts'     => true,
        'delete_private_pages'   => true,
        'edit_private_pages'     => true,
        'read_private_pages'     => true,
        'delete_users'           => true,
        'create_users'           => true,
        'unfiltered_upload'      => true,
        'edit_dashboard'         => true,
        'update_plugins'         => true,
        'delete_plugins'         => true,
        'install_plugins'        => true,
        'update_themes'          => true,
        'install_themes'         => true,
        'update_core'            => true,
        'list_users'             => true,
        'remove_users'           => true,
        'promote_users'          => true,
        'edit_theme_options'     => true,
        'delete_themes'          => true,
        'export'                 => true,
    ));
}
register_activation_hook( __FILE__, 'cms_custom_roles_activate' );

/**
 * Xóa custom roles khi deactivate plugin
 */
function cms_custom_roles_deactivate() {
    remove_role( 'cms_read' );
    remove_role( 'cms_write' );
    remove_role( 'cms_admin' );
}
register_deactivation_hook( __FILE__, 'cms_custom_roles_deactivate' );

/**
 * Đảm bảo roles luôn tồn tại (phòng trường hợp bị mất)
 */
function cms_custom_roles_init() {
    // Kiểm tra nếu roles chưa tồn tại thì tạo lại
    if ( ! get_role( 'cms_read' ) || ! get_role( 'cms_write' ) || ! get_role( 'cms_admin' ) ) {
        cms_custom_roles_activate();
    }
}
add_action( 'init', 'cms_custom_roles_init' );

/**
 * Thêm mô tả cho roles trong admin
 */
function cms_custom_roles_admin_notice() {
    $screen = get_current_screen();
    if ( $screen && $screen->id === 'plugins' ) {
        // Hiển thị thông báo sau khi activate
        if ( get_transient( 'cms_custom_roles_activated' ) ) {
            echo '<div class="notice notice-success is-dismissible">';
            echo '<p><strong>CMS Custom Roles</strong> đã được kích hoạt thành công!</p>';
            echo '<ul style="list-style: disc; margin-left: 20px;">';
            echo '<li><strong>CMS Read</strong>: Chỉ có quyền đọc nội dung</li>';
            echo '<li><strong>CMS Write</strong>: Đọc + viết/sửa/xóa bài viết</li>';
            echo '<li><strong>CMS Admin</strong>: Toàn quyền quản trị (cài plugin, theme)</li>';
            echo '</ul>';
            echo '</div>';
            delete_transient( 'cms_custom_roles_activated' );
        }
    }
}
add_action( 'admin_notices', 'cms_custom_roles_admin_notice' );

/**
 * Set transient khi activate để hiển thị thông báo
 */
function cms_custom_roles_set_notice() {
    set_transient( 'cms_custom_roles_activated', true, 30 );
}
register_activation_hook( __FILE__, 'cms_custom_roles_set_notice' );
