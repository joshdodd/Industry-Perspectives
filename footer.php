<?php
/**
 * @package WordPress
 * @subpackage APIC
 */
 
?>





<!--! BEGIN FOOTER -->

<footer id="globalFooter">
	<div class="contentContainer">
		
		<div class="row top spaced">
			<div class="col">
				<img src="<?=$GLOBALS['path']?>images/footer-logo@2x.jpg" alt="APIC Industry Perspectives" class="spacer footer-logo">
				<ul class="social mob">
					<li><a href="https://twitter.com/APICIPIPC" target="_blank"><span class="icon-twitter"></span></a></li>
					<li><a href="https://www.facebook.com/APICInfectionPreventionandYou" target="_blank"><span class="icon-facebook"></span></a></li>
					<li><a href="https://www.youtube.com/user/APICInc" target="_blank"><span class="icon-youtube"></span></a></li>
					<li><a href="https://www.linkedin.com/groups/5186466/profile" target="_blank"><span class="icon-linkedin"></span></a></li>
					<li><a href="<?=$GLOBALS['url']?>?feed=rss" class="rss"><span class="icon-rss"></span></a></li>	
				</ul>
			</div>
			
			<div class="col">
				<ul>
					<li class="title"><a href="<?=$GLOBALS['url']?>the-latest/">Topics</a></li> 
					<?php
						
					foreach($GLOBALS['globalPages'] as $key=>$item){
						if($key<=count($GLOBALS['globalPages'])/2){
							print '<li class="sub"><a href="' . $GLOBALS['globalPageURLs'][$key] . '">' . $GLOBALS['globalPages'][$key] . '</a></li>';
						} else {
							print '<li class="sub hidden"><a href="' . $GLOBALS['globalPageURLs'][$key] . '">' . $GLOBALS['globalPages'][$key] . '</a></li>';		
						}
					}
					
					?>
				</ul>
			</div>
			
			<div class="col">
				<ul>
					<li class="title filler"><a href="#">filler</a></li> 
					<?php
						
					foreach($GLOBALS['globalPages'] as $key=>$item){
						if($key>count($GLOBALS['globalPages'])/2){
							print '<li class="sub"><a href="' . $GLOBALS['globalPageURLs'][$key] . '">' . $GLOBALS['globalPages'][$key] . '</a></li>';
						}
					}
					
					?>
				</ul>
			</div>
			
			<div class="col">
				<ul>
					<li class="title"><a href="<?=$GLOBALS['url']?>about-us/">About Us</a></li>
					<li class="sub"><a href="<?=$GLOBALS['url']?>strategic-partners/">Partners</a></li>
					<li class="sub"><a href="<?=$GLOBALS['url']?>feedback/">Feedback</a></li>
					<li class="sub"><a href="http://www.apic.org" target="_blank">APIC.org</a></li>
					<li class="sub"><a href="<?=$GLOBALS['url']?>terms-and-conditions/">Terms & Conditions</a></li>
					<li class="sub"><a href="<?=$GLOBALS['url']?>private-policy/">Privacy Policy</a></li>
				</ul>
			</div>
			
			<div class="col social dsk">
				<ul>
					<li><a href="https://twitter.com/APICIPIPC" target="_blank"><span class="icon-twitter"></span></a></li>
					<li><a href="https://www.facebook.com/APICInfectionPreventionandYou" target="_blank"><span class="icon-facebook"></span></a></li>
					<li><a href="https://www.youtube.com/user/APICInc" target="_blank"><span class="icon-youtube"></span></a></li>
					<li><a href="https://www.linkedin.com/groups/5186466/profile" target="_blank"><span class="icon-linkedin"></span></a></li>
					<li><a href="<?=$GLOBALS['url']?>?feed=rss" class="rss"><span class="icon-rss"></span></a></li>	
				</ul>
			</div>
	
		</div>
		
		<div class="row bottom">
			<div class="col">
				<p>Powered by</p>
				<img src="<?=$GLOBALS['path']?>images/APIC_Logo_Horz_Fullname_web.jpg" alt="APIC logo" class="bottom-logo">
			</div>
		</div>
		
	</div>	
</footer>

<!-- END FOOTER -->





<!--! BEGIN SEARCH -->

<div id="overlay">
<div class="blanket"></div>
	
	<div class="overlayWrap" id="overlay-search">
	<div class="overlay-box"><div>
		
		<div id="searchForm">
			<div class="contentContainer">
			<form id="search-form" name="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="post">
				<input type="text" id="searchinput" name="s" placeholder="Search">
				<input type="hidden" name="s_page" value="1">
				<button type="submit"><span class="icon-search"></span></button>
			</form>
			</div>
		</div>
		
	</div></div>
	</div>
	
</div>

<!-- END SEARCH -->






<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
<script src="<?=$GLOBALS['path']?>js/apic.js"></script>

<script type="text/javascript">
if($('body').hasClass('page-article')){
	$(window).load(function(){
		var sponsor_email = '<?php echo get_field('sponsor_email'); ?>';
		tmp = $('.a2a_button_email').html();
		$('.a2a_button_email').remove();
		if(sponsor_email != ''){	
			//newbtn = '<a href="mailto:'+sponsor_email+'"><span class="a2a_svg a2a_w__default a2a_w_email"></span></a>';
			
			newbtn = '<a href="mailto:'+sponsor_email+'" title="Email" rel="nofollow" target="_blank"><span class="a2a_svg a2a_s__default a2a_s_email" style="background-color: rgb(153, 214, 214);"><svg focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32"><path fill="#FFF" d="M26 21.25v-9s-9.1 6.35-9.984 6.68C15.144 18.616 6 12.25 6 12.25v9c0 1.25.266 1.5 1.5 1.5h17c1.266 0 1.5-.22 1.5-1.5zm-.015-10.765c0-.91-.265-1.235-1.485-1.235h-17c-1.255 0-1.5.39-1.5 1.3l.015.14s9.035 6.22 10 6.56c1.02-.395 9.985-6.7 9.985-6.7l-.015-.065z"></path></svg></span><span class="a2a_label">Email</span></a>';


			$('.a2a_button_print').after(newbtn);		
		} 
	})	
}
</script>
<style type="text/css">
#article-container .article-photo h1 span{color: #<?=$GLOBALS['pageColor']?>;}
</style>

<!-- Twitter universal website tag code -->
<script>
!function(e,t,n,s,u,a){e.twq||(s=e.twq=function(){s.exe?s.exe.apply(s,arguments):s.queue.push(arguments);
},s.version='1.1',s.queue=[],u=t.createElement(n),u.async=!0,u.src='//static.ads-twitter.com/uwt.js',
a=t.getElementsByTagName(n)[0],a.parentNode.insertBefore(u,a))}(window,document,'script');
// Insert Twitter Pixel ID and Standard Event data below
twq('init','nxr3a');
twq('track','PageView');
</script>
<!-- End Twitter universal website tag code -->

<?php wp_footer(); ?>

</body>
</html>