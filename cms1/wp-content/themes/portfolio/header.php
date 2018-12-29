<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="<?php echo get_bloginfo( 'admin_email' ); ?>" />
    <title><?php echo get_bloginfo( 'name' ); ?></title>
    <meta name="description" content="<?php echo get_bloginfo( 'description' ); ?>">

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>
    <div class="polygon">
      <svg preserveAspectRatio="none" viewBox="0 0 100 100">
        <polygon points="0,0 100,0 100,0 0,100" opacity="1"></polygon>
      </svg>
    </div>
    <nav class="container pt-4 pb-2">
      <?php
      $custom_logo_id = get_theme_mod('custom_logo');
      $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
      if (has_custom_logo()) {
          echo '<img class="logo" src="' . esc_url($logo[0]) . '">';
      }
      ?>
      <?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container_class' => 'text-dark font-weight-bold text-lowercase', 'menu_class' => '' ) ); ?>
    </nav>
