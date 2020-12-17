<?php					
			
if(!empty($side_banner_img)){
	print '<p style="width:100%; text-align:center; margin-bottom:15px; font-size:14px;">ADVERTISEMENTS</p>';
	
	foreach($side_banner_img as $key=>$row){
		if($key>0){
			print '<div style="display:none;" ';
		} else {
			print '<div ';
		}
		
		print 'class="ad rotate-ad" data-num="' . $key . '"><a href="' . $side_banner_url[$key] . '" target="_blank" class="ad-click"><img src="' . $side_banner_img[$key] . '" class="spacer"></a></div>';
	}
}			

?>