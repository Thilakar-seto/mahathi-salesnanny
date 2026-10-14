<?php
/**
 * Site footer: <app-footer>, the contact popup and the closing of the page shell.
 *
 * @package Mahathi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
  <div>
    <app-footer><?php mh_component( 'footer' ); ?></app-footer>
  </div>
</div>
</app-root>
<?php mh_component( 'contact-popup' ); ?>
<?php wp_footer(); ?>
</body>
</html>
