<?PHP

if($_POST['form_type'] == 'feedback'){
	
	$message = "Name: " . $_POST['name'] . "\n";
	$message .= "Email: " . $_POST['email'] . "\n\n";
	
	$message .= "Message:\n" . $_POST['message'] . "\n";
	$message = stripslashes($message);
	
	$subject = 'Feedback Form Submission from APIC Industry Perspectives Website';

}

if($_POST['form_type'] == 'download'){
		
	$message = "First Name: " . $_POST['first_name'] . "\n";
	$message .= "Last Name: " . $_POST['last_name'] . "\n";
	$message .= "Email: " . $_POST['email'] . "\n";		
	$message .= "Organization: " . $_POST['organization'] . "\n";
	$message .= "Title: " . $_POST['title'] . "\n";	
	$message .= "APIC member: " . $_POST['member'] . "\n";
	$message .= "Share email with the sponsor: " . $_POST['share'];
	$message = stripslashes($message);
	
	$subject = 'Download PDF Form Submission from APIC Industry Perspectives Website';

}


//$toEmail = "justin@jlern.com";
$toEmail = "industryperspectives@apic.org";

$email = $_POST['email']; 

mail($toEmail,$subject,$message,"From: ".$email);

setcookie("pdfdl", null, time()-3600, '/');

header('Location:' . $_POST['thanks_page']);

?>