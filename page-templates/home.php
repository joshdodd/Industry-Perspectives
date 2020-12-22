<?php

/*
Template Name: Home
*/


if($_COOKIE['STYXKEY_revisit'] != 'yes'){
	$domain =  $_SERVER['HTTP_HOST'];
	setcookie("STYXKEY_revisit", "yes", strtotime( '+7 days' ), '/');
}

get_header(); 

?>
	

<div class="covid-banner">
	<a href="<?php echo get_home_url(); ?>/covid-19">COVID-19 Resources »</a>

</div>	
	
	
	
<!--! BEGIN HOME HERO -->

<section id="home-hero">
	<div class="row">
			
		<div class="home-feature big filler">
			<img src="<?=$GLOBALS['path']?>images/home-feature-spacer-big.png" class="spacer">
		</div>
		
		<?php
			
		$big_features = get_field('featured_stories');
			
		foreach($big_features as $key=>$row){
				
			$post_object = $row['article'];
			$post = $post_object;
			setup_postdata($post);
			
			array_push($GLOBALS['shown_stories'], $post->ID);
			
			// get full topic name
			$field = get_field_object('field_579f7f6350d36');
			$value = get_field('topic_id');
			$topicFull = $field['choices'][$value];
			
			// get id number for colors
			foreach($GLOBALS['sectionIDs'] as $key2=>$section){
				if($section == get_field('topic_id')){
					$topicNum = $key2;
				}
			}

			$featured_image_arr = get_field('large_image');
			$featured_image     = $featured_image_arr['url'];
			$featured_image_alt = $featured_image_arr['alt'];

			$sponsor_image_arr = get_field('sponsor_logo');
			$sponsor_image     = $sponsor_image_arr['url'];
			$sponsor_image_alt = $sponsor_image_arr['alt'];
			
			print '<div class="home-feature big slide" data-num="' . ($key+1) . '" style="background-image: url(' . $featured_image . ');">';
			print '<div class="hover-dark"></div>';
			print '<div class="home-feature-contents">';
			print '<div class="cat">';
			print '<span class="icon-' . get_field('topic_id') . '"></span>';
			print '<p>' . $topicFull . '</p>';
			print '</div>';		
			print '<div class="cta">';
			print '<h2>' . get_the_title() . '</h2>';
			print '<div class="cta-box">';
			print '<div class="box-overlay"><div style="background-color: #' . $GLOBALS['iconColors'][$topicNum] . ';"></div><div style="background-color: #' . $GLOBALS['iconColors'][$topicNum] . ';"></div></div>';
			
			print '<div class="row">';
			print '<div class="col left">';
			print '<p>' . get_the_excerpt() . '</p>';
			print '<a href="' . get_permalink()  . '">Read more</a>';
			print '</div>';
			print '<div class="col right">';
			
			print '<div class="sponsor">';
			print '<p>Sponsored by</p>';
			print '<img src="' . $sponsor_image . '" alt="' . $sponsor_image_alt .' " class="hero-sponsor">';
			print '</div>';
			
			print '</div>';
			print '</div>';
			
			print '</div>';
			print '</div>';			
			print '</div>';
			print '</div>';
							
		}
		
		wp_reset_postdata();
		
		?>		
		
		<div class="feature-dots">
			<?php
		
			foreach($big_features as $key=>$item){
				print '<div class="feature-dot';
				if($key == 0){print ' active';}
				print '" data-num="' . ($key+1) . '"></div>' . "\n";
			}
			
			?>
		</div>
				
	</div>
</section>

<!-- END HOME HERO -->





<!--! BEGIN HOME INTRO -->

<?php

$welcome = get_field('welcome_message');

if($welcome){

	foreach($welcome as $key=>$row){
		$headline = $row['headline'];
		$intro = $row['intro_text'];
		$image = $row['image'];
	}
}
?>

 <section id="home-intro" class="collapsed"><div class="contentContainer  short">
 
 
		
		<div id="home-intro-text" class="row spaced">



			<div class="col left">	

				 <!--  <div class="home-callout">
					<h2>STARC Systems Virtual Symposium | How to Repurpose the Built Environment to Create Additional Infection Isolation Capacity</h2>
					<h4>September 24, 2020 at 3:00 PM ET</h4>
 					<p>While some hospitals were more prepared than others for the COVID-19 pandemic, no one could have foreseen just how profound the impact of the crisis on our healthcare system would be. When the novel coronavirus hit the U.S., media reports and scenes of hospitals on the front lines struggling to keep up with patient surges demonstrated the importance of on demand flexibility in dealing with repurposing the built environment. Over the past six months, we’ve learned several valuable lessons that can help your healthcare facility prepare for a surge, or resurge, of cases in your facility.</p>

 					<p><a href="https://industryperspectives.com//starc-systems-virtual-symposium/" class="home-callout-btn">Register Today</a></p>

				</div>  -->

		 		<h1>Welcome to Industry Perspectives</h1>
				<p><strong>The Association for Professionals in Infection Control and Epidemiology (APIC) created <em>Industry Perspectives</em>  because infection prevention and control is everybody’s business. Explore this site and find the latest information on products, research, and education for infection prevention and control coming out of industry.
</strong></p>
<p>&nbsp;</p>
		 



			</div>




			<div class="col right ads">
				 
					 <?php 
					 $side_banners = get_field('side_banners');
					$side_banner_img = array();
					$side_banner_url = array();
					
					if(!empty($side_banners)){
						foreach($side_banners as $key=>$row){
							$side_banner_img[] = $row['banner_image'];
							$side_banner_url[] = $row['banner_link'];
						}
					}

					 include('side-banners.php'); ?> 
			 
			</div>
		</div>
		
	</div>
</section>

<!-- END HOME INTRO -->





<!--! BEGIN HOME LATEST -->

<section id="home-stories">
	<div class="contentContainer divborder">
		
		<hgroup class="spaced">
			<h3>Latest Stories</h3>								
			<div><a href="<?=$GLOBALS['url']?>the-latest/">See All</a></div>
		</hgroup>
		
		<div class="row spaced">



		<!--! BEGIN STORY GRID -->
		
		<div class="col left stories-grid spaced">
			
			<?php
				
			// SPONSORED STORIES
			/*
			$sponsored_stories = get_field('sponsored_latest');
				
			foreach($sponsored_stories as $key=>$row){
					
				// grab post data
				$post_object = $row['article'];
				$post = $post_object;
				setup_postdata($post);
				
				// add story to array so it is not reused
				array_push($GLOBALS['shown_stories'], $post->ID);
				
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
				
				print '<div class="story-box sponsored">';
				print '<div class="cat">';
				print '<span class="icon-' . get_field('topic_id') . ' icon" style="color:#' . $GLOBALS['iconColors'][$topicNum] . ';"></span>';
				print '<p>' . $topicFull . ' <span class="vline-div">|</span> ' . $the_date . '</p>';
				print '</div>';
				print '<div class="story-thumb" style="background-image: url(' . get_field('thumbnail_image') . '); border-color:#' . $GLOBALS['lineColors'][$topicNum] . ';">';
				print '<div class="hover-dark"></div>';
				print '<img src="' . $GLOBALS['path'] . 'images/home-story-spacer.png" class="spacer">';
				print '</div>';
				print '<h4><a href="' . get_permalink()  . '">' . get_the_title() . '</a></h4>';
				print '<p>' . get_the_excerpt() . '</p>';
				print '</div>';
			}
			*/

			
			// ALL OTHER STORIES BY DATE
			
			//'category__not_in' => array(16),

			
			$args = array(
				'posts_per_page'	=> 20,
				'order'				=> 'DESC',
				'orderby'			=> 'meta_value',
				'meta_key'			=> 'cfdate'
			);			
			
			$posts = get_posts($args);
			$aCount = 0;
			foreach($posts as $key=>$post){
				setup_postdata($post);
			
				// check if story was already used
				//if(!in_array($post->ID, $GLOBALS['shown_stories'])){
				
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
					
					if($aCount>=12){
						print '<div class="story-box hidden" data-topic="' . get_field('topic_id') . '">';
					} else {
						print '<div class="story-box" data-topic="' . get_field('topic_id') . '">';
					}

					$thumb_image_arr = get_field('thumbnail_image');
					$thumb_image     = $thumb_image_arr['url'];
					$thumb_image_alt = $thumb_image_arr['alt'];
					
					print '<div class="cat">';
					print '<span class="icon-' . get_field('topic_id') . ' icon" style="color:#' . $GLOBALS['iconColors'][$topicNum] . ';"></span>';
					print '<p>' . $topicFull . ' <span class="vline-div">|</span> ' . $the_date . '</p>';
					print '</div>';
					print '<div class="story-thumb" style="background-image: url(' . $thumb_image  . '); border-color:#' . $GLOBALS['lineColors'][$topicNum] . ';">';
					print '<div class="hover-dark"></div>';
					print '<img src="' . $GLOBALS['path'] . 'images/home-story-spacer.png" class="spacer">';
					print '</div>';
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
					
					$aCount++;
				
				//}
			}
			
			wp_reset_postdata();
			
			
			?>
			
			<div class="story-box filler"></div>
			<div class="story-box filler"></div>
			<div class="story-box filler"></div>
			
			<a href="#" class="more-btn">More Stories <span>+</span></a>
			
		
		</div>
		
		<!-- END STORY GRID -->		
		
		
		<!--! AD SPOTS #1 -->
		
		<!-- <?php
		
		
		$side_banners = get_field('side_banners');
		$side_banner_img = array();
		$side_banner_url = array();
		
		if(!empty($side_banners)){
			foreach($side_banners as $key=>$row){
				$side_banner_img[] = $row['banner_image'];
				$side_banner_url[] = $row['banner_link'];
			}
		}
		
		
			
		?>
		
		<div class="col right ads">	
			<?php	
				
			//print get_field('home_sponsor_list');	
				
			
			include('side-banners.php');
			
			
			?>	
		</div>
		
		<!-- END AD SPOTS -->  
		
		
		
		
		</div>
		
	</div>
</section>

<!-- END HOME LATEST -->





<!--! BEGIN PARTNERS -->
<!--
<section id="home-partners">
	<div class="contentContainer divborder">
		
		<hgroup class="spaced">
			<h3>Strategic Partners</h3>
			<div><a href="<?=$GLOBALS['url']?>strategic-partners/">See All</a></div>
		</hgroup>
		
		<div class="partner-logos">
			
			<div class="row spaced">
				
				<?php
				
				$partners = get_field('strategic_partners');
				
				foreach($partners as $key=>$row){
					print '<div class="partner-logo"><a href="' . $row['link'] . '" target="_blank"><img src="' . $row['logo'] . '" class="spacer"></a></div>';
				}
					
				?>
				
				<div class="partner-logo filler"></div>
				<div class="partner-logo filler"></div>
				<div class="partner-logo filler"></div>
				<div class="partner-logo filler"></div>
			</div>
			
		</div>
		
	</div>
</section>
-->
<!--! END PARTNERS -->





<!--! BEGIN HOME RESOURCES -->

<section id="home-resources">
	<div class="contentContainer">
		
		<h3>More Resources</h3>
		
		<div class="row spaced">

			<div class="col left outlined rec-articles">
				<h4>Recent News</h4>	
				<ul>
					
					<?php
				
					// PULL ARTICLES FROM RECENT NEWS PAGE
					
					//$recent_articles = get_field('resources_recent_articles');
					$post = get_post(1918);
					$post = get_page_by_title('Recent News');
					setup_postdata($post);
					
					$articles = get_field('external_articles');
					$order = array();
					foreach($articles as $i => $row){
						$order[$i] = $row['pub_date'];
					}

					array_multisort($order, SORT_DESC, $articles);		
						
					foreach($articles as $key=>$row){
						
						if($key<5){
						
						// format date
						$pub_date = strtotime($row['pub_date']);
						$the_date = date('n.j.y', $pub_date);
						
						print '<li><a href="' . $row['link']  . '" target="_blank">' . $row['title'] . '<time>' . $row['publication'] . ', ' . $the_date . '</time></a><div class="botborder"></div></li>';						
						
						}
					}
			
					wp_reset_postdata();
			
					?>

				</ul>
				<a href="<?=$GLOBALS['url']?>recent-news/" class="see-all">See All</a>
			</div>
			
			<div class="col mid outlined resources-boxes">
				
			<script type="text/javascript" src="https://cqrcengage.com/apic/plugin/439778/bootstrap.js"></script>
			<div id="engage-plugin-439778"></div>





				<!-- <?php
				
				// FEATURED STORY BOXES
				
				$feature_boxes = get_field('resources_feature_boxes');
					
				foreach($feature_boxes as $key=>$row){
						
					// grab post data
					$post_object = $row['article'];
					$post = $post_object;
					setup_postdata($post);
					
					// get id number for colors
					foreach($GLOBALS['sectionIDs'] as $key2=>$section){
						if($section == get_field('topic_id')){$topicNum = $key2;}
					}

					$thumb_image_arr = get_field('thumbnail_image');
					$thumb_image     = $thumb_image_arr['url'];
					$thumb_image_alt = $thumb_image_arr['alt'];
					
					print '<div class="resources-box" style="background-image: url(' . $thumb_image . ');">';
					print '<div class="hover-dark"></div>';
					print '<img src="' . $GLOBALS['path'] . 'images/home-resources-spacer.png" class="spacer">';
					print '<div class="resources-box-text" style="background-color: #' . $GLOBALS['lineColors'][$topicNum] . ';">';
					print '<p><a href="' . get_permalink()  . '">' . get_the_title() . '</a></p>';
					print '</div>';
					print '</div>' . "\n\n";
					
				}
				
				wp_reset_postdata();
				
				?> -->
				
				<!--
					<div class="resources-box" style="background-image: url(<?=$GLOBALS['path']?>images/home-resources-image2.jpg);">
						<div class="hover-dark"></div>
						<img src="<?=$GLOBALS['path']?>images/home-resources-spacer.png" class="spacer">
						<div class="resources-box-text" style="background-color: #fbb944;">
							<p>Nasal Antiseptic Swabs Offer Solution for IPs</p>
						</div>
						<div class="video-icon">
							<div class="video-icon-circle"><span class="icon-play"></span></div>
						</div>
					</div>
				-->
				
			</div>
			
			<div class="col right">
				<div class="twitter-feed outlined">
					<h4><span class="icon-twitter"></span><a href="http://www.twitter.com/APICIPIPC/" target="_blank">@APICIPIPC</a></h4>	
					<ul>
						<?php 
							include('tweets.php'); 
						?>
						<li class="follow"><a href="http://www.twitter.com/APICIPIPC/" target="_blank">Follow us on Twitter</a></li>
					</ul>
				</div>
				
				<div class="home-email-signup" style="display:none;">
					<p>Sign Up for Alerts</p>
					<?php
					
					echo do_shortcode('[contact-form-7 id="1253" title="Alerts" html_id="email-signup"]');
						
					?>
					<!--
					<form id="email-signup" name="" method="post" action="">
						<input type="email" name="email" placeholder="Email">
						<button type="submit"><span class="icon-angle-right"></span></button>
					</form>
					-->
				</div>
			</div>
			
		</div>
		
	</div>
</section>

<!-- END HOME RESOURCES -->





<!--! BEGIN TOPICS INTERACTIVE -->

<?php

$topic_sections = get_field('topics_interactive');
$topicIDs = array();
$topicFulls = array();
$topicDescs = array();
$topicBGs = array();			

foreach($topic_sections as $key=>$row){
	$topicIDs[] = $row['topic_id'];
	
	// get full topic name
	foreach($GLOBALS['sectionIDs'] as $key2=>$item){
		if($row['topic_id'] == $item){
			$topicFulls[] = $GLOBALS['sectionsFull'][$key+1];
		}
	}
	
	$topicDescs[] = $row['description'];
	$topicBGs[] = $row['background_image'];
}

?>

<section id="home-learn">
	
	<div class="side-arrow left"><div class="arrow-box"><span class="icon-angle-left icon"></span></div></div>
	<div class="side-arrow right"><div class="arrow-box"><span class="icon-angle-right icon"></span></div></div>
	
	<?php
	
	foreach($topicBGs as $key=>$item){
		print '<div class="home-learn-bg" data-num="' . ($key+1) . '" style="background-image: url(' . $item . ')"></div>';
	}
		
	?>
	
	<div class="contentContainer">
		
		<div class="home-learn-contents">
			
			<div class="home-learn-text spacer"></div>
			
			<?php
	
			foreach($topicIDs as $key=>$item){				
				print '<div class="home-learn-text" data-num="' . ($key+1) . '">';
				print '<h3>' . $topicFulls[$key] . '</h3>';
				print '<p>' . $topicDescs[$key] . '</p>';
				print '<a href="' . $GLOBALS['globalPageURLs'][$key+1] . '" class="box-btn">Learn More</a>';
				print '</div>';
			}
				
			?>
			
		</div>
		
		<div class="home-learn-icons">
			<ul class="spaced">
				
				<?php
					
				foreach($topicIDs as $key=>$item){					
					print '<li ';
					if($key == 0){print 'class="active"';}					
					print 'data-num="' . ($key+1) . '"><a href="#"><span class="icon-' . $topicIDs[$key] . ' icon"></span></a><span class="learn-icon-title"><span>' . $topicFulls[$key] . '</span></span></li>';					
				}
				
				?>
				
				<li class="filler"></li>

			</ul>
		</div>
		
	</div>
</section>

<!-- END TOPICS INTERACTIVE -->





<?php 
	
get_footer(); 

?>