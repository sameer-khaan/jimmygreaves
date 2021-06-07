<?php
include __DIR__ . "/db.php";

    $subject = "Bid Placed";

	$message = "<html>
	<head>
	<title>HTML email</title>
	</head>
	<body>
	<p>Hello test</p>
	<p>
		You bid has been placed successfully. We will get in touch with you soon.
	</p>
	<br>

	<p>
		<b>Auction Item: </b> test1
	</p>
	<p>
		<b>Bid Amount: </b> $20
	</p>
	<br><br>

	<p>Thanks</p>
	</body>
	</html>";
    // Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	// More headers
	$headers .= 'From: '.$_GLOBAL['from_name'].' <'.$_GLOBAL['from_email'].'>' . "\r\n";

	//sent to user
	if(mail('sameerkhan5130@gmail.com',$subject,$message,$headers)){
        echo 'mail sent!';
    }
    else {
        echo 'mail not sent!';
        print_r(error_get_last());
    }
?>