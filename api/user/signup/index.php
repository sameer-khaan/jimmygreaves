<?php
session_start();

include __DIR__ . "/../../../db.php";
include __DIR__ . "/../../../vendor/autoload.php";

$client = new MailchimpMarketing\ApiClient();

$client->setConfig([
  'apiKey' => MAILCHIMP_APIKEY,
  'server' => MAILCHIMP_SERVER
]);

$fullname = $_POST['fullname'];
$email    = $_POST['email'];
$password = $_POST['password'];
$password_hash = password_hash($password, PASSWORD_DEFAULT);
$accept_checkbox = isset($_POST['accept_checkbox']) ? $_POST['accept_checkbox'] : '0';
$status = ($accept_checkbox == '1') ? 'subscribed' : 'cleaned';
// $verify = password_verify($password, $password_hash); 
$header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
$payload = json_encode(['fullname' => $fullname,'email'=>$email]);
$base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
$base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
$signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, 'abC123!', true);
$base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
$token = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

$sql="SELECT * FROM user WHERE email='$email'";
$result = $conn->query($sql);
if($result->num_rows != 0)
{
	$return['status']=400;
	$return['message']="Alread exist";
}	 
else{
    $query_insert = "INSERT INTO user (fullname,email,password,token,mailing_list) VALUES ('$fullname', '$email', '$password_hash','$token','$accept_checkbox')";
	$result1 = $conn->query($query_insert);
	$id = $conn->insert_id;
	$return['status']=200;
	$return['token']=$token;
	$return['user_name']=$fullname;
	$return['user_id']=$id;
	$return['email']=$email;
	$_SESSION['login_flag']="1";
	$_SESSION['token']=$token;
	$_SESSION['user_name']=$fullname;
	$_SESSION['user_id']=$id;
	$_SESSION['email']=$email;
	try {
		$response = $client->lists->addListMember(MAILCHIMP_LISTID, [
			"email_address" => $email,
			"merge_fields" => [
				"FNAME" => $fullname
			],
			"status" => $status,
		]);
	}
	catch(Exception $e) {
	}
}

echo json_encode($return);
?>