<?php
/**
 * Single Post file
 *
 * @package WordPress
 * @subpackage APIC
 */
 
$GLOBALS['topicID'] = get_field('topic_id');

$field = get_field_object('field_579f7f6350d36');
$value = get_field('topic_id');
$GLOBALS['topicFull'] = $field['choices'][$value];

$file_type = get_field('file_type');
$file_title = get_field('file_title');

$filedl = get_field('file_download');
if(get_field('file_url_for_download') != ''){$filedl = get_field('file_url_for_download');}

//Old Cookies
// setcookie("STYXKEY_file_type", $file_type, time()+604800, '/');
// setcookie("STYXKEY_file_title", $file_title, time()+604800, '/');
// setcookie("STYXKEY_pdfdl", $filedl, time()+604800, '/');

// check if has video
$hasVideo = false;
if(get_field('video_url') != ''){
	$hasVideo = true;
	$video_url = get_field('video_url');
	$video_ctatext = get_field('video_cta_text');
	$video_ctaurl = get_field('video_cta_link');
	$embed_url = explode('?v=', $video_url);
}

if($hasVideo && $_COOKIE['STYXKEY_vidreg'] == ''){
	setcookie("STYXKEY_vidpage", get_permalink(), time()+604800, '/');
} else {
	setcookie("STYXKEY_vidpage", get_permalink(), time(), '/');
}

get_header(); 

$the_date = strtotime(get_field('cfdate'));
$show_date = date('F j, Y', $the_date);
//$show_author = get_author_name();
$show_author = get_field('author');

$thumb_image_arr = get_field('thumbnail_image');
$thumb_image     = $thumb_image_arr['url'];
$thumb_image_alt = $thumb_image_arr['alt'];

$featured_image_arr = get_field('large_image');
$featured_image     = $featured_image_arr['url'];
$featured_image_alt = $featured_image_arr['alt'];

$sponsor_logo_arr = get_field('sponsor_logo');
$sponsor_logo     = $sponsor_logo_arr['url'];
$sponsor_logo_alt = $sponsor_logo_arr['alt'];
 

$sponsor_name = get_field('sponsor_name');
$post_title = get_the_title();


 
//get tags list
$tags = get_the_tags($post->ID);
$html = '';
foreach ( $tags as $tag ) {
    $tag_link = get_tag_link( $tag->term_id );
             
    $html .= "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug}'>";
    $html .= "{$tag->name}</a>, ";
}
$tag_html = trim($html,", ");

//get primary content type taxonomy
$content_types = get_post_primary_category($post->ID, 'content_type'); 
$content_type = $content_types['primary_category'];

$ct_name = $content_type->name;
$ct_link = get_term_link($content_type->term_id);



?>





<!--! BEGIN ARTICLE HEADER -->

<section id="article-header" style="background-image: url(<?=$GLOBALS['path']?>images/header-bg-<?=$GLOBALS['topicID']?>.jpg);">		
	<div class="row">
		
	<h2><?=$GLOBALS['topicFull']?></h2>
	
		<?php
				
		// If has sub pages
		if(sizeof($GLOBALS['subpages']) > 0){	
			print '<div class="subnav-menu"><div class="subnav-menu-btn">Focus Areas <span class="icon-angle-down"></span></div><nav><ul>';		
			foreach($GLOBALS['subpages'] as $key=>$subpage){			
				print '<li><a href="' . $GLOBALS['subpageurls'][$key] . '">' . $subpage . '</a></li>';
			}		
			print '</ul></nav></div>';
		}
		
		?>
	
	</div>		
</section>

<!-- END ARTICLE HEADER -->





<!--! BEGIN ARTICLE -->

<article id="article-container">
	
	<!--
	<header>
		<h1><?php the_title(); ?></h1>		
	</header>
	-->
	
	<!--<div class="article-photo" style="background-image:url(<?=$featured_image?>);">
		<img src="<?=$GLOBALS['path']?>images/article-photo-spacer.png" class="spacer">-->
		<div class="article-photo">
		<h1><?php the_title(); ?></h1>
		<!--<div class="article-photo-sponsor">
			 
		</div>-->
		<?php if($ct_name){ ?>
		<div class="ct-wrapper">
			<a class="content-type-link" href="<?=$ct_link?>"><i class="far fa-file-alt"></i>  <?=$ct_name?></a>
		</div>
		<?php } ?>
	</div>
	
	<div class="contentContainer">
		
		
		
		<div class="article-header spaced">
			<div class="article-details">
				<ul>
					<li>Posted: <strong><?=$show_date?></strong></li> 
					<li class="divline">|</li>
					<li>
						Provided By:
						
						<?php 
							
						if(get_field('sponsor_website') != ''){
							print '<a href="' . get_field('sponsor_website') . '" target="_blank">';
						}
						
						print '<img src="' . $sponsor_logo . '" alt="' . $sponsor_logo_alt . '" class="sponsor-logo">';
						
						if(get_field('sponsor_website') != ''){
							print '</a>';
						}
						
						?> 	
					</li>	
				</ul>
			</div>
			<nav class="social">
				<p>SHARE:</p>
				<?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
			</nav>
			
		</div>


		
		
			
			
		<div class="row spaced article-contents">



		<!--! BEGIN ARTICLE CONTENTS -->
		
		<div class="col left">
			
			<?php 
				
			if($hasVideo){
				if($_COOKIE['STYXKEY_vidreg'] == ''){
					print get_field('before_body_text');
				} else {
					print get_field('after_body_text');
				}
			} else {
				print apply_filters('the_content',$post->post_content);
			}
			
			if(get_field('file_download') != '' || get_field('file_url_for_download') != ''){

				$site_url = get_option( 'siteurl' );

				$filetype = get_field('file_type');

				$dltype = "PDF file";

				if($filetype == 'Video'){
					$dltext = "View Video";
					$dltype = "Video";

				}
				else{
					$dltext = "Download PDF";
					$dltype = "PDF file";
				}

				?>
				
				<!-- <a class="dl-button" href="<?php echo $site_url;?>/download-pdf"><?php echo $dltext; ?></a> -->

				<?php	

			
				//print '<div class="download-pdf">' . get_field('download_pdf_text') . '</div>';
				
				/*
				if(in_category(16)){
					print '<a href="' . $_GLOBALS['url'] . 'download-pdf/" target="_blank">Download PDF <span class="icon-angle-right"></span><a></p></div>';
				} else {
					print '<a href="' . get_field('file_download') . '" target="_blank">Download PDF <span class="icon-angle-right"></span><a></p></div>';
				}
				*/
			
			

 
			
 
			
			?>	

			<div class="tags-list">
				<span>TAGS:</span> 
				<?php echo $tag_html; ?>
			</div>

		 
			<a class="dl-button" href="<?php echo $filedl ?>" target="_blank"><?php echo $dltext; ?></a>  




			<div class="download-pdf" >
				<p>If you would like to be contacted by the sponsor for more information, please provide us with your contact information below.</p>
			</div>


			<?php gravity_form( 2, false, false, false, array('post_title' => $post_title,'sponsor' => $sponsor_name, 'dl_file_url'=>$filedl), true );?>	


			<!-- <a class="dl-button" href="<?php echo $filedl ?>" target="_blank"><?php echo $dltext; ?></a> -->

		<?php } ?>
			

		</div>
		
		<!-- END ARTICLE CONTENTS -->		
		
		
		
		<?php get_sidebar(); ?>		
		
		

		</div>
		
	</div>
</article>

<!-- END ARTICLE -->





<?php get_footer(); ?>
