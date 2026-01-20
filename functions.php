

<?php

function my_custom_function() {

    
    
}

add_action('init', 'my_custom_function');


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







?>