jQuery(document).ready(function($) {

    $('.item').on('click', function() {
        var post_id = $(this).data('post-id'); // Get the post ID from the data attribute
        var title = $(this).data('title'); // Get the title
    
        // Make AJAX request to fetch the content
        $.ajax({
            url: ajax_object.ajax_url, 
            method: 'POST',
            data: {
                action: 'load_post_content',
                post_id: post_id,
            },
            success: function(response) {
                // Set the modal content dynamically
                $('#postModalLabel').text(title); // Set the title in modal
                $('#modal-content').html(response); // Set the content in modal

            },
            error: function() {
                $('#modal-content').html('<p>Error loading post. Please try again later.</p>');
            }
        });
    });


    // Initialize OwlCarousel
    $('.owl-carousel').owlCarousel({
        loop: true,                // Enable infinite loop
        margin: 10,                // Add space between items
        nav: false,                 // Show navigation arrows (next/prev)
        autoplay: true,            // Enable autoplay
        autoplayTimeout: 5000,     // Set autoplay speed (in milliseconds)
        items: 1,                  // Number of slides to show at a time
        responsive: {        
            1024: {
                items: 1,          // 3 slides for tablets and larger screens
            }
        }
    });

    // Modal content population on click
   

    // Initialize Modal when it opens
    $('#postModal').on('show.bs.modal', function(e) {
        var button = $(e.relatedTarget); // Button that triggered the modal
        var post_id = button.data('post-id'); // Get the post ID
    });
});

