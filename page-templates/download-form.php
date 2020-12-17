<?php

/*
Template Name: Download PDF
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
				<input type="hidden" name="thanks_page" value="<?=$_COOKIE['pdfdl']?>">
				<input type="hidden" name="form_type" value="download">
				
				<fieldset>
					<label>Are you an APIC member?</label>
					<fieldset><input type="radio" name="member" value="Yes"><label>Yes</label></fieldset>
					<fieldset><input type="radio" name="member" value="No"><label>No</label></fieldset>
				</fieldset>

				<input type="text" name="first_name" placeholder="First Name*" data-type="req">
				<input type="text" name="last_name" placeholder="Last Name*" data-type="req">
				<input type="text" name="email" placeholder="Email*" data-type="req">
				
				<fieldset>
					<label>Please indicate (Y/N) whether you want to share your email with the sponsor of this content.</label>
					<fieldset><input type="radio" name="share" value="Yes"><label>Yes</label></fieldset>
					<fieldset><input type="radio" name="share" value="No"><label>No</label></fieldset>
				</fieldset>
				
				<input type="text" name="organization" placeholder="Organization">
				<input type="text" name="title" placeholder="Title">
				<input type="submit" value="send">
			</form>
			
						
		</div>
		<div class="col right"></div>
	</div>
	-->
	
	<script type="text/javascript">
	
	var file_type = "<?=$_COOKIE['STYXKEY_file_type']?>";
	var file_title = "<?=$_COOKIE['STYXKEY_file_title']?>";
	var dlfile = "<?=$_COOKIE['STYXKEY_pdfdl']?>";
	var vidpage = "<?=$_COOKIE['STYXKEY_vidpage']?>";

	if(vidpage != '') dlfile = vidpage;

	/*
	var pdf = dlfile.split('/');
	pdf = pdf[pdf.length-1];
	*/
	window.onload = function(){
		$('.wpcf7-form>div:first-child').append('<input type="hidden" name="file_type" value="'+file_type+'">');		
		$('.wpcf7-form>div:first-child').append('<input type="hidden" name="file_title" value="'+file_title+'">');		
		$('.wpcf7-form>div:first-child').append('<input type="hidden" name="download_file" value="'+dlfile+'">');		
	}

	// //call download function
	// document.addEventListener( 'wpcf7submit', function( event ) {
	//     //get_download();
	
	// }, false );

	document.addEventListener( 'wpcf7submit', function( event ) {
	    var inputs = event.detail.inputs;
	    var valid = true;
	 
	    for ( var i = 0; i < inputs.length; i++ ) {
	        if ( 'firstname' == inputs[i].name ) {

	        	if(inputs[i].value == ""){
	        		valid = false;

	            	break;
	        	}
	            
	        }

	        if ( 'lastname' == inputs[i].name ) {

				if(inputs[i].value == ""){
	        		valid = false;
	            	break;
	        	}
	        }

	        if ( 'your-email' == inputs[i].name  ) {

	        	if(inputs[i].value == ""){
	        		valid = false;
	            	break;
	        	}
	        }



	    }

	if(valid){
	   	get_download();
	}



	}, false );
		
	
	</script>

	
	</div>
</section>

<!-- END TIER CONTENTS -->





<?php 
	
get_footer(); 

?>
