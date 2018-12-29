<?php
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-logo' );

function enqueue_scripts() {
	wp_enqueue_style( 'fonts', 'https://fonts.googleapis.com/css?family=Aleo|Lato:300,400,700,900',false,'1.0.0','all');
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css',false,'4.1.3','all');
	wp_enqueue_style( 'portfolio', get_template_directory_uri() . '/portfolio.css',false,'1.0.0','all');

	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/assets/js/jquery.js', array ( 'jquery' ), '3.3.1', true);
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.js', false, 1.1, true);
}

add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );

/**
 * Menus
 */
function register_menu_locations() {
	register_nav_menus(
		array(
			'primary-menu' => __('Primary Menu'),
      'social-links' => __('Social Links'),
		)
  );
}
add_action( 'init', 'register_menu_locations' );

/**
 * Sidebar
 */
function register_sidebar_locations() {
	register_sidebars(2,
		array(
			'before_widget' => '<section id="%1$s" class="box widget-box bg-light p-4 %2$s">',
			'after_widget'  => "</section>\n",
			'before_title'  => '<h4 class="font-weight-bold">',
			'after_title'   => "</h4>\n",
		)
	);
}

add_action('widgets_init', 'register_sidebar_locations');

/**
 * Experience Custom Post
 */
function experience_init() {
	$args = array(
		'label' => 'Experience',
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'exclude_from_search' => true,
		'hierarchical' => false,
		'rewrite' => array('slug' => 'experience'),
		'query_var' => true,
		'menu_icon' => 'dashicons-welcome-learn-more',
		'has_archive' => true,
		'supports' => array(
				'title',
				'editor',
				'custom-fields',
				'revisions',
				'thumbnail',
				'page-attributes',)
		);
	register_post_type( 'experience', $args );
}
add_action( 'init', 'experience_init' );

// custom fields
function add_experience_fields_meta_box() {
	add_meta_box(
		'experience_fields_meta_box', // $id
		'Information', // $title
		'show_experience_fields_meta_box', // $callback
		'experience', // $screen
		'normal', // $context
		'high' // $priority
	);
}
add_action( 'add_meta_boxes', 'add_experience_fields_meta_box' );

function show_experience_fields_meta_box() {
	global $post;  
		$metaPeriode = get_post_meta( $post->ID, 'periode_field', true );
		$metaPlace = get_post_meta( $post->ID, 'place_field', true ); ?>

	<input type="hidden" name="your_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

	<p>
    <label for="periode_field[text]">Periode</label>
    <br>
    <input type="text" name="periode_field[text]" id="periode_field[text]" class="regular-text" value="<?php if (is_array($metaPeriode) && isset($metaPeriode['text'])) {	echo $metaPeriode['text']; } ?>">
  </p>

	<p>
    <label for="place_field[text]">Place</label>
    <br>
    <input type="text" name="place_field[text]" id="place_field[text]" class="regular-text" value="<?php if (is_array($metaPlace) && isset($metaPlace['text'])) {	echo $metaPlace['text']; } ?>">
  </p>


	<?php }

function updateExperienceField($post_id, $field) {
	$old = get_post_meta( $post_id, $field, true );
	$new = $_POST[$field];

	if ( $new && $new !== $old ) {
		update_post_meta( $post_id, $field, $new );
	} elseif ( '' === $new && $old ) {
		delete_post_meta( $post_id, $field, $old );
	}
}

function save_experience_meta_fields( $post_id ) {   
	// verify nonce
	if ( !wp_verify_nonce( $_POST['your_meta_box_nonce'], basename(__FILE__) ) ) {
		return $post_id; 
	}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if ( 'page' === $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}  
	}
	
	updateExperienceField($post_id, 'periode_field');
	updateExperienceField($post_id, 'place_field');
}
add_action( 'save_post', 'save_experience_meta_fields' );


/**
 * Portfolio item Custom Post
 */
function portfolio_item_init() {
	$args = array(
		'label' => 'Portfolio Item',
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'exclude_from_search' => true,
		'hierarchical' => false,
		'rewrite' => array('slug' => 'portfolio-item'),
		'query_var' => true,
		'menu_icon' => 'dashicons-portfolio',
		'has_archive' => true,
		'supports' => array(
				'title',
				'editor',
				'custom-fields',
				'revisions',
				'thumbnail',
				'page-attributes',)
		);
	register_post_type( 'portfolio-item', $args );
}
add_action( 'init', 'portfolio_item_init' );

// custom fields
function add_portfolio_item_fields_meta_box() {
	add_meta_box(
		'portfolio_item_fields_meta_box', // $id
		'Information', // $title
		'show_portfolio_item_fields_meta_box', // $callback
		'portfolio-item', // $screen
		'normal', // $context
		'high' // $priority
	);
}
add_action( 'add_meta_boxes', 'add_portfolio_item_fields_meta_box' );

function show_portfolio_item_fields_meta_box() {
	global $post;  
		$metaLink = get_post_meta( $post->ID, 'link_field', true );?>

	<input type="hidden" name="your_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

	<p>
    <label for="link_field[text]">Link</label>
    <br>
    <input type="link" name="link_field[text]" id="link_field[text]" class="regular-text" value="<?php if (is_array($metaLink) && isset($metaLink['text'])) {	echo $metaLink['text']; } ?>">
  </p>

	<?php }

function save_portfolio_item_meta_fields( $post_id ) {   
	// verify nonce
	if ( !wp_verify_nonce( $_POST['your_meta_box_nonce'], basename(__FILE__) ) ) {
		return $post_id; 
	}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if ( 'page' === $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		} elseif ( !current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}  
	}
	
	updateExperienceField($post_id, 'link_field');
}
add_action( 'save_post', 'save_portfolio_item_meta_fields' );

/**
 * Skills
 */
function skill_init() {
	$args = array(
		'label' => 'Skills',
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'exclude_from_search' => true,
		'hierarchical' => false,
		'rewrite' => array('slug' => 'skill'),
		'query_var' => true,
		'menu_icon' => 'dashicons-hammer',
		'has_archive' => true,
		'supports' => array(
				'title',
				'revisions',
				'page-attributes',)
		);
	register_post_type( 'skill', $args );
}
add_action( 'init', 'skill_init' );

/**
 * Exclude pages from posts
 */
if (!is_admin()) {
	function wpb_search_filter($query){
		if ($query->is_search) {
				$query->set('post_type', 'post');
		}
		return $query;
	}
	add_filter('pre_get_posts', 'wpb_search_filter');
}

