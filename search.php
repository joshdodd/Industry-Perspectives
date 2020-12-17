<?php
/**
 * The template for displaying search results pages.
 *
 * @package WordPress
 * @subpackage APIC
 */

get_header();

?>





<!--! BEGIN ARTICLE -->

<section id="tier-stories">
	
	<div class="contentContainer">	
		
		<h3>Search Results</h3>
		
		<div class="row spaced">


		<!--! BEGIN ARTICLE CONTENTS -->
		
		<div id="search-results" class="col left stories-grid">
			
			<?php 
				
			$page = $_POST['s_page'];
			$args['offset'] = 10*($page-1);
			$args['posts_per_page'] = 10;
			$args['s'] = $_POST['s'];
			$s = $_POST['s'];
			$no_show = array('cfdate');
			
			$post_query = new WP_Query($args);
			
			if ( have_posts() ) : 
			while ($post_query->have_posts()) : $post_query->the_post();
			
				$page_contents = get_the_content();
				$custom_fields = get_post_custom();
			
				foreach ( $custom_fields as $field_key => $field_values ) {
				
						if(substr($field_key, 0, 1) != '_' && !in_array($field_key, $no_show)){
							//print $field_key.', ';
							foreach ( $field_values as $key => $value ){
							$page_contents .= $value . ' ';
						}
					}
				}
								
				$page_contents = wp_trim_words($page_contents, 20);
				$page_contents = preg_replace('/[^A-Za-z0-9]table id=[0-9\.\-][0-9\.\-][^A-Za-z0-9][^A-Za-z0-9]/', '', $page_contents);					
				
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
				print '<div class="story-thumb" style="background-image: url(' . $thumb_image . '); border-color:#' . $GLOBALS['lineColors'][$topicNum] . '">';
				print '<div class="hover-dark"></div>';
				print '<img src="' . $GLOBALS['path'] . 'images/tier-story-spacer.png" class="spacer">';
				print '</div>';
				print '<div class="story-text">';
				print '<time>' . $the_date . ' <span class="vline-div">|</span> ' . $topicFull . '</time>';
				print '<h4><a href="' . get_permalink()  . '">' . get_the_title() . '</a></h4>';
				print '<p>' . $page_contents . '</p>';
				print '</div>';
				print '</div>';					
			
			endwhile;		
			else : print '<p>There are no matches for your search.</p>';
			
			endif;
			
			
			
			
			
			// BEGIN PAGINATION
			
			$pag = '';
			$totPages = ceil($post_query->found_posts/10);
			
			for($i=1;$i<$totPages+1;$i++){
				if($i == $page){
					$pag .=  '<li class="active"><a href="#" class="search-pag" data-num="' . $i . '">' . $page . '</a></li>';
				} else {
					$pag .=  '<li><a href="#" class="search-pag" data-num="' . $i . '">' . $i . '</a></li>';
				}
			}
			
			if($totPages > 1){
				print '<div class="pagination">';
				print '<nav class="pag-nav"><ul>';
				
				if($page > 1){
					print '<li><a href="#" class="search-pag" data-num="' . ($page-1) . '"><span class="icon-angle-left arr left"></span></a></li>';					
				}
				
				print $pag;
				
				if($page < $totPages){
					print '<li><a href="#" class="search-pag" data-num="' . ($page+1) . '"><span class="icon-angle-right arr right"></span></a></li>';
				}
				
				print '</ul></nav>';
				print '</div>';	
			}
			
			// END PAGINATION
			
			?>

		</div>
		
		<!-- END ARTICLE CONTENTS -->		
		
		
		
		<?php get_sidebar(); ?>		
		
		

		</div>
		
	</div>
</section>

<!-- END ARTICLE -->





<?php 
	
get_footer(); 

?>