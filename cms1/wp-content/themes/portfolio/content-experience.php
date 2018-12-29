<?php
/**
 * Template Name: Experience section
 **/
?>
<article class="box post-box row">
  <div class="col-6 bg-dark">
    <?php	the_post_thumbnail('medium_large'); ?>
  </div>
  <div class="col-6 bg-light p-5 d-flex flex-column justify-content-between align-items-end">
    <div class="box-body">
      <h3 class="font-weight-normal"><?php the_title(); ?></h3>
      <p class="text-muted font-weight-normal">
        <?php echo get_post_meta( $post->ID, 'place_field', true )['text']; ?>
        (<?php echo get_post_meta( $post->ID, 'periode_field', true )['text']; ?>)
      </p>
      <?php the_excerpt(); ?>
    </div>
  </div>
</article>