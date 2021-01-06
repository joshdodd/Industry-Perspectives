<?php
 

get_header(); 

?>
 

<!--! BEGIN HEADER -->

<section id="tier-header" style="background-image: url(<?=$GLOBALS['path']?>images/header-bg-generic.jpg);">		
	<div class="row">
		
	<h1 class="h1-small"><?php echo  single_term_title(); ?> Articles</h1>
	
	</div>		
</section>

<!-- END HEADER -->





<!--! BEGIN STORY LIST -->

<section id="tier-stories">
	<div class="contentContainer">
		
		<?php  //include('filters.php'); ?>
		
		<div class="row spaced">



		<!--! BEGIN STORY GRID -->
		
		<div class="col left stories-grid">
			
			<?php	

			$taxonomy = get_queried_object();

			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			
			$perpage = 8;
 
			$args = array(
				'tax_query' => array(
			        array(
			            'taxonomy' => $taxonomy->taxonomy,
			            'field'    => 'term_id',
			            'terms'    => $taxonomy->term_id,
			        ),
			    ),
				'posts_per_page'	=> $perpage,
				'paged' 			=> $paged,
 
			);
 
			$posts = new WP_Query( $args );

			if ( $posts->have_posts() ) :
				while ( $posts->have_posts() ) : $posts->the_post(); 

					//get primary content type taxonomy
					$content_types = get_post_primary_category($post->ID, 'content_type'); 
					$content_type = $content_types['primary_category'];

					$ct_name = $content_type->name;
					$ct_link = get_term_link($content_type->term_id);

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

					if($ct_name){
					print '<div class="ct-wrapper ct-list ">
						<a class="content-type-link" href="'.$ct_link.'"><i class="far fa-file-alt"></i>  '.$ct_name.'</a>
					</div>';
					}
					
					
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



				endwhile;

				?>
				
		        <div class="pagination">
		        	
			    <?php 
			        $page_links =  paginate_links( array(
			            'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
			            'total'        => $posts->max_num_pages,
			            'current'      => max( 1, get_query_var( 'paged' ) ),
			            'format'       => '?paged=%#%',
			            'show_all'     =>  true,
			            'type'         => 'array',
			            'end_size'     => 2,
			            'mid_size'     => 1,
			            'prev_next'    => true,
			            'prev_text'    => sprintf( '<i></i> %1$s', __( '     ', 'text-domain' ) ),
			            'next_text'    => sprintf( '%1$s <i></i>', __( '   >  ', 'text-domain' ) ),
			            'add_args'     => false,
			            'add_fragment' => '',
			        ) );

			         if( $page_links ) {
					     echo '<nav class="pag-nav"><ul>';
					     foreach($page_links as $page_link ) {
					          echo "<li>".$page_link."</li>";
					     }
					     echo '</ul></nav>';
					 }



			    ?>
			    	</ul></nav>
				</div>
				<?php wp_reset_postdata();  

			endif;

 
			
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
			
			 //include('side-banners.php');			
			
			?>	
		</div>
 
		

		</div>
		
	</div>
</section>

<!-- END STORY LIST -->





<?php 
	
get_footer(); 

?>