<?php
/*
* Main Plugin class
*/

// No Direct script Allowed
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'VL_CLASS_Main' ) ) {
	/*
	** Create Main Class
	*/
	class VL_CLASS_Main {

		/*
		* Add Slug of the plugin
		*/
		protected $plugin_slug;
		/*
		* Creates Class Constructor
		*/
		public function __construct() {

			$this->plugin_slug = 'video_listing';
			//
			  add_action( 'init', array( $this, 'REGISTER_VL_CPT' ) );
			  add_action( 'init', array( $this, 'REGISTER_TAXONOMY' ) );
			  add_action( 'add_meta_boxes', array( $this, 'videos_add_meta_box' ) );
			  add_action( 'wp_enqueue_scripts', array( $this, 'add_css' ) );
			  add_action( 'save_post', array( $this, 'save_cafe_custom_fields') );
			  add_action( 'new_to_publish', array( $this, 'save_cafe_custom_fields') );
			  add_shortcode( 'video_list' , array( $this, 'video_list' ) );
			}

			/*
			* Add Plugin CSS
			*/
			public function add_css() {
			wp_enqueue_style( 'public_css', VL_DIR_PATH.'/css/vl_style.css' );
			}


			/**
			 * plugin activation 
			 * @see register_activation_hook()
			 */
			public static function activate() {
				add_action( 'init', array( $this, 'REGISTER_VL_CPT' ) );
			}

			/**
			 * plugin deactivation callback
			 * @see register_deactivation_hook()
			 */
			public static function deactivate() {
				flush_rewrite_rules();
			}


			/*
			* Register Post Type on activate
			* @link http://codex.wordpress.org/Function_Reference/register_post_type
			*/
			public function REGISTER_VL_CPT() {
				$labels = array(
				'name' 				=> _x( 'videos', 'Post Type General Name','video_listing' ),
				'singular_name' 	=> _x( 'video', 'Post Type Singular Name', 'video_listing' ),
				'add_new' 			=> __( 'Add New', 'video_listing' ),
				'add_new_item' 		=> __( 'Add New Video', 'video_listing' ),
				'edit_item' 		=> __( 'Edit Video', 'video_listing' ),
				'new_item' 			=> __( 'New Video', 'video_listing' ),
				'view_item' 		=> __( 'View Video', 'video_listing' ),
				'search_items' 		=> __( 'Search Video', 'video_listing' ),
				'not_found' 		=> __( 'No Videos found', 'video_listing' ),
				'not_found_in_trash'=> __( 'No Videos found in Trash', 'video_listing' ),
				'parent_item_colon' => __( 'Parent Video:', 'video_listing' ),
				'menu_name' 		=> __( 'Video', 'video_listing' ),
				);

				$args = array(
				'labels' 			=> $labels,
				'hierarchical' 		=> false,
				'description' 		=> __( 'Videos POST TYPE', 'video_listing' ),
				'supports' 			=> array( 'title' ),
				'taxonomies' 		=> array( 'videos_type' ),
				'show_ui' 			=> true,
				'show_in_menu' 		=> true,
				'menu_position' 	=> 10,
				'menu_icon' 		=> 'dashicons-video-alt3',
				'show_in_nav_menus' => false,
				'publicly_queryable'=> true,
				'exclude_from_search'=> false,
				'query_var' 		=> false,
				'can_export' 		=> true,
				'public' 			=> true,
				'has_archive' 		=> true,
				);  
			register_post_type( 'videos', $args );
				// echo '<script>alert("plugin activated");</script>';
			}


			/*
			* Create Taxonomy
			*/
			public function REGISTER_TAXONOMY() { 
				$arg =  array(  
						'hierarchical' 	=> true,  
						'label' 		=> 'Videos Type',  //Taxonomy Name
						'query_var' 	=> true,
						'rewrite' 		=> array(
											'slug' 		=> 'videos_type', 
											'with_front' => false 
											)
							);
				register_taxonomy( 'videos_type',	'videos', $arg );
			}  


			/*
			* Add Meta Box
			*/
			public function videos_add_meta_box( $post_type ) {
				global $wp_meta_boxes;
				$post_type = 'videos';
				add_meta_box(
					'youtube_id',	// $id
					'Youtube Id',	// $title
					array( $this, 'display_youtube_id' ),	// $callback
					$post_type,	// $page
					'normal',	// $context
					'low'	// $priority
				);
			}


			/* 
			* Display Youtube ID admin
			*/
			public function display_youtube_id() {
				global $post;
				wp_nonce_field( basename( __FILE__ ), 'videos_nonce' );
				// Get youtube id if it's already been added
				$youtube_id = get_post_meta( $post->ID, 'youtube_id', true );
				// Output the youtube ID
				echo '<input type="text" name="youtube_id" value="'. wp_strip_all_tags( $youtube_id ). '">';
			}




			/*
			* Save Youtube Id Custom field
			*/
			public function save_cafe_custom_fields( $post_id ) {

				if ( ! isset( $_POST['youtube_id'] ) || ! wp_verify_nonce( $_POST['videos_nonce'], basename(__FILE__) ) ) {
					return $post_id;
				}
				// This sanitizes the field 
				$youtube_id = wp_strip_all_tags( $_POST['youtube_id'] );
				// Update Post Meta 
				update_post_meta( $post_id, 'youtube_id', $youtube_id );
			}


			/*
			* Display VIdeos Shortcode
			*/
			public function video_list(){
				$list = '';
				$args_vid = array(
				'post_type' => 'videos',
				'posts_per_page' => 1,
				);

				$args_post = array(
				'post_type' => 'videos',
				'posts_per_page' => -1,
				);

				$video_query = new WP_Query( $args_vid );
				$post_query  = new WP_Query( $args_post );

				if ( $video_query->have_posts() && $post_query->have_posts() ) {
					$list .= '<div class="vl_container">';
					while ( $video_query->have_posts() ) : 
					$video_query->the_post(); 

					$list .= '<div class="vl-video-sec">'.
					'<div class="vl-youtube" >'.
					'<iframe src="http://www.youtube.com/embed/'.get_post_meta( get_the_ID(), 'youtube_id', true).
	   				'" width="560" height="315" frameborder="0" allowfullscreen>'.
					'</iframe>'.
					'</div>'.      
					'<h3 class="vl_you_title">'.get_the_title().    
					'</div>';
					endwhile;

					$list .= '<div class="vl-post-sec">';
					while ( $post_query->have_posts() ) : 
					$post_query->the_post(); 

					$list .= '<div class="vl-post" >'.
							'<a href="'.get_permalink().
							'">'.get_the_title().
							'</a>'.
							'</div>';
					endwhile;


					$list .= '</div></div>';
				}
				else{
					$list .= '<h2>No posts found</h2>';
				}
				wp_reset_postdata();
				return $list;
			}



	} // End of class

}

?>