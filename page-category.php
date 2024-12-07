<?php
/*
Template Name: Category List Page
*/


get_header();

// Get the category slug from the URL, default to 'school-events' if not set
$category_slug = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : 'school-events'; 

// Debug to see what category slug is being passed
echo '<div class="container-fluid"><div class="row"><div class="col-lg-6 px-0"> <div class="row mx-0">';
// WP_Query to get posts from the selected category
$args = array(
	'post_type' => 'news',
    'category_name' => $category_slug, // Use category_name for querying by category slug
    'posts_per_page' => 5, // Limit to 5 posts per page
    'paged' => get_query_var('paged', 1), // Handle pagination
);

$category_query = new WP_Query($args);
if ($category_query->have_posts()) :
    
    // Loop through the posts and display them
    while ($category_query->have_posts()) : $category_query->the_post(); ?>
        <div class="col-md-6 px-0">
	<div class="position-relative overflow-hidden item" data-post-id="<?php the_ID(); ?>"  style="height: 250px;" data-toggle="modal" data-target="#newsModal">
            <?php if (has_post_thumbnail()) : ?>
               <img class="img-fluid w-100 h-100" src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>" style="object-fit: cover;">
	    <?php endif; ?>
            <div class="overlay">
		 <div class="mb-2">
                  <?php
                    // Get categories of the current post
                    $categories = get_the_category();
                    if (!empty($categories)) :
                        foreach ($categories as $category) :
                            // Display category name as a badge and link to the category page
                            echo '<a class="badge  badge-' . strtolower(str_replace(' ', '-', $category->name)) . '  text-uppercase font-weight-semi-bold p-2 mr-2" href="#" data-toggle="modal" data-target="#newsModal">' . $category->name . '</a>';
                        endforeach;
                    endif;
                    ?>
		   <a class="text-white" href="#" data-toggle="modal" data-target="#newsModal"><small><?php the_date() ?></small></a>
                 </div>
		 <a class="h6 m-0 text-white text-uppercase font-weight-semi-bold" href="#" data-toggle="modal" data-target="#newsModal"><?php the_title(); ?></a>
                 
            </div>

	</div>
        </div> 
    <?php endwhile;

    // Pagination
    echo '<div class="pagination">';
    echo paginate_links(array(
        'total' => $category_query->max_num_pages, // Total pages for pagination
    ));
    echo '</div>';

else :
    echo '<p>No posts found for this category.</p>';
endif;

echo '</div></div></div></div>';
wp_reset_postdata(); // Reset the WP_Query

get_footer(); // Include footer
?>


<!-- Modal for displaying full news content -->
<div class="modal fade" id="newsModal" tabindex="-1" role="dialog" aria-labelledby="newsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newsModalLabel" style="display:none;" ></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-content">
                <!-- Content will be loaded dynamically via AJAX -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

