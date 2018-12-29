<?php get_header(); ?>

<aside class="container d-flex flex-wrap">
	<?php dynamic_sidebar('sidebar-2'); ?>
</aside>

<main class="container page-blog">

  <?php 
  if ( have_posts() ) : while ( have_posts() ) : the_post();
    get_template_part( 'content-blog', get_post_format() );

  endwhile; endif; 
  ?>

</main>

<?php get_footer(); ?>