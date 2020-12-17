<?php

/*
Template Name: Three Column Grid
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
		
		<div class="col left stories-grid spaced">
			
			<?php		
			
			$perpage = 12;
			
			if($GLOBALS['formattedName'] == 'galleries'){$filter_cat = 'galleries';}
			if($GLOBALS['formattedName'] == 'resources-tools'){$filter_cat = 'resources';}
			$queryNum = get_cat_ID($filter_cat);
			
			$args = array(
				'category'			=> $queryNum,
				'posts_per_page'	=> $perpage,
				'offset'			=> $perpage*($page-1),
				'order'				=> 'DESC',
				'orderby'			=> 'meta_value',
				'meta_key'			=> 'cfdate'
			);			
			
			$posts = get_posts($args);

			foreach($posts as $key=>$post){
				setup_postdata($post);						
				
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
				print '<div class="cat">';
				print '<span class="icon-' . get_field('topic_id') . ' icon" style="color:#' . $GLOBALS['iconColors'][$topicNum] . ';"></span>';
				print '<p>' . $topicFull . ' <span class="vline-div">|</span> ' . $the_date . '</p>';
				print '</div>';
				print '<div class="story-thumb" style="background-image: url(' . $thumb_image . ');">';
				print '<div class="hover-dark"></div>';
				print '<img src="' . $GLOBALS['path'] . 'images/tier-story-spacer.png" class="spacer">';
				print '</div>';
				print '<h4><a href="' . get_permalink()  . '">' . get_the_title() . '</a></h4>';
				print '<p>' . get_the_excerpt() . '</p>';
				print '</div>';
			}
			
			wp_reset_postdata();
			
			?>
			
			<div class="story-box filler"></div>
			<div class="story-box filler"></div>
			
						
			
			
			
			<!--! BEGIN PAGINATION -->
			
			<?php
				
			// figure out total posts
			
			$args = array(
				'posts_per_page'	=> -1,
				'category'			=> $queryNum
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
				
		
		
		<!--! BEGIN SIDEBAR -->

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
		
		<!--! END SIDEBAR -->
		
		

		</div>
		
	</div>
</section>

<!--! END STORY LIST -->





<?php 
	
get_footer(); 

?>