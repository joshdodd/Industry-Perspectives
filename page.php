<?php

/*
Template Name: Generic Template
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
		
	<?php echo apply_filters('the_content',$post->post_content); ?>
			
	</div>
</section>

<!-- END TIER CONTENTS -->





<?php 
	
get_footer(); 

?>