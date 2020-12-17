<?php

/*
Template Name: Single Column Stories
*/

get_header(); 

?>





<!--! BEGIN HEADER -->

<section id="tier-header" style="background-image: url(<?=$GLOBALS['path']?>images/header-bg-generic.jpg);">		
	<div class="row">
		
	<h1><?php the_title(); ?></h1>
	
	</div>		
</section>

<!-- END HEADER -->





<!--! BEGIN STORY LIST -->

<section id="tier-stories">
	<div class="contentContainer">
		
		<?php include('filters.php'); ?>
		
		<div class="row spaced">



		<!--! BEGIN STORY GRID -->
		
		<div class="col left stories-grid">
			
			<?php		
			
			$perpage = 8;
			
			$args = array(
				'posts_per_page'	=> $perpage,
				'offset'			=> $perpage*($page-1),
				'orderby'			=> 'meta_value',
				'meta_key'			=> 'cfdate'
			);
			
			// add categories to query
			$in_cats = array();
			$newqstring = '';
			
			if($GLOBALS['formattedName'] == 'expert-qas'){				
				$in_cats[] = get_cat_ID('Expert QA');
			}
			
			if(isset($_GET['topic'])){
				$in_cats[] = $_GET['topic'];
				$newqstring .= '?topic='.$_GET['topic'];
			}
			
			if(isset($_GET['order']) && $_GET['order'] == 'old'){
				$args['order'] = 'ASC';
			} else {
				$args['order'] = 'DESC';
			}

			if(sizeof($in_cats) > 0){
				$args['category'] = $in_cats;
			}					
										
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

					$thumb_image_arr = get_field('thumbnail_image');
					$thumb_image     = $thumb_image_arr['url'];
					$thumb_image_alt = $thumb_image_arr['alt'];
					
					// format date
					$the_date = strtotime(get_field('cfdate'));
					$the_date = date('n.j.y', $the_date);
					
					print '<div class="story-box" data-topic="' . get_field('topic_id') . '" data-date="' . get_field('cfdate') . '">';
					print '<div class="cat">';
					print '<span class="icon-' . get_field('topic_id') . ' icon" style="color:#' . $GLOBALS['iconColors'][$topicNum] . ';"></span>';
					print '<p>' . $topicFull . ' <span class="vline-div">|</span> ' . $the_date . '</p>';
					print '</div>';
					print '<div class="story-box-contents">';
					print '<div class="story-thumb" style="background-image: url(' . $thumb_image  . ');">';
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
					
					print '</div></div>';
					print '</div>';
					
				}
			}
			
			wp_reset_postdata();
			
			?>
						
					
			
			<!--! BEGIN PAGINATION -->
			
			<?php
				
			// figure out total posts
			
			$args = array(
				'posts_per_page'	=> -1,
				'post__not_in' 		=> $GLOBALS['shown_stories']
			);
			
			if(sizeof($in_cats) > 0){
				$args['category'] = $in_cats;
			}	
			$totposts = get_posts($args);
				
			$pag = '';
			$tot = count($totposts);
			$totPages = ceil($tot/$perpage);
						
			for($i=1;$i<$totPages+1;$i++){
				if($i == $page){
					$pag .=  '<li class="active"><a href="#">' . $page . '</a></li>';
				} else {
					$pag .=  '<li><a href="' . get_site_url() . '/' . $post->post_name . '/' . $i . '/' . $newqstring . '">' . $i . '</a></li>';
				}
			}
			
			if($totPages > 1){
				print '<div class="pagination">';
				print '<nav class="pag-nav"><ul>';
				
				if($page > 1){
					print '<li><a href="' . get_site_url() . '/' . $post->post_name . '/' . ($page-1) . '/' . $newqstring . '"><span class="icon-angle-left arr left"></span></a></li>';					
				}
				
				print $pag;
				
				if($page < $totPages){
					print '<li><a href="' . get_site_url() . '/' . $post->post_name . '/' . ($page+1) . '/' . $newqstring . '"><span class="icon-angle-right arr right"></span></a></li>';
				}
				
				print '</ul></nav>';
				print '</div>';	
			}
			
			?>
			
			<!-- END PAGINATION -->

			
			
		
		
		</div>
		
		<!-- END STORY GRID -->
		
		
		
		<!--! AD SPOTS #1 -->
		
		<?php
			
		$post = get_post(1190);
		setup_postdata($post);		
		
		$side_banners = get_field('side_banners');
		$side_banner_img = array();
		$side_banner_url = array();
		
		if(!empty($side_banners)){
			foreach($side_banners as $key=>$row){
				$side_banner_img[] = $row['banner_image'];
				$side_banner_url[] = $row['banner_link'];
			}
		}
		
		wp_reset_postdata();
			
		?>
		
		<div class="col right ads">	
			<?php					
			
			include('side-banners.php');			
			
			?>	
		</div>
		
		<!-- END AD SPOTS -->
				
		
		
		<!--! BEGIN SIDEBAR -->
		<!--
		<div class="col right sponsors">
			
			<div class="sponsor-logos">
				<h4>Featured Sponsers</h4>
				<div class="sponsor-grid">
					
					<?php
						
					$sponsors = get_field('sponsors');
					
					if(sizeof($sponsors)>1){
						foreach($sponsors as $key=>$row){
							print '<div class="sponsor-box"><a href="' . $row['link'] . '" target="_blank"><img src="' . $GLOBALS['path'] . 'images/sidesponsor-spacer.png" class="spacer"><div class="logo"><img src="' . $row['logo'] . '"></div></a></div>';
						}
					}
						
					?>
					
				</div>
			</div>
		</div>
		-->
		<!--! END SIDEBAR -->
		
		

		</div>
		
	</div>
</section>

<!-- END STORY LIST -->





<?php 
	
get_footer(); 

?>