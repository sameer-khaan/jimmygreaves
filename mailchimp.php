<?php

require_once('vendor/autoload.php');

$client = new MailchimpMarketing\ApiClient();

$client->setConfig([
  'apiKey' => 'fd194716bec5c6fbdff48d332b4c5190-us5',
  'server' => 'us5'
]);

$list_id = 'b9eece34b4';

try {
  //$response = $mailchimp->ping->get();
  //$response = $client->lists->getAllLists();
  //$response = $client->lists->getList($list_id);
  // $response = $client->lists->getListMembersInfo($list_id);
  // $response = $client->lists->tagSearch($list_id);

  $response = $client->lists->addListMember($list_id, [
    "email_address" => "test@gmail.com",
    "merge_fields" => [
      "FNAME" => "Sameer",
    ],
    "status" => "cleaned",
  ]);

  // $response = $client->lists->addListMember($list_id, [
  //   "email_address" => "sameer@gmail.com",
  //   "merge_fields" => [
  //     "FNAME" => "Sameer",
  //     "LNAME" => "Khan"
  //   ],
  //   "tags" => [
  //       "id" => 2086134,
  //       "name" => "Contact Form"
  //   ],
  //   "status" => "cleaned",
  // ]);

  // $response = $client->lists->setListMember($list_id, "0ca5f1f06fd09c09f0376f66c5c92a97", [
  //   "status" => "cleaned"
  //   // "merge_fields" => [
  //   //   "FNAME" => "Sameer",
  //   //   "LNAME" => "Khan"
  //   // ]
  // ]);
  // $response = $client->lists->deleteListMemberPermanent(
  //   $list_id,
  //   "be00630d886f20c5ce3c29587547f3de"
  // );
}
catch(Exception $e) {
  echo 'Message: ' .$e->getMessage();
}

echo '<pre>';
print_r($response);
echo '</pre>';

?>