<?php
include __DIR__ . "/../db.php";
$request = $_POST['request'];

if($request=="get_auctions"){
	$sql="SELECT a.*, IFNULL(d.bid_cnt, 0) AS bid_count, (SELECT IFNULL(MAX(bid_amount), a.init_price) FROM auction_detail auc WHERE auc.auction_id=d.auction_id) as max_amount 
	FROM auctions a LEFT JOIN (SELECT auction_id, COUNT(id) AS bid_cnt FROM auction_detail GROUP BY auction_id) d ON a.id = d.auction_id";
	$result = $conn->query($sql);
    $rows = array();
	if($result->num_rows != 0)
	{
		while ($row = $result -> fetch_assoc()) {
	       $rows[] = $row;

	    }
		$return['status']=200;
		$return['data']=$rows;
	}	 
	else{
		$return['status']=201;
		$return['message']="There is no result";
	}
	echo json_encode($return);
}

if($request=="get_auction_by_id"){
	$id = $_POST['id'];
	$sql="SELECT * FROM auctions WHERE id='$id'";
		$result = $conn->query($sql);
    $rows = array();
	if($result->num_rows != 0)
	{
		$row = $result -> fetch_assoc();
		$return['status']=200;
		$return['data']=$row;
	}	 
	else{
		$return['status']=201;
		$return['message']="There is no result";
	}
	echo json_encode($return);
}

if($request=="get_biders"){
	$id = $_POST['id'];
	$sql="SELECT u.fullname, u.email, d.* FROM user u, auction_detail d WHERE u.id=d.user_id AND d.auction_id='$id' ORDER BY d.bid_amount desc";
	$result = $conn->query($sql);
    $rows = array();
	if($result->num_rows != 0)
	{
		while ($row = $result -> fetch_assoc()) {
	       $rows[] = $row;
	    }
		$return['status']=200;
		$return['data']=$rows;
	}	 
	else{
		$return['status']=201;
		$return['message']="There is no result";
	}
	echo json_encode($return);
}

if($request=="get_biders_user"){
	$user_id = $_POST['user_id'];
	$sql="SELECT a.*, d.bid_amount, (SELECT count(*) FROM auction_detail auc WHERE auc.auction_id=d.auction_id) as 'total_bids', (SELECT MAX(bid_amount) FROM auction_detail auc WHERE auc.auction_id=d.auction_id) as 'max_amount' 
			FROM auction_detail d, auctions a 
			WHERE d.auction_id=a.id 
			AND d.bid_amount = (SELECT MAX(bid_amount) FROM auction_detail WHERE auction_detail.auction_id = d.auction_id AND auction_detail.user_id=d.user_id)
			AND d.user_id='$user_id'
			GROUP BY d.auction_id";

	$result = $conn->query($sql);
    $rows = array();
	if($result->num_rows != 0)
	{
		while ($row = $result -> fetch_assoc()) {
	       $rows[] = $row;
	    }
		$return['status']=200;
		$return['data']=$rows;
	}	 
	else{
		$return['status']=201;
		$return['message']="No bids placed yet";
	}
	echo json_encode($return);
}

if($request=="get_buyers"){
	$id = $_POST['id'];
	$sql="SELECT u.fullname, u.email, d.* FROM user u, raffle_detail d WHERE u.id=d.user_id AND d.raffle_id='$id'";
	$result = $conn->query($sql);
    $rows = array();
	if($result->num_rows != 0)
	{
		while ($row = $result -> fetch_assoc()) {
	       $rows[] = $row;

	    }
		$return['status']=200;
		$return['data']=$rows;
	}	 
	else{
		$return['status']=201;
		$return['message']="There is no result";
	}
	echo json_encode($return);
}

if($request=="get_buyers_user"){
	$user_id = $_POST['user_id'];
	$sql="SELECT u.fullname, u.email, a.*, d.buy_amount, d.price 
			FROM user u, raffle_detail d, raffle a 
				WHERE u.id=d.user_id 
				AND d.raffle_id=a.id 
				AND d.user_id='$user_id'";

	$result = $conn->query($sql);
    $rows = array();
	if($result->num_rows != 0)
	{
		while ($row = $result -> fetch_assoc()) {
	       $rows[] = $row;
	    }
		$return['status']=200;
		$return['data']=$rows;
	}	 
	else{
		$return['status']=201;
		$return['message']="No tickets bought yet";
	}
	echo json_encode($return);
}

if($request=="get_donates"){
	$sql="
		SELECT u.fullname, u.email, d.* FROM user u, donate d WHERE u.id=d.user_id";
	$result = $conn->query($sql);
    $rows = array();
	if($result->num_rows != 0)
	{
		while ($row = $result -> fetch_assoc()) {
	       $rows[] = $row;

	    }
		$return['status']=200;
		$return['data']=$rows;
	}	 
	else{
		$return['status']=201;
		$return['message']="There is no result";
	}
	echo json_encode($return);
}

if($request=="get_contact"){
	$sql="SELECT * FROM contact order by id desc";
	$result = $conn->query($sql);
    $rows = array();
	if($result->num_rows != 0)
	{
		while ($row = $result -> fetch_assoc()) {
	       $rows[] = $row;

	    }
		$return['status']=200;
		$return['data']=$rows;
	}	 
	else{
		$return['status']=201;
		$return['message']="There is no result";
	}
	echo json_encode($return);
}

if($request=="get_users"){
	$sql="SELECT * FROM user WHERE email != '' order by admin desc, id desc";
	$result = $conn->query($sql);
    $rows = array();
	if($result->num_rows != 0)
	{
		while ($row = $result -> fetch_assoc()) {
	       $rows[] = $row;

	    }
		$return['status']=200;
		$return['data']=$rows;
	}	 
	else{
		$return['status']=201;
		$return['message']="There is no result";
	}
	echo json_encode($return);
}

if($request=="create_auction"){
	$name = $_POST['name'];
	$desc = $_POST['desc'];
	$delivery = $_POST['delivery'];
	$terms = $_POST['terms'];
	$price = $_POST['price'];
	$endtime = $_POST['endtime'];
	$create_time = date("Y-m-d h:i:sa");
	$sql = "INSERT INTO auctions (auction_name,description,delivery,terms,status,create_time,end_time,image,image_full,init_price) VALUES ('".$name."','".$desc."','".$delivery."','".$terms."','0','".$create_time."','".$endtime."','[]','[]','$price')";

	$result = $conn->query($sql);
	$insert_id = $conn->insert_id;
	$return['status']=200;
	$return['id']=$insert_id;
	mkdir("upload/auction/".$insert_id, 0777, true);
	echo json_encode($return);

}

if($request=="edit_auction"){
	$name = $_POST['name'];
	$desc = $_POST['desc'];
	$delivery = $_POST['delivery'];
	$terms = $_POST['terms'];
	$endtime = $_POST['endtime'];
	$id = $_POST['id'];
	$price = $_POST['price'];
	$sql = "UPDATE auctions SET auction_name='".$name."',description='".$desc."',delivery='".$delivery."',terms='".$terms."',end_time='".$endtime."',init_price='".$price."' WHERE id='".$id."'";
	$result = $conn->query($sql);
	$insert_id = $conn->insert_id;
	$return['status']=200;
	echo json_encode($return);
}

if($request=="save_auction_image"){
	$id = $_POST['id'];
	$image = $_POST['images'];
	$sql = "UPDATE auctions SET image='".$image."' WHERE id='".$id."'";
	$result = $conn->query($sql);
	$insert_id = $conn->insert_id;
	$return['status']=200;
	echo json_encode($return);
}

if($request=="save_auction_image_full"){
	$id = $_POST['id'];
	$image = $_POST['images'];
	$sql = "UPDATE auctions SET image_full='".$image."' WHERE id='".$id."'";
	$result = $conn->query($sql);
	$insert_id = $conn->insert_id;
	$return['status']=200;
	echo json_encode($return);
}

if($request=="auction_paid"){
	$id = $_POST['id'];
	$amount = $_POST['amount'];
	$sql = "UPDATE auctions SET paid_price='".$amount."', paid_status='paid' WHERE id='".$id."'";
	$result = $conn->query($sql);
	$return['status']=200;
	echo json_encode($return);
}

if($request=="save_bid"){
	$id = $_POST['id'];
	$user_id = $_POST['user_id'];
	$bid_amount = $_POST['bid_amount'];
	$create_time = date("Y-m-d h:i:sa");

	$sql="SELECT * FROM user WHERE id='$user_id'";
	$result = $conn->query($sql);
    $rowUser = $result->fetch_assoc();

	$sql="SELECT * FROM auctions WHERE id='$id'";
	$result = $conn->query($sql);
    $rowRes = $result->fetch_assoc();

	$sql = "INSERT INTO auction_detail (user_id,auction_id,bid_amount,bid_time,status) VALUES ('".$user_id."','".$id."','".$bid_amount."','".$create_time."','0')";
	$result = $conn->query($sql);
	$insert_id = $conn->insert_id;

	$data = array(
		'userName' => $rowUser['fullname'],
		'userEmail' => $rowUser['email'],
		'auctionName' => $rowRes['auction_name'],
		'bidAmount' => $bid_amount
	);

	$return['status']=200;
	$return['id']=$insert_id;
	$return['data']=$data;
	echo json_encode($return);
}

if($request=="buy_raffle"){
	$id = $_POST['id'];
	$user_id = $_POST['user_id'];
	$price = $_POST['price'];
	$buy_amount = $_POST['buy_amount'];
	$create_time = date("Y-m-d h:i:sa");

	$sql="SELECT * FROM user WHERE id='$user_id'";
	$result = $conn->query($sql);
    $rowUser = $result->fetch_assoc();

	$sql="SELECT * FROM raffle WHERE id='$id'";
	$result = $conn->query($sql);
    $rowRes = $result->fetch_assoc();

	$sql = "INSERT INTO raffle_detail (user_id,raffle_id,buy_amount,price,buy_time,status) VALUES ('".$user_id."','".$id."','".$buy_amount."','".$price."','".$create_time."','0')";
	$result = $conn->query($sql);
	$insert_id = $conn->insert_id;

	$data = array(
		'userName' => $rowUser['fullname'],
		'userEmail' => $rowUser['email'],
		'raffleName' => $rowRes['raffle_name'],
		'totalTickets' => $buy_amount,
		'buyAmount' => $price*1,
		'amountPaid' => $price*$buy_amount
	);

	$return['status']=200;
	$return['id']=$insert_id;
	$return['data']=$data;
	echo json_encode($return);
}

if($request=="contact"){
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$number = mysqli_real_escape_string($conn, $_POST['number']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$message = mysqli_real_escape_string($conn, $_POST['message']);

	$sql = "INSERT INTO contact (name,number,email,message) VALUES ('".$name."','".$number."','".$email."','".$message."')";
	$result = $conn->query($sql);

	$data = array(
		'name' => $name,
		'number' => $number,
		'email' => $email,
		'message' => $message
	);

	$return['status']=200;
	$return['data']=$data;
	echo json_encode($return);
}

if($request=="buy_donate"){
	$user_id = $_POST['user_id'];
	$price = $_POST['price'];
	$add_gift = isset($_POST['add_gift']) ? $_POST['add_gift'] : '0';
	$create_time = date("Y-m-d h:i:sa");

	$sql="SELECT * FROM user WHERE id='$user_id'";
	$result = $conn->query($sql);
    $rowUser = $result->fetch_assoc();

	$sql = "INSERT INTO donate (user_id,amount,create_time,add_gift,status) VALUES ('".$user_id."','".$price."','".$create_time."','".$add_gift."','0')";
	$result = $conn->query($sql);
	$insert_id = $conn->insert_id;

	$data = array(
		'userName' => $rowUser['fullname'],
		'userEmail' => $rowUser['email'],
		'amountPaid' => $price
	);

	$return['status']=200;
	$return['id']=$insert_id;
	$return['data']=$data;
	echo json_encode($return);
}


//raffle
if($request=="get_raffles"){
	// $sql="SELECT * FROM raffle";
	$sql="SELECT r.*, IFNULL(d.buyer_cnt, 0) AS buyer_count, IFNULL(e.ticket_cnt, 0) AS ticket_sold FROM raffle r LEFT JOIN (SELECT raffle_id, COUNT(raffle_id) AS buyer_cnt FROM raffle_detail GROUP BY raffle_id) d ON r.id = d.raffle_id LEFT JOIN (SELECT raffle_id, SUM(buy_amount) AS ticket_cnt FROM raffle_detail GROUP BY raffle_id) e ON r.id = e.raffle_id";
	$result = $conn->query($sql);
    $rows = array();
	if($result->num_rows != 0)
	{
		while ($row = $result -> fetch_assoc()) {
	       $rows[] = $row;

	    }
		$return['status']=200;
		$return['data']=$rows;
	}	 
	else{
		$return['status']=201;
		$return['message']="There is no result";
	}
	echo json_encode($return);
}

if($request=="get_raffle_by_id"){
	$id = $_POST['id'];
	$sql="SELECT * FROM raffle WHERE id='$id'";
	$result = $conn->query($sql);
    $rows = array();
	if($result->num_rows != 0)
	{
		$row = $result -> fetch_assoc();
		$return['status']=200;
		$return['data']=$row;
	}	 
	else{
		$return['status']=201;
		$return['message']="There is no result";
	}
	echo json_encode($return);
}


if($request=="create_raffle"){
	$name = $_POST['name'];
	$desc = $_POST['desc'];
	$delivery = $_POST['delivery'];
	$terms = $_POST['terms'];
	$price = $_POST['price'];
	$endtime = $_POST['endtime'];
	$create_time = date("Y-m-d h:i:sa");
	$sql = "INSERT INTO raffle (raffle_name,description,delivery,terms,status,create_time,end_time,image,image_full,price) VALUES ('".$name."','".$desc."','".$delivery."','".$terms."','0','".$create_time."','".$endtime."','[]','[]','$price')";
	$result = $conn->query($sql);
	$insert_id = $conn->insert_id;
	$return['status']=200;
	$return['id']=$insert_id;
	mkdir("upload/raffle/".$insert_id, 0777, true);
	echo json_encode($return);

}

if($request=="edit_raffle"){
	$name = $_POST['name'];
	$desc = $_POST['desc'];
	$delivery = $_POST['delivery'];
	$terms = $_POST['terms'];
	$endtime = $_POST['endtime'];
	$id = $_POST['id'];
	$price = $_POST['price'];
	$sql = "UPDATE raffle SET raffle_name='".$name."',description='".$desc."',delivery='".$delivery."',terms='".$terms."',end_time='".$endtime."',price='".$price."' WHERE id='".$id."'";
	$result = $conn->query($sql);
	$insert_id = $conn->insert_id;
	$return['status']=200;
	echo json_encode($return);
}

if($request=="save_raffle_image"){
	$id = $_POST['id'];
	$image = $_POST['images'];
	$sql = "UPDATE raffle SET image='".$image."' WHERE id='".$id."'";
	$result = $conn->query($sql);
	$insert_id = $conn->insert_id;
	$return['status']=200;
	echo json_encode($return);
}

if($request=="save_raffle_image_full"){
	$id = $_POST['id'];
	$image = $_POST['images'];
	$sql = "UPDATE raffle SET image_full='".$image."' WHERE id='".$id."'";
	$result = $conn->query($sql);
	$insert_id = $conn->insert_id;
	$return['status']=200;
	echo json_encode($return);
}

if($request=="delete_auction"){
	$id = $_POST['id'];
	$sql = "DELETE FROM auctions WHERE id='$id'";
	$result = $conn->query($sql);
	$insert_id = $conn->insert_id;
	$return['status']=200;
	echo json_encode($return);
}

if($request=="delete_raffle"){
	$id = $_POST['id'];
	$sql = "DELETE FROM raffle WHERE id='$id'";
	$result = $conn->query($sql);
	$insert_id = $conn->insert_id;
	$return['status']=200;
	echo json_encode($return);
}

if($request=="delete_donate"){
	$id = $_POST['id'];
	$sql = "DELETE FROM donate WHERE id='$id'";
	$result = $conn->query($sql);
	$insert_id = $conn->insert_id;
	$return['status']=200;
	echo json_encode($return);
}

if($request=="delete_contact"){
	$id = $_POST['id'];
	$sql = "DELETE FROM contact WHERE id='$id'";
	$result = $conn->query($sql);
	$insert_id = $conn->insert_id;
	$return['status']=200;
	echo json_encode($return);
}



?>