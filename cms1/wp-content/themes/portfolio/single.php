<?php /* Template Name: Blog article */?>
<?php get_header();?>

<main class="container blog-single">
  <?php 
  if ( have_posts() ) : while ( have_posts() ) : the_post();
    ?>
  <article class="box cover-box row bg-light">
    <header class="text-light" style="background: linear-gradient( rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6) ), url(<?php echo get_the_post_thumbnail_url($post->ID, 'large');?>) no-repeat">
      <div class="header-text pb-4">
        <h1 class="font-weight-bold"><?php the_title(); ?></h1>
        <p><?php the_tags( 'Topics: ', ', '); ?></p>
        <p><?php the_date(); ?></p>
      <div>
    </header>
    <div class="col-12 paper pt-4">
      <?php the_content(); ?>
    </div>
  </article>
  <?php
  if ( comments_open() || get_comments_number() ) :
    comments_template();
  endif;
  ?>

    <?php
  endwhile; else:
  endif;
  ?>
</main>

<?php get_footer();?>