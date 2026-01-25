

<?php

function ruku_theme_function() {

  register_nav_menus( array(
    'primary' => __( 'Primary Menu', 'rukunujjaman' ),
    'footer'  => __( 'Footer Menu', 'rukunujjaman' ),
  ) );

  add_theme_support('post-thumbnails');
  add_theme_support('title-tag');


}

add_action('init', 'ruku_theme_function');

function theme_setup() {
    add_theme_support('custom-logo', array(
        'height'      => 80,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}
add_action('after_setup_theme', 'theme_setup');


function enqueue_custom_assets() {

    // CSS
    wp_enqueue_style(
        'custom-style',
        get_template_directory_uri() . '/assets/css/style.css',
        array(),
        '1.0.0'
    );
      wp_enqueue_style(
        'bootstrap',
        get_template_directory_uri() . '/assets/css/bootstrap.min.css',
        array(),
        '5.3',
    );

    // JS
    wp_enqueue_script(
        'custom-script',
        get_template_directory_uri() . '/assets/js/main.js',
        array('jquery'),
        '1.0.0',
        true
    );
     
    wp_enqueue_script(
        'bootstrap-js',
        get_template_directory_uri() . '/assets/js/bootstrap.min.js',
        array(),
        '5.3',
        true
    );
}
add_action('wp_enqueue_scripts', 'enqueue_custom_assets');



function ruku_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Footer Widget Area', 'rukunujjaman' ),
        'id'            => 'footer-1',
        'description'   => __( 'Add widgets here to appear in your footer.', 'rukunujjaman' ),
        'before_widget' => '<div class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-widget-title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'ruku_widgets_init' );

function create_custom_post_type() {
    $labels = array(
        'name'               => _x( 'Projects', 'post type general name', 'rukunujjaman' ),
        'singular_name'      => _x( 'Project', 'post type singular name', 'rukunujjaman' ),
        'menu_name'          => _x( 'Projects', 'admin menu', 'rukunujjaman' ),
        'name_admin_bar'     => _x( 'Project', 'add new on admin bar', 'rukunujjaman' ),
        'add_new'            => _x( 'Add New', 'project', 'rukunujjaman' ),
        'add_new_item'       => __( 'Add New Project', 'rukunujjaman' ),
        'new_item'           => __( 'New Project', 'rukunujjaman' ),    
        'edit_item'          => __( 'Edit Project', 'rukunujjaman' ),
        'view_item'          => __( 'View Project', 'rukunujjaman' ),
        'all_items'         => __( 'All Projects', 'rukunujjaman' ),
        'search_items'       => __( 'Search Projects', 'rukunujjaman' ),
        'parent_item_colon'  => __( 'Parent Projects:', 'rukunujjaman' ),
        'not_found'          => __( 'No projects found.', 'rukunujjaman' ),
        'not_found_in_trash' => __( 'No projects found in Trash.', 'rukunujjaman' ),
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'project' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        'taxonomies'         => array( 'category', 'post_tag' ),
    );
    register_post_type( 'project', $args );



}
add_action( 'init', 'create_custom_post_type' );

// Add Meta Box
function project_add_custom_meta_box() {
    add_meta_box(
        'project_link_meta',        // ID
        'Project View Link',        // Title
        'project_link_meta_callback', // Callback
        'project',                  // Post type
        'normal',                   // Context
        'high'                      // Priority
    );
}
add_action('add_meta_boxes', 'project_add_custom_meta_box');

// Meta Box HTML
function project_link_meta_callback($post) {
    wp_nonce_field('project_link_nonce', 'project_link_nonce_field');
    $value = get_post_meta($post->ID, '_project_link', true);
    ?>
    <label for="project_link">Project URL:</label>
    <input type="url" name="project_link" id="project_link" value="<?php echo esc_attr($value); ?>" style="width:100%;" placeholder="https://example.com/project-page">
    <?php
}

// Save Meta Box Data
function project_save_meta_box($post_id) {
    // Verify nonce
    if (!isset($_POST['project_link_nonce_field']) || !wp_verify_nonce($_POST['project_link_nonce_field'], 'project_link_nonce')) {
        return;
    }

    // Prevent autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // Check permissions
    if (!current_user_can('edit_post', $post_id)) return;

    // Save or delete
    if (isset($_POST['project_link'])) {
        update_post_meta($post_id, '_project_link', esc_url_raw($_POST['project_link']));
    } else {
        delete_post_meta($post_id, '_project_link');
    }
}
add_action('save_post', 'project_save_meta_box');






?>