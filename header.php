<?php
/**
 * @package WordPress
 * @subpackage APIC
 */ 

$GLOBALS['url'] = get_site_url() . '/';
$GLOBALS['path'] = get_template_directory_uri() . '/';
$GLOBALS['pageName'] = strtolower(get_the_title());
$GLOBALS['pageName'] = str_replace('&#038;', '', $GLOBALS['pageName']);
$GLOBALS['pageName'] = str_replace('  ', ' ', $GLOBALS['pageName']);
$GLOBALS['pageName'] = str_replace(',', '', $GLOBALS['pageName']);
$GLOBALS['formattedName'] = str_replace(' ', '-', $GLOBALS['pageName']);
$tmpTemplate = explode('page-templates/',get_page_template_slug($post->ID));
$tmpTemplate2 = explode('.php',$tmpTemplate[1]);
$GLOBALS['templateName'] = $tmpTemplate2[0];
if($GLOBALS['templateName'] != 'topic' && !is_single()){
	$GLOBALS['topicID'] = 'default';
}
if($GLOBALS['templateName'] == 'topic'){
	$GLOBALS['topicFull'] = get_the_title();
}
if(is_single()){
	$GLOBALS['templateName'] = 'article';
}

include('colors.php');

foreach($GLOBALS['sectionIDs'] as $key=>$section){
	if($section == $GLOBALS['topicID']){
		$GLOBALS['topicNum'] = $key;
	}
}

$GLOBALS['pageColor'] = $GLOBALS['lineColors'][$GLOBALS['topicNum']];
$GLOBALS['shown_stories'] = array();

if(is_search()){
	$GLOBALS['formattedName'] = 'search';
	$GLOBALS['templateName'] = 'search';
	$GLOBALS['pageColor'] = '1373ba';
}

if(in_array($GLOBALS['templateName'], array('latest','about','galleries','contact','events',''))){
	$GLOBALS['pageColor'] = '4387c6';
	$GLOBALS['templateName'] = 'generic';
}

?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	
<title><?php wp_title( '|', true, 'right'); ?></title>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="en-us" />


<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

<link href="<?=$GLOBALS['path']?>css/normalize.css" rel="stylesheet" type="text/css" />
<link href="<?=$GLOBALS['path']?>css/fonts/fonts.css" rel="stylesheet" type="text/css" />
<link href="<?=$GLOBALS['path']?>css/icons.css" rel="stylesheet" type="text/css" />
<link href="<?=$GLOBALS['path']?>style.css" rel="stylesheet" type="text/css" />
<?php print '<script type="text/javascript">var path = "' . $GLOBALS['path'] . '";var url = "' . $GLOBALS['url'] . '";var fullurl = "' . get_permalink() . '"</script>'; ?>

<link rel="apple-touch-icon" sizes="57x57" href="<?=$GLOBALS['url']?>/wp-content/themes/Industry-Perspectives/images/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?=$GLOBALS['url']?>/wp-content/themes/Industry-Perspectives/images/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?=$GLOBALS['url']?>/wp-content/themes/Industry-Perspectives/images/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?=$GLOBALS['url']?>/wp-content/themes/Industry-Perspectives/images/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?=$GLOBALS['url']?>/wp-content/themes/Industry-Perspectives/images/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?=$GLOBALS['url']?>/wp-content/themes/Industry-Perspectives/images/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?=$GLOBALS['url']?>/wp-content/themes/Industry-Perspectives/images/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?=$GLOBALS['url']?>/wp-content/themes/Industry-Perspectives/images/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?=$GLOBALS['url']?>/wp-content/themes/Industry-Perspectives/images/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?=$GLOBALS['url']?>/wp-content/themes/Industry-Perspectives/images/favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?=$GLOBALS['url']?>/wp-content/themes/Industry-Perspectives/images/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?=$GLOBALS['url']?>/wp-content/themes/Industry-Perspectives/images/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?=$GLOBALS['url']?>/wp-content/themes/Industry-Perspectives/images/favicon/favicon-16x16.png">
<link rel="manifest" href="<?=$GLOBALS['url']?>/wp-content/themes/Industry-Perspectives/images/favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?=$GLOBALS['url']?>/wp-content/themes/Industry-Perspectives/images/favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">


<?php $sponsor_name = get_field('sponsor_name'); ?>



<?php wp_head(); ?>
<script>
	
	dataLayer.push({'contentSponsor': '<?php echo $sponsor_name; ?>',
                      'event':'sponsorTracker'});
</script>

</head>





<body id="page-<?=$GLOBALS['formattedName']?>"<?php if(!is_home()){print ' class="page-' . $GLOBALS['templateName'] . '"';} ?>>
	
	
	
	
	
<!--! BEGIN HEADER -->

<header id="globalHeader">
	<div class="row spaced">
		
		<div class="col left">
			<a href="<?=$GLOBALS['url']?>">
				<div class="logo-group">
					<div class="dsk">
						<img src="<?=$GLOBALS['path']?>images/logo-big@2x.png" alt="APIC Industry Perspectives" class="logo">
						<img src="<?=$GLOBALS['path']?>images/logo-arc-<?=$GLOBALS['topicID']?>.png" alt="logo part"  class="logo-arc">
					</div>
					<div class="mob">
						<img src="<?=$GLOBALS['path']?>images/logo-short@2x.png" alt="APIC Industry Perspectives" class="logo">
						<img src="<?=$GLOBALS['path']?>images/logo-arc-short-<?=$GLOBALS['topicID']?>.png"  alt="logo part" class="logo-arc">
					</div>
				</div>
			</a>
			
			<div class="menu-icon">
				<div class="icon-menu"></div>
			</div>
			
		</div>
		
		<div class="col right">
			<nav class="social">
				<ul>
					<li><a href="https://twitter.com/APICIPIPC" target="_blank"><span class="icon-twitter"></span></a></li>
					<li><a href="https://www.facebook.com/APICInfectionPreventionandYou" target="_blank"><span class="icon-facebook"></span></a></li>
					<li><a href="https://www.youtube.com/user/APICInc" target="_blank"><span class="icon-youtube"></span></a></li>
					<li><a href="https://www.linkedin.com/groups/5186466/profile" target="_blank"><span class="icon-linkedin"></span></a></li>
					<li><a href="<?=$GLOBALS['url']?>?feed=rss" class="rss"><span class="icon-rss"></span></a></li>	
				</ul>
			</nav>
			<nav class="toplinks">
				<ul>
					<li><a href="<?=$GLOBALS['url']?>about-us/">About Us</a></li>
					<li><a href="<?=$GLOBALS['url']?>feedback/">Feedback</a></li>
					<li><a href="http://www.apic.org" target="_blank">apic.org</a></li>
					<li><a href="<?=$GLOBALS['url']?>understanding-research/">Research</a></li>
				 
				</ul>
			</nav>
		</div>
		
	</div>
</header>

<!-- END HEADER -->





<!--! BEGIN TOP BANNER AD -->

<?php

if($GLOBALS['formattedName'] == 'home'){
	$leaderboard = get_field('leaderboard_banner');
	if($leaderboard){
		foreach($leaderboard as $key=>$row){
			$banner_img_arr = $row['banner_image'];
 
			$banner_img = $banner_img_arr['url'];
			$banner_alt = $banner_img_arr['alt'];

			$banner_mob_arr = $row['mobile_image'];
			$banner_mob = $banner_mob_arr['url'];
			$banner_mob_alt = $banner_mob_arr['alt'];
 
			$banner_url = $row['banner_link'];
			$banner_mob_url = $row['mobile_banner_link'];
		}
	} else {
		$noAd = true;
	}
}
	
?>
	
<?php 

if($noAd == true || $banner_img == ''){
} else {
	print '<div class="topbanner"><a href="' . $banner_url . '" target="_blank" class="dsk ad-click"><img src="' . $banner_img . '" class="dsk" alt="' . $banner_alt . '"></a><a href="' . $banner_mob_url . '" alt="' .$banner_mob_alt . '" target="_blank" class="mob ad-click"><img src="' . $banner_mob . '" class="mob"></a></div>';
} 

?>
	
<!-- END TOP BANNER AD -->





<!--! BEGIN GLOBAL NAV -->

<?php
	
$globalPages = array();
$globalPageURLs = array();
$subPages = array();
$subPageURLs = array();
$topicIDs = array();
$gNum = -1;
$sNum = 0;

$menu_items = wp_get_nav_menu_items('Main');
foreach($menu_items as $menu_item){
	
	// Topic
	if (!$menu_item->menu_item_parent) {
		$gNum++;
		$parent_id = $menu_item->ID;
		$globalPages[$gNum] = $menu_item->title;
		$globalPageURLs[$gNum] = $menu_item->url;
		
		// for global use
		$GLOBALS['globalPages'][$gNum] = $menu_item->title;
		$GLOBALS['globalPageURLs'][$gNum] = $menu_item->url;
		
		// get associated icon
		foreach($GLOBALS['sectionsFull'] as $key=>$sectionName){
			if(html_entity_decode($menu_item->title) == html_entity_decode($sectionName)){
				$topicIDs[$gNum] = $GLOBALS['sectionIDs'][$key];
			}
		}
		
		// set up for subnav
		$subPages[$gNum] = array();
		$sNum = 0;		
	}
	
	// Focus Area under Topic
	if ($parent_id == $menu_item->menu_item_parent){
		//print $gNum.' / '.$sNum.' / '.$menu_item->title;
		$subPages[$gNum][$sNum] = $menu_item->title;
		$subPageURLs[$gNum][$sNum] = $menu_item->url;		
		$sNum++;
	}
}

// PREPARE SUB PAGES FOR MENU
$GLOBALS['subpages'] = array();
$GLOBALS['subpageurls'] = array();
if($GLOBALS['templateName'] == 'topic' || is_single()){

	if($subPages[$GLOBALS['topicNum']]){
		foreach($subPages[$GLOBALS['topicNum']] as $key=>$subpage){	
			$GLOBALS['subpages'][] = $subpage;
			$GLOBALS['subpageurls'][] = $subPageURLs[$GLOBALS['topicNum']][$key]; 
		}
	}
	
}

// SET TOPIC COLOR STYLES
print '<style type="text/css">';
print '.subnav-menu nav li{background-color: #'.$GLOBALS['pageColor'].';}';
print '@media screen and (min-width:1025px){.subnav-menu:hover > .subnav-menu-btn, #article-header .subnav-menu nav a:hover, #tier-hero .subnav-menu nav a:hover{background-color:#fff; color: #'.$GLOBALS['pageColor'].';}}';
print '#article-container .article-contents h4{color: #'.$GLOBALS['pageColor'].';}';
print '</style>';

wp_reset_postdata();

?>






<div id="globalNav" style="border-color:#<?=$GLOBALS['pageColor']?>;">
	
	<div class="mobile-close mob"><div class="icon-cross"></div></div>

	<nav class="main">
		<ul>
			<li class="hasSub cats">
				<a href="#">Topics<span class="icon-angle-down arr"></span></a>
				<ul class="mobile-sub mob">
					<?php
						
					foreach($globalPages as $key=>$item){
						print '<li><a href="' . $globalPageURLs[$key] . '">' . $globalPages[$key] . '</a></li>';
					}
					
					?>

				</ul>
			</li>
			<li class="noSub"><a href="<?=$GLOBALS['url']?>the-latest/">The Latest</a></li>
			<li class="noSub"><a href="<?=$GLOBALS['url']?>events/">Events</a></li>
			<li class="noSub"><a href="<?=$GLOBALS['url']?>webinars/">Industry Webinars</a></li>
			<li class="noSub"><a href="<?=$GLOBALS['url']?>strategic-partner-spotlight/">Strategic Partners</a></li>
			<!-- <li class="noSub"><a href="<?=$GLOBALS['url']?>covid-19/">COVID-19 Resources</a></li> -->

			<!--<li class="noSub"><a href="<?=$GLOBALS['url']?>expert-qa/">Expert Q&As</a></li>
			<li class="noSub"><a href="<?=$GLOBALS['url']?>galleries/">Galleries</a></li>
			<li class="noSub"><a href="<?=$GLOBALS['url']?>resources-tools/">Resources & Tools</a></li>-->
			<!--<li class="hasSub">
				<a href="<?=$GLOBALS['url']?>resources-tools/">Resources & Tools<span class="icon-angle-down arr"></span></a>
			</li>
			-->
		</ul>
	</nav>
	
	<div class="search-icon">
		<p>Search</p>
		<a href="#"><span class="icon-search"></span></a>
	</div>
	
	<div class="mobile-toplinks mob">
		<nav class="social">
			<ul>
				<li class="search-icon"><a href="#"><span class="icon-search"></span></a></li>
				<li><a href="https://twitter.com/APICIPIPC" target="_blank"><span class="icon-twitter"></span></a></li>
				<li><a href="https://www.facebook.com/APICInfectionPreventionandYou" target="_blank"><span class="icon-facebook"></span></a></li>
				<li><a href="https://www.youtube.com/user/APICInc" target="_blank"><span class="icon-youtube"></span></a></li>
				<li><a href="https://www.linkedin.com/groups/5186466/profile" target="_blank"><span class="icon-linkedin"></span></a></li>
				<li><a href="<?=$GLOBALS['url']?>?feed=rss" class="rss"><span class="icon-rss"></span></a></li>
			</ul>
		</nav>
		<nav class="toplinks">
			<ul>
				<li><a href="<?=$GLOBALS['url']?>about-us/">About Us</a></li>
				<li><a href="<?=$GLOBALS['url']?>feedback/">Feedback</a></li>
				<li><a href="http://www.apic.org" target="_blank">apic.org</a></li>
				<li><a href="<?=$GLOBALS['url']?>understanding-research/">Research</a></li>
			</ul>
		</nav>
	</div>



	<!--! BEGIN DROP MENU -->
	
	<div id="menu">
		<div class="contentContainer">
			
		<div class="row spaced">
	
			<?php

			foreach($globalPages as $key=>$item){
				
				if($key == 0){
					print '<div class="col left">';
				}
				
				if($key == 3){
					print '</div><div class="col mid">';
				}
				
				if($key == 6){
					print '</div><div class="col right">';
				}

				print '<nav>';
				print '<div class="icon-' . $topicIDs[$key] . ' nav-icon" style="color:#' . $GLOBALS['iconColors'][$key] . ';"></div>';
				print '<ul>';
				print '<li class="title"><a href="' . $globalPageURLs[$key] . '">' . $globalPages[$key] . '</a></li>';
				foreach($subPages[$key] as $key2=>$item2){
					print '<li><a href="' . $subPageURLs[$key][$key2] . '">' . $subPages[$key][$key2] . '</a></li>';	
				}
				print '</ul>';
				print '</nav>';
				
				if($key == sizeof($globalPages)-1){
					print '</div>';
				}
			}
				
			?>
				
		</div>
		</div>
	</div>

	<!-- END DROP MENU -->



</div>

<!-- END GLOBAL NAV -->