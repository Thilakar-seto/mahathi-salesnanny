<?php
// Get the current post object
global $post;

// Set up post data to ensure author information is available
setup_postdata($post);

// Check if the post belongs to the "blogs" category
if (in_category('blogs')) {
    // If it's in the "blogs" category, include the specific template for blogs
    get_template_part('single-blogs');
} elseif (in_category('success-stories')) {
    // If it's in the "success stories" category, include the specific template for success stories
    get_template_part('single-success-stories');
} else {
    // If it doesn't belong to either category, include the default template
    get_template_part('single-default');
}

// Reset post data
wp_reset_postdata();
?>
