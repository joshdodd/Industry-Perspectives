var mobile = false;
var mobileBreak = 768;
if($(window).width() <= mobileBreak){mobile = true;}
var is_firefox = navigator.userAgent.toLowerCase().indexOf('firefox') > -1;
var path;

//! WINDOW RESIZE

var winW;
var winH;
$(window).resize(function(){
	winW = $(window).width();
	winH = $(window).height();
	//console.log(winW);
	
	// position drop menu
	menuT = $('#globalNav').outerHeight();
	$('#menu').css('top',menuT-1);
	
	// position tier subnav
	if($('body').hasClass('page-topic') && winW>550){
		pT = Number($('#tier-hero').css('padding-top').split('px')[0]);
		pH = Number($('#tier-hero').find('h1').css('margin-bottom').split('px')[0]);
		subT = pT+pH+$('.tier-hero-text').find('h1').height();
		$('.tier-subnav').css('top',subT+'px');
		
		$('.tier-hero-text').css('height','');
		tH = $('#tier-hero .contentContainer').height()+pT;
		sH = $('.tier-subnav').children('nav').height()+subT;
		hDif = sH-tH;
		if(sH>tH){
			$('.tier-hero-text').css('height',tH+hDif);
			if(hDif>100){
				$('.tier-subnav').css('top',pT+20+'px');
				sH = $('.tier-subnav').children('nav').height()+pT;
				hDif = sH-tH;
				$('.tier-hero-text').css('height',tH+hDif);
			}
		}
	} else {
		$('.tier-subnav').css('top','');
	}
	
	
	
	// go to desktop
	
	if(winW>mobileBreak && mobile){
		mobile = false;
		mobileMenu = false;
		$('#globalNav').css({'display':'','opacity':'','left':''});
			
	
	// go to mobile 
				
	} else if(winW<=mobileBreak && !mobile){
		mobile = true;
		subMenu = false;
		$('#menu').attr('style','');
	}
	
	
	
	if($('body').attr('id') == 'page-home'){
		homeResizer();
		setTimeout(function(){
			homeResizer();
		}, 200); // prevent hiccup
	}
})
$(window).resize();
$(window).load(function(){
	$(window).resize();	
})





//! HOME RESIZE

function homeResizer(){
	$('.resources-box').css('height','')
	if(winW>1024){
		resH = $('.resources-boxes').height()/2;
		$('.resources-box').css('height',resH-5);
	} else {
		$('.resources-box').css('height','');
	}
	
	if($('.story-box:not(.filler)').length%3 != 0){
		$('.story-box.filler').show();
	}
	
	// for hero sponsor
	/*
	$('.home-feature').each(function(){
		tmpW = (winW*.2)*.75;
		if($(this).find('.hero-sponsor').width() > tmpW){
			$(this).find('.hero-sponsor').css({'max-width':tmpW, 'height':'auto'});
		} 
	})
	*/
	
}





//! HOME LATEST STORIES

$('#home-stories').find('.more-btn').click(function(){
	if(winW>1024){
		addAmt = 3;
	} else if(winW<= 1024 && winW>768){
		addAmt = 2;
	} else if(winW<=768 && winW>550){
		addAmt = 3;
	} else {
		addAmt = 2;
	}
	
	$('#home-stories').find('.hidden').each(function(i){
		if(i<addAmt){
			$(this).removeClass('hidden');
		}
	})
	
	if($('#home-stories').find('.hidden').length == 0){
		$('#home-stories').find('.more-btn').hide();
	}
	
	return false;
})






//! FILTER FOR STORIES

var filterTopic = '';
var filterOrder = '';

$('.filter-wrap').find('a').click(function(){
	if($(this).parents('.filter-wrap').attr('data-type') == 'topic'){
		filterTopic = $(this).attr('data-topic');	
	}
	if($(this).parents('.filter-wrap').attr('data-type') == 'order'){
		filterOrder = $(this).attr('data-order');	
	}
		
	setFilter();	
	return false;
})

function setFilter(){
	qstring = '';
	
	if(filterTopic != ''){
		qstring = '?topic=' + filterTopic;
	}
	if(filterOrder != ''){
		if(qstring == ''){
			qstring += '?';
		} else {
			qstring += '&';
		}
		qstring += 'order=' + filterOrder;
	}	
	
	window.location.href = fullurl+qstring;
}

$('.active-filter').click(function(){
	if($(this).attr('data-type') == 'topic'){
		filterTopic = '';
	}
	if($(this).attr('data-type') == 'order'){
		filterDate = '';
	}
	setFilter();
})





//! GLOBAL NAV

$('#globalNav').find('.main li.noSub').click(function(){
	window.location.href = $(this).children('a').attr('href');
})





//! SUB MENU

var subMenu = false;

$('#globalNav').find('.hasSub.cats').mouseenter(function(){
	if(!mobile){
		$(this).addClass('active');
		openSubmenu();	
	}
})
$('#globalNav').find('.hasSub.cats').click(function(){
	if(mobile){
		if($('.mobile-sub').height()>0){
			$('.mobile-sub').css({'height':0,'padding-top':0});
		} else {
			$('.mobile-sub').css({'height':'auto','padding-top':20});
		}
	}
})

function openSubmenu(){
	TweenMax.to('#menu', .5, {opacity:1, 'display':'block'});
	subMenu = true;	
}

$('#menu').mouseleave(function(){
	TweenMax.to('#menu', .5, {opacity:0, 'display':'none'});
	$('#globalNav').find('.hasSub').removeClass('active');
	subMenu = false;
})
$('#globalHeader, #globalNav .noSub').mouseenter(function(){
	if(subMenu){
		TweenMax.to('#menu', .5, {opacity:0, 'display':'none'});
		$('#globalNav').find('.hasSub').removeClass('active');
		subMenu = false;
	}
})

$('.filter-wrap').click(function(){
	$(this).find('nav').addClass('shown');
	$(this).find('nav').mouseleave(function(){
		$(this).removeClass('shown');
	})
})

$('.subnav-menu').click(function(){
	$(this).find('nav').css({'opacity':1,'visibility':'visible'});
})
$('.subnav-menu').mouseleave(function(){
	$(this).find('nav').css({'opacity':'','visibility':''});
})





//! MOBILE MENU

var mobileMenu = false;

$('.menu-icon').click(function(){
	$('#globalNav').css({'left':-winW});
	TweenMax.to('#globalNav', .6, {left:0, 'display':'block', ease:Power4.easeInOut});
	//TweenMax.to($(this).children('.icon-menu'), .25, {opacity:0, 'display':'none'});
	$('body').css({'width':'100%','height':'100%','overflow':'hidden'});
	mobileMenu = true;
})
$('.icon-cross').click(function(){
	TweenMax.to('#globalNav', .5, {left:-winW, 'display':'none', ease:Power4.easeInOut});
	TweenMax.to($('.menu-icon').children('.icon-menu'), .25, {opacity:1, 'display':'block'});
	$('body').css({'width':'','height':'','overflow':''});
	mobileMenu = false;
})




//! HOME HERO SLIDESHOW

if($('body').attr('id') == 'page-home'){
	var slideshow = true;
	var slideInt = 10000;
	var curSlide = 1;
	var totalSlides = $('.home-feature.slide').length;
	
	function homeSlideshow(){
		homeSlides = setInterval(function(){
			TweenMax.to($('.home-feature.slide[data-num="'+curSlide+'"]'), 1.5, {opacity:0, 'display':'none', 'z-index':1})
			$('.feature-dot[data-num="'+curSlide+'"]').removeClass('active');
			curSlide++;
			if(curSlide > totalSlides){curSlide = 1;}		
			TweenMax.to($('.home-feature.slide[data-num="'+curSlide+'"]'), 1.5, {opacity:1, 'display':'block', 'z-index':3})
			$('.feature-dot[data-num="'+curSlide+'"]').addClass('active');
		}, slideInt)
	}
	homeSlideshow();
}

$('.home-feature, .story-box:not(.nolink), .feature-story-contents, .resources-box').click(function(){
	if($(this).find('a').attr('target') == '_blank'){
		window.open($(this).find('a').attr('href'), '');
	} else {
		window.location.href = $(this).find('a').attr('href');		
	}
})
$('.home-feature, .story-box, .feature-story-contents, .resources-box').find('a').click(function(e){
	e.stopPropagation();
})


$('#home-hero').find('.feature-dot').click(function(){
	clearInterval(homeSlides);
	
	TweenMax.to($('.home-feature.slide[data-num="'+curSlide+'"]'), 1.5, {opacity:0, 'display':'none', 'z-index':1})
	$('.feature-dot[data-num="'+curSlide+'"]').removeClass('active');
	curSlide = $(this).attr('data-num');
	if(curSlide > totalSlides){curSlide = 1;}		
	TweenMax.to($('.home-feature.slide[data-num="'+curSlide+'"]'), 1.5, {opacity:1, 'display':'block', 'z-index':3})
	$(this).addClass('active');
})





//! HOME INTRO EXPAND/COLLAPSE

// var introCollapsed = false;
// if($('#home-intro').hasClass('collapsed')){
// 	introCollapsed = true;
// 	$('.home-intro-btn').find('a').html('Expand <span class="icon-angle-down"></span>');
// 	$('#home-intro-text').height(0);
// }

// $('.home-intro-btn').find('a').click(function(){
// 	if(introCollapsed){
// 		$('#home-intro-text').height('auto');
// 		tmpH = $('#home-intro-text').outerHeight();
		
// 		TweenMax.to('#home-intro-text', .5, {startAt:{height:0}, height:tmpH, ease:Expo.easeOut, onComplete:function(){
// 			$('#home-intro-text').css({'height':''})
// 		}})
// 		$('#home-intro').find('.contentContainer').removeClass('short');
		
// 		$(this).html('Collapse <span class="icon-angle-up"></span>');
// 		introCollapsed = false;
// 	} else {
// 		tmpH = $('#home-intro-text').outerHeight();
// 		$('#home-intro-text').height(tmpH);
// 		TweenMax.to('#home-intro-text', .5, {height:0, ease:Expo.easeOut})
// 		$('#home-intro').find('.contentContainer').addClass('short');
		
// 		$(this).html('Expand <span class="icon-angle-down"></span>');
// 		introCollapsed = true;
// 	}
// 	return false;
// })





//! HOME LEARN ICONS

if($('body').attr('id') == 'page-home'){
	
	var biggestH = 0;
	var biggestC = '';
	$('.home-learn-text').each(function(i){
		$(this).addClass('sizer');
		tmpH = $(this).height();
		if(tmpH>biggestH){
			biggestH = tmpH;
			biggestC = $(this).html();
		}
		$(this).removeClass('sizer');
		if(i>1){
			$(this).hide();
		}
	})
	
	$('.home-learn-text.spacer').html(biggestC);

	var learn_slideInt = 10000;
	var learnSlide = 1;
	var totalLearn = 7;
	
	function learnSlideshow(){
		learnSlides = setInterval(function(){
			
			if(!hovering){
				$('.home-learn-icons li[data-num="'+learnSlide+'"]').removeClass('active');
			}
			TweenMax.to($('.home-learn-bg[data-num="'+learnSlide+'"]'), .5, {opacity:0})
			TweenMax.to($('.home-learn-text:not(.spacer)'), .5, {opacity:0, 'display':'none'})
			
			learnSlide++;
			
			if(learnSlide > totalLearn){learnSlide = 1;}		
			
			if(!hovering){
				$('.home-learn-icons li[data-num="'+learnSlide+'"]').addClass('active');
			}
			TweenMax.to($('.home-learn-bg[data-num="'+learnSlide+'"]'), .5, {opacity:1})
			TweenMax.to($('.home-learn-text[data-num="'+learnSlide+'"]'), .5, {delay:.5, opacity:1, 'display':'block'})
			
		}, learn_slideInt)
	}
	learnSlideshow();
}

var hovering = false;

$('.home-learn-icons').find('a').each(function(){
	$(this).mouseenter(function(){
		$('.home-learn-icons').find('li').removeClass('active');
		$(this).parents('li').addClass('active');
		hovering = true;
	})
	$(this).mouseleave(function(){
		$(this).parents('li').removeClass('active');
		$('.home-learn-icons li[data-num="'+learnSlide+'"]').addClass('active');
		hovering = false;
	})
	$(this).click(function(){
		clearInterval(learnSlides);
		
		TweenMax.killTweensOf($('.home-learn-text'));
		TweenMax.to($('.home-learn-bg'), .5, {opacity:0})
		TweenMax.to($('.home-learn-text:not(.spacer)'), .5, {opacity:0, 'display':'none'})
			
		learnSlide = $(this).parents('li').attr('data-num');			
			
		TweenMax.to($('.home-learn-bg[data-num="'+learnSlide+'"]'), .5, {opacity:1})
		TweenMax.to($('.home-learn-text[data-num="'+learnSlide+'"]'), .5, {delay:.5, opacity:1, 'display':'block'})
		
		return false;
	})
})

$('.arrow-box').click(function(){
	if($(this).parents('.side-arrow').hasClass('left')){
		dir = -1;
	}
	if($(this).parents('.side-arrow').hasClass('right')){
		dir = 1;
	}
	
	clearInterval(learnSlides);
	TweenMax.killTweensOf($('.home-learn-text'));
	TweenMax.to($('.home-learn-bg'), .5, {opacity:0})
	TweenMax.to($('.home-learn-text:not(.spacer)'), .5, {opacity:0, 'display':'none'})
	$('.home-learn-icons li[data-num="'+learnSlide+'"]').removeClass('active');
	
	learnSlide += dir;	
	if(learnSlide > totalLearn){learnSlide = 1;}
	if(learnSlide == 0){learnSlide = totalLearn;}	
		
	$('.home-learn-icons li[data-num="'+learnSlide+'"]').addClass('active');
	TweenMax.to($('.home-learn-bg[data-num="'+learnSlide+'"]'), .5, {opacity:1})
	TweenMax.to($('.home-learn-text[data-num="'+learnSlide+'"]'), .5, {delay:.5, opacity:1, 'display':'block'})
})





//! PARTNER LOGO SLIDESHOW

/*
if($('body').attr('id') == 'page-home'){
	var partnersslideInt = 10000;
	var partnersSlide = 1;
	var totalPartners = 2;
	
	function partnersSlideshow(){
		partnersSlides = setInterval(function(){
			TweenMax.to($('.partner-logos').find('.row[data-num="'+partnersSlide+'"]'), .5, {autoAlpha:0})
			
			partnersSlide++;
			
			if(partnersSlide > totalPartners){partnersSlide = 1;}		
			
			TweenMax.to($('.partner-logos').find('.row[data-num="'+partnersSlide+'"]'), .5, {delay:.5, autoAlpha:1})			
			
		}, partnersslideInt)
	}
	partnersSlideshow();
}
*/






//! TOPIC LANDING SLIDESHOW

if($('body').hasClass('page-topic')){
	var slideshow = true;
	var slideInt = 10000;
	var curSlide = 1;
	var lastSlide = 1;
	var totalSlides = $('.feature-story-image').length;
	var topicTimer;
	
	function topicSlideshow(){
		topicSlides = setInterval(function(){
			curSlide++;
			if(curSlide > totalSlides){curSlide = 1;}	
			
			slideW = $('.feature-story-images').width();
			TweenMax.to($('.feature-story-image[data-num="'+lastSlide+'"]'), .75, {delay:.2, left:-slideW, 'display':'none', ease:Expo.easeInOut})
			$('.feature-dot[data-num="'+lastSlide+'"]').removeClass('active');
				
			TweenMax.to($('.feature-story-image[data-num="'+curSlide+'"]'), .75, {delay:.2, startAt:{left:slideW, 'display':'block'}, left:0, ease:Expo.easeInOut})
			$('.feature-dot[data-num="'+curSlide+'"]').addClass('active');
			
			TweenMax.to($('.feature-story-wrap'), .2, {'opacity':0, onComplete:function(){
				topicTimer = setTimeout(function(){
					$('.feature-story-contents[data-num="'+lastSlide+'"]').hide();
					$('.feature-story-contents[data-num="'+curSlide+'"]').show();
					TweenMax.to($('.feature-story-wrap'), .5, {'opacity':1});
					lastSlide = curSlide;
				}, 500);
				
			}})
			
		}, slideInt)
	}
	
	if(totalSlides > 1){
		topicSlideshow();
	} else {
		$('.feature-dots').hide();
	}
	
	$('#feature-story').find('.feature-dot').click(function(){
		clearInterval(topicSlides);
		clearTimeout(topicTimer);
		
		slideW = $('.feature-story-images').width();
		TweenMax.to($('.feature-story-image[data-num="'+lastSlide+'"]'), .75, {delay:.2, left:-slideW, 'display':'none', ease:Expo.easeInOut})
		$('.feature-dot[data-num="'+curSlide+'"]').removeClass('active');
		curSlide = $(this).attr('data-num');
		if(curSlide > totalSlides){curSlide = 1;}		
		TweenMax.to($('.feature-story-image[data-num="'+curSlide+'"]'), .75, {delay:.2, startAt:{left:slideW, 'display':'block'}, left:0, ease:Expo.easeInOut})
		TweenMax.to($('.feature-story-wrap'), .2, {'opacity':0, onComplete:function(){
			topicTimer = setTimeout(function(){
				$('.feature-story-contents[data-num="'+lastSlide+'"]').hide();
				$('.feature-story-contents[data-num="'+curSlide+'"]').show();
				TweenMax.to($('.feature-story-wrap'), .5, {'opacity':1});
				lastSlide = curSlide;
			}, 500);
			
		}})
		$(this).addClass('active');
	})
}





//! FORM SUBMIT

var formSent = false;
var formURL = $('#contactForm').attr('action');

$('#contactForm').submit(function(){
	if(validateForm($(this))){
		//sendForm();
		return true;
	}
	return false;
});
/*
function sendForm(){

// animation actions

var formData = $('#contactForm').serialize();

$.ajax({
    url: formURL,
    type: 'POST',
    data: formData,
        
    success: function(result){					
		formSent = true;
    }
});

}
*/
function validateForm(formObj){	
	var vNum = 0;
	$(formObj).find('[data-type="req"]').each(function(){
		if($(this).val() == ""){
			vNum++;
		}
	});
	if(vNum==0){
		return true;
	} else {
		alert('Please fill in all required fields');
		return false;
	}
}





//! SEARCH

var overlayOpen = false;

$('.search-icon').click(function(){
	openSearch();
	return false;
})

function openSearch(){
	$('.overlayWrap').hide();
	$('#overlay-search').show();
	
	overlayOpen = true;
	
	// freeze contents
	$('body').css({'width':'100%','height':'100%','overflow':'hidden'});
	
	$('#overlay').css({'display':'block', opacity:0});
	$('.blanket').css({'display':'block', opacity:.9});
	//TweenMax.to('.blanket', .65, {width:'100%', opacity:.9, ease:Power4.easeInOut});
	TweenMax.to('#overlay', .3, {opacity:1});
	
	$('#overlay').click(function(){
		closeOverlay();
	})
	$('#searchForm').click(function(){
		event.stopPropagation();
	})
	
	setTimeout(function(){
		$('#searchinput').focus();
	}, 100);
}

function closeOverlay(){
	TweenMax.to('#overlay', .75, {opacity:0, 'display':'none'});
	TweenMax.to($('#overlay .close-x'), .5, {scaleX:1, scaleY:1, ease:Expo.easeOut})
	$('body').css({'width':'','height':'','overflow':''});
	overlayOpen = false;
}





// turn off slideshows if you leave window
$(window).blur(function(){
	if($('body').attr('id') == 'page-home'){
		clearInterval(learnSlides);
		//clearInterval(partnersSlides);
	}
})





//! VIDEO EMBEDS

$('#article-container').find('iframe').each(function(){
	$(this).attr({'width':'','height':''});
	$(this).parents('p').addClass('video-box');
})






function get_download(){
	if(vidpage != ''){
		var now = new Date();
		now.setTime(now.getTime() + 1 * 3600 * 3);
		document.cookie = "STYXKEY_vidreg=yes; expires=" + now.toUTCString() + "; path=/";
		window.location.href = vidpage;
	}	
	else if(dlfile != ''){
		window.location.href = dlfile;
	}
}




//! SIDE BANNER ROTATION

var totalAds = $('.rotate-ad').length;
var adInt = 5000;
var curAd = 0;

if(totalAds>0){
	adRotator = setInterval(function(){
		$('.rotate-ad[data-num="'+curAd+'"]').css('display','none');
		curAd++;
		if(curAd==totalAds){curAd = 0;}
		$('.rotate-ad[data-num="'+curAd+'"]').css('display','inline-block');	
	}, adInt)
}
 
