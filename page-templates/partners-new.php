<?php

/*
Template Name: Strategic Partners
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





<!--! BEGIN TIER CONTENTS -->

<section id="tier-contents">
	<div class="contentContainer">
		<div class="row spaced">
			<div class="col left">
				<?php echo apply_filters('the_content',$post->post_content); ?>
			
				<div id="partner-intro-text">
					<?php echo get_field('partner_intro'); ?>
				</div>



				<div class="flextable">
					<?php

					$partners = get_field('strategic_partners');

					foreach($partners as $key=>$row){ 
						print '<div class="flex-cell flex-cell-25"><a href="' . $row['link'] . '" target="_blank"><img src="' . $row['logo'] . '" class="spacer"></a></div>';
						print '<div class="flex-cell flex-cell-75">' . $row['description'] . ' <a href="' . $row['link'] . '" class="dl-button" target="_blank">Visit Website</a></div>';
					}
					?>


				</div>




			
				<!-- <div id="tier-partner-logos">
						
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
					
				</div> -->
			</div>

			<div class="col right">
				<?php echo get_field('side_column'); ?>
			</div>
			
		</div>
	<?php //echo apply_filters('the_content',$post->post_content); ?>
			
	</div>
</section>

<!-- END TIER CONTENTS -->





<?php 
	
get_footer(); 

?>