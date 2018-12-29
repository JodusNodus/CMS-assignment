<?php /* Template Name: Experience*/ ?>
<?php get_header(); ?>

<main class="container">

  <?php 
  if ( have_posts() ) : while ( have_posts() ) : the_post();
    get_template_part( 'content-experience', get_post_format() );

  endwhile; endif; 
  ?>

</main>

<?php get_footer(); ?>