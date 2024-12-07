<?php

// page-all-categories.php
/*
Template Name: All Categories
*/

get_header(); // Include header

// Get the selected category from the URL (using the 'category' query parameter)
$category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';

// If a category is selected, query posts for that category; else, show all categories
if ($category) {
    // Query posts for the selected category
    $args = array(
        'category_name' => $category, // Filter posts by the category slug
        'posts_per_page' => 10,        // Limit to 10 posts
    );
} else {
    // Show all posts if no category is selected
    $args = array(
        'posts_per_page' => 10,        // Limit to 10 posts
    );
}

// Query posts based on the selected category or all posts
$category_posts = new WP_Query($args);

if ($category_posts->have_posts()) :
    echo '<h2>Posts</h2>';

    // Loop through the posts
    while ($category_posts->have_posts()) : $category_posts->the_post(); ?>
        <div class="category-post">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p><?php the_excerpt(); ?></p>
        </div>
    <?php endwhile;

    wp_reset_postdata(); // Reset the WP_Query
else :
    echo '<p>No posts found.</p>';
endif;

get_footer(); // Include footer

?>

