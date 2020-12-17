<?php

/*
Template Name: About
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





<!--! BEGIN ABOUT INTRO -->

<?php

/*
$intro = get_field('about_intro');

foreach($intro as $key=>$row){
	$intro = $row['intro_text'];
	$image = $row['image'];
}
*/
	
?>
<!--
<section id="about-intro">
	<div class="contentContainer divborder">
		
		<div id="about-intro-text" class="row spaced">
			<div class="col left">				
				<?=$intro?>
			</div>
			<div class="col right">
				<div class="about-intro-image" style="background-image:url(<?=$image?>);">
					<img src="<?=$image?>">
				</div>
			</div>
		</div>
		
	</div>
</section>
-->
<!-- END ABOUT INTRO -->






<!--! BEGIN TIER CONTENTS -->

<section id="tier-contents">
	<div class="contentContainer">
		
		<div class="row spaced">
			
		<div class="col left">
			<?php echo apply_filters('the_content',$post->post_content); ?>
		</div>
		
		<div class="col right">
			<?php echo get_field('side_column'); ?>
		</div>
		
		</div>
			
	</div>
</section>

<!-- END TIER CONTENTS -->





<?php 
	
get_footer(); 

?>