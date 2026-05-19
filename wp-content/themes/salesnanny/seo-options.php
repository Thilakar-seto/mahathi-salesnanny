<?php


// Add meta boxes to posts and pages
function add_seo_meta_boxes() {
    $post_types = ['post', 'page'];
    foreach ($post_types as $post_type) {
        add_meta_box(
            'seo_meta_box',
            'SEO Options',
            'display_seo_meta_box',
            $post_type,
            'normal',
            'high'
        );
    }
}
add_action('add_meta_boxes', 'add_seo_meta_boxes');

// Display meta box content
function display_seo_meta_box($post) {
    wp_nonce_field('seo_meta_box', 'seo_meta_box_nonce');
    $meta_title = get_post_meta($post->ID, '_meta_title', true);
    $meta_description = get_post_meta($post->ID, '_meta_description', true);
    ?>
    <p>
        <label for="meta_title">Meta Title:</label><br>
        <input type="text" id="meta_title" name="meta_title" 
               value="<?php echo esc_attr($meta_title); ?>" style="width: 100%">
    </p>
    <p>
        <label for="meta_description">Meta Description:</label><br>
        <textarea id="meta_description" name="meta_description" 
                  rows="4" style="width: 100%"><?php echo esc_textarea($meta_description); ?></textarea>
    </p>
    <?php
}

// Save meta box data
function save_seo_meta_box($post_id) {
    if (!isset($_POST['seo_meta_box_nonce']) || 
        !wp_verify_nonce($_POST['seo_meta_box_nonce'], 'seo_meta_box') || 
        defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['meta_title'])) {
        update_post_meta($post_id, '_meta_title', sanitize_text_field($_POST['meta_title']));
    }
    if (isset($_POST['meta_description'])) {
        update_post_meta($post_id, '_meta_description', sanitize_textarea_field($_POST['meta_description']));
    }
}
add_action('save_post', 'save_seo_meta_box');

// Helper function to get post ID from URL
function get_post_id_from_url($url) {
    // Remove protocol (http/https)
    $url = preg_replace('(^https?://)', '', $url);
    
    // Get site URL without protocol
    $site_url = preg_replace('(^https?://)', '', site_url());
    
    // Remove site URL from the full URL to get the path
    $path = str_replace($site_url, '', $url);
    
    // Remove trailing slashes
    $path = trim($path, '/');
    
    // Split path into segments
    $segments = explode('/', $path);
    
    // If we have a custom post type in the URL
    if (count($segments) > 1) {
        $post_type = $segments[0];
        $post_slug = end($segments);
        
        // Try to get post by path and post type
        $post = get_page_by_path($post_slug, OBJECT, $post_type);
    } else {
        // For regular posts/pages
        $post = get_page_by_path($path, OBJECT, ['post', 'page']);
    }
    
    return $post ? $post->ID : false;
}
