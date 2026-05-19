<?php
/**
 * Main template file
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php wp_enqueue_scripts(); ?>
</head>
<body>
    <main>
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                ?>
                <article>
                    <h1><?php the_title(); ?></h1>
                    <?php the_content(); ?>
                </article>
                <?php
            endwhile;
        endif;
        ?>
    </main>
</body>
</html>