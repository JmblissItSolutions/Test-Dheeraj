<?php
/*
Template Name:  Page Store
*/
get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<div id="main-content">

<?php if ( ! $is_page_builder_used ) : ?>

	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">

<?php endif; ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php if ( ! $is_page_builder_used ) : ?>

					<h1 class="entry-title main_title"><?php the_title(); ?></h1>
				<?php
					$thumb = '';

					$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

					$height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
					$classtext = 'et_featured_image';
					$titletext = get_the_title();
					$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
					$thumb = $thumbnail["thumb"];

					if ( 'on' === et_get_option( 'divi_page_thumbnails', 'false' ) && '' !== $thumb )
						print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height );
				?>

				<?php endif; ?>

					<div class="entry-content">
					<?php
						the_content();

						if ( ! $is_page_builder_used )
							wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
					</div> <!-- .entry-content -->

				<?php
					if ( ! $is_page_builder_used && comments_open() && 'on' === et_get_option( 'divi_show_pagescomments', 'false' ) ) comments_template( '', true );
				?>

				</article> <!-- .et_pb_post -->

			<?php endwhile; ?>

<?php if ( ! $is_page_builder_used ) : ?>

			</div> <!-- #left-area -->
			<?php dynamic_sidebar('store'); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->

<?php endif; ?>

</div> <!-- #main-content -->
<style>
.edd_downloads_list.edd_download_columns_4.facetwp-template {
	padding:20px !important;
	min-height:600px;
}
div#edd_download_pagination {
	float:left !important;
	margin-top:30px !important;
}
h3.edd_download_title {
color:black !important;
}

.et_pb_bg_layout_dark{
color:black !important;
}

.page-template-page-store .et_pb_column_1_4 .et_pb_widget {
margin-bottom: 5% !important;
background: url(/wp-content/themes/mythmachine/images/side-bar-bg-small.png) no-repeat center top;
background-size: 100% 100%;
min-height: 200px;
padding: 20px !important;
}

.edd_download_inner {
	margin-top: 0px !important;
}
.facetwp-checkbox{
color: white !important;
background-color: black !important;
}
.facetwp-slider-label{
color:white !important;
}

.page-template-page-store .et_pb_sidebar_0.et_pb_widget_area {
border-color:none !important;
border-style:none !important;
}


.edd_download_title {
	color:#000 !important;
}
.edd_download_columns_4 .edd_download {
	width:23% !important;
	margin-left:1% !important;
	margin-right:1% !important;
}
.edd_download_inner {
	margin:5px !important;
}
@media (min-width: 981px){

.single.et_right_sidebar #left-area , .page-id-1878 .et_pb_row_1 .et_pb_column_2_3 {
    float: left !important;
   margin-right: 5.5% !important;
   width: 63.625%;
}
.single #sidebar , .page-id-1878 .et_pb_row_1 .et_pb_column_1_3 {
    float: left;
    width: 30.875%;
   padding-left: 0;
   margin-right:0 !important;
   padding-right:5px !important;
}
}

@media (max-width: 414px){
.edd_download_columns_2 .edd_download {
    width:100% !important;
}
}

.right-social{
float:left;
}

.right-social img {
width: 49%;
float: left;
margin-top: 10px;
margin-right: 2px;
box-shadow: none;
}

.attachment-medium size-medium wp-post-image{
    width:100px !important;
}

.edd-add-to-cart button blue edd-submit et_pb_button edd-has-js{
width:30px !important;
}

.edd-add-to-cart button blue edd-submit et_pb_button edd-has-js a{
hover:none;
}

.edd_purchase_submit_wrapper a.edd-add-to-cart.edd-has-js {
display: inline-block;
font-size: 10px;
}

h3.edd_download_title {
font-size: 14px;
margin-top:10px;
    } 

img.attachment-medium size-medium wp-post-image{
max-width: 100%;
height: auto;
height: 193px;
}

.edd_download_inner {
text-align: center;
border: 1px solid #000;
padding:0px;
}

.facetwp-checkbox {
background: url(../images/checkbox.png) 0 50% no-repeat;
background-size: 15px 14px;
margin-bottom: 14px;
padding-left: 19px;
cursor: pointer;
color: black;
}

.facetwp-toggle {
cursor: pointer;
color: black !important;
}

.et_pb_widget ul li {
margin-bottom: 0.5em;
color: black;
}

.edd_download_inner
{
position:relative !important;
}

.edd_download_buy_button
{  
position:absolute !important;
bottom:0;
width:100%;
}

.edd_purchase_submit_wrapper a.edd-add-to-cart.edd-has-js {
display: inline-block;
font-size: 12px !important;
padding: 10px !important;
height:auto;
font-weight: bold !important;
}

input.facetwp-search{
padding: 12px;
border: 1px solid black;
color: #4e4e4e;
background-color: #fff;
}

.edd_purchase_submit_wrapper {
    position: relative;
    height: 51px;
}

.edd_download{
    height:385px;
    margin-top:25px;
}

.edd_download_inner{
    height:450px;
}

h4.widgettitle{
color:black !important;
text-shadow:none !important;
font-size:15px !important;
font-family:'arial' !important;
font-weight:bold !important;

}

.et_pb_bg_layout_light .et_pb_widget li a {
    font-size:20px !important;
}

.edd-submit.button.blue {
background: #428bca;
border-color: #357ebd;
height: 42px;
font-size:12px;
}

.noUi-connect{
    background:#3ba0e0 !important;
}

.et_pb_widget {
margin-bottom: 26.348%;
border: 1px solid rgba(0,0,0,0.1);
padding-left: 16px;
padding-top:7px;
}

.et_pb_widget select{
width:93%;
}

.single form p{
width:64%;
}

.single form p input{
width:158%;
height:24px;
border-radius:5px;
background:#428bca;
border-color:#357ebd;
color:white;
font-size:white;
font-weight:bold;
}

.single form p{
color:black;
}

textarea{
width:158%;
border-radius:5px;
box-shadow:0px 0px 25px #2b8db5;
}

.edd-reviews-review-title p{
color:black;
}

.edd-reviews-review-title{
box-shadow:3px 5px 25px rgba(22, 26, 26, 0.3), -3px -3px 25px rgba(24, 28, 28, 0.3);
}

form input[type="text"]{
color:black;
}

.edd-reviews-form label {
padding-bottom: 10px;
}


.edd_download_columns_4 .edd_download {
margin-top: 60px;
}

.et_pb_button{
transition:none !important;
line-height:0.7em !important;
}

.et_pb_button:after{
transition: all 12.2s;
}

h3.edd_download_title{
padding-bottom:54px;
font-size:14px;
margin-top:10px;
font-weight:bold;
}

.edd_purchase_submit_wrapper .edd-submit.button.blue.active, 
.edd_purchase_submit_wrapper .edd-submit.button.blue:focus, 
.edd_purchase_submit_wrapper .edd-submit.button.blue:hover {
padding:13px !important;
background: #3276b1 !important;
border:2px solid #285e8e !important;
}
.edd_purchase_submit_wrapper .et_pb_button:after {
display: none !important;
}


.et_pb_widget_area_left{
padding-right:12px;
}

div#text-12.et_pb_widget .widget_text{
margin-bottom:4.348% !important;
}

.edd_download_inner{
margin-top:-22px;
}
span.edd-reviews-average-rating-label{
display:none !important;
}

.et_pb_text_inner {
margin-top: -40px !important;
}

.edd_download_image img {
width:100% !important;
height:300px !important;
}

.facetwp-slider-label{
color:black;
}
.noUi-handle{
background-color:black !important;
}


.page-template-page-store .et_pb_widget{
margin-bottom: 5% !important;
}

.edd-cart-number-of-items{
font-style: normal !important;
color: black !important;
font-weight: 500 !important;
font-size:16px !important;
}

.et_pb_bg_layout_light .et_pb_widget li a {
font-size: 20px !important;
padding-right: 45px !important;
padding-left: 45px !important;
margin-left: 1px !important;
padding: 3px !important;
background-color: #2ea3f2 !important;
color: white !important;
border:1px solid black;
}

a.edd-remove-from-cart {
display:none !important;

}
.edd-cart-meta.edd_total{
background-color:white !important;
margin-bottom: 23px !important;
}

.facetwp-slider-label{
font-size:15px !important;
}

.facetwp-facet{
margin-bottom:22px !important;
}

.facetwp-facet-categories{
font-size:13px !important;
}

.et_pb_widget_area ul{
font-size:12px !important;
}

input.facetwp-search{
border: 1px solid black !important;
color: #4e4e4e !important;
background-color: #fff !important;
width: 91% !important;
padding: 9px !important;
}

.et_pb_widget select{
border:1px solid black !important;
}

.edd_download_inner{
border:none;
}

.edd_purchase_submit_wrapper{
height:60px;
}
.edd-cart-ajax-alert, .edd-cart-ajax-alert {
display:none !important;
font-size:0px !important;
}

.page-template-page-store .edd-submit .button.blue {
font-size: 12px !important;
}

.et_pb_widget_area ul{
padding:16px !important;
}

.edd-download-pagination{
text-align:center !important;
padding-top:43px !important;
}

.facetwp-slider-wrap{
margin-right:10px !important;
}

}



 // iphone


@media (min-width: 320px) and (max-width: 480px ){
    body {
    min-width: 960px;
}

}

@media (min-width: 320px) and (max-width: 480px ){

.edd_download_columns_4 .edd_download {
width:100% !important;
margin-top:60px !important;
    }
.edd_download_inner {
margin:0px !important;
    }
}

 h3.edd_download_title{
    padding-bottom:18px !important;
}

.edd_download_inner{
border:none;
}

.edd_purchase_submit_wrapper{
height:60px;
}
#edd_download_pagination{
padding-top:43px !important;
text-align:center !important;
}
.facetwp-slider-wrap{
margin-right:10px !important;
}
.et_pb_bg_layout_light .et_pb_widget li a {
font-size:20px !important;
}

.page-template-page-store .edd-submit .button.blue {
font-size: 12px !important;
}

}

//ipad

@media (min-width: 768px) and (max-width: 1024px ){
body {
min-width: 960px;
}

}

@media (min-width: 768px) and (max-width: 1024px ){

.edd_download_columns_4 .edd_download{
width:45% !important;
margin-right:5%;
    }

.edd_purchase_submit_wrapper a.edd-add-to-cart.edd-has-js{
font-size:15px !important;
padding:24px !important;
}

.edd_download_inner {
margin:0px !important;
    } 

.et_pb_section {
padding: none !important;
}  
  


h3.edd_download_title{
padding-bottom:18px !important;
}

.edd_download_inner{
border:none !important;
}

.edd_purchase_submit_wrapper{
height:60px !important;
}
.edd_download_pagination{
padding-top:43px !important;
text-align:center !important;
}
.facetwp-slider-wrap{
margin-right:10px !important;
}
.et_pb_bg_layout_light .et_pb_widget li a {
font-size:20px !important;
}

.page-template-page-store .edd-submit .button.blue {
font-size: 12px !important;
}

.et_pb_widget{
    padding-bottom:20px;
}

.edd_purchase_submit_wrapper .edd-submit.button.blue.active, 
.edd_purchase_submit_wrapper .edd-submit.button.blue:focus, 
.edd_purchase_submit_wrapper .edd-submit.button.blue:hover {
padding:32px !important;
background: #3276b1 !important;
border:2px solid #285e8e !important;
}

}







</style>
<?php get_footer(); ?>