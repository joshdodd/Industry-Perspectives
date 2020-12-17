<?php

/*
Template Name: Recent News
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
		
		<div class="row spaced">



		<!--! BEGIN STORY GRID -->
		
		<div class="col left stories-grid">
			
			<?php
							
			$articles = get_field('external_articles');
			$order = array();
			foreach($articles as $i => $row){
				$order[$i] = $row['pub_date'];
			}
			
			array_multisort($order, SORT_DESC, $articles);	
			
			foreach($articles as $key=>$row){
					
				// format date
				$pub_date = strtotime($row['pub_date']);
				$the_date = date('n.j.y', $pub_date);
				
				print '<div class="story-box">';
				print '<div class="story-box-contents">';
				print '<div class="story-text">';
				print '<time>' . $the_date . ' <span class="vline-div">|</span> ' . $row['publication'] . '</time>';
				print '<h4><a href="' . $row['link'] . '" target="_blank">' . $row['title'] . '</a></h4>';				
				print '</div></div>';
				print '</div>';

			}
			
			wp_reset_postdata();
			
			?>

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

		
		

		</div>
		
	</div>
</section>

<!-- END STORY LIST -->





<?php 
	
get_footer(); 

?>