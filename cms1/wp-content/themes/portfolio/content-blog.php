<article class="box post-box row">
  <div class="col-6 bg-dark">
    <?php	the_post_thumbnail('medium_large'); ?>
  </div>
  <div class="col-6 bg-light p-5 d-flex flex-column justify-content-between align-items-end">
    <div class="box-body">
      <h4 class="font-weight-normal"><?php the_title(); ?></h4>
      <p class="text-muted"><?php the_date(); ?></p>
      <?php the_excerpt(); ?>
    </div>
    <a href="<?php the_permalink(); ?>" class="btn btn-md btn-outline-secondary font-weight-bold">read more</a>
  </div>
</article>