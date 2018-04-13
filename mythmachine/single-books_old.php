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
                	<div class="price"><sup>$</sup><?php echo get_post_meta( get_the_ID(), 'Enter Price', true ); ?></div>
                    <div class="buy-now-btn"><a href="<?php echo get_post_meta( get_the_ID(), 'BUY NOW Link', true ); ?>">buy now</a></div>
                    <div class="read-free-btn"><a href="<?php echo get_post_meta( get_the_ID(), 'READ FREE Link', true ); ?>">read free</a></div>
                
                </div>
      
      </div>
      
      <div class="single-book-right">
      <div class="single-book-image">
        <div>
			<?php the_post_thumbnail('full');?>
       </div> 
</div>

	<div class="about-author-block">
    	<h3>About the Author</h3>
        	<div class="author-left">
            	<div class="author-img"><div><?php echo get_avatar( get_the_author_meta( 'ID' ), 220 ); ?></div></div>
                <?php
    $prefix_twitter_url = get_the_author_meta( 'twitter' );
    $prefix_facebook_url = get_the_author_meta( 'facebook' );
    $prefix_linkedin_url = get_the_author_meta( 'linkedin' );

?>	
			<div class="profile-social">
				<a href="<?php the_author_meta( 'facebook' ) ?>"><span class="fa fa-facebook"></span></a> 
                <a href="<?php the_author_meta( 'twitter' ) ?>"><span class="fa fa-twitter"></span></a>
                <a href="<?php the_author_meta( 'linkedin' ) ?>"><span class="fa fa-linkedin"></span></a>
                </div>

            </div>
            <div class="author-right">
            	<h1 class="author-fullname"><?php $autor_id = $query->post_author; echo get_the_author_meta( 'display_name', $author_id ); ?></h1>
                <div class="author-discription">
                <?php echo nl2br(get_the_author_meta('description')); ?>
                
                
                </div>
            </div>
    
    </div>
    
    <div class="rating-block">
    	<h3>ratings</h3>
        <div class="rating-left">
        	<div class="review-th-rating">
            	<h2><span class="ratings">4.3</span> <span>/</span> <span class="out-of">5</span></h2>
                <p>7 ratings and 3 reviews</p>
            </div>
        </div>
        <div class="rating-right">
        
        	<div class="rating-chart"><img src="/wp-content/uploads/2017/12/rating-chart.png" alt=""></div>
        	
        </div>
    </div>
</div>
      
      </div>

            <?php endwhile; ?>
            
       

</div>
<div class="customer-review-sec">
       		<div class="review-head-block">
            	<h1>Customer top reviews</h1>
            </div>
            <div class="reviews-cols">
            <div class="rew-col-1 rew-col">
            <div class="rating"><img src="/wp-content/themes/mythmachine/images/stars.png" alt=""></div>
            <div class="customer-name">- John Doe <span class="days">4 days ago</span></div>
           
            <div class="rew-text">
            <p>Lorem ipsum damet, consectetur elit. Aliquam in eleifend arcu. Sed at quam vulputate, laoreet tellus a, rutrum sapien. Ut tincidunt mauris nec erat accumsan tempus. </p>

<p>Aenean eu odio vitae neque ornare auctor sit amet sed massa. Nullam laoreet justo ac fermentum ent asus convallis. </p>

<p>Pellentesque tortor massa, pellentesque sit amet volutpat nec, posuere et nulla. Pellentesque faucibus sem velit, vel facilisis odio tristique et. Integer non varius elit.</p>
</div>
            
            </div> 
            <div class="rew-col-1 rew-col">
            <div class="rating"><img src="/wp-content/themes/mythmachine/images/stars.png" alt=""></div>
            <div class="customer-name">- John Doe <span class="days">4 days ago</span></div>
           
            <div class="rew-text">
            <p>Lorem ipsum damet, consectetur elit. Aliquam in eleifend arcu. Sed at quam vulputate, laoreet tellus a, rutrum sapien. Ut tincidunt mauris nec erat accumsan tempus. </p>

<p>Aenean eu odio vitae neque ornare auctor sit amet sed massa. Nullam laoreet justo ac fermentum ent asus convallis. </p>

<p>Pellentesque tortor massa, pellentesque sit amet volutpat nec, posuere et nulla. Pellentesque faucibus sem velit, vel facilisis odio tristique et. Integer non varius elit.</p>
            </div> 
            
         
       
       
       </div>
       <div class="rew-col-1 rew-col">
            <div class="rating"><img src="/wp-content/themes/mythmachine/images/stars.png" alt=""></div>
            <div class="customer-name">- John Doe <span class="days">4 days ago</span></div>
           
            <div class="rew-text">
            <p>Lorem ipsum damet, consectetur elit. Aliquam in eleifend arcu. Sed at quam vulputate, laoreet tellus a, rutrum sapien. Ut tincidunt mauris nec erat accumsan tempus. </p>

<p>Aenean eu odio vitae neque ornare auctor sit amet sed massa. Nullam laoreet justo ac fermentum ent asus convallis. </p>

<p>Pellentesque tortor massa, pellentesque sit amet volutpat nec, posuere et nulla. Pellentesque faucibus sem velit, vel facilisis odio tristique et. Integer non varius elit.</p>
            
            </div>            
            </div>
</div>
</div>

</div>
</div>
</div>


<?php get_footer(); ?>