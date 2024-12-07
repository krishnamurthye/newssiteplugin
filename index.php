<?php
get_header();

$args = array(
	'post_type' => 'news', 
        'posts_per_page' => 5, // Limit to 5 posts
);

$query = new WP_Query($args); // Run the query

if ($query->have_posts()) :
    echo '<div class="container-fluid"> <div class="row"> <div class="col-12 px-0">';
    echo '<div class="owl-carousel main-carousel position-relative">'; 
    while ($query->have_posts()) : $query->the_post(); ?>
        <div class="item" data-toggle="modal" data-target="#postModal" data-post-id="<?php the_ID(); ?>" data-title="<?php the_title(); ?>" data-image="<?php the_post_thumbnail_url('full'); ?>" data-date="<?php echo get_the_date(); ?>">
            <!-- Display the featured image -->
            <?php if (has_post_thumbnail()) : ?>
                <img class="img-fluid" src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>" style="object-fit: cover;">
            <?php endif; ?>
	    <div class="overlay">
                <div class="mb-2">
                       <?php
                        // Get categories of the current post
                        $categories = get_the_category();
                        if (!empty($categories)) :
                            foreach ($categories as $category) :
                                // Display category name as a badge and link to the category page
				    echo '<a class="badge badge-' . strtolower(str_replace(' ', '-', $category->name)) . ' text-uppercase font-weight-semi-bold p-2 mr-2" href="#" data-toggle="modal" data-target="#newsModal">' . $category->name . '</a>';
                            endforeach;
                        endif;
                        ?>
                        <a class="text-white" href="#" data-toggle="modal" data-target="#newsModal"><small><?php the_date() ?></small></a>
                 </div>
                <a class="h2 m-0 text-white text-uppercase font-weight-bold" href="#" data-toggle="modal" data-target="#newsModal"><?php the_title(); ?></a>
            </div>
        </div>
    <?php endwhile;
    echo '</div>'; // End the carousel
else :
    echo '<p>No news found.</p>';
endif;

wp_reset_postdata(); // Reset the post data

get_footer();
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

