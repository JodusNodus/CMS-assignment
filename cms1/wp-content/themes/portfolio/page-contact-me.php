<?php /* Template Name: About Me */?>
<?php get_header();?>

<main class="container page-contact-me">
  <?php 
  if ( have_posts() ) : while ( have_posts() ) : the_post();
    ?>
  <section class="box cover-box row">
    <div class="col-6 bg-dark p-5 d-flex flex-column justify-content-between">
      <h1 class="display-3 font-weight-bold text-serif text-light">Get in touch</h1>
    </div>
    <div class="col-6 bg-light p-5">
      <?php the_content(); ?>
    </div>
  </section>
    <?php
  endwhile; else:
  endif;
  ?>
</main>

<?php get_footer();?>