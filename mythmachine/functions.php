<?php
//
// Recommended way to include parent theme styles.
//  (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
//  
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}

include ('infusion_settings.php');

// hide toolbar all users
add_action('after_setup_theme', 'remove_admin_bar');
 
function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
  show_admin_bar(false);
}
}
//Logout Redirect
add_action('wp_logout',create_function('','wp_redirect(home_url());exit();'));
 


//
// Your code goes below
//
add_theme_support('category-thumbnails');

add_filter('body_class', 'modify_body_classes', 20);
function modify_body_classes( $classes ) {
  if( is_buddypress()) {
    $remove_classes = array('et_right_sidebar', 'et_left_sidebar', 'et_includes_sidebar');
    foreach( $classes as $key => $value ) {
      if ( in_array( $value, $remove_classes ) ) unset( $classes[$key] );
    }
    $classes[] = 'et_full_width_page';
  }
  return $classes;
}

// Change Profile menu/tab order 
function rt_change_profile_tab_order() {
global $bp;

$bp->bp_nav['profile']['name'] = 'my profile';
//$bp->bp_nav['groups']['name'] = 'my fandoms';
bp_core_remove_nav_item( 'groups' );

}
add_action( 'bp_setup_nav', 'rt_change_profile_tab_order', 999 );

//For My Books
function profile_tab_yourtabname() {
      global $bp;
 
      bp_core_new_nav_item( array( 
            'name' => 'my books', 
            'slug' => 'books', 
            'screen_function' => 'books_screen', 
            'position' => 40,
            'parent_url'      => bp_loggedin_user_domain() . '/books/',
            'parent_slug'     => $bp->profile->slug,
            'default_subnav_slug' => 'books'
      ) );
}
add_action( 'bp_setup_nav', 'profile_tab_yourtabname' );
function books_screen(){
   add_action( 'bp_template_content', 'book_content' );
   bp_core_load_template( 'buddypress/members/single/plugins' );
  
   
}
function book_content() { 
    bp_get_template_part( 'members/single/my-books');
  
}


//For Reader My Avatar
function my_avatar_show() {
   if ( user_can( bp_displayed_user_id(), 'subscriber' ) ) {
      global $bp;
 
      bp_core_new_nav_item( array( 
            'name' => 'my avatar', 
            'slug' => 'myavatar',
            'screen_function' => 'my_avatar', 
            'position' => 80,
            'parent_url'      => bp_loggedin_user_domain() . '/myavatar/',
            'parent_slug'     => $bp->profile->slug,
            'default_subnav_slug' => 'avatar',
      ) );
}
}
add_action( 'bp_setup_nav', 'my_avatar_show' );
function my_avatar(){
   add_action( 'bp_template_content', 'my_avatar_content' );
   bp_core_load_template( 'buddypress/members/single/plugins' );
  
}
function my_avatar_content() { 
    bp_get_template_part( 'members/single/myavatar'   );
  
}

//For Reader Become Author
function become_author_show() {
   if ( user_can( bp_displayed_user_id(), 'subscriber' ) ) {
      global $bp;
 
      bp_core_new_nav_item( array( 
            'name' => 'Become Author', 
            'slug' => 'become-author',
            'screen_function' => 'become_author', 
            'position' => 80,
            'parent_url'      => bp_loggedin_user_domain() . '/become-author/',
            'parent_slug'     => $bp->profile->slug,
            'default_subnav_slug' => 'become-author',
      ) );
}
}
add_action( 'bp_setup_nav', 'become_author_show' );
function become_author(){
   add_action( 'bp_template_content', 'become_author_content' );
   bp_core_load_template( 'buddypress/members/single/plugins' );
  
}
function become_author_content() { 
    bp_get_template_part( 'members/single/become-author'   );
  
}


//For SUbmit Blog
function submit_blog_show() {
   if ( user_can( bp_displayed_user_id(), 'author' ) ) {
      global $bp;
 
      bp_core_new_nav_item( array( 
            'name' => 'submit blog', 
            'slug' => 'submit-blog',
            'screen_function' => 'submit_blog', 
            'position' => 20,
            'parent_url'      => bp_loggedin_user_domain() . '/submit-blog/',
            'parent_slug'     => $bp->profile->slug,
            'default_subnav_slug' => 'submit-blog',
      ) );
}
}
add_action( 'bp_setup_nav', 'submit_blog_show' );
function submit_blog(){
   add_action( 'bp_template_content', 'submit_blog_content' );
   bp_core_load_template( 'buddypress/members/single/plugins' );  
}
function submit_blog_content() { 
     bp_get_template_part( 'members/single/submit-blog'   );  
}


//Submit Book
function submit_book_show() {
   if ( user_can( bp_displayed_user_id(), 'author' ) ) {
      global $bp;
 
      bp_core_new_nav_item( array( 
            'name' => 'submit book', 
            'slug' => 'submit-book',
            'screen_function' => 'submit_book', 
            'position' => 30,
            'parent_url'      => bp_loggedin_user_domain() . '/submit-book/',
            'parent_slug'     => $bp->profile->slug,
            'default_subnav_slug' => 'submit-book',
      ) );
}
}
add_action( 'bp_setup_nav', 'submit_book_show' );
function submit_book(){
   add_action( 'bp_template_content', 'submit_book_content' );
   bp_core_load_template( 'buddypress/members/single/plugins' );
   
}
function submit_book_content() { 
     bp_get_template_part( 'members/single/submit-book'   );
}

//Manage Book
function manage_book_show() {
   if ( user_can( bp_displayed_user_id(), 'author' ) ) {
      global $bp;
 
      bp_core_new_nav_item( array( 
            'name' => 'manage book', 
            'slug' => 'manage-book',
            'screen_function' => 'manage_book', 
            'position' => 40,
            'parent_url'      => bp_loggedin_user_domain() . '/manage-book/',
            'parent_slug'     => $bp->profile->slug,
            'default_subnav_slug' => 'manage-book',
      ) );
}
}
add_action( 'bp_setup_nav', 'manage_book_show' );
function manage_book(){
  add_action( 'bp_template_content', 'manage_book_content' );
   bp_core_load_template( 'buddypress/members/single/plugins' );
   
}
function manage_book_content() { 
    bp_get_template_part( 'members/single/manage-book'   );
}


//Book Stats
function book_stats_show() {
   if ( user_can( bp_displayed_user_id(), 'author' ) ) {
      global $bp;
 
      bp_core_new_nav_item( array( 
            'name' => 'book stats', 
            'slug' => 'book-stats',
            'screen_function' => 'book_stats', 
            'position' => 50,
            'parent_url'      => bp_loggedin_user_domain() . '/book-stats/',
            'parent_slug'     => $bp->profile->slug,
            'default_subnav_slug' => 'book-stats',
      ) );
}
}
add_action( 'bp_setup_nav', 'book_stats_show' );
function book_stats(){
  add_action( 'bp_template_content', 'book_stats_content' );
   bp_core_load_template( 'buddypress/members/single/plugins' );
  
}
function book_stats_content() { 
     bp_get_template_part( 'members/single/book-stats'   );
}

//Advertise
function advertise_show(){
    if ( user_can( bp_displayed_user_id(), 'author' ) ) {
      global $bp;
      bp_core_new_nav_item( array( 
        'name' => 'advertise', 
        'slug' => 'advertise', 
      'position' => 60,
            'screen_function' => 'advertise', 
      'parent_url'      => bp_loggedin_user_domain() . '/advertise/',
       'parent_slug'     => $bp->profile->slug,
      'default_subnav_slug' => 'advertise'
      ) );
}
}
add_action( 'bp_setup_nav', 'advertise_show' );
function advertise(){
  add_action( 'bp_template_content', 'advertise_content' );
   bp_core_load_template( 'buddypress/members/single/plugins' );
  
}
function advertise_content() { 
     bp_get_template_part( 'members/single/advertise'   );
}


//Billing
function billing_show(){
    if ( user_can( bp_displayed_user_id(), 'author' ) ) {
      global $bp;
      bp_core_new_nav_item( array( 
        'name' => 'billing', 
        'slug' => 'billing', 
      'position' => 70,
            'screen_function' => 'billing', 
      'parent_url'      => bp_loggedin_user_domain() . '/billing/',
       'parent_slug'     => $bp->profile->slug,
      'default_subnav_slug' => 'billing'
      ) );
}
}
add_action( 'bp_setup_nav', 'billing_show' );
function billing(){
  add_action( 'bp_template_content', 'billing_content' );
   bp_core_load_template( 'buddypress/members/single/plugins' );
   
}
function billing_content() { 
    bp_get_template_part( 'members/single/billing'   );
}

//Fandoms AUTHOR
function fandom_show(){
   if ( user_can( bp_displayed_user_id(), 'author' ) ) {
      global $bp;
      bp_core_new_nav_item( array( 
        'name' => 'fandoms', 
        'slug' => 'fandom', 
      'position' => 80,
            'screen_function' => 'fandom', 
      'parent_url'      => bp_loggedin_user_domain() . '/fandom/',
       'parent_slug'     => $bp->profile->slug,
      'default_subnav_slug' => 'fandom'
      ) );
}
}
add_action( 'bp_setup_nav', 'fandom_show' );
function fandom(){
  add_action( 'bp_template_content', 'fandom_content' );
   bp_core_load_template( 'buddypress/members/single/plugins' );  
}
function fandom_content() { 
  bp_get_template_part( 'members/single/fandoms'   ); 
}


//Fandoms READER
function fandom_show_reader(){
   if ( user_can( bp_displayed_user_id(), 'subscriber' ) ) {
      global $bp;
      bp_core_new_nav_item( array( 
        'name' => 'my fandoms', 
        'slug' => 'fandom', 
      'position' => 40,
            'screen_function' => 'fandom', 
      'parent_url'      => bp_loggedin_user_domain() . '/fandom/',
       'parent_slug'     => $bp->profile->slug,
      'default_subnav_slug' => 'fandom'
      ) );
}
}
add_action( 'bp_setup_nav', 'fandom_show_reader' );



//Request
function request_show(){
    if ( user_can( bp_displayed_user_id(), 'author' ) ) {
      global $bp;
      bp_core_new_nav_item( array( 
        'name' => 'request', 
        'slug' => 'request', 
      'position' =>90,
            'screen_function' => 'request', 
      'parent_url'      => bp_loggedin_user_domain() . '/request/',
       'parent_slug'     => $bp->profile->slug,
      'default_subnav_slug' => 'request'
      ) );
}
}
add_action( 'bp_setup_nav', 'request_show' );
function request(){
  add_action( 'bp_template_content', 'request_content' );
   bp_core_load_template( 'buddypress/members/single/plugins' );
   
}
function request_content() { 
 bp_get_template_part( 'members/single/request'   );
}

// Creates Books Add Custom Post Type
function books_init() {
    $args = array(
      'label' => 'Books',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'books'),
        'query_var' => true,
        //'menu_icon' => 'dashicons-video-alt',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes',),
      'taxonomies'  => array( 'bookcategory'),
        );
    register_post_type( 'books', $args );
}
add_action( 'init', 'books_init' );

//new
register_taxonomy('bookcategory', 'books',
          array("hierarchical" => true,
              "label" => "Book Category",
              "singular_label" => "book category",
              'update_count_callback' => '_update_post_term_count',
              'query_var' => true,
              'rewrite' => array( 'slug' => 'bookcategory', 
              'with_front' => true ),
              'public' => true,
              'show_ui' => true,
              'show_tagcloud' => true,
              '_builtin' => false,
              'show_in_nav_menus' => false
        ));
        
        
// Creates Shop Add Custom Post Type
function fandom_init() {
    $args = array(
      'label' => 'Fandom',
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => array('slug' => 'fandom'),
        'query_var' => true,
        'menu_icon' => 'dashicons-video-alt',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'trackbacks',
            'custom-fields',
            'comments',
            'revisions',
            'thumbnail',
            'author',
            'page-attributes',),
      'taxonomies'  => array( 'fandom_category'),
        );
    register_post_type( 'fandom', $args );
}
add_action( 'init', 'fandom_init' );

//new
register_taxonomy('fandom_category', 'fandom',
          array("hierarchical" => true,
              "label" => "Fandom Category",
              "singular_label" => "Fandom category",
              'update_count_callback' => '_update_post_term_count',
              'query_var' => true,
              'rewrite' => array( 'slug' => 'fandom_category', 
              'with_front' => true ),
              'public' => true,
              'show_ui' => true,
              'show_tagcloud' => true,
              '_builtin' => false,
              'show_in_nav_menus' => false,
              'show_admin_column' => true,
        )); 

function my_et_builder_post_types( $post_types ) {
    $post_types[] = 'fandom';
         
    return $post_types;
}
add_filter( 'et_builder_post_types', 'my_et_builder_post_types' );

function remove_nav_items() {
$current_user   = wp_get_current_user();
    $role_name      = $current_user->roles[0];
    if($role_name==='author'){
    bp_core_remove_nav_item( 'books' );
    bp_core_remove_nav_item( 'groups' );

}
}
add_action( 'bp_setup_nav', 'remove_nav_items');


function my_post_form() {
    $settings = array(
        'post_type' => 'post',
        //which post type
        'post_author'           =>  bp_loggedin_user_id(),
        //who will be the author of the submitted post
        'post_status'           => 'draft',
        //how the post should be saved, change it to 'publish' if you want to make the post published automatically
        'tax' => array(
            'category' => array(
                'include' => array(), //category ids
                'view_type' => 'radio',
            )
        ),
    
    'current_user_can_post' =>  is_user_logged_in(),

        //who can post
        'show_categories'       => true,
        //whether to show categories list or not, make sure to keep it true
        'show_comment_option'  => false,  
    'allow_upload' => true
    
    );
 
    $form = bp_new_simple_blog_post_form( 'post form', $settings );
    //create a Form Instance and register it
}
 
add_action( 'bp_init', 'my_post_form', 4 );//register a form




//BP Code
/**
 * Register a custom Form
 *
 */
 $form = bp_new_simple_blog_post_form( $form_name, $settings );
 
function my_book_form() {
    $settings = array(
        'post_type' => 'books',
        //which post type
        'post_author'           =>  bp_loggedin_user_id(),
        //who will be the author of the submitted post
        'post_status'           => 'draft',
        //how the post should be saved, change it to 'publish' if you want to make the post published automatically
        'tax' => array(
            'bookcategory' => array(
                'include' => array(), //category ids
                'view_type' => 'radio',
            )
        ),
      'custom_fields'       => array(
             'Docx_file' => array( 'type' => 'textbox', 'id' => 'doc_file', 'name' => 'doc_file', 'label'=> 'Upload Book (.docx only)', )
        ),
    
    'current_user_can_post' =>  is_user_logged_in(),

        //who can post
        'show_categories'       => true,
        //whether to show categories list or not, make sure to keep it true
        'show_comment_option'  => false,  
    'allow_upload' => true
    
    );
 
    $form = bp_new_simple_blog_post_form( 'book form', $settings );
    //create a Form Instance and register it
}
 
add_action( 'bp_init', 'my_book_form', 4 );//register a form

//For feature Image


//DashBoard Page
function profile_tab_dashboard() {
      global $bp;
 
      bp_core_new_nav_item( array( 
            'name' => 'Dashboard', 
            'slug' => 'dashboard', 
            'screen_function' => 'dashboard_screen', 
            'position' => 10,
      'parent_url'      => bp_displayed_user_domain()  . '/dashboard/',
      'parent_slug'     => $bp->profile->slug,
      'default_subnav_slug' => 'dashboard'
      ) );
}
add_action( 'bp_setup_nav', 'profile_tab_dashboard' );
 
 
function dashboard_screen() {
    //add title and content here - last is to call the members plugin.php template
    //add_action( 'bp_template_title', 'dashboard_title' );
    add_action( 'bp_template_content', 'dashboard_content' );
    bp_core_load_template( 'buddypress/members/single/plugins' );
}

function dashboard_content() { 
$current_user   = wp_get_current_user();
    $role_name      = $current_user->roles[0];
    if($role_name==='subscriber'){ 
    bp_get_template_part( 'members/single/reader-dashboard'   );
  }
  else if($role_name==='author'){
    bp_get_template_part( 'members/single/author-dashboard'   );
  }
}

//For Group Types
function my_bp_custom_group_types() {
    bp_groups_register_group_type( 'team', array(
        'labels' => array(
            'name' => 'Teams',
            'singular_name' => 'Team'
        ),
 
        // New parameters as of BP 2.7.
        'has_directory' => 'teams',
        'show_in_create_screen' => true,
        'show_in_list' => true,
        'description' => 'Teams are good',
        'create_screen_checked' => true
    ) );
}
add_action( 'bp_groups_register_group_types', 'my_bp_custom_group_types' );



//register member types
 
add_action( 'bp_register_member_types', 'buddydev_register_member_types' );
 
function buddydev_register_member_types() {
  
   bp_register_member_type( 'Reader', array(
        'labels' => array(
            'name'            => __( 'Readers' ),
            'singular_name'    => __( 'Reader' )
        ), 
    'has_directory'    => 'reader',
    ) );
 
    bp_register_member_type( 'Author', array(
        'labels' => array(
            'name'            => __( 'Authors' ),
            'singular_name'    => __( 'Author' )
        ),
        'has_directory'    => 'author',//can be given a slug that will be appended to member directory to list all users of this type    
    ) );

}

add_action( 'gform_after_submission_3', 'set_post_content', 10, 2 );
add_action( 'gform_after_submission_4', 'set_post_content', 10, 2 );
function set_post_content( $entry, $form ) {
    //getting post
   $post = get_post( $entry['post_id'] );
   $ptitle = $post->post_title;
   $pexcerpt = $post->post_content;
   $pauthor = $post->post_author;
   $pguid = $post->guid;


   $thumbid = get_post_thumbnail_id($entry['post_id']);
   $post_thumb = get_post( $thumbid );
   $thumb_name = $post_thumb->post_title;
   $thumb_guid = $post_thumb->guid;
   $thumb_post_mime_type = $post_thumb->post_mime_type;
   $thumb_post_author = $post_thumb->post_author;
    $book_doc = $entry[22];

   $text = print_r($entry, true);
    echo "<script type='text/javascript'>console.log(".json_encode($text).") </script>";

      global $wpdb;
// Set Member Type 
      bp_set_member_type( $pauthor, 'author' );
      xprofile_set_field_data ('Tipo', $pauthor, 'author' );

// Upload avatar attachment to media
      $wp_upload_dir = wp_upload_dir();
      require_once(ABSPATH . 'wp-admin/includes/file.php');
      require_once(ABSPATH . 'wp-admin/includes/image.php');
      require_once(ABSPATH . 'wp-admin/includes/media.php');
      $avatar = $entry[34];
      if( $avatar ){
        $avext = pathinfo($avatar, PATHINFO_EXTENSION);
          if ( $avext == 'png' ) {
            $avmitype = "image/png";
          }
          if ( $avext == 'jpg' || $avext == 'jpeg' ) {
            $avmitype = "image/jpeg";
          }
      $attachment = array(
        'guid' => $wp_upload_dir['url'] . '/' . basename( $avatar ),
        'post_mime_type' => $avmitype,
        'post_title' => preg_replace('/\.[^.]+$/', '', basename($avatar)),
      );

      $attach_id = wp_insert_attachment($attachment, $avatar);

      $attach_data = wp_generate_attachment_metadata($attach_id, $avatar);

      wp_update_attachment_metadata($attach_id, $attach_data);
      $q = array(
                'author' => $pauthor,
                'post_type' => 'attachment',
                'post_status' => 'inherit',
                'posts_per_page' => '-1',
                'meta_query' => array(
                  array(
                    'key' => '_wp_attachment_wp_user_avatar',
                    'value' => "",
                    'compare' => '!='
                  )
                )
              );
              $avatars_wp_query = new WP_Query($q);
              while($avatars_wp_query->have_posts()) : $avatars_wp_query->the_post();
                wp_delete_attachment($post->ID);
              endwhile;
              wp_reset_query();
               //Remove old attachment postmeta
              delete_metadata('post', null, '_wp_attachment_wp_user_avatar', $pauthor, true);
              // Create new attachment postmeta
              update_post_meta($attach_id, '_wp_attachment_wp_user_avatar', $pauthor);
              // Update usermeta
              update_user_meta($pauthor, 'wphp_user_avatar', $attach_id);
      //echo "<script>alert('PHP: ".$attach_id."');</script>";
    }
/*
Book submit On downloads
*/      
        $book_field = $entry[41];
     //   echo "<script>alert('PHP: ".$book_field."');</script>";
        if( $book_field ){
        $download_id = $entry['post_id'];
        $download_files = array();
        $file_id        = 1;
        $book_url = $book_field;
        $download_file_args = array(
          'file' => $book_url,
          'name' => basename( $book_url ),
        );
        $download_files[ $file_id ] = $download_file_args;
        update_post_meta( $download_id, 'edd_download_files', $download_files );
      }
      else{
        $book_url = "";
      }  

// Insert in Book post type
$wpdb->insert( 
  'wphp_posts', 
  array( 
    'post_type' => 'books', 
    'post_status' => 'draft', 
    'post_author' => $pauthor, 
    'post_title' => $ptitle, 
    'post_excerpt' => $pexcerpt,  
  ), 
  array( 
    '%s', 
    '%s', 
    '%s', 
    '%s', 
    '%s', 
  ) 
);
$lastid = $wpdb->insert_id;

//Insert Category On book POst type 
  $dload_cat = $entry[19];
  if( $dload_cat ){
  $dloadcat = get_term_by('id', $dload_cat, 'download_category');
  $dloadcat_slug = $dloadcat->slug;

  $book_cat_array = get_term_by('slug', $dloadcat_slug, 'bookcategory');
  $book_cat_id = $book_cat_array->term_id;
  $wpdb->insert( 
    'wphp_term_relationships', 
    array( 
      'object_id' => $lastid, 
      'term_taxonomy_id' => $book_cat_id,
      'term_order' => 0,  
    ), 
    array( 
      '%d', 
      '%d', 
      '%d', 
    ) 
  );
}

$wpdb->insert( 
  'wphp_posts', 
  array( 
    'post_type' => 'attachment', 
    'post_status' => 'inherit', 
    'post_author' => $thumb_post_author, 
    'post_title' => $thumb_name, 
    'post_name' => $thumb_name, 
    'post_parent' => $lastid, 
    'guid' => $thumb_guid, 
    'post_mime_type' => $thumb_post_mime_type,  
  ), 
  array( 
    '%s', 
    '%s', 
    '%d', 
    '%s', 
    '%s', 
    '%d', 
    '%s', 
    '%s', 
  ) 
);
$lastidthumb = $wpdb->insert_id;
$wpdb->insert( 
  'wphp_postmeta', 
  array( 
    'post_id' => $lastid, 
    'meta_key' => '_thumbnail_id',
    'meta_value' => $lastidthumb,  
  ), 
  array( 
    '%d', 
    '%s', 
    '%d', 
  ) 
);


$pkey = get_post_meta($thumbid);
  $thumbdata =  $pkey['_wp_attachment_metadata'][0];
   $thumbfile =  $pkey['_wp_attached_file'][0];


$wpdb->insert( 
  'wphp_postmeta', 
  array( 
    'post_id' => $lastidthumb, 
    'meta_key' => '_wp_attached_file', 
    'meta_value' => $thumbfile, 
  ), 
  array( 
    '%s', 
    '%s', 
  ) 
);
$wpdb->insert( 
  'wphp_postmeta', 
  array( 
    'post_id' => $lastidthumb, 
    'meta_key' => '_wp_attachment_metadata', 
    'meta_value' => $thumbdata, 
  ), 
  array( 
    '%s', 
    '%s', 
  ) 
);
$wpdb->insert( 
  'wphp_postmeta', 
  array( 
    'post_id' => $lastid, 
    'meta_key' => 'book_file',
    'meta_value' => $book_doc,  
  ), 
  array( 
    '%d', 
    '%s', 
    '%s', 
  ) 
);
}

//set member type EDD Auto Register
add_action("edd_auto_register_insert_user",'edd_member_type', 10, 3);
function edd_member_type($user_id, $user_args, $payment_id){

  $member_type = 'reader';  //set member type Auto Register Plugin
  bp_set_member_type( $user_id, $member_type );
  xprofile_set_field_data ('Tipo', $user_id, $member_type );

}

//set member type
add_action("APSL_createUser",'try_the_hook');
function try_the_hook($user_id){
 global $wpdb;
$wpdb->insert( 
  'wphp_term_relationships', 
  array( 
    'object_id' => $user_id, 
    'term_taxonomy_id' => 20
  ), 
  array( 
    '%d', 
    '%d' 
  ) 
);
}

//add_action( 'user_register', 'buddydev_assign_member_type_on_registration', 10, 1 );

//set default member type
function buddydev_assign_member_type_on_registration( $user_id ) {

  // // replace =gender with your field name
  // $current_user   = wp_get_current_user();
 //    $role_name      = $current_user->roles[0];
 //    if($role_name ==='subscriber'){
    
  //    bp_set_member_type( $user_id, 'reader' );
  //    xprofile_set_field_data ('Tipo', $user_id, 'reader' );
 //      xprofile_set_field_data ('member_type', $user_id, 'reader' );

  // }
  /*
  * Start Add to InfusionSoft
  */
  $user_info = get_userdata($user_id);
  $userEmail = $user_info->user_email;
  $userFirst = $_POST['field_1'];
  $api_settings = get_option('Infusion_api_option');
  require_once ('vendor/autoload.php');
  $infusionsoft = new Infusionsoft\Infusionsoft(array(
      'clientId' => $api_settings['client_id'],
      'clientSecret' => $api_settings['client_secret'],
      'redirectUri' => 'https://mythmachine.com/',
  ));
  $stored_token = get_option("stored_tokensss",true);
  if ($stored_token) {
      $infusionsoft->setToken(unserialize($stored_token));
  }
  if (isset($_GET['code']) and !$infusionsoft->getToken()) {
      $infusionsoft->requestAccessToken($_GET['code']);
  }
  if ($infusionsoft->getToken()) {
      try {
          $email = $userEmail;
          try {
              $cid = $infusionsoft->contacts()->where('email', $email)->first();
          } catch (\Infusionsoft\InfusionsoftException $e) {
              $cid = add_user_new($infusionsoft, $email, $userFirst);
          }
      } catch (\Infusionsoft\TokenExpiredException $e) {
          $infusionsoft->refreshAccessToken();
          $cid = add_user_new($infusionsoft, $email, $userFirst);
      }
      $contact = $infusionsoft->contacts()->with('custom_fields')->find($cid->id);
     // var_dump($contact->toArray());
      $new_token = $infusionsoft->getToken();
      update_option('stored_tokensss', serialize($new_token));
      $contactID = $cid->id;
      $tagID = array(108); // Signup Tag
      $contact->addTags($tagID);
      
  }
  /*
  * Finish Adding to InfusionSoft
  */  
}
  function buddydev_set_member_type( $user_id ) {
  $user_meta = get_userdata($user_id); 
  $user_roles = $user_meta->roles; 
    if (in_array("subscriber", $user_roles)){
     $member_type = 'reader';//change with the unique slug of your member type
     bp_set_member_type( $user_id, $member_type );
    }else{
      $member_type = 'author';//change with the unique slug of your member type
     bp_set_member_type( $user_id, $member_type );
    }
  
}
add_action( 'bp_core_activated_user', 'buddydev_set_member_type', 0 );

function set_default_member_type( $user_id ) {
  $user_meta = get_userdata($user_id); 
  $user_roles = $user_meta->roles; 
    if (in_array("subscriber", $user_roles)){
      bp_set_member_type( $user_id, 'reader' );
      xprofile_set_field_data ('Tipo', $user_id, 'reader' );
    }else{
       bp_set_member_type( $user_id, 'author' );
      xprofile_set_field_data ('Tipo', $user_id, 'author' );     
    }
  }

add_action( 'bp_core_signup_user', 'set_default_member_type' );

function redirect_login_page()
{
  // The URL to your login page
  $login_page  = home_url('/?page_id='. $page_id. '/');
  $page_viewed = basename($_SERVER["REQUEST_URI"]);
 
  if($page_viewed == "wp-login.php" AND $_SERVER["REQUEST_METHOD"] == "GET")
  {
    wp_redirect($login_page);
    exit;
  }
}
add_action("init","redirect_login_page");

function redirect_forgot_page()
{
  // The URL to your login page
  $login_page  = site_url("/account/inloggen/");
  $page_viewed = basename($_SERVER["REQUEST_URI"]);
 
  if($page_viewed == "wp-login.php" AND $_SERVER["REQUEST_METHOD"] == "GET")
  {
    wp_redirect($login_page);
    exit;
  }
}
add_action("init","redirect_forgot_page");






function add_user_new($infusionsoft, $email, $userFirst, $userLast='')
{
    $email1 = new \stdClass;
    $email1->field = 'EMAIL1';
    $email1->email = $email;
    $contact = ['given_name' => $userFirst, 'family_name' => $userLast,  'email_addresses' => [$email1]];
    return $infusionsoft->contacts()->create($contact);

}
add_action('groups_join_group', 'my_groups_join_group_action', 10, 2);

function my_groups_join_group_action($group_id, $user_id) {
    // use $group_id and $user_id here:
    $group = groups_get_group( array( 'group_id' => $group_id ) );
    $creator_id = $group->creator_id;

    $user_info = get_userdata($user_id);
    $userEmail = $user_info->user_email;
    $userFirst = $user_info->first_name;
    $userLast = $user_info->last_name;
    $api_settings = get_option('Infusion_api_option');
    require_once ('vendor/autoload.php');
    $infusionsoft = new Infusionsoft\Infusionsoft(array(
        'clientId' => $api_settings['client_id'],
        'clientSecret' => $api_settings['client_secret'],
        'redirectUri' => 'https://mythmachine.com/',
    ));
    $stored_token = get_option("stored_tokensss",true);
    if ($stored_token) {
        $infusionsoft->setToken(unserialize($stored_token));
    }
    if (isset($_GET['code']) and !$infusionsoft->getToken()) {
        $infusionsoft->requestAccessToken($_GET['code']);
    }
    if ($infusionsoft->getToken()) {
        try {
            $email = $userEmail;
            try {
                $cid = $infusionsoft->contacts()->where('email', $email)->first();
            } catch (\Infusionsoft\InfusionsoftException $e) {
                $cid = add_user_new($infusionsoft, $email, $userFirst, $userLast);
            }
        } catch (\Infusionsoft\TokenExpiredException $e) {
            $infusionsoft->refreshAccessToken();
            $cid = add_user_new($infusionsoft, $email, $userFirst, $userLast);
        }
        $contact = $infusionsoft->contacts()->with('custom_fields')->find($cid->id);
       // var_dump($contact->toArray());
        $new_token = $infusionsoft->getToken();
        update_option('stored_tokensss', serialize($new_token));


          $group_name =  $group->name;
          $tag_name = 'Fandom-'.$group_name;
          $tag = ['description' => $group_name, 'name' => $tag_name];

          $result = $infusionsoft->tags()->all();
          foreach ( $result->toArray() as $arr ){
              if ( $tag_name == $arr['name'] ){
                  $tag_id = $arr['id'];
              }

          } 
          if ( !$tag_id ){
                  $result = $infusionsoft->tags()->create($tag);
                  $return = $result->toArray();
                  $tag_id = $return['id'];
          }                                 
        $contactID = $cid->id;
        $tagID = array($tag_id); // Signup Tag
       $contact->addTags($tagID);
        
    }
    /*
    * Finish Adding to InfusionSoft
    */ 

}


add_filter( 'wp_insert_post_data' , 'filter_post_data3' , '99', 2 );

function filter_post_data3( $data , $postarr ) {



    $content = $data['post_content'];

        $len = strlen($data['post_content']);
        $i=0;

        while($i<$len) {

            $i = strpos($data['post_content'], "</p>", $i);
            if($i === false) {
                // No more paragraph endings
                break;
            }
            else {
                // Add the length of </p>
                $i += 4;

                // First Update
                // $ad = '[native_ad]<!--nextpage-->';
                // $data['post_content'] = wordwrap($data['post_content'], 1500, $ad);
                
                // // Second Update
                $ad = '<!--nextpage-->';
                $data['post_content'] = wordwrap($data['post_content'], 1000, $ad);

            // Set the correct i
                $i+= strlen($ad);
            }
        }

    return $data;
}
add_shortcode('native_ad','native_ad_code');
function native_ad_code($atts){
  ob_start();
  echo '<div class="native_ad">
 <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- RightRail1 -->
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:250px"
     data-ad-client="ca-pub-7961269813846982"
     data-ad-slot="9867208476"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
  </div>';

  return ob_get_clean();
}
function page_pagination( $echo = 1 )
{

    global $page, $numpages, $multipage, $more;

    if( $multipage ) { //probably you should add && $more to this condition.
        $next_text = "Next >";
        $prev_text = "< Prev";

        if( $page < $numpages ) {
            $next = _wp_link_page( $i = $page + 1 );
            $next_link = $next . $next_text . "</a>";
        }

        if( $i = ( $page - 1 ) ) {
            $prev = _wp_link_page( $i );
            $prev_link = $prev . $prev_text . "</a>";
        }

        $output = 
        "<div class=\"prev-next-page\">"
        . $prev_link 
        . "<span class=\"page-counter\">{$page} of {$numpages}</span>"
        . $next_link
        . "</div>";

    }

    if( $echo ){
        echo $output;
    }

    return $output;

}

add_shortcode('author_section','author_shortcode');
function author_shortcode(){
  ob_start();
$section = $_GET['section'];
$user = get_userdatabylogin($_GET['author']);

         echo  ( xprofile_get_field_data($section, $user->ID , $multi_format = 'comma') ) ? xprofile_get_field_data($section, $user->ID , $multi_format = 'comma') : "This user has not added anything here yet";
    return ob_get_clean();

  }



add_filter('the_content', 'wpse_ad_content_1');

function wpse_ad_content_1($content)
{
    if (!is_single('548')) return $content;

    if ( ! in_array( get_post()->post_type, [ 'books'] ) ) return $content;


    $paragraphAfter = 1; //Enter number of paragraphs to display ad after.
    $content = explode("</strong>", $content);
    $new_content = '';
    for ($i = 0; $i < count($content); $i++) {
        if ($i == $paragraphAfter) {
          $new_content.= '<div class="buy_ad"><button id="closeButton">X</button>';
            $new_content.= do_shortcode('[the_ad_group id="118"]');
            $new_content.= '</div>';
        }

        $new_content.= $content[$i] . "</strong>";
    }

    return $new_content;
}

function term_box() {
  ?>
<script>
function accptts(){
 jQuery(".pop-up").fadeIn("slow");
}

jQuery(document).ready(function(){
    jQuery(".check-bx, .lab-bx, .check_terms").click(function(){        
        jQuery(".pop-up").fadeIn("slow");
    });

     jQuery(".btn-accpt , .cross-btn").click(function(){        
        jQuery(".pop-up").fadeOut("slow");
        jQuery("body").addClass("fix-page");
    });
    

      jQuery(".btn-accpt, .cross-btn").click(function(){        
        jQuery("body").removeClass("fix-page");
    });
    

    jQuery(".btn-accpt").click(function(){
       jQuery(".radio-btn").addClass("input_blc");
    }); 
     jQuery(".radio-btn input").click(function(){        
        jQuery(".radio-btn").removeClass("input_blc");
    });

       jQuery("#agreed").click(function(){        
        jQuery(".radio-btn").removeClass("input_blc");
    });

    //Checkbox click add to cart on checkout page
    jQuery('#add_direct').on('change', function () {
      if (this.checked) {
      jQuery(".edd-has-js").click();
      }
    });


 jQuery(".checkout_row").addClass("height-pg"); 

    jQuery("#edd-gateway-option-stripe").click(function(){        
        jQuery(".checkout_row ").addClass("height-pg");
    });
    
    jQuery("#edd-gateway-option-paypal").click(function(){        
        jQuery(".checkout_row ").removeClass("height-pg");
    });

    if(jQuery("#edd_checkout_cart_wrap").length == 0) {
  jQuery(".checkout_row ").removeClass("height-pg");
  jQuery(".checkout_row ").addClass("empty-cart");
}

 jQuery(".pum-close").click(function(){
        jQuery(".field_hide").show();
    });
     
});

jQuery(function ($) {
$("#signup_submit").on("click",function(){
    if (($("input[name*='agree-btn']:checked").length)<=0) {
        alert("Please click on checkbox to agree term and condition");
        // $("#radio-eror").html("Please select checkbox");
    }
    return true;
});
$(".click-cat-dload").click(function(){
        $("#dload-cat").slideToggle();
    });

    $(".click-cat").click(function(){
        $("#bookcat").slideToggle();
    });

    $("#skip").click(function(){ 
        $('#popmake-4267').popmake('close');
       });
});
</script>
<?php
}
add_action( 'wp_footer', 'term_box' );

function add_bookmark(){
  ?>
<script>
    jQuery(document).ready(function($) {
    var value = $('.single-book-text strong').html();
    var check = 'chapter';
    if ( value ){
      value = value.toLowerCase();
    if(value.indexOf(check) != -1){
                event.preventDefault();
                //Add New Bookmark
                 var $self = $('a.wpf-favorite-link');
                 if ( $self ){
                    var data = {
                        post_id: $self.data('id'),
                        page_num: $self.data('num'),
                        nonce: wfp.nonce,
                        action: 'wfp_action'
                    };

                    $self.addClass('wfp-loading');

                    $.post(wfp.ajaxurl, data, function(res) {

                        if (res.success) {
                            $self.html(res.data);

                        } else {
                            alert(wfp.errorMessage);
                        }

                        // remove loader
                        $self.removeClass('wfp-loading');
                    });
                }

         var now = new Date();
        var time = now.getTime();
        time += 36000;
        now.setTime(time);    
    document.cookie = "Book_"+$self.data('id')+"="+value+"; expires="+now.toUTCString()+";domain=mythmachine.com; path=/";
        }
      }
    });
</script>
<?php
}
function remove_bookmark(){
  ?>
  <script>
    jQuery(document).ready(function($) {
    var value = $('.single-book-text strong').html();
    var check = 'chapter';
    if ( value ){
      value = value.toLowerCase();
    if(value.indexOf(check) != -1){
    
                event.preventDefault();

                //Add New Bookmark
                 var $self = $('a.wpf-favorite-link');
                 if ( $self ){
                   var data = {
                        post_id: $self.data('id'),
                        nonce: wfp.nonce,
                        action: 'wfp_action'
                    };
                    $self.addClass('wfp-loading');

                    $.post(wfp.ajaxurl, data, function(res) {

                        if (res.success) {
                            $self.html(res.data);

                        } else {
                            alert(wfp.errorMessage);
                        }

                        // remove loader
                        $self.removeClass('wfp-loading');
                    });
                }
                var $self = $('a.wpf-favorite-link');
                 if ( $self ){
                    var data = {
                        post_id: $self.data('id'),
                        page_num: $self.data('num'),
                        nonce: wfp.nonce,
                        action: 'wfp_action'
                    };

                    $self.addClass('wfp-loading');

                    $.post(wfp.ajaxurl, data, function(res) {

                        if (res.success) {
                            $self.html(res.data);

                        } else {
                            alert(wfp.errorMessage);
                        }

                        // remove loader
                        $self.removeClass('wfp-loading');
                    });
                }

         var now = new Date();
        var time = now.getTime();
        time += 36000;
        now.setTime(time);    
    document.cookie = "Book_"+$self.data('id')+"="+value+"; expires="+now.toUTCString()+";domain=mythmachine.com; path=/";                
        }
      }
   });
  </script>
<?php
}

function show_fcrd_group(){
  if( !isset($_GET['grpage']) )
  {
  ?>
  <div class="tab_fea et_pb_row et_pb_row_0">
  <div class="et_pb_column et_pb_column_4_4  et_pb_column_0 et-last-child">
    <div class="et_pb_text et_pb_module et_pb_bg_layout_light et_pb_text_align_left fcrd-top-text et_pb_text_0">
      <div class="et_pb_text_inner">
        <div class="feachure-cont">
            <?php 
                $argsfc = array(
                     'group_type' => 'featured',
                      'per_page' => 1,
                );
              if ( bp_has_groups( $argsfc ) ) : 
              while ( bp_groups( $argsfc ) ) : bp_the_group( $argsfc ); ?>
              <h1>featured fandoms</h1>
              <p><a href="<?php bp_group_permalink(); ?>"><?php bp_group_avatar( 'type=full&width=150&height=150' ); ?></a></p>
              <h2><a href="<?php bp_group_permalink() ?>"><?php bp_group_name() ?></h2>
              <?php bp_group_description_excerpt(); ?>
              <?php endwhile; ?>  
              <?php endif; ?>
        </div>
      </div>
    </div> <!-- .et_pb_text -->
  </div> <!-- .et_pb_column -->
</div><!-- END OF ROW FEACHRED -->
<?php
}
}
add_shortcode( 'show_fcrd', 'show_fcrd_group' );

//* Gravity form hide label
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

//* Gravity form add Button after submit
add_filter( 'gform_submit_button_1', 'add_paragraph_below_submit', 10, 2 );

function add_paragraph_below_submit( $button, $form ) {
 
    return $button .= ' <a class="tml-signup_" href="/login/">LOG IN</a>';
}

function homepage_show(){

 if( is_user_logged_in() ){
       $uid = get_current_user_id();
       $member_type = bp_get_member_type($uid);
    if( is_front_page() )
    {
          if ($member_type === 'author') { 
               echo '<script>window.location="/author-home";</script>';
          } 
           if ($member_type === 'reader') { 
               echo '<script>window.location="/reader-home";</script>';
          } 
    }
    if( is_page(3974) ){
       if ($member_type === 'reader') { 
               echo '<script>window.location="/reader-home";</script>';
          } 
      }
    if( is_page(3975) ){
         if ($member_type === 'author') { 
                 echo '<script>window.location="/author-home";</script>';
            } 
      }
    }
}
add_action('wp_head','homepage_show');

function show_user_domain(){
  $uid = get_current_user_id();
  $domain = bp_core_get_user_domain( $uid );
  return $domain;
}
add_shortcode('user_domain','show_user_domain');


/**
 * EDD Cross-sell & Upsell - Removing the excerpt
 * https://easydigitaldownloads.com/extensions/cross-sell-and-upsell/?ref=166
*/
function sumobi_edd_csau_show_excerpt() {
  return false;
}
add_filter( 'edd_csau_show_excerpt', 'sumobi_edd_csau_show_excerpt' );

/*
* For Change Email lavel text on checkout page
*
*/
remove_action( 'edd_purchase_form_after_user_info', 'edd_user_info_fields' );
remove_action( 'edd_register_fields_before', 'edd_user_info_fields' );
add_action( 'edd_purchase_form_after_user_info', 'custom_edd_user_info_fields' );
add_action( 'edd_register_fields_before', 'custom_edd_user_info_fields' );
function custom_edd_user_info_fields() {

  $customer = EDD()->session->get( 'customer' );
  $customer = wp_parse_args( $customer, array( 'first_name' => '', 'last_name' => '', 'email' => '' ) );

  if( is_user_logged_in() ) {
    $user_data = get_userdata( get_current_user_id() );
    foreach( $customer as $key => $field ) {

      if ( 'email' == $key && empty( $field ) ) {
        $customer[ $key ] = $user_data->user_email;
      } elseif ( empty( $field ) ) {
        $customer[ $key ] = $user_data->$key;
      }

    }
  }

  $customer = array_map( 'sanitize_text_field', $customer );
  ?>
  <fieldset id="edd_checkout_user_info">
    <legend><?php echo apply_filters( 'edd_checkout_personal_info_text', esc_html__( 'Personal Info', 'easy-digital-downloads' ) ); ?></legend>
    <?php do_action( 'edd_purchase_form_before_email' ); ?>
    <p id="edd-email-wrap">
      <label class="edd-label" for="edd-email">
        <?php esc_html_e( 'Email Address', 'easy-digital-downloads' ); ?>
        <?php if( edd_field_is_required( 'edd_email' ) ) { ?>
          <span class="edd-required-indicator">*</span>
        <?php } ?>
      </label>
      <span class="edd-description" id="edd-email-description"><?php esc_html_e( 'This email address will be used to create an account for you.', 'easy-digital-downloads' ); ?></span>
      <input class="edd-input required" type="email" name="edd_email" placeholder="<?php esc_html_e( 'Email address', 'easy-digital-downloads' ); ?>" id="edd-email" value="<?php echo esc_attr( $customer['email'] ); ?>" aria-describedby="edd-email-description"<?php if( edd_field_is_required( 'edd_email' ) ) {  echo ' required '; } ?>/>
    </p>
    <?php do_action( 'edd_purchase_form_after_email' ); ?>
    <p id="edd-first-name-wrap">
      <label class="edd-label" for="edd-first">
        <?php esc_html_e( 'First Name', 'easy-digital-downloads' ); ?>
        <?php if( edd_field_is_required( 'edd_first' ) ) { ?>
          <span class="edd-required-indicator">*</span>
        <?php } ?>
      </label>
      <span class="edd-description" id="edd-first-description"><?php esc_html_e( 'We will use this to personalize your account experience.', 'easy-digital-downloads' ); ?></span>
      <input class="edd-input required" type="text" name="edd_first" placeholder="<?php esc_html_e( 'First Name', 'easy-digital-downloads' ); ?>" id="edd-first" value="<?php echo esc_attr( $customer['first_name'] ); ?>"<?php if( edd_field_is_required( 'edd_first' ) ) {  echo ' required '; } ?> aria-describedby="edd-first-description" />
    </p>
    <p id="edd-last-name-wrap">
      <label class="edd-label" for="edd-last">
        <?php esc_html_e( 'Last Name', 'easy-digital-downloads' ); ?>
        <?php if( edd_field_is_required( 'edd_last' ) ) { ?>
          <span class="edd-required-indicator">*</span>
        <?php } ?>
      </label>
      <span class="edd-description" id="edd-last-description"><?php esc_html_e( 'We will use this as well to personalize your account experience.', 'easy-digital-downloads' ); ?></span>
      <input class="edd-input<?php if( edd_field_is_required( 'edd_last' ) ) { echo ' required'; } ?>" type="text" name="edd_last" id="edd-last" placeholder="<?php esc_html_e( 'Last Name', 'easy-digital-downloads' ); ?>" value="<?php echo esc_attr( $customer['last_name'] ); ?>"<?php if( edd_field_is_required( 'edd_last' ) ) {  echo ' required '; } ?> aria-describedby="edd-last-description"/>
    </p>
    <?php do_action( 'edd_purchase_form_user_info' ); ?>
    <?php do_action( 'edd_purchase_form_user_info_fields' ); ?>
  </fieldset>
  <?php
}

/*
* Add terms and condition popup on checkout page
*
*/
remove_action( 'edd_purchase_form_before_submit', 'edd_terms_agreement' );
add_action( 'edd_purchase_form_before_submit', 'custom_edd_terms_agreement' );
function custom_edd_terms_agreement() {
  if ( edd_get_option( 'show_agree_to_terms', false ) ) {
    $agree_text  = edd_get_option( 'agree_text', '' );
    $agree_label = edd_get_option( 'agree_label', __( 'Agree to Terms?', 'easy-digital-downloads' ) );
    
    ob_start();
?>
    <fieldset id="edd_terms_agreement">
      <div id="edd_terms" style="display:none;">
        <?php
          do_action( 'edd_before_terms' );
          echo wpautop( stripslashes( $agree_text ) );
          do_action( 'edd_after_terms' );
        ?>
      </div>
      <div id="edd_show_terms">
        <a href="#" class="edd_terms_links"><?php _e( 'Show Terms', 'easy-digital-downloads' ); ?></a>
        <a href="#" class="edd_terms_links" style="display:none;"><?php _e( 'Hide Terms', 'easy-digital-downloads' ); ?></a>
      </div>
      <div class="edd-terms-agreement">
        <div class="radio-btn">
        <input id="agreed" name="edd_agree_to_terms" class="required" type="checkbox" value="1"/>
        <div class="check-bx"></div>
        <label class="lab-bx" for="edd_agree_to_terms" onclick="accptts()"><?php echo stripslashes( $agree_label ); ?></label>
        </div>
      </div>
    </fieldset>
<?php
    $html_output = ob_get_clean();

    echo apply_filters( 'edd_checkout_terms_agreement_html', $html_output );
  }
}

/*
* For Show Discount field on checkout page
*
*/
remove_action( 'edd_checkout_form_top', 'edd_discount_field', -1 );
add_action( 'edd_checkout_form_bottom', 'edd_discount_field', -1 );

/*
* Add Popup on prebook books
*/
function prebook_popup()
{
    $opt = '<button class="preorder-btn" style="display:none;"></button>';
    $opt .= '<script type="text/javascript">
        jQuery("document").ready(function() {
              setTimeout(function() {
              jQuery(".preorder-btn").trigger("click");
            },10);
          });
             // alert("hello");
            </script>';
return $opt;
}
add_shortcode( 'prebook_popup' , 'prebook_popup' );