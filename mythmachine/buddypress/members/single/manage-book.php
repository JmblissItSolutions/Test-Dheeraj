<?php
/**
 * BuddyPress - Manage Books
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<div class="manage-book-Carousel-sec">
<h1 class="manage-carousel-head">manage books</h1>
<div id="book-Carousel" >
 
  <?php
  global $current_user;
get_currentuserinfo();
$user = $current_user->ID;
$current_url = home_url(add_query_arg(array(),$wp->request));
  $query = new WP_Query(array('author' => $user, 'post_type'=>'books','posts_per_page'=>-1,'post_status' => 'publish','orderby' => 'publish_date','order' => 'DESC'));
if ( $query->have_posts() ) { while ( $query->have_posts() ) {$query->the_post();
$edit_post = add_query_arg( 'books', get_the_ID(), $current_url );

?>
  
  <div class="item">
     <div class="manage-book-Carousel-img">
     <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full');?></a>
     </div>
     <div class="manage-book-Carousel-title"><h1><a href="<?php the_permalink(); ?>"><?php the_title();?></a> </h1>
     </div>
    <div class="manage-book-Carousel-author"><?php //$autor_id = $query->post_author; echo get_the_author_meta( 'display_name', $author_id ); ?>
     <a href="<?php echo $edit_post; ?>">Edit</a>
    </div>
  </div>


  <?php           }}
  wp_reset_postdata();       
?>
 </div>
    

<!-- NEW CODE START -->

  
 <div class="post-edit-sec">
  <?php
    global $post_id;
    if(isset($_GET["books"])){
    $post_id = $_GET["books"];
    $queried_post = get_post($post_id);
    $docfile =  get_post_meta( $post_id , 'book_file', true );
    $cat = get_the_terms( $post_id, 'bookcategory' ); 
    // print_r($cat);
    $title = $queried_post->post_title;

  if ( $dl = get_page_by_title( html_entity_decode(  $title ), OBJECT, 'download' ) )
    $id = $dl->ID;
    $dcat = get_the_terms( $id, 'download_category' );
    $dloadfile =  get_post_meta( $id , 'edd_download_files', true );
    $dfilename = $dloadfile[1]["name"];
    foreach ( $dcat as $dpostcat){
      $dpcatid = $dpostcat->term_id;
      }

    $content = $queried_post->post_excerpt;
    $feature = get_the_post_thumbnail( $post_id );
?>
      <div class="post-edit-left manage-book-left">
      <?php 
      //Check file Upload ?
      // $pmeta =  get_post_meta($post_id);
      // print_r($pmeta);
      ?>
          <form action="" id="primaryPostForm" method="POST" enctype='multipart/form-data'>
 
  <fieldset>
 
    <label for="postTitle"><?php _e( 'Book\'s Title:', 'framework' ); ?></label>
 
    <input type="text" name="postTitle" id="postTitle" value="<?php echo $title; ?>" class="required" />
 
  </fieldset>
 
  <?php if ( $postTitleError != '' ) { ?>
    <span class="error"><?php echo $postTitleError; ?></span>
    <div class="clearfix"></div>
  <?php } ?>
 
  <fieldset>
         
    <label for="postContent"><?php _e( 'Edit Synopsis:', 'framework' ); ?></label>
    <br>
    <textarea name="postexcerpt" id="postContent" rows="20" cols="77"><?php echo $content; ?></textarea>
 
  </fieldset>


 


  <fieldset>
     
    <?php wp_nonce_field( 'post_nonce', 'post_nonce_field' ); ?>
 
    <input type="hidden" name="submitted" id="submitted" value="true" />
   <!--      <button type="submit"><?php _e( 'Update Post', 'framework'); ?></button> -->
 
  </fieldset>

  <div class="file-btn-box">
                        <div class="form-group">
                        <label for="pdffile"><?php _e( 'Please select / change Docx file:', 'framework' ); ?></label>
               <div class="input-bx"> <input type="file" class="filestyle" name="docfile" data-icon="false" accept=".doc,.docx" >
                <p class="curr-file">Current Doc File : <?php echo basename( $docfile ); ?></p>
               </div>
              </div>

                         <div class="form-group">
                        <label for="eddupload"><?php  _e( 'Please select / change Mobi / Epub file:', 'framework' ); ?></label>

               <div class="input-bx"> <input type="file" id="eddupload" class="filestyle" name="eddupload" data-icon="false" accept=".epub,.mobi">
               <p class="curr-file">Current Mobi / Epub File : <?php echo  $dfilename; ?></p> 
               </div>
             </div>
  </div>

<!-- 
Book category dropdown
 -->
<div class="open-check">
<div class="click-cat">
  <label for="category"><?php _e( 'Please select / change Free Read Category:', 'framework' ); ?></label>
</div>
  <div class="checkbox-cat" id="bookcat">
      <fieldset>
        <?php 
        $taxonomy = 'bookcategory';
        $separator = ', ';
        $check = ' ';
        $terms =  array(
          'hide_empty' => 0,
          'title_li' => true,
          'style'    => 'list',
          'taxonomy' => $taxonomy,
        ) ;
        $categories = get_categories( $terms );
        foreach ($categories as $category) {
          $check = ' ';
         $cid = $category->term_id;
         $cname = $category->cat_name;
         foreach( $cat as $catt){
            if ( $catt->term_id == $cid) {
              $check = "checked";
            }
          }
        ?>

         <p class="pcat"><input type="checkbox" name="category[]" value="<?php echo $cid; ?>" <?php echo $check;?> ><label class="catname"><?php echo $cname; ?> </label></p>
        <?php
      }
       ?> 
    </fieldset>
  </div>
</div><!-- open ckheck -->
<!-- 
download category dropdown
 -->
<div class="open-check">
<div class="click-cat-dload">
  <label for="dcategory"><?php _e( 'Please select / change Digital Download Category:', 'framework' ); ?>
  </label>
</div>
  <div class="checkbox-cat" id="dload-cat">
    <fieldset>
        <?php 
        $dtaxonomy = 'download_category';
        $separator = ', ';
        $check = "";
        $dterms =  array(
          'hide_empty' => 0,
          'title_li' => true,
          'style'    => 'list',
          'taxonomy' => $dtaxonomy,
        ) ;
        $dcategories = get_categories( $dterms );
        foreach ($dcategories as $dcategory) {
          $check = "";
         $dcid = $dcategory->term_id;
         $dcname = $dcategory->cat_name;
         foreach( $dcat as $dcatt){
            if ( $dcatt->term_id == $dcid) {
              $check = "checked";
            }
          }
        ?>
          <p class="pcat"><input type="checkbox" value="<?php echo $dcid; ?> " name="dcategory[]" <?php echo $check;?> ><label class="catname"><?php echo $dcname; ?></label></p>
        <?php
        }
       ?> 
    </fieldset>
  </div>
</div><!-- open check -->
</div>
      <div class="post-edit-right">
        <div class="edit-image">
          <?php echo $feature; ?>
          <div class="fcrdimg">
          <div class="file-btn-box">
             <div class="form-group">
               <div class="input-bx"> <input type="file" class="filestyle" name="file" data-icon="false"></div>
             </div>
          </div>
          </div>
           <!--  <a class="edit-btn" href="#"><img src="/wp-content/themes/mythmachine/images/ico-edit-btn.png" />Edit / Update</a> -->
        </div>
      </div>
      <?php
      }
      ?>
 </div>
</div>
<?php
if(isset($_GET["books"])){
  ?>
 <div class="btn-sec">
  <a class="delete-btn" onclick="return confirm('Are you sure you wish to delete this book : <?php echo $title; ?>?')" href="<?php echo get_delete_post_link( $post_id ); ?>">delete book</a>
  <button type="submit" class="update-btn"><?php _e( 'Update / save', 'framework'); ?></button>
    <img src="/wp-content/themes/mythmachine/images/ajax-loader.gif" alt="loader1" style="display:none; height:30px; width:auto;" id="loaderImg">
 </div>
 <?php
}
?>
 </form>

 <?php
 if ( isset( $_POST['submitted'] ) && isset( $_POST['post_nonce_field'] ) && wp_verify_nonce( $_POST['post_nonce_field'], 'post_nonce' ) ) {

$book_content = "";

  if ( trim( $_POST['postTitle'] ) === '' ) {
    $postTitleError = 'Please enter a title.';
    $hasError = true;
  }
    require_once( ABSPATH . 'wp-admin/includes/image.php' );
  require_once( ABSPATH . 'wp-admin/includes/file.php' );
  require_once( ABSPATH . 'wp-admin/includes/media.php' );
  $attachment_id = media_handle_upload('file',$post_id);
  set_post_thumbnail($post_id, $attachment_id);


//UPLOAD DOC 
 if($_FILES['docfile']['name']!=""){
//require_once(ABSPATH . "wp-admin" . '/includes/image.php');
require_once(ABSPATH . "wp-admin" . '/includes/file.php');
require_once(ABSPATH . "wp-admin" . '/includes/media.php');

$attach_id = media_handle_upload( 'docfile', $post_id );
$attach_url = wp_get_attachment_url($attach_id);
update_post_meta($post_id,'book_file', $attach_url);

/*
* convert docx to HTML
*/
          $file_url = $attach_url;
          $dir =  wp_upload_dir();
          $filedir = $dir['basedir'];

          $parts  = explode('/', $file_url);
          $result =  implode('/', array_slice($parts, 5, 7));

          $file = $filedir.'/'.$result;


          include get_stylesheet_directory() . '/docx_reader.php';
          $doc = new Docx_reader();
          $doc->setFile($file);

          if(!$doc->get_errors()) {
              $html = $doc->to_html();
              $plain_text = $doc->to_plain_text();

              // echo $html;
              // echo $plain_text;
              $len = strlen($html);
              $i=0;

        while($i<$len) {

            $i = strpos($html, "</p>", $i);
            if($i === false) {
                // No more paragraph endings
                break;
            }
            else {
                // Add the length of </p>
                $i += 4;

                // First Update
                $ad = '[native_ad]<!--nextpage-->';
                $html = wordwrap($html, 1500, $ad);
                
                // Second Update
                // $ad = '<!--nextpage-->';
                // $data['post_content'] = wordwrap($data['post_content'], 1000, $ad);

                // Set the correct i
                $i+= strlen($ad);
            }
        }
        $book_content = $html;
     }
}
//////////////////////////////////////////////////////

/*
*
** Upload Epub or Mobi 
*/
if($_FILES['eddupload']['name']!=""){
//require_once(ABSPATH . "wp-admin" . '/includes/image.php');
require_once(ABSPATH . "wp-admin" . '/includes/file.php');
require_once(ABSPATH . "wp-admin" . '/includes/media.php');

$dload_id = media_handle_upload( 'eddupload', $id );
$dload_url = wp_get_attachment_url($dload_id);
$download_files = array();
 // echo '<script>alert("'.$_FILES['eddupload']['name'].'");</script>';
        $file_id        = 1;
        $book_url = $dload_url;
        $download_file_args = array(
          'file' => $book_url,
          'name' => basename( $book_url ),
        );
        $download_files[ $file_id ] = $download_file_args;
        update_post_meta( $id, 'edd_download_files', $download_files );
}

$cat_update = $_POST['category'];
$postexcerpt = $_POST['postexcerpt'];
$terms =  $cat_update  ;
$dcat_update = $_POST['dcategory'];

$dterms =  $dcat_update;
  $post_information = array(
  'ID' => $post_id,
  'post_title' =>  wp_strip_all_tags( $_POST['postTitle'] ),
  'post_type' => 'books',
  'post_excerpt' => $postexcerpt,
  'post_status' => 'publish',
  'post_content' => $book_content
);

  if ( $book_content == '' ) {
    unset($post_information['post_content']);
  }

  wp_set_post_terms( $post_id, $terms, 'bookcategory');
 // update_post_meta($post_id,'post_excerpt', $postexcerpt);
  $update = wp_update_post( $post_information );


/*
*
** Update DOwnload Post type 
*
*/

   $dl_information = array(
    'ID' => $id,
    'post_title' =>  wp_strip_all_tags( $_POST['postTitle'] ),
    'post_type' => 'download',
    'post_content' => $postexcerpt,
    'post_status' => 'publish'
  );
  wp_set_post_terms( $id, $dterms, 'download_category');
   

    set_post_thumbnail( $id, $attachment_id );
     $dl_update = wp_update_post( $dl_information );


  if ( is_wp_error( $dl_update ) ) {
  echo  $id->get_error_message();
   echo "<script>alert('Book Updation Failed');</script>";
}
else {
     header("Refresh:0");
    echo "<script>alert('Book Updated Successfully');</script>";
}
   
}
?>

<script type="text/javascript">
  jQuery(function(){
  jQuery('#primaryPostForm').submit(function() {
    jQuery('#loaderImg').show(); 
    return true;
  });
});
</script>