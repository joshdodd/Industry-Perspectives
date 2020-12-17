<!--! BEGIN SIDEBAR -->

<?php

// If not parent, page get data for parent sidebar

if(is_single()){
	
	// article pages	
	
	//$parentid = get_page_by_title($GLOBALS['topicFull']);
	//$parent = get_post($parentid->ID);
	$sidebar_data = get_field('include_sidebar', $parent);
	
} else {
	
	// topic pages
	
	if($post->post_parent != 0){ 
		$parent = get_post($post->post_parent);
		$sidebar_data = get_field('include_sidebar', $parent);
	} else {
		$sidebar_data = get_field('include_sidebar');
	}
}


?>

<div class="col right sidebar" id="cat-sidebar">
	
	<?php

	if( $sidebar_data != ''){
		foreach($sidebar_data as $key=>$row){
	
		// AD
		if($row['section'] == 'Sponsor Ad'){

			$banner_ad_arr = $row['banner_ad'];
 
			$banner_ad = $banner_ad_arr['url'];
			$banner_alt = $banner_ad_arr['alt'];	


			print '<div class="group ad dsk"><a href="' . $row['banner_link'] . '" target="_blank" class="ad-click"><img src="' . $banner_ad . '" alt="'.$banner_alt.'"  class="spacer "></a></div>';
		}
		
		// RECENT ARTICLES
		if($row['section'] == 'Recent Articles'){
			print '<div class="group outlined rec-articles">';
			print '<div class="colorbar" style="background-color: #' . $GLOBALS['pageColor'] . ';"></div>';
			print '<h4 style="color: #' . $GLOBALS['pageColor'] . ';">Recent Articles</h4>';
			print '<ul>';
													
			$posts = get_posts('posts_per_page=4&order=DESC&orderby=meta_value&meta_key=cfdate');
			foreach($posts as $key=>$post){				
				$the_date = strtotime(get_field('cfdate'));
				$the_date = date('n.j.y', $the_date);					
				print '<li><a href="' . get_permalink()  . '">' . get_the_title() . '<time>' . $the_date . '</time></a><div class="botborder"></div></li>';				
			}
			
			wp_reset_postdata();
							
			print '</ul>';
			print '<a href="' . $GLOBALS['url'] . 'the-latest/" class="see-all">See All</a>';
			print '</div>';
		}
		
		// EXPERT QA
		if($row['section'] == 'Expert Q&A'){
			print '<div class="group outlined expert-qa">';
			print '<div class="colorbar" style="background-color: #' . $GLOBALS['pageColor'] . ';"></div>';
			print '<h4 style="color: #' . $GLOBALS['pageColor'] . ';">Expert Q&A</h4>';
			print '<div class="row">';
			print '<div class="thumb"><img src="' . $GLOBALS['path'] . 'images/expertqa-thumb.jpg"></div>';
			print '<p><a href="' . $GLOBALS['url'] . 'expert-qa/">Learn best practices from IPs in the field from our recent Q&A interview with?</a></p>';
			print '</div>';
			print '</div>';
		}
		
		// GALLERIES
		if($row['section'] == 'Galleries'){
			print '<div class="group galleries">';
			print '<h4>Galleries</h4>';
			print '<p>Browse latest resources from industry partners and APIC.</p>';
			print '<a href="' . $GLOBALS['url'] . 'galleries/" class="box-btn">Click to See More <span class="icon-angle-right"></span></a>';
			print '</div>';
		}
		
		// SIGN UP
		if($row['section'] == 'Sign Up'){
			print '<div class="group alerts">';
			print '<p>Sign Up for Alerts</p>';
			print '<form id="email-signup" name="" method="post" action="">';
			print '<input type="email" name="email" placeholder="Email">';
			print '<button type="submit"><span class="icon-angle-right"></span></button>';
			print '</form>';
			print '</div>';
		}	
		
	}	
	}
		
	?>
	
</div>

<!-- END SIDEBAR -->