<?php

if (!current_user_can('administrator')) {
    add_filter('show_admin_bar', '__return_false');
}


function theme_register_hide_menus() {
    register_nav_menus(
        array(
            'primary' => __( 'Primary Menu' ), // Main menu
            'footer' => __( 'Footer Menu' ),    // Footer menu (if required)
        )
    );
}
add_action( 'after_setup_theme', 'theme_register_hide_menus' );


function load_javascript_libraries_enqueue_scripts() {
   
    // load the wordpress jQuery
    wp_enqueue_script('jquery');

    // Enqueue Bootstrap CSS and JS
    wp_enqueue_style('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap', 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js', array('jquery'), '', true);

    // Enqueue Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css');

    // Enqueue OwlCarousel CSS and JS (ensure correct path)
    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/lib/owlcarousel/assets/owl.carousel.min.css');
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/lib/owlcarousel/owl.carousel.min.js', array('jquery'), '', true);

    // Enqueue Custom JS for OwlCarousel initialization
    wp_enqueue_script('our-carousel-js', get_template_directory_uri() . '/js/owl-carousel-init.js', array('jquery', 'owl-carousel'), '', true);

    // Localize the admin-ajax.php URL to JavaScript
    wp_localize_script('custom-carousel-js', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php') // Pass admin-ajax URL to JavaScript
    ));

}
add_action('wp_enqueue_scripts', 'load_javascript_libraries_enqueue_scripts');


// Add the AJAX handler for fetching the single post content
function load_post_content() {
    // Check if the post ID is provided
    if ( isset($_POST['post_id']) ) {
        $post_id = intval($_POST['post_id']); // Sanitize the post ID

        // Get the post by ID
        $post = get_post($post_id);

        if ($post) {
            // Include the content of the post (without header and footer)
            setup_postdata($post);

            // Get the post content and title
            $post_c = '<h1>' . get_the_title($post) . '</h1> <div class="post-content">' . apply_filters('the_content', get_the_content('', false, $post)) . '</div>';


            $post_c .= ob_get_clean(); // Append the comments section

            // Send the response back to the JavaScript
            echo $post_c;
        }
    }

    // Always die at the end of an AJAX function to return the response
    die();
}
add_action('wp_ajax_load_post_content', 'load_post_content');
add_action('wp_ajax_nopriv_load_post_content', 'load_post_content');


?>
