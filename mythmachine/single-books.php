<?php

$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
$webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");


/*
* Get download post id on this book
*/
global $post; 
$ptitle = $post->post_title;
if ( $dl = get_page_by_title( html_entity_decode(  $ptitle ), OBJECT, 'download' ) )
    $dload_id = $dl->ID;


  
if ( $iPod || $iPhone || $iPad || $Android || $webOS ) {
    get_header('book');
    ?>
    <div id="main-content">
        <div class="container">
            <div id="content-area" class="clearfix">
                <div class="single-books-section">
                    <?php /* The loop */ ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                    <div class="single-book-content">
                        <div class="single-book-left">
                            <div class="single-book-text">
                                <?php the_content(); ?> </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
        <?php page_pagination();
        global $page;
            $check_favorite_post = WeDevs_Favorite_Posts::init();
            $user_id = get_current_user_id();
            $post_id = get_the_ID();        
            if ( get_the_ID() === 548 && ( $page === 7 || $page === 11 )  ){
                echo '<div class="buy_ad"><button id="closeButton">X</button>';
                echo do_shortcode('[the_ad_group id="118"]');
                echo  '</div>';
            }
            if ( $page >= 99 && !is_user_logged_in() ){
                $pro_url = '/register/?pid='.$page;
                header('Location:' .$pro_url);
            }elseif ( is_user_logged_in() && $check_favorite_post->get_post_status( $post_id, $user_id )  ){
                remove_bookmark();
            }elseif ( is_user_logged_in() && !$check_favorite_post->get_post_status( $post_id, $user_id )  ){
                add_bookmark();
            }
                              /*
                              * Start Add to InfusionSoft
                              */
                              $ck = "Book_".get_the_ID();
                                //echo $ck;
                                if ( is_user_logged_in() && isset($_COOKIE[$ck])) {
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


                                            $chapter_name =  $_COOKIE[$ck];
                                            
                                            $book_title = get_the_title();
                                            $tag_name = $book_title.' '.$chapter_name;
                                            $tag = ['description' => $book_title, 'name' => $tag_name];

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
}else{
    get_header('mobile');
    ?>
    <div id="main-content">
        <div class="container">
            <div id="content-area" class="clearfix">
                <div class="single-books-sec">
                    <?php while ( have_posts() ) : the_post(); ?>
                    <div class="single-book-content">
                        <div class="single-book-left">
                            <div class="books_nav"> 
                                <a href="/start-reading">
                                    <i class="fa fa-chevron-circle-left" aria-hidden="true" style="font-size:28px;margin-right:10px;"></i></a> | <?php echo do_shortcode( '[favorite-post-btn]'); ?> | <a href="https://mythmachine.com"><i class="fa fa-home" aria-hidden="true" style="font-size:28px;margin-right:10px;"></i></a> | <a href="/about-us/"><i class="fa fa-info-circle" aria-hidden="true" style="font-size:28px;margin-right:10px;"></i></a> | <div class="dload-btn"> <?php echo do_shortcode( '[purchase_link id="'.$dload_id.'" text="Cart" style="text"]'); ?><i class="fa fa-shopping-cart" aria-hidden="true" style="font-size:28px;margin-right:10px;"></i></div>
                                <hr />
                            </div>
                            <div class="single-book-text">
                                <?php the_content(); page_pagination(); 
                                global $page;
                                $check_favorite_post = WeDevs_Favorite_Posts::init();
                                $user_id = get_current_user_id();
                                $post_id = get_the_ID();
                                if ( $page >= 99 && !is_user_logged_in() ){
                                    $pro_url = '/register/?pid='.$page;
                                    header('Location:' .$pro_url);
                                }elseif ( is_user_logged_in() && $check_favorite_post->get_post_status( $post_id, $user_id )  ){
                                    remove_bookmark();
                                }elseif ( is_user_logged_in() && !$check_favorite_post->get_post_status( $post_id, $user_id )  ){
                                    add_bookmark();
                                }
                                
                              /*
                              * Start Add to InfusionSoft
                              */
                              $ck = "Book_".get_the_ID();
                                //echo $ck;
                                if ( is_user_logged_in() && isset($_COOKIE[$ck])) {
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


                                            $chapter_name =  $_COOKIE[$ck];
                                            
                                            $book_title = get_the_title();
                                            $tag_name = $book_title.' '.$chapter_name;
                                            $tag = ['description' => $book_title, 'name' => $tag_name];

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
                                 ?>
                            </div>
                            </div>
                        <div class="single-book-right">
                            <?php dynamic_sidebar( 'eReader Sidebar'); ?> 
                        </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<style>
@media only screen 
  and (min-device-width: 768px) 
  and (max-device-width: 1024px) 
  and (-webkit-min-device-pixel-ratio: 1) {
.native_ad{
    font-size:0px !important;
    background:#fff !important;
    height:250px !important;
    width:300px !important;
    display:block !important;
}
html, body {
    min-height:100% !important;
}
body.custom-background {
    background:url(/wp-content/uploads/2017/12/single-books-bg.png);
    background-size: cover !important;
    background-position: center center;
    background-repeat: repeat;
}

.single-book-text p {
    font-size:2vh;
}
#main-header {
    display:none !important;
}
#et-main-area {
    background:none !important;
}
.books_nav {
    text-align: center;
    margin-bottom: 5px;
    width: 100%;
    display: block;
    float: left;
    padding-top: 10px;
}
.single-books #et-main-area .container {
    padding:0px !important;
}
#main-header{
    padding:0px !important;
}
.single-books-section {
    background: none !important;
    min-height: 100%;
    height:auto;
    position: relative;
    margin-top:-10px;
    padding:40px;

}
.prev-next-page{
        width: 100%;
    display: block;
    position: absolute;
    bottom: 0;
    float: none;
    margin: auto;
    background: #000;
    left: 0;
    text-align: center;
    padding:10px;
}
.prev-next-page a:first-child {
    float: left;
    padding-left: 10px;
}
.prev-next-page a:last-child {
    float: right;
    padding-right: 10px;
}
}
@media (max-width: 767px) {
.native_ad{
    background:#fff !important;
    height:260px !important;
    width:310px !important;
    display:block !important;
}
html, body {
    min-height:100% !important;
}
body.custom-background {
    background:url(/wp-content/uploads/2017/12/single-books-bg.png);
    background-size: cover !important;
    background-position: center center;
    background-repeat: repeat;
}
#et-main-area {
    margin-top:70px;

}
.single-book-text p {
    font-size:2vh;
}
#main-header {
    display:none !important;
}
#et-main-area {
    background:none !important;
}
.books_nav {
    text-align: center;
    margin-bottom: 5px;
    width: 100%;
    display: block;
    float: left;
    padding-top: 10px;
    position:absolute;
    top:0;
}
.single-books #et-main-area .container {
    padding:0px !important;
}
.single-books-section {
    background: none !important;
    min-height: 100%;
    height:auto;
    position: relative;
    margin-top:-10px;

}
.prev-next-page{
        width: 100%;
    display: block;
    position: absolute;
    bottom: 0;
    float: none;
    margin: auto;
    background: #000;
    left: 0;
    text-align: center;
    padding:10px;
}
.prev-next-page a:first-child {
    float: left;
    padding-left: 10px;
}
.prev-next-page a:last-child {
    float: right;
    padding-right: 10px;
}
}
.books_nav {
    text-align: center;
    margin-bottom: 5px;
    width: 100%;
    display: block;
    float: left;
    padding-top: 10px;
}
.prev-next-page{
        width: 100%;
    display: block;
    position: absolute;
    bottom: 0;
    float: none;
    margin: auto;
    background: #000;
    left: 0;
    text-align: center;
    padding:10px;
}
.prev-next-page a:first-child {
    float: left;
    padding-left: 10px;
}
.prev-next-page a:last-child {
    float: right;
    padding-right: 10px;
}
.single-books-sec{
    background:url(/wp-content/uploads/2017/12/single-books-bg.png);
    background-size: cover !important;
    background-position: center center;
    background-repeat: repeat;
    min-height: 100%;
    height:auto;
}
#sidebar {
    display:block !important;
    padding:0px !important;;
    width:100% !important;
}
.et_header_style_centered #main-header .logo_container {
    display:none !important;
}
.single-book-text p {
    font-size:2vh;
}
.buy_ad {
    position: fixed;
    padding: 0;
    margin: 0;
    left: 0;
    width: 100%;
    height: auto;
    text-align: center;
    bottom: 0;
    z-index: 99999;
}
#closeButton{
    position:absolute;
    top:0;
    right:0;
    font-weight:bold;
    background: #fff;
}

</style>
<script>
jQuery(document).ready(function($) {
    $('#closeButton').on('click', function(e) { 
        $('.buy_ad').remove(); 
    });
});
</script>
<?php get_footer('book'); ?>