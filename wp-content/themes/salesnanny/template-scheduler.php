<?php
/**
 * Template Name: Full Width Scheduler
 * Template Post Type: page
 */

get_header(); ?>
<?php wp_head(); ?>

<div class="wpts-hyper-modern-wrapper">
    <main id="wpts-scheduler-container">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
                the_content();
            endwhile;
        endif;
        ?>
    </main>
</div>
<script>
  window.addEventListener('beforeunload', function (e) {
    // Cancel the event
    e.preventDefault();

    // Chrome requires returnValue to be set
    e.returnValue = '';

    // The browser will show a generic message (you can't customize it)
    return '';
  });
</script>
<?php wp_footer(); ?>
<?php get_footer(); ?>