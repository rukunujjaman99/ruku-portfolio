

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
    wp_enqueue_style(
        'fontawesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
        array(),
        '6.4.0'
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
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
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




function ruku_education_custom_post_type() {
    $labels = array(
        'name'               => _x( 'Educations', 'post type general name', 'rukunujjaman' ),
        'singular_name'      => _x( 'Education', 'post type singular name', 'rukunujjaman' ),
        'menu_name'          => _x( 'Educations', 'admin menu', 'rukunujjaman' ),
        'name_admin_bar'     => _x( 'Education', 'add new on admin bar', 'rukunujjaman' ),
        'add_new'            => _x( 'Add New', 'education', 'rukunujjaman' ),
        'add_new_item'       => __( 'Add New Education', 'rukunujjaman' ),
        'new_item'           => __( 'New Education', 'rukunujjaman' ),    
        'edit_item'          => __( 'Edit Education', 'rukunujjaman' ),
        'view_item'          => __( 'View Education', 'rukunujjaman' ),
        'all_items'         => __( 'All Educations', 'rukunujjaman' ),
        'search_items'       => __( 'Search Educations', 'rukunujjaman' ),
        'parent_item_colon'  => __( '', '', '' ),
        );
    $args = array(
         'labels'             => $labels,
    'public'             => true,
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'education' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'menu_icon'          => 'dashicons-welcome-learn-more',
    'supports'           => array( 'title',  'thumbnail', 'excerpt',  ),
   
    );
    register_post_type( 'education', $args );
}
add_action( 'init', 'ruku_education_custom_post_type' ); 

function add_education_meta_box() {
    add_meta_box(
        'education_meta_box',
        'Education Details',
        'render_education_meta_box',
        'education',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_education_meta_box');



function render_education_meta_box($post) {

    wp_nonce_field('save_education_meta', 'education_meta_nonce');

    $educations = get_post_meta($post->ID, 'education_repeater', true);
    if (!is_array($educations)) {
        $educations = [];
    }
    ?>

    <div id="education-repeater-wrapper">

        <?php foreach ($educations as $index => $edu) : ?>
            <div class="education-group" style="border:1px solid #ddd;padding:15px;margin-bottom:15px;">
                
                <p>
                    <label><strong>Degree</strong></label>
                    <input type="text" name="education_repeater[<?php echo $index; ?>][degree]" class="widefat"
                           value="<?php echo esc_attr($edu['degree'] ?? ''); ?>">
                </p>

                <p>
                    <label><strong>University</strong></label>
                    <input type="text" name="education_repeater[<?php echo $index; ?>][university]" class="widefat"
                           value="<?php echo esc_attr($edu['university'] ?? ''); ?>">
                </p>

                <p>
                    <label><strong>Academic Year</strong></label>
                    <input type="text" name="education_repeater[<?php echo $index; ?>][academic_year]" class="widefat"
                           value="<?php echo esc_attr($edu['academic_year'] ?? ''); ?>">
                </p>

                <p>
                    <label><strong>Short Description</strong></label>
                    <textarea name="education_repeater[<?php echo $index; ?>][short_description]" rows="3" class="widefat"><?php
                        echo esc_textarea($edu['short_description'] ?? '');
                    ?></textarea>
                </p>

                <button type="button" class="button remove-education">Remove</button>
            </div>
        <?php endforeach; ?>

    </div>

    <button type="button" class="button button-primary" id="add-education">+ Add Education</button>

    <!-- TEMPLATE -->
    <script type="text/html" id="education-template">
        <div class="education-group" style="border:1px solid #ddd;padding:15px;margin-bottom:15px;">
            <p>
                <label><strong>Degree</strong></label>
                <input type="text" name="education_repeater[{{index}}][degree]" class="widefat">
            </p>

            <p>
                <label><strong>University</strong></label>
                <input type="text" name="education_repeater[{{index}}][university]" class="widefat">
            </p>

            <p>
                <label><strong>Academic Year</strong></label>
                <input type="text" name="education_repeater[{{index}}][academic_year]" class="widefat">
            </p>

            <p>
                <label><strong>Short Description</strong></label>
                <textarea name="education_repeater[{{index}}][short_description]" rows="3" class="widefat"></textarea>
            </p>

            <button type="button" class="button remove-education">Remove</button>
        </div>
    </script>

    <script>
        (function($){
            let index = <?php echo count($educations); ?>;

            $('#add-education').on('click', function(){
                let template = $('#education-template').html().replace(/{{index}}/g, index);
                $('#education-repeater-wrapper').append(template);
                index++;
            });

            $(document).on('click', '.remove-education', function(){
                $(this).closest('.education-group').remove();
            });
        })(jQuery);
    </script>

    <?php
}
function save_education_meta_box($post_id) {

    if (!isset($_POST['education_meta_nonce']) ||
        !wp_verify_nonce($_POST['education_meta_nonce'], 'save_education_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (get_post_type($post_id) !== 'education') return;

    if (isset($_POST['education_repeater']) && is_array($_POST['education_repeater'])) {

        $clean_data = [];

        foreach ($_POST['education_repeater'] as $edu) {
            $clean_data[] = [
                'degree' => sanitize_text_field($edu['degree'] ?? ''),
                'university' => sanitize_text_field($edu['university'] ?? ''),
                'academic_year' => sanitize_text_field($edu['academic_year'] ?? ''),
                'short_description' => sanitize_textarea_field($edu['short_description'] ?? ''),
            ];
        }

        update_post_meta($post_id, 'education_repeater', $clean_data);
    } else {
        delete_post_meta($post_id, 'education_repeater');
    }
}
add_action('save_post', 'save_education_meta_box');


function ruku_experience_custom_post_type() {
    $labels = array(
        'name'               => _x( 'Experiences', 'post type general name', 'rukunujjaman' ),
        'singular_name'      => _x( 'Experience', 'post type singular name', 'rukunujjaman' ),
        'menu_name'          => _x( 'Experiences', 'admin menu', 'rukunujjaman' ),
        'name_admin_bar'     => _x( 'Experience', 'add new on admin bar', 'rukunujjaman' ),
        'add_new'            => _x( 'Add New', 'experience', 'rukunujjaman' ),
        'add_new_item'       => __( 'Add New Experience', 'rukunujjaman' ),
        'new_item'           => __( 'New Experience', 'rukunujjaman' ), 
        'edit_item'          => __( 'Edit Experience', 'rukunujjaman' ),
        'view_item'          => __( 'View Experience', 'rukunujjaman' ),
        'all_items'         => __( 'All Experiences', 'rukunujjaman' ),
        'search_items'       => __( 'Search Experiences', 'rukunujjaman' ),
        'parent_item_colon'  => __( '', '', '' ),
        );
    $args = array(
         'labels'             => $labels,
    'public'             => true,
     'menu_icon'          => 'dashicons-hammer',
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'experience' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'menu_icon'          => 'dashicons-portfolio',
    'supports'           => array( 'title',  'thumbnail'  ),
   
    );
    register_post_type( 'experience', $args );
}
add_action( 'init', 'ruku_experience_custom_post_type' );



function add_experience_meta_box() {
    add_meta_box(
        'experience_meta_box',
        'Experience Details',
        'render_experience_meta_box',
        'experience', // change if needed
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_experience_meta_box');


function render_experience_meta_box($post) {

    wp_nonce_field('save_experience_meta', 'experience_meta_nonce');

    $job_title = get_post_meta($post->ID, 'job_title', true);
    $company   = get_post_meta($post->ID, 'company', true);
    $duration  = get_post_meta($post->ID, 'duration', true);
    $desc      = get_post_meta($post->ID, 'short_description', true);
    ?>

    <p>
        <label><strong>Job Title</strong></label>
        <input type="text" name="job_title" class="widefat"
               value="<?php echo esc_attr($job_title); ?>">
    </p>

    <p>
        <label><strong>Company</strong></label>
        <input type="text" name="company" class="widefat"
               value="<?php echo esc_attr($company); ?>">
    </p>

    <p>
        <label><strong>Duration</strong></label>
        <input type="text" name="duration" class="widefat"
               value="<?php echo esc_attr($duration); ?>">
    </p>

    <p>
        <label><strong>Short Description</strong></label>
        <textarea name="short_description" rows="4" class="widefat"><?php
            echo esc_textarea($desc);
        ?></textarea>
    </p>

    <?php
}

function save_experience_meta_box($post_id) {

    if (!isset($_POST['experience_meta_nonce']) ||
        !wp_verify_nonce($_POST['experience_meta_nonce'], 'save_experience_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (get_post_type($post_id) !== 'experience') return;

    update_post_meta($post_id, 'job_title', sanitize_text_field($_POST['job_title'] ?? ''));
    update_post_meta($post_id, 'company', sanitize_text_field($_POST['company'] ?? ''));
    update_post_meta($post_id, 'duration', sanitize_text_field($_POST['duration'] ?? ''));
    update_post_meta($post_id, 'short_description', sanitize_textarea_field($_POST['short_description'] ?? ''));
}
add_action('save_post', 'save_experience_meta_box');



function ruku_training_custom_post_type() {
    $labels = array(
        'name'               => _x( 'Trainings', 'post type general name', 'rukunujjaman' ),    
        'singular_name'      => _x( 'Training', 'post type singular name', 'rukunujjaman' ),
        'menu_name'          => _x( 'Trainings', 'admin menu', 'rukunujjaman' ),
        'name_admin_bar'     => _x( 'Training', 'add new on admin bar', 'rukunujjaman' ),
        'add_new'            => _x( 'Add New', 'training', 'rukunujjaman' ),
        'add_new_item'       => __( 'Add New Training', 'rukunujjaman' ),
        'new_item'           => __( 'New Training', 'rukunujjaman' ),   
        'edit_item'          => __( 'Edit Training', 'rukunujjaman' ),  
        'view_item'          => __( 'View Training', 'rukunujjaman' ),
        'all_items'         => __( 'All Trainings', 'rukunujjaman' ),
        'search_items'       => __( 'Search Trainings', 'rukunujjaman' ),
        'parent_item_colon'  => __( '', '', '' ),
        );
    $args = array(
         'labels'             => $labels,
    'public'             => true,
     'menu_icon'          => 'dashicons-welcome-learn-more',
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'training' ),
    'capability_type'    => 'post',
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'supports'           => array( 'title',  'thumbnail'  ),
   
    );
    register_post_type( 'training', $args );
}
add_action( 'init', 'ruku_training_custom_post_type' );



function add_training_meta_box() {
    add_meta_box(
        'training_meta_box',
        'Training Details',
        'render_training_meta_box',
        'training', // change if needed
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_training_meta_box');


function render_training_meta_box($post) {

    wp_nonce_field('save_training_meta', 'training_meta_nonce');

    $course_name = get_post_meta($post->ID, 'course_name', true);
    $institute   = get_post_meta($post->ID, 'institute', true);
    $duration    = get_post_meta($post->ID, 'duration', true);
    $desc        = get_post_meta($post->ID, 'short_description', true);


    ?>

    <p>
        <label><strong>Course Name</strong></label>
        <input type="text" name="course_name" class="widefat"
               value="<?php echo esc_attr($course_name); ?>">
    </p>

    <p>
        <label><strong>Institute</strong></label>
        <input type="text" name="institute" class="widefat"
               value="<?php echo esc_attr($institute); ?>">
    </p>

    <p>
        <label><strong>Duration</strong></label>
        <input type="text" name="duration" class="widefat"
               value="<?php echo esc_attr($duration); ?>">
    </p>

    <p>
        <label><strong>Short Description</strong></label>
        <textarea name="short_description" rows="4" class="widefat"><?php
            echo esc_textarea($desc);
        ?></textarea>
    </p>

    <?php
}

function save_training_meta_box($post_id) {

    if (!isset($_POST['training_meta_nonce']) ||
        !wp_verify_nonce($_POST['training_meta_nonce'], 'save_training_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    if (get_post_type($post_id) !== 'training') return;

    update_post_meta($post_id, 'course_name', sanitize_text_field($_POST['course_name'] ?? ''));
    update_post_meta($post_id, 'institute', sanitize_text_field($_POST['institute'] ?? ''));
    update_post_meta($post_id, 'duration', sanitize_text_field($_POST['duration'] ?? ''));
    update_post_meta($post_id, 'short_description', sanitize_textarea_field($_POST['short_description'] ?? ''));
}
add_action('save_post', 'save_training_meta_box');




function skill_custom_post_type() {
    $labels = array(
        'name'               => _x( 'Skills', 'post type general name', 'rukunujjaman' ),
        'singular_name'      => _x( 'Skill', 'post type singular name', 'rukunujjaman' ),
        'menu_name'          => _x( 'Skills', 'admin menu', 'rukunujjaman' ),
        'name_admin_bar'     => _x( 'Skill', 'add new on admin bar', 'rukunujjaman' ),
        'add_new'            => _x( 'Add New', 'skill', 'rukunujjaman' ),
        'add_new_item'       => __( 'Add New Skill', 'rukunujjaman' ),
        'new_item'           => __( 'New Skill', 'rukunujjaman' ),    
        'edit_item'          => __( 'Edit Skill', 'rukunujjaman' ), 
        'view_item'          => __( 'View Skill', 'rukunujjaman' ),
        'all_items'         => __( 'All Skills', 'rukunujjaman' ),          
        'search_items'       => __( 'Search Skills', 'rukunujjaman' ),
        'parent_item_colon'  => __( '', '', '' ),
        );  
    $args = array(
         'labels'             => $labels,
    'public'             => true,
     'menu_icon'          => 'dashicons-awards',
    'publicly_queryable' => true,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'query_var'          => true,
    'rewrite'            => array( 'slug' => 'skill' ),
    'capability_type'    => 'post', 
    'has_archive'        => true,
    'hierarchical'       => false,
    'menu_position'      => null,
    'supports'           => array( 'title',  'thumbnail'  ),
   
    );
    register_post_type( 'skill', $args );
}
add_action( 'init', 'skill_custom_post_type' );



