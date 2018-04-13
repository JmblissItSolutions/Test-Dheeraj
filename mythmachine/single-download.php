<?php
get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<div id="main-content">
<div class="container">
		<div id="content-area" class="clearfix">
        	<div class="single-books-sec">
            	

<?php /* The loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>
            <div class="single-book-content">
            	<div class="single-book-left">
                <span class="user-view">You are viewing</span>
                <div class="single-book-title"><h1><?php the_title();?></h1></div>
                <span class="synopsis">Synopsis</span>
      <div class="single-book-text"><?php the_content();?></div>
      
      
      			<div class="purchase-sec">
              <br />
                    <div class="buy-now-btn"><?php echo do_shortcode('[purchase_link id="'.get_the_ID().'" text="BUY NOW" style="button" color="blue"]'); ?>
                    </div>
                </div>
      
      </div>
      
    <div class="single-book-right">
        <div class="single-book-image">
            <div>
                <?php the_post_thumbnail('full');?>
            </div> 
        </div> 
        <!-- 
        book review start
         -->
        <div class="single-reviews">
            <?php 
            $pid = get_the_ID();
            echo do_shortcode('[review download="'.$pid.'" multiple="true" number="5"]'); ?>
        </div>  
    </div>
      
      </div>

            <?php endwhile; ?>
            
       

</div>
<br /><br />


</div>
</div>

</div>

<style>
.discount{
    background: #ecc609;
    border-radius: 5px;
}
.discount h1 {
    color: #000;
    font-size: 18px;
    line-height: 1.4em;
    text-align: center;
    padding: 10px;
}
.edd-submit.button.orange {
    background:url(https://mythmachine.com/wp-content/uploads/2018/01/Buy-Now-high-res1.png);
    background-repeat: no-repeat;
    width: 300px !important;
    font-size: 0px !important;
    border: none !important;
    box-shadow: none !important;
    background-size: cover;
    height: 119px;
    margin:auto !important;
}
.edd-submit.button.orange:hover, .edd-submit.button.orange:focus, .edd-submit.button.orange:active {
    background:url(https://mythmachine.com/wp-content/uploads/2018/01/Buy-Now-high-res1.png);
    background-repeat: no-repeat;
    width: 300px !important;
    font-size: 0px !important;
    border: none !important;
    box-shadow: none !important;
    background-size: cover;
    height: 119px;
    margin:auto !important;
}
.edd-submit.button.orange a:after, .edd-submit.button.orange a:hover{
    border: none !important;
    border-radius:none !important;
    box-shadow: none !important;
    margin:auto !important;
  }
</style>

<?php get_footer(); ?>