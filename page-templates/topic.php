<?php

/*
Template Name: Topic Landing
*/

$GLOBALS['topicID'] = get_field('topic_id');

$cat_id = get_field('category_id');

get_header(); 

?>





<!--! BEGIN TIER HERO -->

<section id="tier-hero" style="background-image: url(<?=$GLOBALS['path']?>images/hero-bg-<?=$GLOBALS['topicID']?>.jpg);" class="short">
	<div class="contentContainer">
				
		<div class="tier-hero-text">
			
			<div class="row">
			<h1><?php the_title(); ?></h1>
			
			<?php
				
			
			// If has sub pages
			if(sizeof($GLOBALS['subpages']) > 0){	
				print '<div class="subnav-menu"><div class="subnav-menu-btn">Focus Areas <span class="icon-angle-down"></span></div><nav><ul>';		
				foreach($GLOBALS['subpages'] as $key=>$subpage){			
					print '<li><a href="' . $GLOBALS['subpageurls'][$key] . '">' . $subpage . '</a></li>';
				}		
				print '</ul></nav></div>';
			}
			
			?>
			
			</div>
		
			<?php 
			
			print get_field('intro_text');
			
			
			$cta = get_field('cta_btn');
			if(count($cta) > 1){				
			
				foreach($cta as $key=>$row){
					$cta_txt = $row['text'];
					$cta_url = $row['links_to'];
				}
				
				if($cta_txt != ''){
					print '<a href="' . $cta_url . '" class="box-btn">' . $cta_txt . '<span class="icon-angle-right"></span></a>';				
				}	
			}
				
			?>
						
		
			
		</div>
	
	</div>	
	
	<?php
		
	/*
	// If has sub pages
	if(sizeof($GLOBALS['subpages']) > 0){	
		print '<div class="tier-subnav"><nav><ul><li class="title">Focus Areas</li>';		
		foreach($GLOBALS['subpages'] as $key=>$subpage){			
			print '<li><a href="' . $GLOBALS['subpageurls'][$key] . '"><span class="icon-angle-right icon"></span> <span class="txt">' . $subpage . '</span></a></li>';
		}		
		print '</ul></nav></div>';
	}
	*/
	
	?>
		
</section>

<!-- END TIER HERO -->





<!--! BEGIN FEATURE STORY -->

<?php
				
$main_features = get_field('featured_stories');
$featured_images = array();
$featured_dates = array();
$featured_titles = array();
$featured_urls = array();
$featured_excerpts = array();
	
foreach($main_features as $key=>$row){
		
	$post_object = $row['article'];
	$post = $post_object;
	setup_postdata($post);
	
	array_push($GLOBALS['shown_stories'], $post->ID);
	
	// format date
	$the_date = strtotime(get_field('cfdate'));
	$featured_dates[] = date('n.j.y', $the_date);
	
	// get image
	 
	$featured_image_arr = get_field('large_image');
	$featured_images[]     = $featured_image_arr['url'];
	$featured_image_alts[] = $featured_image_arr['alt'];

 
	$sponsor_logo_arr = get_field('sponsor_logo');
	$sponsor_logos[]    = $sponsor_logo_arr['url'];
	$sponsor_logo_alts[] = $sponsor_logo_arr['alt'];

	$featured_titles[] = get_the_title();
	$featured_urls[] = get_permalink();
	$featured_excerpts[] = get_the_excerpt();
	
}

wp_reset_postdata();
				
?>

<section id="feature-story" class="short">
	<div class="contentContainer">
	
		<div class="feature-story-box">
			
			<div class="feature-story-images">
				
				<?php
				
				foreach($featured_titles as $key=>$item){
					print '<div class="feature-story-image" data-num="' . ($key+1) . '" style="background-image: url(' . $featured_images[$key] . ')"></div>';
				}
					
				?>

				<div class="feature-story-photo mob"><img src="<?=$GLOBALS['path']?>images/category-feature-image.jpg" alt=" " class="spacer"></div>
				
				<div class="feature-dots">
					
					<?php
				
					foreach($featured_titles as $key=>$item){
						print '<div class="feature-dot';
						if($key == 0){print ' active';}
						print '" data-num="' . ($key+1) . '"></div>' . "\n";
					}
					
					?>

				</div>
				
			</div>
			
			
			
			<p class="feature-story-label">Feature Story</p>
			
			
			<div class="feature-story-callout"><div class="feature-story-wrap">
				
				<?php
				
				foreach($featured_titles as $key=>$item){
					print '<div class="feature-story-contents" data-num="' . ($key+1) . '">';
					print '<time>' . $featured_dates[$key] . '</time>';
					print '<h3>' . $featured_titles[$key] . '</h3>';
					print '<p>' . $featured_excerpts[$key] . '</p>';
					print '<a href="' . $featured_urls[$key] . '" class="cta">Read more <span class="icon-angle-right"></span></a>';				
					print '<div class="sponsor">';
					print '<p>Provided by</p>';
					print '<img src="' . $sponsor_logos[$key] . '" alt="'.$sponsor_logo_alts[$key] .'">';
					print '</div>';
					print '</div>';					
				}
					
				?>	
				
				<div class="corner-notch"></div>
			</div></div>		
		</div>
	
	</div>
</section>

<!-- END FEATURE STORY -->





<!--! BEGIN TOPIC LATEST -->

<section id="tier-stories">
	<div class="contentContainer">
		
		<hgroup class="spaced">
			<h3>Latest Stories</h3>
						
			<?php 
			
			//include('filters.php'); 
			
			?>
					
		</hgroup>
		
		<div class="row spaced">



		<!--! BEGIN STORY GRID -->
		
		<div class="col left stories-grid">
			
			<?php
				
			// get id number for category queries
			foreach($GLOBALS['sectionIDs'] as $key=>$section){
				if($section == get_field('topic_id')){$queryNum = $GLOBALS['queryIDs'][$key];}
			}		
			
			$perpage = 8;
			
			$args = array(
				'cat'			=> $cat_id,
				'posts_per_page'	=> $perpage,
				'offset'			=> $perpage*($page-1),
				'order'				=> 'DESC',
				'orderby'			=> 'meta_value',
				'meta_key'			=> 'cfdate',
				'post__not_in' 		=> $GLOBALS['shown_stories']
			);
			
			//$my_query1 = new WP_Query($args);							
			$posts = get_posts($args);
			
			foreach($posts as $key=>$post){
				 setup_postdata($post);
							
				// check if story was already used
				if(!in_array($post->ID, $GLOBALS['shown_stories'])){
				
					// get full topic name
					$field = get_field_object('field_579f7f6350d36');
					$value = get_field('topic_id');
					$topicFull = $field['choices'][$value];
					
					// get id number for colors
					foreach($GLOBALS['sectionIDs'] as $key2=>$section){
						if($section == get_field('topic_id')){$topicNum = $key2;}
					}
					
					// format date
					$the_date = strtotime(get_field('cfdate'));
					$the_date = date('n.j.y', $the_date);

					$thumb_image_arr = get_field('thumbnail_image');
					$thumb_image     = $thumb_image_arr['url'];
					$thumb_image_alt = $thumb_image_arr['alt'];
					
					print '<div class="story-box">';
					print '<div class="story-thumb" style="background-image: url(' . $thumb_image  . '); border-color:#' . $GLOBALS['lineColors'][$topicNum] . '">';
					print '<div class="hover-dark"></div>';
					print '<img src="' . $GLOBALS['path'] . 'images/tier-story-spacer.png" class="spacer">';
					print '</div>';
					print '<div class="story-text">';
					print '<time>' . $the_date . ' <span class="vline-div">|</span> ' . $topicFull . '</time>';
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
			
						
			
			
			
			<!--! BEGIN PAGINATION -->
			
			<?php
				
			// figure out total posts
			
			$args = array(
				'category'			=> $queryNum,
				'posts_per_page'	=> -1,
				'post__not_in' 		=> $GLOBALS['shown_stories']
			);
			$totposts = get_posts($args);
				
			$pag = '';
			$tot = count($totposts);
			$totPages = ceil($tot/$perpage);
						
			for($i=1;$i<$totPages+1;$i++){
				if($i == $page){
					$pag .=  '<li class="active"><a href="#">' . $page . '</a></li>';
				} else {
					$pag .=  '<li><a href="' . get_site_url() . '/' . $post->post_name . '/' . $i . '">' . $i . '</a></li>';
				}
			}
			
			if($totPages > 1){
				print '<div class="pagination">';
				print '<nav class="pag-nav"><ul>';
				
				if($page > 1){
					print '<li><a href="' . get_site_url() . '/' . $post->post_name . '/' . ($page-1) . '"><span class="icon-angle-left arr left"></span></a></li>';					
				}
				
				print $pag;
				
				if($page < $totPages){
					print '<li><a href="' . get_site_url() . '/' . $post->post_name . '/' . ($page+1) . '"><span class="icon-angle-right arr right"></span></a></li>';
				}
				
				print '</ul></nav>';
				print '</div>';	
			}
			
			?>
			
			<!-- END PAGINATION -->

			
			
		
		
		</div>
		
		<!-- END STORY GRID -->
				
		
		
		<?php get_sidebar(); ?>	
		
		

		</div>
		
	</div>
</section>

<!-- END TOPIC LATEST -->





<?php 
	
get_footer(); 

?>