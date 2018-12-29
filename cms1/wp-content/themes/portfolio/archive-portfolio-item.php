<?php /* Template Name: Portfolio Items*/ ?>
<?php get_header(); ?>

<main class="container archive-portfolio-item">

  <?php 
  if ( have_posts() ) : while ( have_posts() ) : the_post();
    get_template_part( 'content-portfolio-item', get_post_format() );

  endwhile; endif; 
  ?>

</main>

<?php get_footer(); ?>