<?php

/*
Template Name: Strategic Partner Stories
*/

get_header(); 

?>


<!--! BEGIN TIER HERO -->

<section id="tier-hero" style="background-image: url(<?=$GLOBALS['path']?>images/hero-bg-technology.jpg);" class="short">
	<div class="contentContainer">
				
		<div class="tier-hero-text">
			
			<div class="row">
			<h1><?php the_title(); ?></h1>
 
			</div>
			
			<h2><?php echo get_field('intro_text'); ?> </h2>
 
			
		</div>
	
	</div>	
	
	<?php
 
	?>
		
</section>

<!-- END TIER HERO -->





<!--! BEGIN FEATURE STORY -->

<?php

// WP_Query arguments
// WP_Query arguments
$args = array(
	'post_type' => array( 'partner_stories' ),
	'posts_per_page' => 1,
);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();

		$featured_image_arr = get_field('feature_photo');
		$featured_image = $featured_image_arr['url'];
		$featured_image_url = $featured_image_arr['sizes']['feature-bg'];

		$partner_image_arr = get_field('partner_logo');
		$partner_image = $partner_image_arr['url'];
		$partner_image_alt = $partner_image_arr['alt'];
 			
?>

<!-- <section id="feature-story" class="short partner">
	<div class="contentContainer">
	
		<div class="feature-story-box">
			
			<div class="feature-story-images">
 
					 <div class="feature-story-image" data-num="1" style="background-image: url(<?php echo $featured_image_url; ?> )"></div> 
 
				
			</div>
			
			
			
			<p class="feature-story-label">Featured Spotlight</p>
			
			
			<div class="feature-story-callout"><div class="feature-story-wrap">
				
				<div class="feature-story-contents" data-num="1">
					 
					<h3><?php the_title(); ?></h3>
					<p><?php the_excerpt(); ?></p>
					<a href="<?php the_permalink(); ?>" class="cta">Read more <span class="icon-angle-right"></span></a>				
					<div class="sponsor">
						<p>Provided by</p>
						<img src="<?php  echo $partner_image; ?>" alt="'.<?php  echo $partner_image_alt; ?> .'">
					</div>
				</div>					
				 
				
				<div class="corner-notch"></div>
			</div></div>		
		</div>
	
	</div>
</section> -->


<?php
 
	}
} else {
	// no posts found
}

// Restore original Post Data
wp_reset_postdata();

?>

<!-- END FEATURE STORY -->






<!--! BEGIN TOPIC LATEST -->

<section id="tier-stories">
	<div class="contentContainer">
		
		<hgroup class="spaced">
			<div class="col left  stories-grid">
				<h3>Our Partner Spotlights</h3>
			</div>
						
			<div class="col right sidebar ">
				<h3>Our Partners</h3>
			</div>
					
		</hgroup>
		
		<div class="row spaced">



		<!--! BEGIN STORY GRID -->
		
		<div class="col left stories-grid">
			
			<?php
				
				
			//OLD VERSION TO PULL LATEST POSTS
			// $perpage = 12;
			
			// $args = array(
				 
			// 	'post_type'			=> 'partner_stories',
			// 	'posts_per_page'	=> $perpage,
			// 	'offset'			=> 0,
			// 	//'post__not_in' 		=> $GLOBALS['shown_stories']
			// );
 			//$posts = get_posts($args);


 			//New custom select stories

 			$posts = get_field('partner_stories');
			
			foreach($posts as $key=>$post){
				 setup_postdata($post);
							
				// check if story was already used
				if(!in_array($post->ID, $GLOBALS['shown_stories'])){
 
					$thumb_image_arr = get_field('feature_photo');
					$thumb_image     = $thumb_image_arr['url'];
					$thumb_image_alt = $thumb_image_arr['alt'];
					
					print '<div class="story-box">';
					print '<div class="story-thumb" style="background-image: url(' . $thumb_image  . '); border-color:#1373ba">';
					print '<div class="hover-dark"></div>';
					print '<img src="' . $GLOBALS['path'] . 'images/tier-story-spacer.png" class="spacer">';
					print '</div>';
					print '<div class="story-text">';
					 
					print '<h4><a href="' . get_permalink()  . '">' . get_the_title() . '</a></h4>';
					
					// get excerpt
					if(get_field('before_body_text') != ''){
						$tmpexc = get_field('before_body_text');
						$words = explode(' ', $tmpexc, 21);
						
						 if (count($words)> 20) {
						 	array_pop($words);
						 	array_push($words, '...');
						 	$text = implode(' ', $words);
						 }
						 
						print '<p>' . $text . '</p>';
					} else {
						print '<p>' . get_the_excerpt() . '</p>';
					}
					
					
					print '</div>';
					print '</div>';
					
				}
			}
			
			wp_reset_postdata();
			
			if(count($posts) == 0){
				print '<h4 style="color:#1373ba; font-size:20px;">Content coming soon. Be sure to check back.</h4>';
			}
			
			?>
			
 
		
		
		</div>
		
		<!-- END STORY GRID -->
		

		<div class="col right sidebar"  >

			<?php echo get_field('side_column'); ?>

		</div>		
		
		
		
		
		

		</div>
		
	</div>
</section>

<!-- END TOPIC LATEST -->





<?php 
	
get_footer(); 

?>
