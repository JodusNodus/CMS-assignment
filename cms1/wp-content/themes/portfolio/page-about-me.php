<?php /* Template Name: About Me */ ?>
<?php get_header(); ?>

<main class="container page-about-me">
  <section class="box cover-box row">
    <div class="col-6 bg-dark p-5 d-flex flex-column justify-content-between">
      <h1 class="display-3 font-weight-bold text-serif text-light">Hello, i am</h1>

      <div class="social-links d-flex flex-row">
      <?php
      foreach( wp_get_nav_menu_items('social-links') as $link) {
        ?>
        <a href="<?php echo $link->url; ?>">
          <img src="<?php echo get_bloginfo('template_directory'); ?>/assets/images/<?php echo $link->post_title; ?>-icon.svg">
        </a>
        <?php
      }
      ?>
      </div>
    </div>
    <?php 
    if ( have_posts() ) : while ( have_posts() ) : the_post();
      ?>
      <div class="col-6 bg-light p-5">
        <?php the_content(); ?>

        <h3>
        <?php
        $query = new WP_Query( array('post_type' => 'skill') );
        
        if ( $query->have_posts() ) : ?>
          <?php while ( $query->have_posts() ) : $query->the_post(); ?>	
            <span class="badge badge-secondary text-lowercase"><?php the_title(); ?></span>
          <?php endwhile; wp_reset_postdata(); ?>
        <?php endif; ?>
        </h3>
      </div>
      <?php
    endwhile; else:
    endif;
    ?>
  </section>

</main>

<aside class="container d-flex flex-wrap">
	<?php dynamic_sidebar('sidebar-1'); ?>
</aside>

<?php get_footer(); ?>