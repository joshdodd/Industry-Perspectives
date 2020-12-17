<div class="filter-area spaced">
	
	
	<div class="story-filter col">
		
		<!--! BEGIN FILTER MENU -->
		
		<h4>Filter by:</h4>
		
		<div class="filter-wrap" data-type="order">
			<div class="filter-title"><p>Date</p><span class="icon-caret-down"></span></div>
			<nav>
				<ul>
					<li class="sub"><a href="#" data-order="new">Newest to Oldest</a></li>
					<li class="sub"><a href="#" data-order="old">Oldest to Newest</a></li>
				</ul>	
			</nav>				
		</div>
		
		<!--
		<div class="filter-wrap" data-type="type">
			<div class="filter-title"><p>Type</p><span class="icon-caret-down"></span></div>
			<nav>
				<ul>
					<li class="sub"><a href="#">Article</a></li>
					<li class="sub"><a href="#">Video</a></li>
				</ul>	
			</nav>				
		</div>
		-->
		
		<div class="filter-wrap" data-type="topic"<?php if($GLOBALS['formattedName'] == 'events'){print ' style="display:none;"';} ?>>
			<div class="filter-title"><p>Topic</p><span class="icon-caret-down"></span></div>
			<nav>
				<ul>
					
					<?php
					
					foreach($GLOBALS['sectionsFull'] as $key=>$item){
						print '<li class="sub"><a href="#" data-topic="' . $GLOBALS['queryIDs'][$key] . '">' . $item . '</a></li>';
					}
						
					?>
					
				</ul>	
			</nav>	


		</div>
		
		<!-- END FILTER MENU -->

		<div class="active-filters col">
		
			<?php
			
			//<div class="active-filter"><span>x</span><p>Old to New</p></div>
			
			if(isset($_GET['topic'])){
				$tmpcat = $_GET['topic'];
				foreach($GLOBALS['queryIDs'] as $key=>$item){	
					if($tmpcat == $item){
						print '<div class="active-filter" data-type="topic"><span>x</span><p>' . $GLOBALS['sectionsFull'][$key] . '</p></div>';
					}
				}
			}
			
			if(isset($_GET['order'])){
				if($_GET['order'] == 'old'){
					print '<div class="active-filter" data-type="order"><span>x</span><p>Oldest to Newest</p></div>';
				}
			}
				
			?>
		</div>	

	</div>
</div>