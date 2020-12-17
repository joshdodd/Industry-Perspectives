<?php

/*
Template Name: Contact
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
	
	<!--
	<div class="row spaced">
		<div class="col left">
			
			
			<form name="contactForm" id="contactForm" action="<?=$GLOBALS['path']?>scripts/form.php" method="post">
				<input type="hidden" name="thanks_page" value="<?=$GLOBALS['url']?>feedback-thanks/">
				<input type="hidden" name="form_type" value="feedback">
				<input type="text" name="name" placeholder="YOUR NAME" data-type="req">
				<input type="text" name="email" placeholder="YOUR EMAIL ADDRESS" data-type="req">
				<textarea name="message" placeholder="MESSAGE" data-type="req"></textarea>
				<input type="submit" value="send">
			</form>
			
			
			
			<div class="contact-info mob">
				<?php echo get_field('side_column_address'); ?>
			</div>
			
			<span<?php if($GLOBALS['formattedName'] == 'feedback'){ print ' style="display:none;"'; }?>>
			<h3>Follow Us</h3>
			<nav class="social">
				<ul>
					<li><a href="https://twitter.com/apic" target="_blank"><span class="icon-twitter"></span></a></li>
					<li><a href="https://www.facebook.com/APICInfectionPreventionandYou"><span class="icon-facebook" target="_blank"></span></a></li>
					<li><a href="https://www.youtube.com/user/APICInc"><span class="icon-youtube" target="_blank"></span></a></li>
					<li><a href="https://www.linkedin.com/groups/5186466/profile"><span class="icon-linkedin" target="_blank"></span></a></li>
					<li><a href="#" class="rss"><span class="icon-rss"></span></a></li>	
				</ul>
			</nav>
			</span>
			
		</div>
		<div class="col right">
			<?php echo get_field('side_column_address'); ?>
		</div>
	</div>
	-->
		
	</div>
</section>

<!-- END TIER CONTENTS -->





<?php 
	
get_footer(); 

?>