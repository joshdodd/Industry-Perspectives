<?php
/**
 * Single Post file
 *
 * @package WordPress
 * @subpackage APIC
 */
 
$GLOBALS['topicID'] = "technology";

 
$file_type = get_field('file_type');
$file_title = get_field('file_title');
 
 

get_header(); 

$the_date = strtotime(get_field('cfdate'));
$show_date = date('F j, Y', $the_date);
//$show_author = get_author_name();
$show_author = get_field('author');

// $thumb_image_arr = get_field('thumbnail_image');
// $thumb_image     = $thumb_image_arr['url'];
// $thumb_image_alt = $thumb_image_arr['alt'];

 

$featured_image_arr = get_field('feature_photo');
$featured_image = $featured_image_arr['url'];
$featured_image_url = $featured_image_arr['sizes']['feature-bg'];

$partner_image_arr = get_field('partner_logo');
$partner_image = $partner_image_arr['url'];
$partner_image_alt = $partner_image_arr['alt'];
 

$sponsor_name = get_field('sponsor_name');
$post_title = get_the_title();

?>





<!--! BEGIN ARTICLE HEADER -->

<section id="article-header" style="background-image: url(<?=$GLOBALS['path']?>images/header-bg-<?=$GLOBALS['topicID']?>.jpg);">		
	<div class="row">
		
	<h2>Strategic Partners Spotlight</h2>
	
 
	
	</div>		
</section>

<!-- END ARTICLE HEADER -->





<!--! BEGIN ARTICLE -->

<article id="article-container">
	
	<!--
	<header>
		<h1><?php the_title(); ?></h1>		
	</header>
	-->
	
	<!--<div class="article-photo" style="background-image:url(<?=$featured_image?>);">
		<img src="<?=$GLOBALS['path']?>images/article-photo-spacer.png" class="spacer">-->
	<div class="article-photo">
		<h1><?php the_title(); ?></h1>
		<!--<div class="article-photo-sponsor">
			 
		</div>-->
	</div>
	
	<div class="contentContainer">
		
		
		
		<div class="article-header spaced">
			<div class="article-details">
				<ul>
					<!-- <li>Posted: <strong><?php the_date(); ?></strong></li>  -->
					
					<li>
						Provided By:
						
						<?php 
							
						if(get_field('sponsor_website') != ''){
							print '<a href="' . get_field('sponsor_website') . '" target="_blank">';
						}
						
						print '<img src="' . $partner_image  . '" alt="' . $partner_image_alt . '" class="sponsor-logo sponsor-logo-large">';
						
						if(get_field('sponsor_website') != ''){
							print '</a>';
						}
						
						?> 	
					</li>	
				</ul>
			</div>

			<nav class="social">
				<p>SHARE:</p>
				<?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
			</nav>
		</div>
			
			
			
		<div class="row spaced article-contents">



		<!--! BEGIN ARTICLE CONTENTS -->
		
		<div class="col left">
			
			<?php 
 				//print '<img class="content-header" src="' . $featured_image  . '" alt="' . $featured_image_alt . '" class="sponsor-logo">';
				print apply_filters('the_content',$post->post_content);
 
			?>	
 

		</div>
		
		<!-- END ARTICLE CONTENTS -->		
		
		
		
		<div class="col right sidebar"  >

			<?php echo get_field('side_column'); ?>

		</div>	
		
		

		</div>
		
	</div>
</article>

<!-- END ARTICLE -->





<?php get_footer(); ?>
