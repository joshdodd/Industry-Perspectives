<?php

/*
Template Name: Events
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
		
		<?php echo apply_filters('the_content',$post->post_content); ?>
		
		<hgroup class="spaced">
			 					
		</hgroup>
		
		<?php 
			//include('filters.php'); 
		?>
		
		<div class="row spaced">



		<!--! BEGIN STORY GRID -->
		
		<div class="col left stories-grid">
			

			<h2 style="margin-bottom: 3.5em; padding: 0 0 15px 0; border-bottom: 1px solid #ccc;">Upcoming <?php echo get_field('page_name'); ?></h2>

			<?php
							
			$events = get_field('events');
			$order = array();
			foreach($events as $i => $row){
				$order[$i] = $row['start_date'];
			}
			
			if($_REQUEST['order'] == 'old'){
				array_multisort($order, SORT_DESC, $events);
			} else {
				array_multisort($order, SORT_ASC, $events);
			}	


			$count = 0;
			foreach($events as $key=>$row){
					
				// format date

				$now_time=time();
 
				$e_time = strtotime($row['start_date']);
				 

				$start_date = strtotime($row['start_date']);
				 
				$start_date = date('n.j.y', $start_date);
				
				if($row['end_date'] != ''){
					$end_date = strtotime($row['end_date']);
					$end_date = date('n.j.y', $end_date);
					$the_date = $start_date . '-' . $end_date;
				} else {
					$the_date = $start_date;
				}

				
				
				if($now_time <= $e_time){

					$count++;;
				
					print '<div class="story-box';
					
					if($row['event_page_link'] == ''){
						print ' nolink';
					}

					$thumb_img_arr = $row['thumbnail__image'];
		 
					$thumb_img = $thumb_img_arr['url'];
					$thumb_alt = $thumb_img_arr['alt'];
					
					print '">';
					print '<div class="story-box-contents">';
					print '<div class="story-thumb">';
					print '<img src="' . $thumb_img  . '" class="spacer">';
					print '</div>';
					print '<div class="story-text">';
					print '<time>' . $the_date . ' <span class="vline-div">|</span> ' . $row['location'] . '</time>';
					print '<h4>' . $row['title'] . '</h4>';
					print '<p>' . $row['blurb'] . '</p>';
					
					if($row['event_page_link'] != ''){
						$cta_text = 'Read More';
						if($row['event_page_link_text'] != ''){$cta_text = $row['event_page_link_text'];}
						print '<p ><a class="dl-button" style="color:white;" href="' . $row['event_page_link'] . '" target="_blank">' . $cta_text . ' ></a></p>';
					}
					
					print '</div></div>';
					print '</div>';
				}

				// if($count == 0){
				// 	echo "<p style='margin-bottom: 5em'>There are currently no upcoming " . get_field('page_name').". Please check back soon for updates!</p>";
				// }
 	

			}

			


			
			wp_reset_postdata();
			
			?>


			<h2 style=" padding: 0 0 15px 0; border-bottom: 1px solid #ccc; margin-bottom: 15px;">Past <?php echo get_field('page_name'); ?></h2>

			<?php
							
			$events = get_field('events');
			$order = array();
			foreach($events as $i => $row){
				$order[$i] = $row['start_date'];
			}
			
			// if($_REQUEST['order'] == 'old'){
			// 	array_multisort($order, SORT_DESC, $events);
			// } else {
			// 	array_multisort($order, SORT_ASC, $events);
			// }		
			
			$count = 0;
			foreach($events as $key=>$row){
					
				// format date

				$now_time=time();
 
				$e_time = strtotime($row['start_date']);
				 

				$start_date = strtotime($row['start_date']);
				 
				$start_date = date('n.j.y', $start_date);
				
				if($row['end_date'] != ''){
					$end_date = strtotime($row['end_date']);
					$end_date = date('n.j.y', $end_date);
					$the_date = $start_date . '-' . $end_date;
				} else {
					$the_date = $start_date;
				}

				
				if($now_time >= $e_time){

					$count++;
				
					print '<div class="story-box';
					
					if($row['event_page_link'] == ''){
						print ' nolink';
					}

					$thumb_img_arr = $row['thumbnail__image'];
		 
					$thumb_img = $thumb_img_arr['url'];
					$thumb_alt = $thumb_img_arr['alt'];
					
					print '">';
					print '<div class="story-box-contents">';
					print '<div class="story-thumb">';
					print '<img src="' . $thumb_img  . '" class="spacer">';
					print '</div>';
					print '<div class="story-text">';
					print '<time>' . $the_date . ' <span class="vline-div">|</span> ' . $row['location'] . '</time>';
					print '<h4>' . $row['title'] . '</h4>';
					print '<p>' . $row['blurb'] . '</p>';
					
					if($row['event_page_link'] != ''){
						$cta_text = 'Read More';
						if($row['event_page_link_text'] != ''){$cta_text = $row['event_page_link_text'];}
						print '<p  ><a class="dl-button" style="color:white;"  href="' . $row['event_page_link'] . '" target="_blank">' . $cta_text . ' ></a></p>';
					}
					
					print '</div></div>';
					print '</div>';
				}

	 

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
			<br><br>
			<hr>
			<p>Want to post an industry event or news item? Email <a href="mailto:industryperspectives@apic.org">industryperspectives@apic.org</a> for more information.</p>
&nbsp;
		</div>
		
		<!-- END AD SPOTS -->

		
		

		</div>
		
	</div>
</section>

<!-- END STORY LIST -->





<?php 
	
get_footer(); 

?>