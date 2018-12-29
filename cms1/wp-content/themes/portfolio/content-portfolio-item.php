<?php
/**
 * Template Name: Portfolio item section
 **/
?>
<article class="box post-box row">
  <div class="col-6 bg-dark">
    <?php	the_post_thumbnail('medium_large'); ?>
  </div>
  <div class="col-6 bg-light p-5 d-flex flex-column justify-content-between align-items-end">
    <div class="box-body">
      <h3 class="font-weight-normal"><?php the_title(); ?></h3>
      <?php the_excerpt(); ?>
    </div>
    <a target="_blank" href="<?php echo get_post_meta( $post->ID, 'link_field', true )['text']; ?>" class="btn btn-md btn-outline-secondary font-weight-bold">explore</a>
  </div>
</article>