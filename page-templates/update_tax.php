<?php 

/*
Template Name: Taxonomy Update
*/

//loop through CSV and set title/taxonomies
 

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);


echo "<br><br><br>";
$dir = getcwd();
$filename = $dir. '/wp-content/themes/Industry-Perspectives/taxonomies.csv';


$row = 0;
if (($handle = fopen($filename, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
 
        $row++;
 
        if($row == 1) continue;
 
        $ptitle = $data[0];

        $topics = array($data[3],$data[4]); //Secondary topic can be $data[4]

        $content_type = array($data[5]);

        $tags = array($data[6],$data[7],$data[8],$data[9],$data[10]);

 		$this_post = get_page_by_title( $ptitle, OBJECT, 'post' );


 		$topic_acf = "";

 		switch ($data[3]) {
		    case "Hand Hygiene":
		        $topic_acf = "hand";
		        break;
		    case "Decontamination, Disinfection and Sterilization":
		        $topic_acf = "decontamination";
		        break;
		    case "HAIs: Types and Pathogens":
		        $topic_acf = "pathogens";
		        break;
		    case "Health Information Technology":
		        $topic_acf = "technology";
		        break;
		    case "Environmental Infection":
		        $topic_acf = "environment";
		        break;
		    case "COVID-19":
		        $topic_acf = "covid-19";
		        break;
		    case "Diagnostics":
		        $topic_acf = "diagnostics";
		        break;                
		}
 
		if($this_post){
			$pid = $this_post->ID;
		 
			//set Categories
			wp_set_object_terms($pid, $topics, 'category');

			$category = get_term_by('name', $data[3], 'category');


			update_post_meta($pid, "_yoast_wpseo_primary_category", $category->term_id );

			update_post_meta($pid, "topic_id", $topic_acf);

			//set tags
			wp_set_post_terms($pid, $tags, 'post_tag');

			//set content typs
			wp_set_object_terms($pid, $content_type, 'content_type');

			echo $row . ': <span style="color: green;">['.$pid. '] ' .$ptitle.' Updated</span><br>';


		}
		else{

			//list out not found
			echo $row . ': <span style="color: red;">['.$pid. '] ' .$ptitle.' Not Found</span><br>';
		}





    }
    fclose($handle);
}



?>




