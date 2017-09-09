<?php include("header.php"); ?>

<?php
 
//Function to send email 
function BasicSendEmail( $fromName, $fromEmail, $body )
{
	//The address to which the mail will be sent. Change as desired.
	$toEmail = "hello@makeitequal.org";

	//A default subject line.
	$subject = "Make It Equal Contact Form Message";

	$rand = md5(time());

	if( strlen( $fromName ) )
        $fromName		= '=?UTF-8?B?' . base64_encode($fromName)    . '?=';
	
	$message_content = "From: $fromName <$fromEmail>\n";
	$message_content .= "MIME-Version: 1.0\n";
	$message_content .= "Content-Type: multipart/mixed; boundary=\"".$rand."\"\n\n";
	$message_content .= "This is a multi-part message in MIME format.\n";
	$message_content .= "--".$rand."\n";
	$message_content .= "Content-Type: text/plain; charset=utf-8\n";
	$message_content .= "\n";

	$message_content .= "$body\n\n";

	$message_content .= "--".$rand."\n";
	
	$message_content .= "--".$rand."--";
	
	$message_content = stripslashes ($message_content);
	
	$good = mail( $toEmail, $subject, "", $message_content);

	return $good;
}

?> 
  
<div class="gray section">
<div class="container_12">  
  <div class="grid_7">
  	<h3>Contact</h3>
  	<p>Interested in getting in touch with us about the Flag of Equal Marriage? Just send an email using the form on the right side of this page.</p>

  	
  	<h4>Who's behind the Flag of Equal Marriage?</h4>
  	<p>The Flag of Equal Marriage was originally created by Carl Tashian, with assistance from his husband Karl. The two continue to guide the project today.</p>
  
  	<p>Paul Kafasis served as the project coordinator for the Flag of Equal Marriage. Web design and development on this site was expertly carried out by Maggie Steciuk.</p>

  </div>
  
<?
	//If this is the first load, we show the form.
	if (!array_key_exists( 'message_body', $_REQUEST ) || ($_REQUEST['sender_name'] == "" || $_REQUEST['sender_email'] == "" || $_REQUEST['message_body'] == "") ) 
	{ 
?>
	<div class="grid_5">
		<!--
		<h4>Get in touch:</h4>		
  		<form class="contact" action="contact.php" method="post">
		<label>Name:</label>
		<input type="text" name="sender_name" id="sender_name" placeholder="Enter your name" class="email cleardefault" />
		<label>E-mail:</label>
		<input type="text" name="sender_email" id="sender_email" placeholder="Enter your e-mail" class="email cleardefault" />
		<label>Your message:</label>
    	<textarea class="message" cols="20" id="message_body" name="message_body" rows="10"></textarea>
    	<input type="submit" value="Send your message" class="extralong standard button" />
     	</form>
     	-->
	</div> 


<?
	}
	
	//If they've already hit Send Your Message, we reload the same page, send their email, and thank them.	
	else
	{		
	//Passes the form's input to the email sending function
	BasicSendEmail($_REQUEST['sender_name'], $_REQUEST['sender_email'], $_REQUEST['message_body']);
	
	//Below, a "Thanks" message is displayed.
?>   
	<div class="grid_5">
		<div class="container thanks">
		<h4>Your message has been sent.</h4>
		<p class="caption">Thanks for getting in touch! We'll try to respond as soon as possible.</p>
		<p class="caption"><strong>The Flag of Equal Marriage</strong></p>	
		</div>  		
	</div>  
<?
	}
?>
   
	</div>  
</div>

<?php include("footer.php"); ?>