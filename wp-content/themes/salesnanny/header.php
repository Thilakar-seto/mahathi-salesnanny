<?php
/**
 * Site header: document head, opening of the page shell and the <app-header> navigation.
 *
 * @package Mahathi
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body class="d-flex flex-column">
<?php wp_body_open(); ?>
<app-root>
<div class="container-fluid p-0 flex-grow-1">
  <div>
    <app-header><?php mh_component( 'header', array( 'headerClass' => mh_header_class() ) ); ?></app-header>
  </div>
  <div class="scroll-effects-layer"></div>
